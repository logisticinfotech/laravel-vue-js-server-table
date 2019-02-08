<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function getData()
    {
        $result = [];
        try {

            $users = Users::select('name', 'id')->get();
            $users = $users->map(function ($result) {
                return ['value' => $result->id, 'label' => $result->name];
            });

            $result['data'] = $users;
            $result['code'] = 200;

        } catch (\Exception $e) {
            $result['code'] = 400;
            $result['message'] = $e->getMessage();
        }
        return response()->json($result, $result['code']);
    }

    public function getServerTable(Request $request)
    {
        $result = [];
        try {

            $total_users = Users::count();

            $users = Users::select('users.*');

            if(isset($request->orderBy)){

                if($request->ascending == 1){

                    $users = $users->orderBy($request->orderBy, "asc");
                } else {
                    $users = $users->orderBy($request->orderBy, "desc");
                }
            }

            if (isset($request->user) && $request->user != '') {

                $users = $users->where('users.id', $request->user);
            }

            if (isset($request->user_search) && $request->user_search != '') {

                $searchString = $request->user_search;
                $users = $users->where(function($query) use($searchString) {
                    $query->where("users.name", "LIKE", DB::raw("'".$searchString."%'"));
                    $query->orWhere("users.email", "LIKE", DB::raw("'".$searchString."%'"));
                });
            }

            $limit = $request->limit;
            $page = $request->page;

            $users = $users->skip(($page - 1) * $limit)->take($limit)->get();

            $users->map(function ($query) {});

            $result['data'] = $users;
            $result['count'] = $total_users;
            $result['code'] = 200;

        } catch (\Exception $e) {
            $result['code'] = 400;
            $result['message'] = $e->getMessage();
        }
        return response()->json($result, $result['code']);
    }
}

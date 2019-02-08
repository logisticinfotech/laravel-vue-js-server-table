<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Vue Js Server Table</div>

                    <div class="card-body">
                        <div class="col-md-12 vue-custom">
                            <div class="form-group vue-custom-filter">
                                <label>Select User:</label>
                                <select class="form-control" name="user" id="user_select" @change="applyUser()">
                                    <option value=''>All Users</option>
                                    <option v-for="(user,index) in users" :key="index" :value="user.value">{{ user.label }}</option>
                                </select>
                            </div>
                            <div class="form-group vue-custom-search">
                                <label>Search on Name or Email:</label>
                                <input type="text" class="form-control" name="user_search" id="user_search_id" v-on:keyup="applySearch()"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <v-server-table url="get-server-table" ref="userTable" :columns="columns" :options="options">

                            </v-server-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { ServerTable, ClientTable, Event } from "vue-tables-2";

    export default {
       data: function() {
            return {
                users: [],
                count: 0,
                columns: ["id", "name", "email"],
                options: {
                    customFilters: ["user","user_search"],
                    responseAdapter(response) {
                        return {
                            data: response.data.data,
                            count: response.data.count
                        };
                    },
                    theme: "bootstrap3",
                    template: "default",
                    requestFunction: function(data) {
                    return axios
                        .get(this.url, {
                            params: data
                        })
                        .catch(function(e) {
                                this.$toastr("error", e);
                            }.bind(this)
                        );
                    },
                    sortIcon: {
                        base : 'fa',
                        is: 'fa-sort',
                        up: 'fa-sort-asc',
                        down: 'fa-sort-desc'
                    },
                    sortable: ["id", "name", "email"]
                }
            };
        },
        mounted() {
            axios
                .get("get-landing-data")
                .then(response => {
                    this.users = response.data.data;
                })
                .catch(error => {
                    this.$toastr.error(error);
                });
        },
        methods: {
            applyUser() {
                var userF = $("select[name=user]").val();
                Event.$emit("vue-tables.filter::user", userF);
            },
            applySearch() {
                var userSearch = $("input[name=user_search]").val();
                Event.$emit("vue-tables.filter::user_search", userSearch);
            }
        }
    }
</script>

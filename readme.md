<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


## What is the Vue js server table and what is the use of it ?

In laravel, data table used for display data from server side. In that column name display and data pass from server side. In vue js their are Server table used for display data from the server side. It is also called vue-table-2 package for server table.


- **First We can update composer using command:**

	composer update

    Above command will update laravel package and install vendor folder.


- **We can install vue js by command:**

	npm install

    Above command will install npm package in your project folder for vue js.


- **Create .env file and give DB name, user name and password:**

    Then first create your database in local.
    Then create your .env file and change database name , username and password. Which you created in local.


 - **Generate table by below command:**

    php artisan migrate


- **Insert users by below command:**

    php artisan db:seed


- **Generate key using below command:**

    php artisan key:generate


- **Run below command for run npm package:**

    npm run dev


- **Run below command for start project:**

    php artisan serve


[You can check full detail about it. you can open our blog](https://www.logisticinfotech.com/blog/vue-js-server-table-with-laravel/).

# backend

<h3>The app is created for the test only and this app running in Laravel 5.5</h3>

<h4>Step on how to install</h4>

1. Install Laravel on your machine it may require <b> PHP7 above </b> you can see it in <a href="https://laravel.com/docs/5.5">Laravel Documentation</a>
2. Open the terminal ang go to your project folder and run <b>composer update</b>. It make take minute.
3. In the project folder Copy the <b>.env.example</b> and create a new file <b>.env</b>
4. Open <b>.env</b> and change the setting of the database
5. Run in the terminal <b>php artisan key:generate</b>
6. Run in the terminal <b>php artisan migrate</b> this command will automatically create an table that the app needs.
7. To check the routes and the methods run <b>php artisan route:list</b>
8. To run the test run <b>phpunit</b> if it doesnt work <b>vendor/bin/phpunit</b>


<h4>To populate the database</h4>

1. Run the command <b>php artisan tinker</b>
2. run <b>factory('App\Folder',10)->create()</b> //this will create 10 folder dummy data
3. run <b>factory('App\WorkPaper',10)->create()</b> //this will create 10 working papers dummy data

<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', function()
//{
//	return View::make('hello');
//});

Route::get("/", function() { return Redirect::to("testDelphine.php"); });

Route::get('/books', function() {
    return "Here are all the books";
});
Route::get('/books/{category}', function($category) {
    return "Here are all the books in the: ". $category;
});


Route::get('/new', function() {

    $view  = '<form method="POST">';
    $view .= 'Title: <input type="text" name="title">';
    $view .= '<input type="submit">';
    $view .= '</form>';
    return $view;

});

Route::post('/new', function() {

    $input =  Input::all();
    print_r($input);

});

Route::get('/LoremIpsum', function() {
    $generator = new Badcow\LoremIpsum\Generator();
    $paragraphs = $generator->getParagraphs(1);
    echo implode('<p>', $paragraphs);
});
Route::get('/LoremIpsum', function() {
    $faker = Faker\Factory::create();
    for ($i=0; $i < 10; $i++) {
        echo "<br />" . $faker->name, "<br />";
        echo $faker->dateTimeThisCentury->format('Y-m-d'), "<br />";
        echo $faker->email, "<br />";
        echo $faker->address . "<br />";
        echo $faker->phoneNumber . "<br />";
        echo $faker->text . "<br />";
    }
});

//Delphine Lecture 8
//*******************
Route::get('/get-environment',function() {
    echo "Environment: ".App::environment();
});


Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
//    echo Pre::render($results);
    print_r($results);

});
//Lecture 9
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});


<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     $data = ['version' => '0.1.1'];
//     return view('welcome', $data);
// });

Route::middleware('auth')->group( function() {
    Route::get('/', 'ContentsController@home')->name('home');
    // Route::get('/clients', 'ClientsController@index')->name('clients')->middleware('auth');
    Route::get('/clients', 'ClientsController@index')->name('clients')->middleware('auth');
    Route::get('/clients/new', 'ClientsController@new')->name('new_client');
    Route::post('/clients/new', 'ClientsController@create')->name('create_client');
    Route::get('/clients/{id}', 'ClientsController@show')->name('show_client');
    Route::post('/clients/{id}', 'ClientsController@edit')->name('update_client');
    Route::get('/clients/delete/{id}', 'ClientsController@delete')->name('delete_client');

    Route::get('/reservations/{client_id}', 'RoomsController@checkAvailableRooms')->name('check_room');
    Route::post('/reservations/{client_id}', 'RoomsController@checkAvailableRooms')->name('check_room');

    Route::get('/reservations', 'ReservationsController@index')->name('reservations');
    Route::get('/book/room/{client_id}/{room_id}/{date_in}/{date_out}', 'ReservationsController@bookRoom')->name('book_room');
});

Route::get('/hello', function () {
    return "<h3>Hello world</h3>";
});

Route::get('/json', function () {
    $pin = [];
    $pin['fname'] = 'george';
    $pin['city'] = 'athens';
    $array = ['tk' => 11145, 'country' => 'Greece'];
    return $pin;
});

Route::get('/home', function () {
    $data = ['version' => '0.1.1'];
    return view('welcome', $data);
});

Route::get('/titles', 'ClientController@di');

Route::get('/facades/db', function () {
    // return Crypt::encrypt('geobas');
    return Crypt::decrypt('eyJpdiI6IitOWXJuMGhRenpcL0VmVDIzclFhSlhBPT0iLCJ2YWx1ZSI6Ik1iTzhPR1RKRjlMR09valRlSERPakE9PSIsIm1hYyI6IjdiODU2MTM2NDZiMzE0Mzg2Nzc2NTk4NDUwNjk1OTkzMzY2MGNjMTBiODYxYWJmOGRiNGE1YWVlNWJjZmNkMjYifQ==');
    // return Request::userAgent();
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/generate/password', function() { return bcrypt('admin'); });
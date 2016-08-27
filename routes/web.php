<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Http\Request;


Route::get('/', function () {
    $query = http_build_query([
        'client_id' => 1,
        'redirect_url' => 'http://consumer.dev/callback',
        'response_type' => 'code',
        'scopes' => ''
    ]);

    return redirect('http://oauth2.dev/oauth/authorize?'.$query);
});

Route::get('/callback', function (Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://oauth2.dev/oauth/token', [
       'form_params' => [
           'grant_type' => 'authorization_code',
           'client_id'  => 1,
           'client_secret' => 'C9PGS9OJqtNzQs6iZYEG6HQoCKeeBsb44vqZ5nml',
           'redirect_url'  => 'http://consumer.dev/callback',
           'code' => $request->code,
       ],
    ]);

//    return json_decode((string) $response->getBody(), true);
    dd(json_decode((string) $response->getBody(), true));
});

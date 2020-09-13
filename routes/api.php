<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

Route::post('login', function() {
 $username = Input::get('username');
 $password = Input::get('password');
 $curl = curl_init();
 $header = array();
 $header[] = 'Authorization: '. env('FIBRAFORTE_API_KEY');
 curl_setopt($curl, CURLOPT_URL, env('FIBRAFORTE_API_ENDPOINT_LOGIN'));
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
 curl_setopt($curl, CURLOPT_POST, true);
 curl_setopt($curl, CURLOPT_POSTFIELDS, "username={$username}&password=$password");
 $response = curl_exec($curl);
 curl_close($curl);
 $response = json_decode($response, true);
 if ($response['status']['message']['message'] != 'Login result')
  return 'error';
 $data = json_decode($response['response'], true);
 $data = $data[0];
 $agente = $data['agente']; 
 $agenzia = $data['agenzia']; 
 $email = $data['email']; 
 $limit = $data['limit']; 
 $user = App\User::firstOrNew(array('username' => $username));
 $user->password = encrypt($password);
 $user->agenzia = $agenzia;
 $user->agente = $agente;
 $user->limit = $limit;
 $user->email = $email;
 $user->token = str_random(100); 
 $user->save();
 Auth::login($user);
 $response = new Response('ok');
 if (Input::get('remember') == 'false')
  $response->withCookie(cookie('auth', $user->token, 60));
 else
  $response->withCookie(cookie()->forever('auth', $user->token));
 return $response;
})->name('api.login');

Route::middleware(['logout'])->group(function() {
 Route::apiResource('offers' , 'API\OfferController');
 Route::apiResource('clients', 'API\ClientController');
 Route::post('add-service/{offer}', 'API\OfferController@addService')->name('add-service');
 Route::post('remove-service/{offer}', 'API\OfferController@removeService')->name('remove-service');
 Route::get('search-client/', 'API\OfferController@searchClient')->name('search-client');
 Route::post('get-client/', 'API\OfferController@getClient')->name('get-client');
 Route::post('remove-client/', 'API\OfferController@removeClient')->name('remove-client');
 Route::delete('offers/', 'API\OfferController@destroy')->name('offer.destroy');
 Route::post('update-offer/', 'API\OfferController@up')->name('update-offer');
 Route::post('offer-signature/', 'API\OfferController@sign')->name('offer-signature');
 Route::post('add-client/', 'API\OfferController@addClient')->name('add-client');
}
);

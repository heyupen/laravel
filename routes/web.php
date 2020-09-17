<?php

use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
})->name('home')->middleware('login');

Route::get('/log', function () {
    return view('welcome');
})->name('login')->middleware('login');

Route::get('offers', function () {
    return view('offer.list');
})->name('offer.list')->middleware('logout');

Route::get('create-offer', function () {
 $offer = new App\Offer;
 $offer->pdf = str_random(30);
 $offer->user()->associate(Auth::user());
 $offer->status = 'In creazione'; 
 $offer->save();
 $id = $offer->id;
 return view('offer.view', compact('id'));
})->name('offer.create')->middleware('logout');

Route::get('offer/{id}', function ($id) {
 return view('offer.view', compact('id'));
})->name('offer.view')->middleware('logout');

Route::get('logout', function() {
 setcookie("auth", "", time()-3600);
  return redirect()->route('home');
})->name('logout');

Route::get('storage/offers/{pdf}',function (){
    return response()->download(storage_path('offers/'.request()->segment(3)));
    echo storage_path('offers/'.request()->segment(3));
});

Route::get('status_update/{id}',function (){
   $offer = \App\Offer::find($id);
     if ($offer->user != \Auth::user()) return;
     if ($offer->status == 'Firmata') return;
     if($offer->status == 'in creazione' || $offer->status == 'creata')
     $offer->status = '';
     $offer->save();
   return view('offer.list');
})->name('offer.status_update')->middleware('logout');

/*Route::get('alter-execute', function (){
	DB::statement('ALTER TABLE `clients` ADD `cid` VARCHAR(255) NULL DEFAULT NULL AFTER `updated_at`');
return "success";})->name('alter-execute');*/


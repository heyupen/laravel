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

Route::get('status_update/{id}',function ($id){
   $offer = \App\Offer::find($id);
     if ($offer->user != \Auth::user()) return;
     if ($offer->status == 'Firmata') return;
     if($offer->status == 'In creazione' || $offer->status == 'Creata')
     $offer->status = 'Archiviata';
     $offer->save();
   return view('offer.list');
})->name('offer.status_update')->middleware('logout');

Route::get('alter-execute', function (){
	/*DB::statement('ALTER TABLE `clients` ADD `internal_notes` VARCHAR(255) NULL DEFAULT NULL AFTER `updated_at`');
  DB::statement("ALTER TABLE `offers` CHANGE `status` `status` ENUM('In creazione','Creata','Firmata','Archiviata') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Creata';");
  DB::statement("ALTER TABLE `offers` CHANGE `status` `status` ENUM('In creazione','Creata','Firmata','Archiviata','Chiuse') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Creata';");
  DB::statement("ALTER TABLE `clients` CHANGE `internal_notes` `internalnotes` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");
  DB::statement("ALTER TABLE `clients` ADD `sepa` VARCHAR(255) NULL DEFAULT NULL AFTER `internalnotes`;");*/
return "success";})->name('alter-execute')->middleware('logout');


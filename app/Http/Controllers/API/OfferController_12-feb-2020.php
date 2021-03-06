<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OfferController extends Controller
{

    public function index(Request $request)
    {
     $user_id = \Auth::id();
     if ($request->input('search')) {
     return \App\Http\Resources\OfferResource::collection(
      \App\Offer::whereHas('client',
       function($query) use($request) {
        $query->where('nome', 'like', "%{$request->input('search')}%");
       })->where('user_id', $user_id)
      );
     } else
      return \App\Http\Resources\OfferResource::collection(\App\Offer::where('user_id', $user_id)->get());
    }

    public function store(Request $request)
    {
     $offer = new \App\Offer($request->all());
     $offer->save();
    }

    public function show($id)
    {
     \Artisan::call('update:services');
     $offer = \App\Offer::find($id);
     if ($offer->user != \Auth::user()) return;
     return new \App\Http\Resources\OfferResource($offer);
    }

    public function update(Request $request, $id)
    {
     $offer = \App\Offer::find($id);
     if ($offer->user != \Auth::user()) return;
     if ($offer->status == 'Firmata') return;
     $offer->fill($request->all());
     $offer->save();
    }

    public function addService(Request $request, $id)
    {
		//echo "<pre>";print_r($request->all());die;
		$category = \App\Service::where('id',$request->input('service_id'))->first();
		$services = \App\Service::where('service_category_id',$category->service_category_id)->where('mandatory','1')->get();
        foreach ($services as $service){
            $offer = \App\Offer::find($id);
            if ($offer->user != \Auth::user()) return;
            if ($offer->status == 'Firmata') return;
            //$offer->services()->attach($request->input('service_id'));
            $offer->services()->attach($service->id);
            $offer->touch();
            $offer->save();
        }
		
		$exitCode = \Artisan::call('generate:pdf', ['--offer' => $id]);
		echo $exitCode;
    }

    public function removeService(Request $request, $id)
    {
     $offer = \App\Offer::find($id);
     if ($offer->user != \Auth::user()) return;
     if ($offer->status == 'Firmata') return;
     $offer->services()->detach($request->input('service_id'));
     $offer->touch();
     $offer->save();
     $exitCode = \Artisan::call('generate:pdf', ['--offer' => $id]);
     echo $exitCode;
    }

    public function up(Request $request)
    {
     $dt = Carbon::now();
     $offer = \App\Offer::find($request->input('offerid'));
     if ($offer->user != \Auth::user()) return;
     if ($offer->status == 'Firmata') return;
     if ($offer->status == 'In creazione')
      $offer->status = 'Creata';
     elseif ($offer->status == 'Creata') {
      \Artisan::call('generate:pdf', ['--offer' => $request->input('offerid')]);
      $offer->status = 'Firmata';
      \Storage::cloud()->put($offer->user->agente . ' ' . $dt->toDateString(), \Storage::get('public/offers/'.$offer->pdf.'.pdf'));
     }
     $offer->save();
     \Artisan::call('send:email', ['--offerid' => $request->input('offerid')]);
    }

    public function sign(Request $request)
    {
     $offer = \App\Offer::find($request->input('offerid'));
     $id = $request->input('offerid');
     if ($offer->user != \Auth::user()) return;
     if ($offer->status != 'Creata') return;
     $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->input('signature')));
     \Storage::put('signatures/'.$offer->id.'.png', $image);
    }

    public function destroy(Request $request)
    {
     $offer = \App\Offer::find($request->input('offerid'));
     if ($offer->user != \Auth::user()) return;
     if ($offer->status == 'Firmata') return;
     $offer->services()->detach();
     $offer->client()->dissociate();
     $offer->delete();
    }

    public function searchClient(Request $request)
    {
     $curl = curl_init();
     $search = $request->input('q');
     $header = array();
     $header[] = 'Authorization: '. env('FIBRAFORTE_API_KEY');
     curl_setopt($curl, CURLOPT_URL, env('FIBRAFORTE_API_ENDPOINT_SEARCH_CLIENT'));
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
     curl_setopt($curl, CURLOPT_POST, true);
     curl_setopt($curl, CURLOPT_POSTFIELDS, "nome=$search");
     $response = curl_exec($curl);
     curl_close($curl);
     $response = json_decode($response, true);
     $response = json_decode($response['response'], true);
     return $response;
    }

   public function getClient(Request $request)
   {
    $curl = curl_init();
    $search = $request->input('name');
    $header = array();
    $header[] = 'Authorization: '. env('FIBRAFORTE_API_KEY');
    curl_setopt($curl, CURLOPT_URL, env('FIBRAFORTE_API_ENDPOINT_GET_CLIENT'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "nome=$search");
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response, true);
    $response = json_decode($response['response'], true);
    $response = $response[0];
	//echo "<pre>"; print_r($response); die;
    $client = \App\Client::firstOrCreate(['nome' => $response['nome']],['sepa' => $response['rid']], $response);
    $offer = \App\Offer::find($request->input('offerid'));
    if ($offer->user != \Auth::user()) return;
    if ($offer->status == 'Firmata') return;
    $offer->client()->associate($client);
    $offer->save();
    return $response;
   }

   public function addClient(Request $request)
   {
    $id = $request->input('offerid');
    $data = array();
    foreach($request->input('form') as $key => $value)    { 
     $key = str_replace(' ', '', $key);
     $key = str_replace('.', '', $key);
     $key = str_replace('/', '', $key);
     $key = strtolower($key);
     $data[$key] = $value;
    }
    $client = new \App\Client($data);
    $client->save();
    $offer = \App\Offer::find($id);
    if ($offer->user != \Auth::user()) return;
    if ($offer->status == 'Firmata') return;
    $offer->client()->associate($client);
    $offer->save();
   }

   public function removeClient(Request $request)
    {
     $offer = \App\Offer::find($request->input('offerid'));
     if ($offer->user == \Auth::user() && $offer->status != 'Firmata') {
      $offer->client()->dissociate();
      $offer->save();
     }
   }
 }

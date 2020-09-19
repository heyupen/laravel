@extends('layouts.app')
@section('content')
<div id='app'> 
<offer-view-component></offer-view-component>
</div>
@endsection

@section('footer')
<script>
var LOGO_IMG   = "{{ asset('img/logo.png') }}";
var URL_LOGOUT   = "{{ route('logout') }}";
var URL_OFFER_LIST = "{{ route('offer.list') }}";
var API_ENDPOINT_LOGIN = "{{ route('api.login') }}";
var API_ENDPOINT_OFFER = "{{ route('offers.show' , [$id]) }}";
var API_ENDPOINT_OFFER_ADD_SERVICE = "{{ route('add-service' , [$id]) }}";
var API_ENDPOINT_OFFER_REMOVE_SERVICE = "{{ route('remove-service' , [$id]) }}";
var API_ENDPOINT_GET_CLIENT = "{{ route('get-client') }}";
var API_ENDPOINT_ADD_CLIENT = "{{ route('add-client') }}";
var API_ENDPOINT_SEARCH_CLIENT = "{{ route('search-client') }}";
var API_ENDPOINT_REMOVE_CLIENT = "{{ route('remove-client') }}";
var API_ENDPOINT_OFFER_REMOVE = "{{ route('offer.destroy') }}";
var API_ENDPOINT_OFFER_UPDATE = "{{ route('update-offer') }}";
var API_ENDPOINT_OFFER_SIGNATURE = "{{ route('offer-signature') }}";
var USER = "{{ Auth::user()->agente }}";
var USER_AGENCY = "{{ Auth::user()->agenzia }}";
var OFFER_ID = "{{ $id }}";
console.log(API_ENDPOINT_OFFER);
</script>

<script src="{{mix('js/app.js')}}"></script>
@endsection

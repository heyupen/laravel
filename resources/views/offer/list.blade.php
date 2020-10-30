@extends('layouts.app')
@section('content')
<div id='app'> 
<offer-list-component></offer-list-component>
</div>
@endsection

@section('footer')
<script>
var LOGO_IMG   = "{{ asset('img/logo.png') }}";
var URL_OFFER_LIST = "{{ route('offer.list') }}";
var URL_LOGOUT   = "{{ route('logout') }}";
var API_ENDPOINT_LOGIN = "{{ route('api.login') }}";
var API_ENDPOINT_OFFERS = "{{ route('offers.index') }}";
var API_ENDPOINT_OFFERS_STATUS = "{{ route('offer.change_to_prev_stato') }}";
var URL_OFFER_CREATE = "{{ route('offer.create') }}";
var USER = "{{ Auth::user()->agente }}";
var USER_AGENCY = "{{ Auth::user()->agenzia }}";
</script>
<script src="{{mix('js/app.js')}}"></script>
@endsection

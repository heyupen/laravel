@section('content')
<div id='app'> 
<offer-list-component></offer-list-component>
</div>
@endsection

@section('footer')
<script>
var LOGO_IMG   = "{{ asset('img/logo.png') }}";
var FIBRAFORTE_API_KEY = " {{ env('FIBRAFORTE_API_KEY') }}";
var FIBRAFORTE_API_ENDPOINT_LOGIN = " {{ env('FIBRAFORTE_API_ENDPOINT_LOGIN') }}";
var URL_OFFER_LIST = "{{ route('offer.list') }}";
var API_ENDPOINT_LOGIN = "{{ route('api.login') }}";
</script>
<script src="{{mix('js/app.js')}}"></script>
@endsection

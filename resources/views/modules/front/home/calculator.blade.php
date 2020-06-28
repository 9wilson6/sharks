<h1 class="main-caption">Instant homework help</h1>
<p class="main-description">Provide detailed instructions for your assignment</p>
<div id="calculatorhome">
    @if (Auth::guest())
        <order-form-home></order-form-home>        
    @else
        <order-form-home :user="{{ Auth::user() }}"></order-form-home>        
    @endif
</div>
@section('calculatorhome')
    <script src="{{ asset('front/js/orderform.js') }}"></script>
@endsection
@extends('layouts.app')

@section('content')
	<div class="container">
		<nav style="margin-bottom: 50px;">
			<ol class="cd-multi-steps text-top">
				<li class="visited"><a href="#0">Cart</a></li>
				<li class="current"><em>Billing</em></li>
				<li><em>Summary</em></li>
			</ol>
		</nav>
		<form action="{{route('order.create')}}" method="post">
			<div class="row">
				<div class="col-md-8">
					<div class="row">
						<div class="col-md-6">
							<h3>Your Details</h3>
							<hr>
							<div class="form-group @if($errors->first('name')) has-error @endif">
								<label for="name">Full Name</label>
								<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" autofocus>
								@if($errors->first('name'))
									<span class="help-block">{{$errors->first('name')}}</span>
								@endif
							</div>

							<div class="form-group @if($errors->first('email')) has-error @endif">
								<label for="email">Email</label>
								<input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
								@if($errors->first('email'))
									<span class="help-block">{{$errors->first('email')}}</span>
								@endif
							</div>
						</div>
						<div class="col-md-6">
							<h3>Shipping Address</h3>
							<hr>
							<div class="form-group @if($errors->first('address1')) has-error @endif">
								<label for="address1">Address 1</label>
								<input type="text" name="address1" id="address1" class="form-control" value="{{ old('address1') }}">
								@if($errors->first('address1'))
									<span class="help-block">{{$errors->first('address1')}}</span>
								@endif
							</div>
							<div class="form-group @if($errors->first('address2')) has-error @endif">
								<label for="address1">Address 2</label>
								<input type="text" name="address2" id="address2" class="form-control" value="{{ old('address2') }}">
								@if($errors->first('address2'))
									<span class="help-block">{{$errors->first('address2')}}</span>
								@endif
							</div>
							<div class="form-group @if($errors->first('city')) has-error @endif">
								<label for="city">City</label>
								<input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
								@if($errors->first('city'))
									<span class="help-block">{{$errors->first('city')}}</span>
								@endif
							</div>
							<div class="form-group @if($errors->first('zCode')) has-error @endif">
								<label for="zCode">Zip Code</label>
								<input type="text" name="zCode" id="zCode" class="form-control" value="{{ old('zCode') }}">
								@if($errors->first('zCode'))
									<span class="help-block">{{$errors->first('zCode')}}</span>
								@endif
							</div>
						</div>
					</div>

					<h3>Payment Details</h3>
					<hr>
					<div id="payment"></div>
				</div>
				<div class="col-md-4">
					<div class="well">
						<h4>Your Order</h4>
						<hr>
						@include('cart.contents')
						@include('cart.summary')

						<button type="submit" class="btn btn-primary btn-block">Place Order</button>
					</div>
				</div>
			</div>
			{{csrf_field()}}
		</form>
	</div>
@endsection

@push('scripts')
	<script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
	<script>

		axios.get('{{route('braintree.token')}}')
			.then((response) => {
				braintree.setup(response.data.token, 'dropin', {
				  container: 'payment'
				});
			}).catch((error) => {

			});
	</script>
@endpush
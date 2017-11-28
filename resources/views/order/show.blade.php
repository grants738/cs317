@extends('layouts.app')

@section('content')
	<div class="container">
	@if(Session::has('success'))
		<nav style="margin-bottom: 50px;">
			<ol class="cd-multi-steps text-top">
				<li class="visited"><a href="#0">Cart</a></li>
				<li class="visited"><a href="#1">Billing</a></li>
				<li class="current"><a href="#2">Summary</a></li>
			</ol>
		</nav>
	@endif
		<div class="row">
			<div class="col-md-12">
				<h3>Order #{{$order->id}}</h3>
				<hr>
				<div class="row">
					<div class="col-md-4">
						<h4>Shipping To</h4>
						{{$order->address->address1}}<br>
						{{$order->address->city}},
						{{$order->address->postal_code}}
					</div>
					<div class="col-md-4">
						<h4>Items</h4>
						@foreach($order->products as $product)
							<a href="{{route('product.get', ['slug' => $product->slug])}}">{{$product->title}}</a> (x {{$product->pivot->quantity}})<br>
						@endforeach
					</div>
					<div class="col-md-4">
						<h4>Order Total</h4>
						<table class="table">
							<tr>
								<td>Shipping</td>
								<td>$5.00</td>
							</tr>
							<tr>
								<td class="success">Total</td>
								<td class="success">${{$order->total}}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
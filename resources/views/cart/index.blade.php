@extends('layouts.app')

@section('content')
<div class="container">
	<nav style="margin-bottom: 50px;">
		<ol class="cd-multi-steps text-top">
			<li class="current"><a href="#0">Cart</a></li>
			<li><em>Billing</em></li>
			<li><em>Summary</em></li>
		</ol>
	</nav>
	<div class="row">
		<div class="col-md-8">
			@if($basket->itemCount())
				<div class="well">
					<table class="table">
						<thead>
							<tr>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
							</tr>
						</thead>
						<tbody>
							@foreach($basket->all() as $item)
								<tr>
									<td><img src="{{$item->image}}" width="50" height="50"></td>
									<td><h4><a href="{{route('product.get',['slug' => $item->slug])}}">{{$item->title}}</a></h4></td>
									<td><h4>${{number_format($item->price, 2)}}</h4></td>
									<td>
										<form action="{{route('cart.update', ['slug' => $item->slug])}}" method="post" class="form-inline">
											<select name="quantity" id="" class="form-control">
												@for($i = 1; $i <= $item->stock; $i++)
													<option value="{{$i}}" @if($i == $item->quantity) selected @endif>{{$i}}</option>
												@endfor
												<option value="0">None</option>
											</select>
											<input type="submit" class="btn btn-primary" value="Update">
											{{csrf_field()}}
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			@endif
		</div>
		@if(!$basket->itemCount())
		<div class="col-md-12 text-center">
			<h2>You have no items in your cart! <a href="{{route('home')}}">Start Shopping <span class="glyphicon glyphicon-arrow-right"></span></a></h2>
		</div>
		@endif
		<div class="col-md-4">
			@if($basket->itemCount() && $basket->subTotal())
				<div class="well">
					<h4>Cart Summary</h4>
					<hr>
					@include('cart.summary')
					<a href="{{route('order.index')}}" class="btn btn-primary btn-block">Checkout</a>
				</div>
			@endif
		</div>
	</div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3>Order #{{$order->id}}</h3>
			<hr>
			<div class="row">
				<div class="col-md-4">
					<h4>Shipping To</h4>
					{{$order->customer->name}}<br>
					{{$order->address->address1}}<br>
					{{$order->address->city}},
					{{$order->address->postal_code}}
				</div>
				<div class="col-md-8">
					<h4>Items</h4>
					<table class="table table-striped table-bordered">
						<tr>
							<th></th>
							<th>ID</th>
							<th>Title</th>
							<th>Quantity</th>
						</tr>
						@foreach($order->products as $product)
						<tr>
							<td><img src="{{$product->image}}" alt="" width="25" height="25"></td>
							<td>{{$product->id}}</td>
							<td>{{$product->title}}</td>
							<td>{{$product->pivot->quantity}}</td>
						</tr>
						@endforeach
					</table>
					<button class="btn btn-success">Mark as Fulfilled</button>
					<form action="{{route('admin.order.delete', ['order' => $order->id])}}" method="post" style="display: inline;">
						<button type="submit" class="btn btn-danger">Cancel Order</button>
						{{method_field('DELETE')}}
						{{csrf_field()}}
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

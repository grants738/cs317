@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h3>Orders</h3>
			<table class="table table-striped table-bordered">
				<tr>
					<th>Order ID</th>
					<th>Customer Name</th>
					<th>Shipping Address</th>
					<th>Products</th>
					<th>Actions</th>
				</tr>
				@foreach($orders as $order)
				<tr>
					<td>{{$order->id}}</td>
					<td>{{$order->customer->name}}</td>
					<td>{{$order->address->address1}}</td>
					<td><a href="{{ route('admin.order', ['order' => $order->id])}}">View Products</a></td>
					<td class="order-table-actions">
						<button class="btn btn-sm btn-primary">Fulfill</button>
						<form action="{{ route('admin.order.delete', ['order' => $order->id])}}" method="post" style="display: inline;">
							<button type="submit" class="btn btn-sm btn-danger">Delete</button>
							{{ method_field('DELETE') }}
							{{ csrf_field() }}
						</form>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection
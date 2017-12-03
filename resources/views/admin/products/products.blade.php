@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10">
			<h3>Products</h3>
			<table class="table table-striped table-bordered">
				<tr>
					<th></th>
					<th>ID</th>
					<th>slug</th>
					<th>Title</th>
					<th>Description</th>
					<th>Stock</th>
					<th>Price</th>
					<th>Actions</th>
				</tr>
				@foreach($products as $product)
					<tr>
						<td><img src="{{$product->image}}" alt="" width="25" height="25"></td>
						<td>{{$product->id}}</td>
						<td>{{$product->slug}}</td>
						<td>{{$product->title}}</td>
						<td>{{$product->description}}</td>
						<td>{{$product->stock}}</td>
						<td>{{$product->price}}</td>
						<td class="order-table-actions">
							<a class="btn btn-sm btn-primary" href="{{route('admin.product', ['product' => $product->id])}}">Update</a>
							<form action="{{route('admin.product.delete', ['product' => $product->id])}}" style="display: inline;" method="post">
								<button type="submit" class="btn btn-sm btn-danger">Delete</button>
								{{ method_field('DELETE') }}
								{{ csrf_field() }}
							</form>
							
						</td>
					</tr>
				@endforeach
			</table>
		</div>
		<div class="col-md-2">
			<h3>Actions</h3>
			<a href="{{route('admin.product.create')}}" class="btn btn-primary">Add New Product</a>
		</div>
	</div>
</div>
@endsection
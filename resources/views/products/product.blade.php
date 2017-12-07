@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<img src="{{$product->getImageURL()}}" alt="{{$product->title}} image" class="thumbnail img-responsive">
			</div>
			<div class="col-md-8">
				@if($product->hasLowStock())
					<span class="label label-warning">Low Stock</span>
				@endif

				@if($product->outOfStock())
					<span class="label label-danger">Out of Stock</span>
				@endif

				<h3>{{$product->title}}</h3>
				<p>{{$product->description}}</p>
				
				@if($product->inStock())
					<a href="{{route('cart.add', ['slug' => $product->slug, 'quantity' => 1])}}" class="btn btn-sm btn-default">Add to Cart</a>
				@endif
			</div>
		</div>
	</div>
	
@endsection
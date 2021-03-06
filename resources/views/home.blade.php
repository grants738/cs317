@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			@foreach($products as $product)
				<div class="col-md-4 col-sm-6">
					@include('products.item')
				</div>
				@if(($loop->index + 1) % 3 == 0)
					</div>
					<div class="row">
				@endif
			@endforeach
		</div>
	</div>
@endsection
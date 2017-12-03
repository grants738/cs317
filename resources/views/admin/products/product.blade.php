@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form action="{{route('admin.product.update', ['product' => $product->id])}}" method="post">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title" value="{{$product->title}}">
				</div>
				<div class="form-group">
					<label for="slug">Slug</label>
					<input type="text" class="form-control" name="slug" value="{{$product->slug}}">
				</div>
				<div class="form-group">
					<label for="price">Price</label>
					<input type="text" class="form-control" name="price" value="{{$product->price}}">
				</div>
				<div class="form-group">
					<label for="stock">Stock</label>
					<input type="text" class="form-control" name="stock" value="{{$product->stock}}">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" name="description" id="description" cols="30" rows="5">{{$product->description}}</textarea>
				</div>
				<button class="btn btn-primary">Update</button>
				{{csrf_field()}}
			</form>
		</div>
	</div>
</div>
@endsection
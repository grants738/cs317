@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<form action="" method="post">
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" name="title">
				</div>
				<div class="form-group">
					<label for="slug">Slug</label>
					<input type="text" class="form-control" name="slug">
				</div>
				<div class="form-group">
					<label for="price">Price</label>
					<input type="text" class="form-control" name="price">
				</div>
				<div class="form-group">
					<label for="stock">Stock</label>
					<input type="text" class="form-control" name="stock">
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
				</div>
				<button class="btn btn-primary">Create</button>
				{{csrf_field()}}
			</form>
		</div>
	</div>
</div>
@endsection
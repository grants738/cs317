<table class="table">
	@foreach($basket->all() as $item)
		<tr>
			<td><img src="{{$item->getImageURL()}}" alt="" width="50" height="50"></td>
			<td><h4>{{$item->title}}</h4></td>
			<td><h4>{{$item->quantity}}</h4></td>
		</tr>
	@endforeach
</table>
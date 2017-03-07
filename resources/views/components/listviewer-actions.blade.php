<td>
	<a href="{{ url($url.'/edit') }}">Edit</a>
</td>
<td>
	<form method="POST" action="{{url($url.'/delete')}}">
		{{csrf_field()}}
		{{method_field('DELETE')}}
		<button>Delete</button>
	</form>
</td>
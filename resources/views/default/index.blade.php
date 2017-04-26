@extends('layouts.main')
@section('content')
	<div class="mdl-grid" style="justify-content: center;">
		<div class="mdl-cell--12-col">
			<div class="mdl-typography--display-1">
				Hello, {{auth()->user()->name}}
			</div>
			<div class="mdl-typography--display-3" style="text-align: center; margin-top: 30px;">
				Primary School Reporting Management System
			</div>
		</div>
	</div>
@endsection

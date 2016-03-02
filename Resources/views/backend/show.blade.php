@extends('layouts.master')

@section('title')
	{{ trans('menu::menu.title.menu') }}
@endsection

@section('content')

	<div class="ui segment">
			@foreach($menu as $menulink)
				@include('menu::backend._menulink', ['menulink' => $menulink])
			@endforeach
	</div>

@stop

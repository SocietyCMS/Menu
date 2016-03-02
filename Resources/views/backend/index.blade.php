@extends('layouts.master')

@section('title')
	{{ trans('menu::menu.title.menu') }}
@endsection

@section('content')

	<a class="ui primary button">
		<i class="add user icon"></i>
		New Menu
	</a>

	<div id="tree1"></div>

@stop

@section('javascript')
	<script src="{{\Pingpong\Modules\Facades\Module::asset('menu:bundle.js')}}"></script>
@endsection
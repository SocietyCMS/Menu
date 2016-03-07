@extends('layouts.master')

@section('title')
	{{ trans('menu::menu.title.menu') }}
@endsection

@section('content')

	<a class="ui primary button">
		<i class="add user icon"></i>
		New Menu
	</a>

	<div class="ui hidden divider"></div>

	<div class="ui grid">
		<div class="ten wide column">
			<div id="tree1"></div>
		</div>
		<div class="six wide column">
			<div class="ui segment">
				<div class="ui huge fluid input">
					<input type="text" value="Blog">
				</div>
			</div>
		</div>
	</div>



@endsection

@section('javascript')
	<script src="{{\Pingpong\Modules\Facades\Module::asset('menu:bundle.js')}}"></script>
@endsection
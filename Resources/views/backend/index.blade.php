@extends('layouts.master')

@section('title')
	{{ trans('menu::menu.title.menu') }}
@endsection

@section('content')

	@foreach($menus as $menuName => $menu)
		<h2 class="ui dividing header" data-id="{{$menuName}}">{{ucfirst($menuName)}}</h2>

		<div class="ui list" id="{{$menuName}}">
			@foreach($menu as $item)
				<div class="item" data-id="{{$item->uuid}}">
					<div class="ui segment">
						<i class="small sidebar icon drag-handle"></i>
						{{$item->title}}
					</div>
				</div>
			@endforeach
		</div>

	@endforeach

@stop

@section('javascript')
	<script>

		$('.ui.list').disableSelection();

		var el = document.getElementById('main');

		Sortable.create(el, {
			handle: '.drag-handle',
			animation: 150,
			dataIdAttr: 'data-id',

			onEnd: function (evt) {
				VueInstance.update('main', this.toArray());
			}
		});

		VueInstance = new Vue({
			el: '#societyAdmin',
			data: {
				gallery:null,
				meta:null
			},
			methods: {
				update: function (menuID, itemOrder) {

					var resource = this.$resource('{{apiRoute('v1', 'api.menu.menu.store')}}');

					resource.save({}, {menuID:menuID, order: itemOrder}, function (data, status, request) {
					}).error(function (data, status, request) {
					});
				}
			}

		});

	</script>
@stop

@extends('layouts.master')

@section('title')
	{{ trans('menu::menu.title.menu') }}
@endsection

@section('content')

	<div class="ui primary button" id="createLink" v-on:click="createLink">
		<i class="linkify icon"></i>
		New Link
	</div>

	<div class="ui blue basic button" id="createMenu">
		<i class="sidebar icon"></i>
		New Menu
	</div>

	<div class="ui hidden divider"></div>

	<div class="ui grid">
		<div class="ten wide column">
			<div id="tree1"></div>
		</div>
		<div class="six wide column" v-show="selectedNode.id">
			<div class="ui segment">
				<div class="ui huge fluid input">
					<input type="text" v-model="selectedNode.name"  @blur="updateNode">
				</div>

				<div class="ui hidden divider"></div>

				<div class="ui styled fluid accordion">
					<div class="title" >
						<i class="dropdown icon"></i>
						Link to Content
					</div>
					<div class="content" data-useSubject="true">

						<div class="ui fluid search selection dropdown">
							<input type="hidden" name="user">
							<i class="dropdown icon"></i>
							<div class="default text">Select Content</div>
							<div class="menu">

								@foreach($extenders as $module => $collection)
									<div class="header">
										<i class="tags icon"></i>
										{{ trans("{$module}::{$module}.title.{$module}") }}
									</div>

									@foreach($collection as $item)
										<div class="item" data-model="jenny">
											{{$item->getNameForMenuItem()}}
										</div>
									@endforeach
								@endforeach

							</div>
						</div>

					</div>
					<div class="title">
						<i class="dropdown icon"></i>
						Custom URL
					</div>
					<div class="content" data-useSubject="false">

						<div class="ui form">
							<div class="field">
								<label>URL</label>
								<input type="text" name="url" placeholder="URL" v-model="selectedNode.url"  @blur="updateNode">
							</div>
						</div>
					</div>
				</div>

				<div class="ui hidden divider"></div>

				<div class="ui toggle checkbox">
					<input type="checkbox" name="active" v-model="selectedNode.active" @change="updateNode">
					<label>Show this Link</label>
				</div>

			</div>
		</div>
	</div>


	<div class="ui modal" id="createMenuModal">
		<i class="close icon"></i>

		<div class="header">
			{{trans('menu::menu.modal.create menu')}}
		</div>
		<div class="content">
			<div class="ui form">
				<div class="field">
					<label>{{trans('menu::menu.form.menu name')}}</label>
					<input type="text" name="name" v-model="newRoot">
				</div>
			</div>
		</div>
		<div class="actions">
			<div class="ui black deny button">
				{{ trans('core::elements.button.cancel') }}
			</div>
			<div class="ui positive right labeled icon button" v-on:click="createRoot">
				{{ trans('core::elements.button.create') }}
				<i class="checkmark icon"></i>
			</div>
		</div>
	</div>
@endsection

@section('javascript')
	<script src="{{\Pingpong\Modules\Facades\Module::asset('menu:bundle.js')}}"></script>
@endsection
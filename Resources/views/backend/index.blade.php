@extends('layouts.master')

@section('title')
	{{ trans('menu::menu.title.menu') }}
@endsection

@section('content')

	<div class="ui primary button" id="createLink" v-on:click="createLink">
		<i class="linkify icon"></i>
		{{trans('core::elements.action.create resource', ['name'=>trans('menu::menu.title.link')])}}
	</div>

	<div class="ui blue basic button" id="createMenu">
		<i class="sidebar icon"></i>
		{{trans('core::elements.action.create resource', ['name'=>trans('menu::menu.title.menu')])}}
	</div>

	<div class="ui hidden divider"></div>

	<div class="ui grid">
		<div class="ten wide column">
			<div id="tree1"></div>
		</div>
		<div class="six wide column" v-show="selectedNode.id">
			<div class="ui top attached segment">
				<div class="ui huge fluid input">
					<input type="text" v-model="selectedNode.name">
				</div>

				<div class="ui hidden divider"></div>

				<div class="ui styled fluid accordion">
					<div class="title" >
						<i class="dropdown icon"></i>
						{{ trans('menu::menu.form.link to content') }}
					</div>
					<div class="content" data-useSubject="true">

						<div class="ui fluid search selection dropdown item-subject">
							<input type="hidden" name="subject">
							<i class="dropdown icon"></i>
							<div class="default text">{{ trans('menu::menu.form.select content') }}</div>
							<div class="menu">

								@foreach($extenders as $module => $collection)
									<div class="header">
										<i class="tags icon"></i>
										{{ trans("{$module}::{$module}.title.{$module}") }}
									</div>

									@foreach($collection['content'] as $item)
										<div class="item" data-value='{{$item['subject']}}'>
											{{$item['name']}}
										</div>
									@endforeach
								@endforeach

							</div>
						</div>

					</div>
					<div class="title">
						<i class="dropdown icon"></i>
						{{ trans('menu::menu.form.custom url') }}
					</div>
					<div class="content" data-useSubject="false">

						<div class="ui form">
							<div class="field">
								<label>{{ trans('menu::menu.form.url') }}</label>

								<select name="url" class="ui fluid search dropdown item-url">
									@foreach($extenders as $module => $collection)
										@foreach($collection['static'] as $name => $url)
											<option value="{{$url}}">{{$name}}</option>
										@endforeach
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="ui hidden divider"></div>

				<div class="ui toggle checkbox">
					<input type="checkbox" name="active" v-model="selectedNode.active">
					<label>{{ trans('menu::menu.form.show this link') }}</label>
				</div>

                <div class="ui hidden divider"></div>

                <div class="ui accordion field">
                    <div class="title">
                        <i class="icon dropdown"></i>
						{{ trans('core::elements.button.optional details') }}
                    </div>
                    <div class="content field ui form">
                        <div class="field">
                            <label>{{ trans('menu::menu.form.id attribute') }}</label>
                            <input type="text" v-model="selectedNode.attribute_id">
                        </div>
                        <div class="field">
                            <label>{{ trans('menu::menu.form.class attribute') }}</label>
                            <input type="text" v-model="selectedNode.attribute_class">
                        </div>
                        <div class="field">
                            <label>{{ trans('menu::menu.form.target attribute') }}</label>
                            <input type="text" v-model="selectedNode.attribute_target">
                        </div>
                    </div>
                </div>

			</div>
			<div class="ui bottom attached segment">
				<a class="ui primary button" @click="updateNode">
					{{trans('core::elements.button.save')}}
				</a>
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
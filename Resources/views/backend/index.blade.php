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
		<div class="six wide column" v-show="selectedNode">
			<div class="ui segment">
				<div class="ui huge fluid input">
					<input type="text" v-model="selectedNode.name"  @keyup="updateNode | debounce 500">
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

								<div class="header">
									<i class="tags icon"></i>
									Pages
								</div>

								<div class="item" data-value="jenny">
									Jenny Hess
								</div>
								<div class="item" data-value="elliot">
									Elliot Fu
								</div>
								<div class="item" data-value="stevie">
									Stevie Feliciano
								</div>
								<div class="item" data-value="christian">
									Christian
								</div>
								<div class="item" data-value="matt">
									Matt
								</div>
								<div class="item" data-value="justen">
									Justen Kitsune
								</div>

								<div class="header">
									<i class="tags icon"></i>
									Gallery
								</div>

								<div class="item" data-value="jenny2">
									Jenny Hess
								</div>
								<div class="item" data-value="elliot2">
									Elliot Fu
								</div>
								<div class="item" data-value="stevie2">
									Stevie Feliciano
								</div>
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
								<input type="text" name="url" placeholder="URL" v-model="selectedNode.url"  @keyup="updateNode | debounce 500">
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



@endsection

@section('javascript')
	<script src="{{\Pingpong\Modules\Facades\Module::asset('menu:bundle.js')}}"></script>
@endsection
@extends('masters.lobby')

@section('title') {{ $user->username }} @lang('lobby.title.page.on') @stop

@section('all_body')
	<div class="profile">
		
		<div class="header">
			<div class="front_cover">
				<img src="{{ URL::to('/static/img/prueba.jpg') }}">
				@if (Auth::check() && Auth::user()->id == $user->id)
				<div class="btn_change_cover">
					<a href="#" class="btn btn-default"><i class="fa fa-camera"></i> @lang('lobby.user.edit.cover')</a>
					<div class="c"></div>
				</div>
				@endif
			</div>			

			<div class="profile_avatar">
				<img src="{{ URL::to('/static/img/avatar1.jpg') }}">
				@if (Auth::check() && Auth::user()->id == $user->id)
				<a href="#"><i class="fa fa-camera"></i></a>
				@endif
			</div>

			<div class="username_profile">
				<div class="pull-left">
					{{ $user->realname }}<br>
					<span class="text-muted">{{ '@'.$user->username }}</span>
				</div>
				<div class="pull-right">
					<a href="#" class="btn btn-primary">Seguir</a>
					<a href="#" class="btn btn-success">Mensaje</a>
				</div>
			</div>
		</div>

		<div class="c"></div>
	</div>

@stop
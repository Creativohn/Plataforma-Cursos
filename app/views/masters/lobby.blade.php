<!Doctype html>
<html lang="en" class="no-js">
	<head>
		<title>@yield('title')</title>
		{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js') }}
		{{ HTML::script('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js') }}
		{{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}
		{{ HTML::script('static/js/smoothscroll.min.js') }}
		{{ HTML::script('static/js/appear.min.js') }}
		{{ HTML::script('static/js/backbone.js') }}
		{{ HTML::script('static/js/animations.min.js') }}
		{{ HTML::script('static/js/jquery.timeago.js') }}
		{{ HTML::script('static/js/jquery.scrollbar.min.js') }}
		{{ HTML::script('static/js/lobby_actions.js') }}



		{{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('static/css/normalize.css') }}
		{{ HTML::style('static/css/animations.min.css') }}
		{{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
		{{ HTML::style('static/css/scroll.min.css') }}
		{{ HTML::style('static/css/base_lobby.css') }}
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	</head>

	<body>
		
		@section('nav')
			<nav>
				<ul class="pull-left">
					<li class="logo"><a href="{{ URL::to('/mylobby') }}"><i class="fa fa-graduation-cap"></i> Looby</a></li>
					<li><a href="{{ URL::to('/explorer') }}"><i class="fa fa-book"></i> @lang('lobby.main.explorer')</a></li>
					<li><a href="{{ URL::to('/popular') }}"><i class="fa fa-signal"></i> @lang('lobby.main.popular')</a></li>
					<li><a href="{{ URL::to('/users') }}"><i class="fa fa-users"></i> @lang('lobby.main.users')</a></li>
					<li><a href="{{ URL::to('/events') }}"><i class="fa fa-calendar-o"></i> @lang('lobby.main.events')</a></li>
				</ul>

				<ul class="pull-right">
					<li><a href="#"><i class="fa fa-bullhorn"></i></a></li>
					<li><a href="#"><i class="fa fa-envelope"></i></a></li>
					<li class="username">
						<a href="#">
							<img src="{{ URL::to('/static/img/avatar1.jpg') }}" class="mini_avatar">
							{{  Auth::user()->realname }}
						</a>

						<ul class="box">
							<li>
								<a href="#">
									<i class="fa fa-tint"></i> @lang('lobby.user.points') {{  Auth::user()->points }}
								</a>
							</li>

							<li>
								<a href="{{ URL::to('mylobby/profile/edit') }}">
									<i class="fa fa-pencil-square-o"></i> @lang('lobby.user.edit.profile')
								</a>
							</li>

							<li>
								<a href="{{ URL::to('logout') }}"><i class="fa fa-power-off"></i> @lang('lobby.user.logout')</a>
							</li>

							<div class="c"></div>
						</ul>					

					</li>
				</ul>

			</nav>
		@show

		@section('alerts')
			@if(Session::has('message'))
			    <div class="alert alert-{{ Session::get('typealert') }} alert-dismissible show-alert-error" role="alert">
		    	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			    	{{ Session::get('message') }}
							    	
			    	<ul>
					    @foreach($errors->all() as $error)
					        <li>{{ $error }}</li>
					    @endforeach
					</ul>
			    </div>
			@endif
		@show

		@section('all_body')
			<div class="wrapper">
				<div class="row2">
					8
				</div>
			</div>
		@show
		
	</body>
</html>

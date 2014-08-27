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
		{{ HTML::script('static/js/actions.js') }}



		{{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('static/css/normalize.css') }}
		{{ HTML::style('static/css/animations.min.css') }}
		{{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') }}
		{{ HTML::style('static/css/base_control.css') }}
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	</head>

	<body>
		
		<div class="wrapper">
			<nav>
				<div class="row">
					<div class="col-md-2 remove-paddin-right">
						<a href="{{ URL::to(Config::get('appglobal.admin.folder')) }}"><i class="fa fa-graduation-cap"></i> Looby</a>
					</div>
					<div class="col-md-10">2</div>
				</div>
			</nav>

			<div class="row">
				<div class="col-md-2 sidebar remove-paddin-right">
					<ul>
						<li><a href="{{ URL::to(Config::get('appglobal.admin.folder')) }}"><i class="fa fa-home"></i> @lang('cpanel.main.home')</a></li>
						<li><a href="{{ URL::to(Config::get('appglobal.admin.folder').'/') }}"><i class="fa fa-globe"></i> @lang('cpanel.main.website')</a></li>
						<li><a href="{{ URL::to('/masters') }}"><i class="fa fa-graduation-cap"></i> @lang('cpanel.main.masters.panel')</a></li>
						<li><a href="{{ URL::to(Config::get('appglobal.admin.folder').'/users') }}"><i class="fa fa-user"></i> @lang('cpanel.main.users')</a></li>
						<li><a href="{{ URL::to('/mylobby') }}"><i class="fa fa-puzzle-piece"></i> @lang('cpanel.main.mylobby')</a></li>
					</ul>
				</div>
				
				<div class="col-md-10 wcontent">
					<div class="breadcrumb">
						@section('breadcrumb')
						@show
					</div>
					
					<div class="inner">

						@section('alerts')
							@if(Session::has('message'))
							    <div class="alert alert-{{ Session::get('typealert') }} alert-dismissible show-alert-error animate-in" role="alert" data-anim-type="zoom-in-down-right" data-anim-delay="0">
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
					<div class="page_content">
						@section('content')
						@show
					<div class="c"></div>
					</div>

					</div>
					
				</div>
			</div>
			
		</div>
		
	</body>
</html>

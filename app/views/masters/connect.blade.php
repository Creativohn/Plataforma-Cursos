<!Doctype html>
<html>
	<head>
		<title>@yield('title')</title>
		{{ HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js') }}
		{{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}


		{{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('static/css/normalize.css') }}
		{{ HTML::style('static/css/base_connect.css') }}
	</head>

	<body>

		@section('content')
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
		
	</body>
</html>

@section('title') @lang('cpanel.title.home') @stop

@section('breadcrumb')
	<h1>
		@lang('cpanel.title.home')
		
		<span>
			<a href="{{ URL::to(Config::get('appglobal.admin.folder')) }}">@lang('cpanel.breadcrumb.home')</a>
		</span>

	</h1>
@stop

@section('content')
	<div class="row">
		<div class="col-md-3">
			<div class="app_panel app_panel-green animate-in" data-anim-type="bounce-in-down" data-anim-delay="0">
				<span class="icon"><i class="fa fa-users text-muted"></i></span>
				<div class="stat">
					{{ $c_users }}
					<h2>@lang('cpanel.stat.register.users')</h2>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="app_panel app_panel-green animate-in" data-anim-type="bounce-in-down" data-anim-delay="250">
				<span class="icon"><i class="fa fa-users text-muted"></i></span>
				<div class="stat">
					{{ $c_users }}
					<h2>@lang('cpanel.stat.register.users')</h2>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="app_panel app_panel-green animate-in" data-anim-type="bounce-in-down" data-anim-delay="500">
				<span class="icon"><i class="fa fa-users text-muted"></i></span>
				<div class="stat">
					{{ $c_users }}
					<h2>@lang('cpanel.stat.register.users')</h2>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="app_panel app_panel-green animate-in" data-anim-type="bounce-in-down" data-anim-delay="750">
				<span class="icon"><i class="fa fa-users text-muted"></i></span>
				<div class="stat">
					{{ $c_users }}
					<h2>@lang('cpanel.stat.register.users')</h2>
				</div>
			</div>
		</div>

	</div>
@stop text-muted
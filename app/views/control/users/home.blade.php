@section('title') @lang('cpanel.title.users') @stop

@section('breadcrumb')
	<h1>
		@lang('cpanel.title.users')
		
		<span>
			<a href="{{ URL::to(Config::get('appglobal.admin.folder')) }}">@lang('cpanel.breadcrumb.home')</a> / 
			<a href="{{ URL::to(Config::get('appglobal.admin.folder').'/users') }}">@lang('cpanel.breadcrumb.users')</a>
		</span>

	</h1>
@stop

@section('content')
	<table class="table table-bordered animate-in" data-anim-type="bounce-in-down" data-anim-delay="0">
		<thead>
			<tr>
				<th>@lang('cpanel.user.id')</th>
				<th>@lang('cpanel.user.avatar')</th>
				<th>@lang('cpanel.user.realname')</th>
				<th>@lang('cpanel.user.email')</th>
				<th>@lang('cpanel.user.activity')</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr class="animate-in" data-anim-type="bounce-in-left" data-anim-delay="250">
					<td>{{ $user->id }}</td>
					<td></td>
					<td>{{ $user->realname }}</td>
					<td>{{ $user->email }}</td>
					<td>
						<div class="text-muted">
							<strong>@lang('cpanel.user.registration'):</strong> <span class="timeago" title="{{ $user->created_at }}"></span><br>
							<strong>@lang('cpanel.user.updated'):</strong> <span class="timeago" title="{{ $user->updated_at }}"></span><br>
							<strong>@lang('cpanel.user.lastlogin'):</strong> <span class="timeago" title="{{ $user->last_login }}"></span>
						</div>
					</td>
					<td align="center">
						<a href="{{ URL::to(Config::get('appglobal.admin.folder').'/user/'.$user->id.'/remove') }}" class="app_tooltip" data-toggle="tooltip" title="@lang('cpanel.tooltip.delete')" onclick="if(!confirm('@lang('cpanel.user.remove.confirm')')){return false;};"><i class="fa fa-times"></i></a>
						<a href="{{ URL::to(Config::get('appglobal.admin.folder').'/user/'.$user->id.'/edit') }}" class="app_tooltip" data-toggle="tooltip" title="@lang('cpanel.tooltip.edit')"><i class="fa fa-pencil-square-o"></i></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

	<?php echo $users->links(); ?>
@stop
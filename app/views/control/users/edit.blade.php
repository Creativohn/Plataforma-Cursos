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
	
		<?php $usergroup = Usergroup::orderBy('usergroup_title','asc')->lists('usergroup_title', 'usergroup'); ?>
		{{Form::open(array('url' => Config::get('appglobal.admin.folder').'/user/'.$user->id.'/edit'))}}
		<table class="table table-bordered animate-in" data-anim-type="bounce-in-down" data-anim-delay="0">
			<thead>
				<tr>
					<th colspan="3">@lang('cpanel.user.edit.general_info')</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="33%">
						{{ Form::label('realname', trans('cpanel.user.edit.realname')) }}
						{{ Form::text('realname', $user->realname, array('class' => 'form-control')) }}
					</td>

					<td width="33%">
						{{ Form::label('email', trans('cpanel.user.edit.email')) }}
						{{ Form::text('email', $user->email, array('class' => 'form-control')) }}
					</td>

					<td width="33%">
						{{ Form::label('usergroup', trans('cpanel.user.edit.usergroup')) }}
						{{ Form::select('usergroup', $usergroup, $user->usergroup, array('class' => 'form-control')) }}
					</td>

				</tr>
				<tr>
					<td width="33%">
						{{ Form::label('user_status', trans('cpanel.user.edit.user_status')) }}
						{{ Form::select('user_status', array('1' => trans('cpanel.user.edit.validate'), '0' => trans('cpanel.user.edit.unvalidate')), $user->validate_status, array('class' => 'form-control')) }}
					</td>

					<td width="33%">
						
					</td>

					<td width="33%">
						
					</td>

				</tr>

				<thead>
					<tr>
						<th colspan="3">@lang('cpanel.user.edit.chance_password')</th>
					</tr>
				</thead>
				<tbody>
					<td width="33%">
						{{ Form::label('new_password', trans('cpanel.user.edit.new_password')) }}
						{{ Form::password('new_password', array('class' => 'form-control')) }}
					</td>
					<td width="33%">
						{{ Form::label('new_password_confirm', trans('cpanel.user.edit.new_password_confirm')) }}
						{{ Form::password('new_password_confirm', array('class' => 'form-control')) }}
					</td>
					<td width="33%">
						
					</td>
				</tbody>



				<tbody>
					<tr>
						<td colspan="3">{{ Form::submit(trans('cpanel.user.edit.update'), array('class' => 'btn btn-success')); }}</td>
					</tr>
				</tbody>
			</tbody>			
			
		</table>
		{{Form::close()}}
@stop
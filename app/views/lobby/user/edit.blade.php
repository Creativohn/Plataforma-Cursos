@extends('masters.lobby')
@section('title') @lang('lobby.title.page.editprofile') @stop

@section('all_body')
	<div class="wrapper edit_profile">
		<div class="row">
			<div class="col-md-2" id="edit_profile_sidebar">
				1
			</div> <!--- End Columna -->


			<div class="col-md-4 column" id="column-images">
				<h2 class="h2-color1">@lang('lobby.user.edit.images')</h2>
			</div> <!--- End Columna -->


			<div class="col-md-6 column" id="column-info">
				<h2 class="h2-color2">@lang('lobby.user.edit.info')</h2>
				{{Form::open(array('url' => 'mylobby/profile/edit'))}}
				<table class="table table-bodered animate-in" data-anim-type="bounce-in-down" data-anim-delay="0">
					<tbody>
						<tr>
							<td width="50%">
								{{ Form::label('realname', trans('lobby.user.edit.realname')) }}
								{{ Form::text('realname', Auth::user()->realname, array('class' => 'form-control')) }}
							</td>
							<td>
								{{ Form::label('email', trans('lobby.user.edit.email')) }}
								{{ Form::text('email', Auth::user()->email, array('class' => 'form-control', 'disabled')) }}
							</td>
						</tr>
						
						<tr>
							<td>
								{{ Form::label('username', trans('lobby.user.edit.username')) }}
								{{ Form::text('username', Auth::user()->username, array('class' => 'form-control')) }}
							</td>
							<td>
								<?php $countries = Countries::orderBy('country_name','asc')->lists('country_name', 'country_name'); ?>

								{{ Form::label('countries', trans('lobby.user.edit.country')) }}
								{{ Form::select('countries', $countries, Auth::user()->country, array('class' => 'form-control')) }}
							</td>
						</tr>

						<tr>
							<td colspan="2">
								{{ Form::label('biography', trans('lobby.user.edit.biography')) }}
								{{ Form::textarea('biography', Auth::user()->biography, array('class' => 'form-control')) }}
							</td>
						</tr>
					</table>

					<h2 class="h2-color2">Password</h2>
					<table class="table animate-in" data-anim-type="bounce-in-down" data-anim-delay="0">
						<tr>
							<td>
								{{ Form::label('old_password', trans('lobby.user.edit.old_password')) }}
								{{ Form::password('old_password', array('class' => 'form-control')) }}
							</td>
						</tr>
						<tr>
							<td>
								{{ Form::label('new_password', trans('lobby.user.edit.new_password')) }}
								{{ Form::password('new_password', array('class' => 'form-control')) }}
							</td>
						</tr>

						<tr>
							<td>
								{{ Form::label('new_password_confirm', trans('lobby.user.edit.new_password_confirm')) }}
								{{ Form::password('new_password_confirm', array('class' => 'form-control')) }}
							</td>
						</tr>
						<tr>
							<td colspan="3">{{ Form::submit(trans('lobby.user.edit.update'), array('class' => 'btn btn-success')); }}</td>
						</tr>
					</tbody>			
					
				</table>
				{{Form::close()}}
			</div> <!--- End Columna -->


		</div>
	</div>
@stop
@extends('masters.connect')

@section('title') @lang('connect.reset.page.title') @stop

@section('content')
	<div class="box">
		<h2>@lang('connect.register.page.title')</h2>
		<div class="inner">

			{{ Form::open(array('url' => '/password/update', 'id' => 'created-form')) }}

				{{ Form::text( 'email', null, array('class'=>'form-control first-input input-lg', 'placeholder'=>trans('connect.email')) ) }}
				{{ Form::password( 'password', array('class'=>'form-control box-input input-lg', 'placeholder'=>trans('connect.password')) ) }}
				{{ Form::password( 'password_confirmation', array('class'=>'form-control last-input input-lg', 'placeholder'=>trans('connect.password.confirm')) ) }}
				{{ Form::hidden('token', $token) }}
				{{ Form::submit( trans('connect.password.reset'), array('class'=>'btn btn-primary btn-lg') ) }}
				

			{{ Form::close() }}

			<div class="new_account">
				<span class="text-muted">@lang('connect.alreadyexist')</span>
				<a href="{{ URL::to('login') }}" class="btn btn-default">@lang('connect.connect')</a>
			</div>

			<div class="answer"></div>
		</div>
	</div>
@stop
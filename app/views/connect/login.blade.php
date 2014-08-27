@extends('masters.connect')

@section('title') @lang('connect.page.title') @stop

@section('content')
	<div class="box">
		<h2>@lang('connect.page.title')</h2>
		<div class="inner">
			{{ Form::open(array('url' => '/login')) }}

				{{ Form::text( 'email', null, array('class'=>'form-control first-input input-lg', 'placeholder'=>trans('connect.email')) ) }}
				{{ Form::password( 'password', array('class'=>'form-control last-input input-lg', 'placeholder'=>trans('connect.password')) ) }}
				{{ Form::submit( trans('connect.connect'), array('class'=>'btn btn-primary btn-lg') ) }}

			{{ Form::close() }}

			<div class="forgot">
				<a href="{{ URL::to('connect/forgot') }}" class="">@lang('connect.forgotpassword')</a>
			</div>

			<div class="new_account">
				<span class="text-muted">@lang('connect.notaccount')</span>
				<a href="{{ URL::to('register') }}" class="btn btn-default">@lang('connect.createaccount')</a>
			</div>
		</div>
	</div>
@stop
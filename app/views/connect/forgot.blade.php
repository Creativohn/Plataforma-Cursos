@extends('masters.connect')

@section('title') @lang('connect.forgot.page.title') @stop

@section('content')
	<div class="box">
		<h2>@lang('connect.forgot.page.title')</h2>
		<div class="inner">
			{{ Form::open(array('url' => '/connect/forgot/try')) }}

				{{ Form::text( 'email', null, array('class'=>'form-control input-lg', 'placeholder'=>trans('connect.email'), 'style' => 'margin-bottom: 10px;') ) }}
				{{ Form::submit( trans('connect.connect'), array('class'=>'btn btn-primary btn-lg') ) }}

			{{ Form::close() }}

			<div class="new_account">
				<span class="text-muted">@lang('connect.alreadyexist')</span>
				<a href="{{ URL::to('login') }}" class="btn btn-default">@lang('connect.connect')</a>
			</div>
		</div>
	</div>
@stop
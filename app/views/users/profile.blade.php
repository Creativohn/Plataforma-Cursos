@extends('masters.lobby')

@section('title') {{ $profile->username }} @lang('lobby.title.page.on') @stop

@section('all_body')
	<div class="profile">
		
		<div class="header">
			<div class="front_cover" id="front_cover">
				<img src="{{ URL::to(App::make('BaseController')->getUserfrontcover($profile->id)) }}" id="original_cover">

				@if (Auth::check() && Auth::user()->id == $profile->id)
				<div class="btn_change_cover">
					<a href="#" class="btn btn-default" id="a_change_cover"><i class="fa fa-camera"></i> @lang('lobby.user.edit.cover')</a>
					<div class="c"></div>
				</div>
				@endif
			</div>			

			<div class="profile_avatar" id="profile_avatar">
				<img src="{{ URL::to(App::make('BaseController')->getUseravatar($profile->id)) }}">
				
				@if (Auth::check() && Auth::user()->id == $profile->id)
					<div class="btn_change_avatar" id="change_btn_avatar">
						<a href="#" id=""><i class="fa fa-camera"></i></a>
					</div>
				@endif
			</div>

			<div class="profile_avatar_big" id="profile_avatar_big">
				<img src="{{ URL::to('/static/img/default_avatar.jpg') }}">
			</div>

			<div class="username_profile">
				<div class="pull-left">
					{{ $profile->realname }}<br>
					<span class="text-muted">{{ '@'.$profile->username }}</span>
				</div>
				<div class="pull-right">
					<a href="#" class="btn btn-default"><i class="fa fa-envelope"></i></a>

					@if(Auth::check())
						@if ($profile->usergroup != "0" && Auth::user()->id != $profile->id)						
								
								@if (App::make('Lobby_userController')->getFriendship_status($profile->id, Auth::user()->id) == "0")
									<a href="{{ URL::to('mylobby/user/follow').'/'.$profile->id }}" class="btn btn-default">
										@lang('lobby.user.follow')
									</a>
								@else
									<a href="{{ URL::to('mylobby/user/unfollow').'/'.$profile->id }}" class="btn btn-default">
										@lang('lobby.user.unfollow')
									</a>
								@endif

						@endif
					@else
						@if ($profile->usergroup != "0")
							<a href="{{ URL::to('mylobby/user/follow').'/'.$profile->id }}" class="btn btn-default">
								@lang('lobby.user.follow')
							</a>
						@endif
					@endif
				</div>
			</div>
		</div>

		<div class="c"></div>
	</div>

<script>
	var cropperOptions = {
		modal:true,
		customUploadButtonId:'a_change_cover',
		uploadUrl: 'mylobby/profile/cover',
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		cropUrl:'mylobby/profile/cover/crop',
		onAfterImgCrop:		function(){ 
			$('.cropControls').hide();
			setInterval(function(){window.location.reload()}, 1000); 
		}
	}

	var cropperAvatar = {
		modal:true,
		customUploadButtonId:'change_btn_avatar',
		uploadUrl: 'mylobby/profile/avatar',
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		cropUrl:'mylobby/profile/avatar/crop',
		onAfterImgCrop:		function(){ 
			$('.cropControls').hide();
			window.location.reload(); 
		}
	}
</script>
@stop
<?php

Class Lobby_userController extends Basecontroller
{
	protected $layout = "masters.lobby";

	public function __construct() {

		$this->beforeFilter('auth', array('except' => 'getuserprofile'));
	    $this->beforeFilter('csrf', array('on'=>'post', 'except' => array('postchangecover','postcovercrop','postchangeavatar','postavatarcrop') ));
	}

	public function getedit(){
		return $this->layout->content = View::make('lobby.user.edit');
	}

	public function postedit(){
		$userid = Auth::id();
		$rules = array(
			'realname' => 'required|min:10',
			'username' => 'required|min:6|max:35|alpha_dash|unique:users,username,'.$userid,
			'old_password' => 'min:6',
			'new_password' => 'min:6',
			'new_password_confirm' => 'min:6',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()):
			return Redirect::back()->with('message', trans('cpanel.errors.validate'))->with('typealert', 'danger')->withErrors($validator);
	    else:
	    	$user = User::find($userid);
	    	$now = date('Y-m-d H:i:s');
	    	$current_password = Input::get('old_password');

	    	$user->realname = e(Input::get('realname'));
	    	$user->username = e(Input::get('username'));
	    	$user->country = e(Input::get('countries'));
	    	$user->biography = e(Input::get('biography'));
	   
	    	$user->updated_at = $now;

	    	if (Input::get('new_password')  != "" || Input::get('new_password_confirm')  != ""):
	    		if (Input::get('new_password') != Input::get('new_password_confirm')):
	    			return Redirect::back()->with('message', trans('lobby.error.newpasswordnotequal'))->with('typealert', 'danger')->withErrors($validator);
	    		else:
	    			if (Hash::check($current_password, Auth::user()->password))
					{
					    $user->password = Hash::make(Input::get('new_password'));
					}else{
						return Redirect::back()->with('message', trans('lobby.error.currentpassword'))->with('typealert', 'danger')->withErrors($validator);
					}
	    		endif;
	    	endif;	    	

	    	if ($user->save()):
	    		return Redirect::back()->with('message', trans('lobby.message.update_user_info'))->with('typealert', 'success')->withErrors($validator);
	    	endif;

	    endif;

	} // End Function

	public function getUserprofile($username){

		$user = DB::table('users')->where('username', $username)->first();
		return $this->layout->content = View::make('users.profile')->with('profile', $user);
	}

	public function postChangecover(){
	$file = Input::file('img');
	$rules = array(
			'img' => 'required|image',
		);

	$path_upload = Config::get('appglobal.path_uploads').'/temp';
	$file->move($path_upload,$file->getClientOriginalName());
	$height = Image::make($path_upload.'/'.$file->getClientOriginalName())->height();
	$width = Image::make($path_upload.'/'.$file->getClientOriginalName())->width();
	$response = array(
			"status" => 'success',
			"url" => $path_upload.'/'.$file->getClientOriginalName(),
			"width" => $width,
			"height" => $height
	);
	 
	return json_encode($response);

	} // End Function

	public function postChangeavatar(){
	$file = Input::file('img');
	$rules = array(
			'img' => 'required|image',
		);

	$path_upload = Config::get('appglobal.path_uploads').'/temp';
	$file->move($path_upload,$file->getClientOriginalName());
	$height = Image::make($path_upload.'/'.$file->getClientOriginalName())->height();
	$width = Image::make($path_upload.'/'.$file->getClientOriginalName())->width();
	$response = array(
			"status" => 'success',
			"url" => $path_upload.'/'.$file->getClientOriginalName(),
			"width" => $width,
			"height" => $height
	);
	 
	return json_encode($response);

	} // End Function



	public function postCovercrop(){
		$imgUrl = Input::get('imgUrl');
		$imgInitW = Input::get('imgInitW');
		$imgInitH = Input::get('imgInitH');
		$imgW = Input::get('imgW');
		$imgH = Input::get('imgH');
		$imgY1 = Input::get('imgY1');
		$imgX1 = Input::get('imgX1');
		$cropW = Input::get('cropW');
		$cropH = Input::get('cropH');

		$jpeg_quality = 100;
		$path = Config::get('appglobal.path_uploads').'/user/'.Auth::user()->id;
		$filename = 'cover_'.str_random(20);
		$output_filename = $path.'/'.$filename;
		if (!File::exists($path))
		{
			File::makeDirectory($path, $mode = 0777, true, true);
		}
		$what = getimagesize($imgUrl);
		switch(strtolower($what['mime']))
		{
		    case 'image/png':
		        $img_r = imagecreatefrompng($imgUrl);
				$source_image = imagecreatefrompng($imgUrl);
				$type = '.png';
		        break;
		    case 'image/jpeg':
		        $img_r = imagecreatefromjpeg($imgUrl);
				$source_image = imagecreatefromjpeg($imgUrl);
				$type = '.jpeg';
		        break;
		    case 'image/gif':
		        $img_r = imagecreatefromgif($imgUrl);
				$source_image = imagecreatefromgif($imgUrl);
				$type = '.gif';
		        break;
		    default: die('image type not supported');
		}

		$resizedImage = imagecreatetruecolor($imgW, $imgH);
		imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, 
					$imgH, $imgInitW, $imgInitH);	
		
		
		$dest_image = imagecreatetruecolor($cropW, $cropH);
		imagecopyresampled($dest_image, $resizedImage, 0, 0, $imgX1, $imgY1, $cropW, 
					$cropH, $cropW, $cropH);	


		if(imagejpeg($dest_image, $output_filename.$type, $jpeg_quality)):

			$user = User::find(Auth::user()->id);
			if ($user->front_cover != "0"):
				File::delete($path.'/'.$user->front_cover);
				File::delete($imgUrl);
			endif;
			$user->front_cover = $filename.$type;
			$user->save();

		endif;
		
		$response = array(
				"status" => 'success',
				"url" => $output_filename.$type 
			  );
		 return json_encode($response);

	} // endfunction

	public function postAvatarcrop(){
		$imgUrl = Input::get('imgUrl');
		$imgInitW = Input::get('imgInitW');
		$imgInitH = Input::get('imgInitH');
		$imgW = Input::get('imgW');
		$imgH = Input::get('imgH');
		$imgY1 = Input::get('imgY1');
		$imgX1 = Input::get('imgX1');
		$cropW = Input::get('cropW');
		$cropH = Input::get('cropH');

		$jpeg_quality = 100;
		$path = Config::get('appglobal.path_uploads').'/user/'.Auth::user()->id;
		$filename = 'avatar_'.str_random(20);
		$output_filename = $path.'/'.$filename;
		if (!File::exists($path))
		{
			File::makeDirectory($path, $mode = 0777, true, true);
		}
		$what = getimagesize($imgUrl);
		switch(strtolower($what['mime']))
		{
		    case 'image/png':
		        $img_r = imagecreatefrompng($imgUrl);
				$source_image = imagecreatefrompng($imgUrl);
				$type = '.png';
		        break;
		    case 'image/jpeg':
		        $img_r = imagecreatefromjpeg($imgUrl);
				$source_image = imagecreatefromjpeg($imgUrl);
				$type = '.jpeg';
		        break;
		    case 'image/gif':
		        $img_r = imagecreatefromgif($imgUrl);
				$source_image = imagecreatefromgif($imgUrl);
				$type = '.gif';
		        break;
		    default: die('image type not supported');
		}

		$resizedImage = imagecreatetruecolor($imgW, $imgH);
		imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, 
					$imgH, $imgInitW, $imgInitH);	
		
		
		$dest_image = imagecreatetruecolor($cropW, $cropH);
		imagecopyresampled($dest_image, $resizedImage, 0, 0, $imgX1, $imgY1, $cropW, 
					$cropH, $cropW, $cropH);	


		if(imagejpeg($dest_image, $output_filename.$type, $jpeg_quality)):

			$user = User::find(Auth::user()->id);
			if ($user->avatar != "0"):
				File::delete($path.'/'.$user->avatar);
				File::delete($imgUrl);
			endif;
			$user->avatar = $filename.$type;
			$user->save();

		endif;
		
		$response = array(
				"status" => 'success',
				"url" => $output_filename.$type 
			  );
		 return json_encode($response);

	} // endfunction

	public function getFriendship_status($user_to,$user_from){
		$check = DB::table('user_friendship')->where('userid_from', $user_from)->where('userid_to', $user_to)->first();

		if (is_null($check)):
			return '0';
		else:
			return $check->friendship_status;
		endif;
	} // End Function

	public function getAddfollowtouser($usertofollow){
		$user_from = Auth::user()->id;
		$type_user = DB::table('users')->select('id', 'usergroup')->where('id', $usertofollow)->first();
		
		if(is_null($type_user) || $type_user->usergroup == "0"):
			return Redirect::back()->with('message', trans('lobby.user.error.cannotfollowtouser'))->with('typealert', 'danger');
		else:
			
			$check = DB::table('user_friendship')->where('userid_from', $user_from)->where('userid_to', $usertofollow)->first();
			if(is_null($check)):
				$friendship = New Userfriendship;
				$friendship->userid_from = $user_from;
				$friendship->userid_to = $usertofollow;
				if($friendship->save()):
					return Redirect::back()->with('message', trans('lobby.user.follow.beginfollow'))->with('typealert', 'success');
				endif;
			else:
				if($check->friendship_status == "0"):
					$friendship = Userfriendship::find($check->id);
					$friendship->friendship_status = "1";
					if($friendship->save()):
						return Redirect::back()->with('message', trans('lobby.user.follow.beginfollow'))->with('typealert', 'success');
					endif;
				else:
					return Redirect::back()->with('message', trans('lobby.user.follow.exist'))->with('typealert', 'danger');
				endif;
			endif;
		endif;
	} // End Function

	public function getUnfollowuser($usertounfollow){
		$user_from = Auth::user()->id;
		$check = DB::table('user_friendship')->where('userid_from', $user_from)->where('userid_to', $usertounfollow)->first();
		
		if(is_null($check)):
			return Redirect::back()->with('message', trans('lobby.user.error.unfollow'))->with('typealert', 'danger');
		else:
			$friendship = Userfriendship::find($check->id);
			$friendship->friendship_status = "0";
			if($friendship->save()):
				return Redirect::back()->with('message', trans('lobby.user.beginunfollow'))->with('typealert', 'success');
			endif;
		endif;
	}

}
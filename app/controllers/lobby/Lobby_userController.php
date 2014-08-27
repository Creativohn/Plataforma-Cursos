<?php

Class Lobby_userController extends Basecontroller
{
	protected $layout = "masters.lobby";

	public function __construct() {

		$this->beforeFilter('auth');
	    $this->beforeFilter('csrf', array('on'=>'post'));
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
		return $this->layout->content = View::make('users.profile')->with('user', $user);
	}

}
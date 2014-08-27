<?php 

class Control_usersController extends BaseController
{
	protected $layout = "masters.control";

	public function __construct() {

		$this->beforeFilter('auth');
		$this->beforeFilter(function()
        {
            if (Auth::user()->usergroup != '2'){
            	return Redirect::to('/');
            }

        });
	    $this->beforeFilter('csrf', array('on'=>'post'));
	}

	public function getIndex(){
		$users = DB::table('users')->orderBy('created_at','desc')->paginate(25);
		$this->layout->content = View::make('control.users.home')->with('users', $users);

	}

	public function getEdit($id)
	{
		$user = User::find($id);
		$this->layout->content = View::make('control.users.edit')->with('user', $user);
	} // End Function 

	public function postEdit($id){
		$rules = array(
			'realname' => 'required|min:10',
			'email' => 'required|email'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()):
			return Redirect::back()->with('message', trans('cpanel.errors.validate'))->with('typealert', 'danger')->withErrors($validator);
	    else:
	    	$user = User::find($id);
	    	$now = date('Y-m-d H:i:s');

	    	$user->realname = e(Input::get('realname'));
	    	$user->email = Input::get('email');
	    	$user->usergroup = Input::get('usergroup');
	    	$user->validate_status = Input::get('user_status');
	    	$user->updated_at = $now;

	    	if (Input::get('new_password')  != "" || Input::get('new_password_confirm')  != ""):
	    		if (Input::get('new_password') != Input::get('new_password_confirm')):
	    			return Redirect::back()->with('message', trans('cpanel.error.passwordnotequal'))->with('typealert', 'danger')->withErrors($validator);
	    		else:
	    			$user->password = Hash::make(Input::get('new_password'));
	    		endif;
	    	endif;

	    	if ($user->save()):
	    		return Redirect::back()->with('message', trans('cpanel.message.updateok'))->with('typealert', 'success')->withErrors($validator);
	    	endif;


	    endif;

	}
}
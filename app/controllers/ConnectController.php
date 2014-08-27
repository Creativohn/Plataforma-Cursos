<?php 
class ConnectController extends BaseController
{

	protected $layout = "masters.connect";

	public function __construct() {

		$this->beforeFilter('auth', array('only' => 'getlogout'));
		$this->beforeFilter(function()
        {
            if (Auth::check()){
            	return Redirect::to('/');
            }

        }, array('except' => 'getlogout'));
	    $this->beforeFilter('csrf', array('on'=>'post'));
	}


	public function getLogin()
	{
		return $this->layout->content = View::make("connect.login");
	}

	public function postLogin()
	{
		if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {

			$user = User::find(Auth::user()->id);

			$user->last_login = date('Y-m-d H:i:s');
			$user->save();

			switch (Auth::user()->usergroup) {
		   		case '0':
		   			return Redirect::to('mylobby');
		   		break;

		   		case '1':
		   			return Redirect::to('masters');
		   		break;

		   		case '2':
		   			return Redirect::to(Config::get('appglobal.admin.folder'));
		   		break;
		   	}

		} else {
		    return Redirect::to('login')
		        ->with('message', trans('connect.badlogin'))
		        ->with('typealert', 'danger')
		        ->withInput();
		}
	}

	public function getLogout(){
		Auth::logout();
		return Redirect::to('/');
	}

	public function getRegister()
	{
		return $this->layout->content = View::make("connect.register");
	}

	public function postNewuser()
	{
		$rules = array(
			'realname' => 'required|min:10',
			'email' => 'required|email',
			'password' => 'required|min:6'
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()):
			return Redirect::to('register')->with('message', trans('connect.register.error'))->with('typealert', 'danger')->withErrors($validator)->withInput();
	    else:

	    	$user = DB::table('users')->where('email', Input::get('email'))->first();

	    	if(is_null($user)):

	    		$validate_code = str_random(40);

		    	$user = new User;
		    	$user->usergroup = "0";
		    	$user->validate_code = $validate_code;
		    	$user->validate_status = "0";
				$user->realname = e(Input::get('realname'));
				$user->email = Input::get('email');
				$user->password = Hash::make(Input::get('password'));

		    	if($user->save()):
		    		Mail::send('emails.welcome', array('name' => Input::get('realname'), 'email' => Input::get('email') ,'validate_code' => $validate_code), function($message){
		    			$message->to(Input::get('email'), Input::get('realname'))->from('noreply@ceocursos.com', trans('connect.email.from.name'))->subject('Bienvenido a nuestra plataforma');
		    		});

		    	$user_check = DB::table('users')->where('email', Input::get('email'))->first();
		    	$user_config = new UserConfiguration;
		    	$user_config->userid = $user_check->id;
		    	$user_config->email = Input::get('email');
		    	$user_config->save();

		    		return Redirect::to('login')->with('message', trans('connect.register.success'))->with('typealert','success');
		    	endif;

	    	else:
	    		return Redirect::to('register')->with('message', trans('connect.user.exist'))->with('typealert', 'danger')->withErrors($validator)->withInput();
	    	endif;
	    endif;
	} // End Function

	public function getForgot()
	{
		return $this->layout->content = View::make("connect.forgot");
	} // End Funtion
	

	public function postForgot()
	{
		$rules = array(
			'email' => 'required|email',
		);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()):
			return Redirect::to('connect/forgot')->with('message', trans('connect.forgot.email.error'))->with('typealert', 'danger')->withErrors($validator)->withInput();
	    else:

	    	$user = DB::table('users')->where('email', Input::get('email'))->first();

	    	if(is_null($user)):
	    		return Redirect::to('connect/forgot')->with('message', trans('connect.forgot.email.noexist'))->with('typealert', 'danger')->withErrors($validator)->withInput();
	    	else:
	    		$credentials = array('email' => Input::get('email'));
 
  				Password::remind($credentials, function($message)
				{
				    $message->from('noreply@ceocursos.com', trans('connect.email.from.name'))->subject('Password Reminder');
				});

				return Redirect::to('connect/forgot')->with('message', trans('connect.forgot.email.send'))->with('typealert', 'success')->withInput();

	    	endif;
	    endif;

	}

	public function getResetpassword($token){
		return $this->layout->content = View::make("connect.reset")->with('token', $token);
	} // End Function

	public function postPasswordupdate(){
		$credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->with('message', Lang::get($response))->with('typealert', 'danger');

            case Password::PASSWORD_RESET:
            	Mail::send('emails.passwordreset', array('password' => Input::get('password')), function($message){
		    			$message->to(Input::get('email'))->from('noreply@ceocursos.com', trans('connect.email.from.name'))->subject(trans('connect.forgot.password.reset'));
		    	});
                return Redirect::to('/login')->with('message', trans('connect.forgot.password.reset'))->with('typealert', 'success');
        }
	}

}
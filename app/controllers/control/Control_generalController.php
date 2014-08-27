<?php 
class Control_generalController extends BaseController
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
		$count_users = DB::table('users')->count();
		$this->layout->content = View::make('control.home')
									->with('c_users', $count_users);
	}

}
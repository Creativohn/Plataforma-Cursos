<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function getUseravatar($userid){

		$user = User::find($userid);

		if ($user->avatar == "0"):
			return URL::to('/static/img/default_avatar.jpg');
		else:
			return URL::to('/uploads/user').'/'.$user->id.'/'.$user->avatar;
		endif;

	}

	public function getUserfrontcover($userid){

		$user = User::find($userid);

		if ($user->front_cover == "0"):
			return URL::to('/static/img/front_cover.jpg');
		else:
			return URL::to('/uploads/user').'/'.$user->id.'/'.$user->front_cover;
		endif;

	}

}

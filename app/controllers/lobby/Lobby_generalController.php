<?php

Class Lobby_generalController extends Basecontroller
{
	protected $layout = "masters.lobby";

	public function __construct() {

		$this->beforeFilter('auth');
	    $this->beforeFilter('csrf', array('on'=>'post'));
	}

	public function getIndex(){
		return $this->layout->content = View::make('lobby.home');
	}

}
<?php

$localesAllowed = array('es','en');

define('DEFAULT_LANG', 'en');

if(!Session::has('locale'))
	Session::put('locale', DEFAULT_LANG);

if(Input::has('lang'))
	if(in_array(Input::get('lang'), $localesAllowed))
		Session::put('locale', Input::get('lang'));
	else
		Session::put('locale', DEFAULT_LANG);


	App::setLocale(Session::get('locale'));

?>
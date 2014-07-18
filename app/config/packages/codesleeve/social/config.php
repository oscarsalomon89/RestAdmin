<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Routing array
	|--------------------------------------------------------------------------
	|
	| This is passed to the Route::group and allows us to group and filter the
	| routes for our package
	|
	*/
	'routing' => array(
		'prefix' => '/social'
	),

	/*
	|--------------------------------------------------------------------------
	| facebook array
	|--------------------------------------------------------------------------
	|
	| Login and request things from facebook.
	|
	*/
	'facebook' => array(
		'key' => '676733425743501',
		'secret' => '4e3e1f48665ce03aceac1b3c673f33d1',
		'scopes' => array('email'),
		'redirect_url' => '/',
	),

	/*
	|--------------------------------------------------------------------------
	| twitter array
	|--------------------------------------------------------------------------
	|
	| Login and request things from twitter
	|
	*/
	'twitter' => array(
		'key' => '',
		'secret' => '',
		'scopes' => array(),
		'redirect_url' => '/',
	),

	/*
	|--------------------------------------------------------------------------
	| google array
	|--------------------------------------------------------------------------
	|
	| Login and request things from google
	|
	*/
	'google' => array(
		'key' => '',
		'secret' => '',
		'scopes' => array(),
		'redirect_url' => '/',
	),
	
	/*
	|--------------------------------------------------------------------------
	| github array
	|--------------------------------------------------------------------------
	|
	| Login and request things from github
	|
	*/
	'github' => array(
		'key' => '',
		'secret' => '',
		'scopes' => array(),
		'redirect_url' => '/',
	),

);

<?php

/**
 * Creativo Framework
 * @version 1.0.0
 * @author Brayan E. Rincon
 */

define('ROOT', realpath(dirname(__FILE__)) .DS );

define('DEFAULT_FORMAT', 'json');

require_once PATH_API . 'defines.php';
require_once PATH_FRAMEWORK . 'eviroment.php';
require_once PATH_FRAMEWORK . 'Creative.php';
require_once PATH_FRAMEWORK . 'Autoload.php';
require_once PATH_KERNEL . 'Conexant.php';
require_once PATH_KERNEL . 'sessions/Session.php';

require_once PATH_KERNEL . 'Lang.php';

abstract class Initialize 
{
	public static function execute()
	{
		Creative::add( 'Conexant' );
		Creative::add( 'Hash' );
		Creative::add( 'Session' );
		Creative::add( 'View' );

		App::initialize();
		Lang::set_locale( App::get('locale') );

		Auth::initialize();
		Registry::initialize();
		Creative::get( 'Session' )->initialize();
	}
}

Initialize::execute();

<?php

/** 
 * -------------------------------------------------------------------
 * Creative - A PHP Framework For Web Mega Creativo
 * -------------------------------------------------------------------
 * 
 * @package     Creative
 * @author      Brayan Rincon <brayan262@gmail.com>
 */


/**
 * Global variable that ensures that the Frame is initialized
 * 
 * Variable global que asegura que el Framework se inicializó
 */
define("CREATIVE", TRUE);


/**
 * Sets the time at which the script is executed
 * 
 * Establece el tiempo en el que se ejecuta el script
 */
define('CREATIVE_START', microtime(true));


/**
 * Minimum PHP version required
 * 
 * Versión mínima de PHP requerida
 */
define('CREATIVE_MINIMUM_PHP', '5.6');


/**
 * Evaluate if the minimum PHP version is installed
 * 
 * Evalua si la versión mínima de PHP está instalada
 */
if (version_compare(PHP_VERSION, CREATIVE_MINIMUM_PHP, '<')){
	die('Your host needs to use PHP ' . CREATIVE_MINIMUM_PHP . ' or higher to run this version of Creative Framework!');
}


/**
 * Separador de directorios según el S.O.
 * 
 * Separador de directorios según el S.O.
 */
define('DS', DIRECTORY_SEPARATOR);


/**
 * Project root directory
 * 
 * Directorio raíz del proyecto
 */
define('PATH_ROOT', realpath(dirname(__FILE__)) .DS. '..' .DS );


define('PATH_APP', PATH_ROOT . 'application' .DS);

define('PATH_FRAMEWORK', PATH_APP . 'framework' .DS);

define('PATH_KERNEL', PATH_FRAMEWORK .'kernel' .DS);

define('PATH_CONF', PATH_APP .DS. 'conf' .DS);


/**
 * Evaluate the existence of the global configuration file
 * 
 * Evalua la existencia del archivo de configuración global
 */
if( !file_exists(PATH_APP . DS . 'settings.json') ){
    echo "Environment Settings File NOT Found: " . PATH_APP . DS. 'settings.json';
    exit;
}


/**
 * It executes the checking of the settings set in in the 
 * settings.json and the load to be used.
 * 
 * Ejecuta la comprobación de las configuraciones establecidas 
 * en en el settings.json  y las carga para ser utilizadas
 */
require_once PATH_APP . 'framework/SettingsAnalyzer.php';
SettingsAnalyzer::execute();



define('PATH_PUBLIC_HTML', PATH_ROOT . PUBLIC_HTML .DS);

define('PATH_API', PATH_ROOT . 'api' .DS);

$GLOBALS['CREATIVE']['CONF'] = array();

?>
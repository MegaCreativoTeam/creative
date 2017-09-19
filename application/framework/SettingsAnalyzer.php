<?php

/**
 * 
 */
abstract class SettingsAnalyzer 
{
    
	/**
	 * Analyze the structure of the Environment 
	 * configuration File and load them into the application
	 * 
	 * @author Brayan Rincon <brincon@megacreativo.com>
	 */
    public static function execute()
    {
        $content = '';
		if ( file_exists( PATH_APP . 'settings.json') )
		{
			$content = json_decode(file_get_contents(PATH_APP . 'settings.json') , true );
		} 
		else 
		{
			exit( '<strong>Error in Environment Configuration File</strong>' );
		}

		if( $content['hash_key'] == '' )
		{
			exit( 'You must generate a new Hash Key. Use the command <strong>"php creative key generate"</strong> to generate a new Hash Key, or modify the key of the file <strong>"/aplication/configuration.json"</strong>' );
		}

		foreach( $content as $key => $value )
		{
			define( strtoupper($key), $value );
		}
    }
}

?>
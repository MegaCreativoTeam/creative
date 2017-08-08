<?php
abstract class App 
{

    private static $config;

    public static function initialize(){
        self::$config = Creative::include_config( 'app' );
    }


    public static function get( $key ){
       if( isset(self::$config[$key]) )
            return self::$config[$key];
        else 
            return '';
    }
    
}

?>
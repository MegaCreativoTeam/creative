<?php
abstract class Auth 
{

    private static $config;


    public static function initialize(){
        self::$config = Creative::include_config( 'auth' );;
    }

    public static function get( $key ){
        if( isset(self::$config[$key]) )
            return self::$config[$key];
        else 
            return '';
    }

    public static function get_all(){
        return self::$config;
    }
    
}

?>
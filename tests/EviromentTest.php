<?php

class EviromentTest extends \PHPUnit_Framework_TestCase
{
    public function testPathEviroment ()
    {
        $root = __DIR__ . DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR ;
        $directories = [
            'application',
            'application/conf',
            'application/controllers',
            'application/models',
            'application/framework',
            'application/framework/kernel',
            'application/temporal',
            'public_html',
            'api',
            'application/conf',
        ];

        foreach ( $directories as $key =>  $value )
        {
            $this->assertDirectoryExists( $root . $value );
        }

    }


    public function testFilesEviroment ()
    {
        $root = __DIR__ . DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR ;
        $directories = [
            'application/initialize.php' ,
            'application/settings.json',
            'application/framework/Autoload.php',
            'application/framework/Creative.php',
            'application/framework/CreativeBase.php',
            'application/framework/Defines.php',
            'application/framework/ErrorHandler.php',
            'application/framework/Eviroment.php',
            'application/framework/ExceptionHandler.php',
            'application/framework/Functions.php',
            'application/framework/ExceptionHandler.php',
            'application/framework/LogsHandler.php',
            'application/framework/SettingsAnalyzer.php',
        ];

        foreach ( $directories as $index =>  $file )
        {
            $type = end(explode( '.', $root . $file  ));
            switch ( true ) {
                case $type == 'json':
                    $content = file_get_contents( $root . $file );
                    $json = json_decode( $content, true );
                break;

                case $type == 'php':                    
                default:
                    $this->assertFileIsReadable( $root . $file );
                break;
            }            
            
        }

    }


    
    public function testFilesInKernel ()
    {
        $path_files = __DIR__ . DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR . 'application/framework/kernel';
        $files = scandir($path_files);
        
        foreach ($files as $key => $value) 
        {
            $path = $path_files.'/'.$value;
            if( strpos($value, '.php') ){
                $this->assertFileIsReadable( $path );
            }
        }

    }



}
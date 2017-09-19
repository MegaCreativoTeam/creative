<?php

class EviromentTest extends \PHPUnit_Framework_TestCase
{
    public function testPathEviroment ()
    {
        $root = __DIR__ . DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR ;
        $directories = [
            'application' => 'Directory "application" Not found',
            'application/conf' => '',
            'application/controllers' => '',
            'application/models' => '',
            'application/framework' => '',
            'application/framework/kernel' => '',
            'application/temporal' => '',
            'public_html' => '',
            'api' => '',
        ];

        foreach ( $directories as $directory =>  $message )
        {
            $message = $message != '' ? $message : $directory;
            $this->assertDirectoryExists( $root . $directory,  'Directory: "'. $message . '" Not found');
        }

    }


    public function testFilesEviroment ()
    {
        $root = __DIR__ . DIRECTORY_SEPARATOR .'..'. DIRECTORY_SEPARATOR ;
        $directories = [
            'application/initialize.php' ,
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
            
            switch ( true ) {
                case strripos($file, 'json'):
                    $content = file_get_contents( $root . $file );
                    $json = json_decode( $content, true );
                break;

                case strripos($file, 'php'):                    
                default:
                $message = $message != '' ? $message : $directory;
                    $this->assertFileIsReadable( $root . $file , 'File: "' .$message . '" Not found' );
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
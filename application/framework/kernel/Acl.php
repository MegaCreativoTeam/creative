<?php

/**
 * 
 * 
 * @copyright   © 2017 Brayan Rincon
 * @version     1.0.0
 * @author      Brayan Rincon <brayan262@gmail.com>
*/
abstract class Acl {
	
	private static 
		  $_registry
		, $_db
		, $_user_id
		, $profile_id
		, $_permissions
		, $_ambit
		, $_table = 'users'
		, $_table_permissions
		, $_conex 
		, $_permissions_user
		, $_async ;
	
	

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
    public static function initialize( $async = FALSE  )
	{
		self::$_async = $async;
		
		if( ! isset( Session::auth()['auth']) OR ! Session::auth()['auth'] )
		{
			/*if( self::$_async )
			{
				$response = [
					'status'=> 401,
					'statusText' => Lang::get('http_error.401'),
					'time' => date('d/m/Y H:m:s'),
					'icon' => 'error',
				];		
				
		        header('Content-Type: application/json; charset=utf8');
		        echo json_encode($response, JSON_PRETTY_PRINT);
				exit;
			}*/
			return FALSE;
		}
		
		self::$_user_id = Session::auth()['id'];
		self::$profile_id = Session::auth()['profile_id'];
		self::$_ambit = Session::auth()['ambit'];
		
		self::$_table = Auth::get('user_ambit')[self::$_ambit];
		self::$_table_permissions = Auth::get('user_ambit')[self::$_ambit]['table'] . '_meta';
 		
        self::reload();
    }
    
    
    
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	private static function get_permissions_user( )
	{	
		if( ! isset( Session::auth()['auth']) OR ! Session::auth()['auth'] )
		{
			if( self::$_async == FALSE )
			{
				header('location: /accounts/auth/');
				exit;	
			}
			else
			{
				return false;
			}			
		}

		$permissions = Creative::get( 'Conexant' )->execute(
			"SELECT 
				* 
			FROM administrators_meta 
			WHERE 
				administrator_id = ".Session::auth()['id']."		
		");
		
		$data = [
			'modules' => [],
			'fields' => []
		];
		 
		foreach( $permissions as $row => $attr )
		{		
			if( $attr['attr'] == 'permission-module' )
			{
				$data['modules'][$attr['name']] = self::format($attr['content']);
			}
			
			if( $attr['attr'] == 'permission-field' )
			{
				$data['fields'][$attr['name']] = self::format($attr['content']);
			}
		}		
		return $data;		
    }

    
	/**
	* 
	* @param undefined $usuario_id
	* 
	* @return
	*/
	public static function reload()
	{		
		self::$_permissions_user = self::get_permissions_user();
		$_SESSION['auth']['permissions'] = self::$_permissions_user ;
		return self::$_permissions_user;
	}
	

	/**
	 * Undocumented function
	 *
	 * @param [type] $content
	 * @return void
	 */
    private static function format( $content )
	{
		$result = [];		
		foreach( explode(',',$content) as $key => $value )
		{
			$per = explode(':', $value);
			$result[$per[0]] = $per[1];
		}
		return $result;
	}
	

	/**
	 * Undocumented function
	 *
	 * @param [type] $type
	 * @param [type] $key
	 * @return void
	 */
    public static function get( $type, $key )
	{
        if( isset(self::$_permissions_user[$type][$key]) )
		{
			return self::$_permissions_user[$type][$key];            
        }        
        return false;
    }
    

	/**
	 * Undocumented function
	 *
	 * @param [type] $ambito
	 * @return void
	 */
	public static function auth()
	{
		if(isset($_SESSION['auth']['auth']))
		{
			return $_SESSION['auth']['auth'];
		} 
		else 
		{
			return false;
		}		
	}
	
	
	/**
	 * Undocumented function
	 *
	 * @param [type] $module
	 * @param string $level
	 * @return void
	 */
	public static function access_module( $module, $level = 'read' )
	{
		//Verificar si el usuario está autenticado
		if( ! self::auth() )
		{
			if( self::$_async === FALSE )
			{
				if ( !isset($_SERVER['PHP_AUTH_USER']) )
				{
					//$realm = 'Authorization Required';
					//header('WWW-Authenticate: Basic realm="'.$realm.'"' );
					header('HTTP/1.0 401 Unauthorized');
					echo '<meta  http-equiv="refresh" content="0;url=/accounts/auth/">';
					exit;	
				}
			}
			else
			{	
				if ( !isset($_SERVER['PHP_AUTH_USER']) )
				{
					$realm = 'Authorization Required';
					//header('WWW-Authenticate: Basic realm="'.$realm.'"' );
					header('HTTP/1.0 401 Unauthorized');

					$response = [
						'status'=> 401,
						'statusText' => Lang::get('http_error.401'),
						'time' => date('d/m/Y H:m:s'),
						'icon' => 'error',
					];						
					
					header('Content-Type: application/json; charset=utf8');
					echo json_encode($response, JSON_PRETTY_PRINT);
					exit;
				}				
			}
			
			/** esto estaba antes return false;**/
		}

		$module = str_ireplace('Controller','',$module);

		//Determinar el tiempo de sessión y si ha expirado el tiempo
		Session::time_now();		

		//Obtiener el usuario
		$user_id = Session::auth()['id'];
		self::reload();			
		
		$permissions = self::$_permissions_user['modules'];
		$permissions = $permissions[$module];
		$permissions = $permissions[$level];

		if( $permissions != '1' OR $permissions == NULL )
		{
			if( self::$_async === FALSE )
			{
				if ( !isset($_SERVER['PHP_AUTH_USER']) )
				{
					$realm = 'Authorization Required';
					header('WWW-Authenticate: Basic realm="'.$realm.'"' );
					header('HTTP/1.0 401 Unauthorized');
					header('location: /errors/backend/401');
				}	
				exit;				
			}
			else
			{	
				if ( !isset($_SERVER['PHP_AUTH_USER']) )
				{
					$realm = 'Authorization Required';
					header('WWW-Authenticate: Basic realm="'.$realm.'"' );
					header('HTTP/1.0 401 Unauthorized');

					$response = [
						'status'=> 401,
						'statusText' => Lang::get('http_error.401'),
						'time' => date('d/m/Y H:m:s'),
						'icon' => 'error',
					];						
					
					header('Content-Type: application/json; charset=utf8');
					echo json_encode($response, JSON_PRETTY_PRINT);
					exit;
				}				
			}
		}
    }
    
    

	/**
	 * Undocumented function
	 *
	 * @param [type] $module
	 * @param string $level
	 * @return void
	 */
	public static  function access_view_module( $module, $level = 'read', $async = FALSE )
	{
		//Verificar si el usuario está autenticado
		if( ! self::auth() )
		{
			return false;
		}

		$module = str_ireplace('Controller','',$module);

		//Determinar el tiempo de sessión y si ha expirado el tiempo
		//Session::time_now();		

		//Obtiener el usuario
		$user_id = Session::auth()['id'];
		self::reload();
		
		$permissions = self::reload();

		if( isset($permissions['modules'][$module]) )
		{
			$permissions = $permissions['modules'][$module][$level];

			if( $permissions != '1' OR $permissions == NULL )
			{
				return FALSE;
			}
			else 
			{
				return TRUE;
			}	
		}

    }
    

				
	/**
	 * Undocumented function
	 *
	 * @param [type] $module
	 * @param string $level
	 * @return void
	 */
	public static function access_field( $module, $field )
	{
		//Obtiener el usuario
		$user_id = Session::auth()['id'];
		self::reload();			
		
		$module = str_ireplace('Controller','',$module);

		$permissions = self::$_permissions_user['fields'];

		if( isset($permissions[$module][$field]) )
		{
			$permissions = $permissions[$module][$field];
			return $permissions;		
		}

    }
    /*
    public function get_modulo_nombre( $permisoID ){
        $permisoID = (int) $permisoID;
        
        $key = $this->_db->query(
                "select `permiso` from permisos " .
                "where id_permiso = {$permisoID}"
                );
                
        $key = $key->fetch();
        return $key['permiso'];
    }
        
    public function _get_permisos(){
        if(isset($this->_permisos) && count($this->_permisos))
            return $this->_permisos;
    }
    
    public function permiso($key){
        if(array_key_exists($key, $this->_permisos)){
            if($this->_permisos[$key]['valor'] == true || $this->_permisos[$key]['valor'] == 1){
                return true;
            }
        }        
        return false;
    }
    
    public function acceso($key){   
        if($this->permiso($key)){
            Session::tiempo();
            return;
        }        
        header("location:" . BASE_URL . "error/clientes/5050");
        exit;
    }*/
}

?>

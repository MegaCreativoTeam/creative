<?php

/**
 * Implements an interface that can be used to perform a query to the database 
 * that returns an ARRAY with two columns "key" and "value"
 * 
 * Implementa una interfaz que puede ser usado para realizar una consulta a la 
 * base de datos que devuelve un ARRAY con dos columnas "key" y "value"
 * 
 * @package Components
 * @author Brayan Rincon <brayan262@gmail.com>
 * 
 */
class DataSource
{	
	private $_DataSources = array();
		
	

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function initialize()
	{
		return $this;
	}


	/**
	 * Crea un nuevo Data Soruce
	 * 
	 * 
	 * @param string $name Name of DataSource
	 * @param array $property Properties 
	 * 
	 * 
	 * @return void
	 */
	public function create( $name, $property )
	{	
		$dsi = new DataSourceItem();
		$dsi->create($name, $property);
		$this->_DataSources[$name] = $dsi;
		return $dsi;
	}
	
	
	/**
	 * Devuelve el DataSource asociado al nombre
	 * @param undefined $name
	 * 
	 * @return
	 */
	public function get ( $name )
	{
		if( isset($this->_DataSources[$name]) )
		{
			return $this->_DataSources[$name];
		}
		else 
		{
			return NULL;
		}
	}
	


	/**
	 * Devuelve el DataSource asociado al nombre
	 * @param undefined $name
	 * 
	 * @return
	 */
	public function get_stock ( $name )
	{
		$path_file = PATH_APP . 'datasources' .DS. $name . '.php';

		if(is_file($path_file) AND is_readable($path_file)){
			return include_once $path_file;
		}
		else 
		{
			return NULL;
		}
	}



	/**
	* Devuelve el DataSource asociado al nombre
	* @param undefined $name
	* 
	* @return
	*/
	public function get_datails ( $name )
	{
		if( isset($this->_DataSources[$name]) )
		{
			return [
				  'name' => $name
				, 'datasources'=>$this->_DataSources[$name]
			];
		} 
		else
		{
			return NULL;
		}
	}
	
	
	/**
	 * 
	 * @param undefined $name
	 * 
	 * @return
	 */
	public function execute ( $name )
	{		
		if( isset($this->_DataSources[$name]) )
		{			
			$dsi  = $this->_DataSources[$name];
			$table = $dsi->source;

			$data = [];

			$dsi->source = self::load_model($dsi->source);

			$data = $dsi->source->exec("SELECT ".$dsi->key.", ".$dsi->value."  FROM ".$table." ORDER BY ".$dsi->value." DESC" );

			foreach( $$data as $key => $value)
			{
				$result[] = [
					  'key' => $value[$dsi->key]
					, 'value' => $value[$dsi->value]
				];
			}
			return $result;
		} 
		else
		{
			return NULL;
		}	
	}
	
	/**
	* Carga o crea un nuevo Modelo Generico
	* @param undefined $modelo
	* 
	* @return
	*/
	public static function load_model( $model, $primary_key = 'id' )
	{		
		$model =  $model . 'Model';
		$path_model = PATH_APP . 'mvc' .DS. 'models' .DS. $model . '.php';
		
		if (is_readable($path_model))
		{
			require_once $path_model;
			$model = new $model;
			return $model; 
		} 
		else 
		{			
			$path_model =  PATH_KERNEL . 'ModelGenerator.php';
			
			if (is_readable($path_model))
			{
				$table = str_ireplace('Model','', $model);
				$ModelGenerator = 'ModelGenerator';
				$model = new $ModelGenerator($table, $primary_key);
		  		return $model;
			} 
			else 
			{				
				return FALSE;
			}
		}
	}
	
	
}





class DataSourceItem
{
	
	private 
		$_datasource = array(),
		$_name = '';
	/**
	* Crea un nuevo Data Soruce
	* @param undefined $name Nombre del DataSource
	* @param undefined $property Propiedades de DAtaSource
	* 
	* @return
	*/
	public function create( $name, $property )
	{
		$this->_name = $name;
		$this->_datasource = (object) array(
			'source'=> $property['source'],
			'key'	=> $property['key'],
			'value'	=> $property['value']
		);		
		return $this;
	}

	
	
	public function execute ()
	{		
			
		$result = [];
		$dsi = $this->_datasource ;
		$table = $dsi->source;
		
		$data = Creative::add( 'Conexant' )->execute("SELECT ".$dsi->key.", ".$dsi->value."  FROM ".$table." ORDER BY ".$dsi->value." ASC" );

		foreach( $data as $key => $value)
		{
			$result[$value[$dsi->key]] = $value[$dsi->value];
		}
		return $result;
	}


}



?>
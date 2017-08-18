<?php



/**
 * Undocumented class
 */
class Model
{
	
	protected 
		  $table = ''
		, $pk = 'id'
		, $variables = []
		
		, $DB_USER 
		, $DB_PASSWORD 
		, $DB_HOST = 'localhost'
		, $DB_DATABASE 
		, $DB_PORT 
		, $DB_COLLATE ;
		
	
	/**
	 * Undocumented function
	 *
	 * @param [type] $DB_USER
	 * @param [type] $DB_PASSWORD
	 * @param [type] $DB_DATABASE
	 * @param string $DB_HOST
	 * @param string $DB_PORT
	 * @param string $DB_COLLATE
	 */
    public function __construct ( $DB_USER=NULL, $DB_PASSWORD=NULL, $DB_DATABASE=NULL , $DB_HOST='localhost', $DB_PORT = '3306', $DB_COLLATE = 'utf8')
	{
    	if( $DB_USER == NULL)
		{
			$this->DB_USER 		= DB_USER;
			$this->DB_PASSWORD 	= DB_PASSWORD;
			$this->DB_HOST 		= DB_HOST;
			$this->DB_DATABASE 	= DB_DATABASE;
			$this->DB_PORT 		= DB_PORT;
			$this->DB_COLLATE 	= DB_COLLATE;
		}
		else
		{
			$this->DB_USER 		= $DB_USER;
			$this->DB_PASSWORD 	= $DB_PASSWORD;
			$this->DB_HOST 		= $DB_HOST;
			$this->DB_DATABASE 	= $DB_DATABASE;
			$this->DB_PORT 		= $DB_PORT;
			$this->DB_COLLATE 	= $DB_COLLATE;
		}
    }
    

	/**
	 * Undocumented function
	 *
	 * @param [type] $name
	 * @param [type] $value
	 */
	public function __set ($name,$value)
	{
		if(strtolower($name) === $this->pk)
		{
			$this->variables[$this->pk] = $value;
		}
		else
		{
			$this->variables[$name] = $value;
		}
	}
	
	
	/**
	 * Undocumented function
	 *
	 * @param [type] $name
	 * @return void
	 */
	public function __get ($name)
	{	
		if(is_array($this->variables))
		{
			if(array_key_exists($name,$this->variables))
			{
				return $this->variables[$name];
			}
		}
		return null;
	}
	
	
	/**
	 * Undocumented function
	 *
	 * @param [type] $pk
	 * @return void
	 */
	public function change_pk ( $pk )
	{
		$this->pk = $pk;
		return $this;
	}
	
	
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function begin ()
	{
		Creative::get( 'Conexant' )->begin();
	}
	
	
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function commit ()
	{
		Creative::get( 'Conexant' )->commit();
	}
	

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function rollback ()
	{
		Creative::get( 'Conexant' )->rollback();
	}
	
	
	
	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function affected()
	{
		$result = Creative::get( 'Conexant' )->row_count();
		return $result;
	}
	

	/**
	 * Undocumented function
	 *
	 * @param array $fields
	 * @param array $sort
	 * @return void
	 */
	public function likeor ( $fields = [], $sort = [] )
	{		
		$bindings = $this->variables;		

		$_fields = '';
		if( count($fields) > 0 )
		{
			foreach($fields as $key => $value)
			{
				$_fields .= ', ' . $value .' AS '. $key;
			}
		}
		$_fields = ' '.$_fields.' ';
		
		$sql = "SELECT * {$_fields} FROM " . $this->table;
		
		if ( !empty($bindings) )
		{
			$fields_values = [];
			$columns = array_keys($bindings);
			foreach($columns as $column)
			{
				$fields_values[] = $column . " LIKE :". $column;
				$this->variables[$column] = "%".$bindings[$column]."%";
			}
			$sql .= " WHERE " . implode(" OR ", $fields_values);
		}
		
		if (!empty($sort))
		{
			$sort_values = [];
			foreach ($sort as $key => $value)
			{
				$sort_values[] = $key . " " . $value;
			}
			$sql .= " ORDER BY " . implode(", ", $sort_values);
		}

		return $this->exec($sql);
	}
	
	
	/**
	 * Undocumented function
	 *
	 * @param array $fields
	 * @param array $sort
	 * @param boolean $lower
	 * 
	 * @return array
	 */
	public function search ($fields = [], $sort = [])
	{
		$bindings = empty($fields) ? $this->variables : $fields;
		$sql = "SELECT * FROM " . $this->table;

		if (!empty($bindings))
		{
			$fieldsvals = [];
			$columns = array_keys($bindings);
			foreach($columns as $column)
			{
				$fieldsvals [] = $column . " = :". $column;
				$this->variables[$column] = $bindings[$column];
			}
			$sql .= " WHERE " . implode(" AND ", $fieldsvals);
		}
		
		if (!empty($sort))
		{
			$sortvals = [];
			foreach ($sort as $key => $value)
			{
				$sortvals[] = $key . " " . $value;
			}
			$sql .= " ORDER BY " . implode(", ", $sortvals);
		}
		return $this->execute($sql);
	}
	


	/**
	 * Undocumented function
	 *
	 * @param array $fields
	 * @param array $sort
	 * @return array
	 */
	public function row ( $fields = [], $sort = [] )
	{		
		$result = $this->search( $fields, $sort );
		if ( !is_null($result) )
		{
            if ( !is_object($result) )
			{
            	return count($result) > 0 ? $result[0] : [];
            } else {
            	return $result[0];
            }
        }
        return [];
	}


	/**
	 * Undocumented function
	 *
	 * @return int
	 */
    public function last_id ()
	{
		return Creative::get( 'Conexant' )->last_insert_id();
    }
    
    
    
	/**
	 * Undocumented function
	 *
	 * @param [type] $fields
	 * @param [type] $filter
	 * @param [type] $value
	 * @param string $addon
	 * @return void
	 */
	public function filter ( $fields, $filter, $value, $addon = '' )
	{
		
		if( !in_array( $filter, $fields) or $value == '')
		{
			array(
				"status"=>300,
				"response"=>array(
					"message"=>'Los parametros de busqueda ingresados no son válidos, o están vacíos',
					"icon"=>'warning'
				)
			);	
		}
		
		if( $filter == 'all' )
		{
			$columns = '';
			$values = array($id);
			foreach( $fields as $key => $val)
			{
				if( $val !== 'all' )
				{
					$columns .= $val . " LIKE ? OR ";
					array_push($values, "%".$value."%");
				}
			}
			
			$columns = substr($columns,0, strlen($columns)-4);
			$data = $this->exec("
				SELECT * FROM ".$this->table." WHERE {$addon} (".$columns.")
			", $values);
		}
		else 
		{
			$data = $this->exec("
				SELECT * FROM ".$this->table." WHERE {$addon} ".$filter." LIKE ?
			", array($id, "%".$value."%"));
		}	
		
		return array("status"=>200,"response" =>$data);
      	
	}
	
	

	/**
	 * Undocumented function
	 *
	 * @param string $sql
	 * @param array $params
	 * @return array
	 */
	public function exec ($sql, $params = [])
	{
		return $this->execute($sql, $params);
	}


	/**
	 * Undocumented function
	 *
	 * @param string $sql
	 * @param array $params
	 * @return array
	 */
	public function execute ($sql, $params = [])
	{		
		if( count($params) )
		{
			$result =  Creative::get( 'Conexant' )->execute($sql, $params);	
		}
		else 
		{
			$result =  Creative::get( 'Conexant' )->execute($sql, $this->variables);	
		}		
		// Empty bindings
		$this->variables = [];
		return $result;
	}
	
    
	/**
	* Obtiene todos los registro de una tabla
	* @param undefined $sort
	* 
	* @return
	*/
    public function all ( $field_others = array(), $sort = array() )
	{
    	$sql_sort = '';
    	if (!empty($sort))
		{
			$sortvals = array();
			foreach ($sort as $key => $value)
			{
				$sortvals[] = $key . " " . $value;
			}
			$sql_sort .= " ORDER BY " . implode(", ", $sortvals);
		}
		
		$fields = '';
		if( count($field_others)>0 )
		{
			foreach($field_others as $key => $value){
				$fields .= ', ' . $value .' AS '. $key;
			}
		}
		$fields = ' '.$fields.' ';
		return $this->exec("SELECT *" .$fields. " FROM {$this->table} " . $sql_sort ) ;
	}


	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function create ()
	{ 
		$bindings   	= $this->variables;

		if(!empty($bindings))
		{
			$fields     =  array_keys($bindings);
			$fieldsvals =  array(implode(",",$fields),":" . implode(",:",$fields));
			$sql 		= "INSERT INTO ".$this->table." (".$fieldsvals[0].") VALUES (".$fieldsvals[1].")";
		}
		else
		{
			$sql 		= "INSERT INTO ".$this->table." () VALUES ()";
		}
		return $this->exec($sql);
	}
		

	/**
	 * Undocumented function
	 *
	 * @param [type] $value
	 * @param [type] $field
	 * @return void
	 */
	public function exists ( $value , $field = NULL)
	{
		$field = $field ? trim($field) : $this->pk;
		$sql = "SELECT count(1) existence FROM {$this->table} WHERE {$field} = :{$field}";
		$row = $this->execute($sql, [$field => $value]);
		
		if( count($row) > 0 )
		{
			return $row[0]['existence'] > 0 ? TRUE : FALSE;
		}			
		else 
		{
			return FALSE;
		}			
	}
	
		
	/**
	 * Undocumented function
	 *
	 * @param integer $fields
	 * @return void
	 */
	public function update ( $fields = 0 )
	{	
		$this->variables[$this->pk] = (empty($this->variables[$this->pk])) ? $fields : $this->variables[$this->pk];
		$fieldsvals = '';
		$columns = array_keys($this->variables);

		foreach($columns as $column)
		{
			if($column !== $this->pk)
			$fieldsvals .= $column . " = :". $column . ",";
		}
		$fieldsvals = substr_replace($fieldsvals , '', -1);
		
		if(count($columns) > 1 )
		{
			$sql = "UPDATE {$this->table} SET {$fieldsvals} WHERE {$this->pk} = :{$this->pk}";
			if($fields === "0" && $this->variables[$this->pk] === "0")
			{ 
				unset($this->variables[$this->pk]);
				$sql = "UPDATE {$this->table} SET {$fieldsvals}";
			}
			return $this->execute($sql);
		}
		
		return null;
	}


	/**
	* Elimina un registro específico por su clave primaria
	* @param undefined $id 
	* 
	* @return
	*/
	public function delete ( $id )
	{
		if(!empty($id))
		{
			$sql = "DELETE FROM {$this->table} WHERE {$this->pk} = :{$this->pk}" ;
		}
		return $this->execute( $sql, [$this->pk => $id] );
	}
		

	/**
	* Busca un registro por su clave primaria
	* @param undefined $id
	* 
	* @return
	*/
	public function find ($field_others = array())
	{		
		$id = $this->variables[$this->pk];
		
		$fields = '';
		if( count($field_others)>0 )
		{
			foreach($field_others as $key => $value)
			{
				$fields .= ', ' . $value .' AS '. $key;
			}
		}
		$fields = ' '.$fields.' ';
		
		if( !empty($id) )
		{
			$sql = "SELECT *" .$fields. " FROM " . $this->table ." WHERE " . $this->pk . "= :" . $this->pk ;	
			
			$result = Creative::get( 'Conexant' )->row($sql, array($this->pk=>$id));
			return ($result != false) ? $result : null;
		}
	}
	
		
	/**
	 * Undocumented function
	 *
	 * @param [type] $field
	 * @return void
	 */
	public function min ($field)
	{
		if($field)
		{
			return $this->single("SELECT min({$field}) result FROM {$this->table}");
		}		
	}
	

	/**
	 * Undocumented function
	 *
	 * @param [type] $field
	 * @return void
	 */
	public function max ($field)
	{
		if($field)
		{
			return $this->single("SELECT max({$field}) result FROM {$this->table}");
		}		
	}
	

	/**
	 * Undocumented function
	 *
	 * @param [type] $field
	 * @return void
	 */
	public function avg($field)
	{
		if($field)
		{
			return $this->single("SELECT avg({$field}) result FROM {$this->table}");
		}		
	}
	

	/**
	 * Undocumented function
	 *
	 * @param [type] $field
	 * @return void
	 */
	public function sum($field)  {
		if($field)
		{
			return $this->single("SELECT sum({$field}) result FROM {$this->table}");
		}		
	}
	

	/**
	 * Undocumented function
	 *
	 * @param [type] $field
	 * @return void
	 */
	public function count($field)  {
		if($field)
			return $this->single("SELECT count({$field}) result FROM {$this->table}");
	}	
	
}


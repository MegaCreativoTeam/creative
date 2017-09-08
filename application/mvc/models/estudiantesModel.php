<?php

class estudiantesModel extends Model
{

    public function __construct(){
		$this->table = 'estudiantes';
		$this->pk = 'id';
		parent::__construct();
    }


    public function encontrar ( $value )
    {
        $data = Creative::get( 'Conexant' )->execute("
            SELECT 
                 e.*
                ,c.nombre carrera
                ,CASE 
                    WHEN e.status = 0 THEN 'Inactivo' 
                    WHEN e.status = 1 THEN 'Activo' 
                END status_text 
                ,CASE 
                    WHEN e.status = 0 THEN 'danger' 
                    WHEN e.status = 1 THEN 'success' 
                END status_class 
                ,CASE 
                    WHEN e.status = 0 THEN 'Inactivo'  
                    WHEN e.status = 1 THEN 'Activo'  
                END status_info 
            FROM estudiantes e
                LEFT JOIN carreras c ON e.carrera_id = c.id
            WHERE e.cedula LIKE '%{$value}%' OR e.apellido LIKE '%{$value}%' OR e.email LIKE '%{$value}%'
        ");
        return $data;
    }


    public function search_record ( $field, $value )
    {
        $data = Creative::get( 'Conexant' )->execute("
            SELECT 
                 e.*
                ,c.nombre carrera
                ,CASE 
                    WHEN e.status = 0 THEN 'Inactivo' 
                    WHEN e.status = 1 THEN 'Activo' 
                END status_text 
                ,CASE 
                    WHEN e.status = 0 THEN 'danger' 
                    WHEN e.status = 1 THEN 'success' 
                END status_class 
                ,CASE 
                    WHEN e.status = 0 THEN 'Inactivo'  
                    WHEN e.status = 1 THEN 'Activo'  
                END status_info 
            FROM estudiantes e
                LEFT JOIN carreras c ON e.carrera_id = c.id
            WHERE e.{$field} LIKE :{$field}
        ", [ $field => "%".$value."%" ]
        );
        return $data;
    }


    /**
     * Undocumented function
     *
     * @param [type] $field
     * @param [type] $value
     * @return void
     */
    public function getdata_byid ( $id = NULL )
    {
        if( ! is_numeric($id) )
        {
            return [];
        }

        $data = Creative::get( 'Conexant' )->execute("
            SELECT 
                 e.* 
                ,c.nombre carrera 
                ,CASE 
                    WHEN e.status = 0 THEN '".Lang::get('dashboard.status.active')."' 
                    WHEN e.status = 1 THEN '".Lang::get('dashboard.status.inactive')."' 
                END
                ,CASE 
                    WHEN e.status = 0 THEN 'danger' 
                    WHEN e.status = 1 THEN 'success' 
                END status_class 
                ,CASE 
                    WHEN e.status = 0 THEN '".Lang::get('dashboard.status.active')."' 
                    WHEN e.status = 1 THEN '".Lang::get('dashboard.status.inactive')."' 
                END status_info 
            FROM estudiantes e 
                LEFT JOIN carreras c ON e.carrera_id = c.id
            WHERE e.id = :id
            ", [ 'id' => $this->pSQL($id) ]
        );

        if( count( $data) )
        {
            return $data[0]; 
        } else {
            return [];
        }
       
    }
    
}

?>
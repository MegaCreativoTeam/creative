<?php

class pensumModel extends Model
{

    const
        SQL_QUERY_BODY = "
        SELECT 
             p.id
            ,p.sede_id	
            ,p.carrera_id carrera_id
            ,c.codigo carrera_codigo
            ,c.nombre carrera_nombre
                
            ,p.created
            ,p.last_update
            ,p.status
            ,CASE 
                WHEN p.status = 0 THEN 'Inactivo' 
                WHEN p.status = 1 THEN 'Activo' 
            END status_text 
            ,CASE 
                WHEN p.status = 0 THEN 'danger' 
                WHEN p.status = 1 THEN 'success' 
            END status_class 
            ,CASE 
                WHEN p.status = 0 THEN 'Inactivo'  
                WHEN p.status = 1 THEN 'Activo'  
            END status_info 
        FROM pensum p 
            LEFT JOIN carreras c ON p.carrera_id = c.id
            LEFT JOIN sedes s ON p.sede_id = s.id ";


    public function __construct()
    {
		$this->table = 'pensum';
		$this->pk = 'id';
		parent::__construct();
    }



    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function _all ()
    {
        $data = Creative::get( 'Conexant' )->execute(
            self::SQL_QUERY_BODY . "            
            ORDER BY c.nombre ASC
            "
        );
        return $data;
    }



    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function _find ( $id )
    {
        $data = Creative::get( 'Conexant' )->execute(
            self::SQL_QUERY_BODY . 
            "    
            WHERE p.id = :id         
            ORDER BY c.nombre ASC
            ", [ 'id' => $this->pSQL($id) ]
        );

        if( is_array($data) AND count($data) )
        {
            return $data[0];
        }
        else 
        {
            return [];
        }
    }

}

?>
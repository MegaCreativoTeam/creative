<?php

class pagosModel extends Model
{

    public function __construct(){
		$this->table = 'pagos';
		$this->pk = 'id';
		parent::__construct();
    }


    public function listar ()
    {
        $data = Creative::get( 'Conexant' )->execute("
            SELECT 
                 p.*
                ,e.cedula estudiante_cedula
                ,e.nombre estudiante_nombre
                ,e.apellido estudiante_apellido
                ,c.nombre estudiante_carrera
                ,CONCAT(e.nombre,' ',e.apellido) estudiante
                ,g.nombre gateway
                ,CASE 
                    WHEN p.status = 0 THEN 'Activo' 
                    WHEN p.status = 1 THEN 'Inactivo' 
                END AS status_text, CASE 
                    WHEN p.status = 0 THEN 'danger' 
                    WHEN p.status = 1 THEN 'success' 
                END AS status_class, CASE 
                    WHEN p.status = 0 THEN 'Activo' 
                    WHEN p.status = 1 THEN 'Inactivo' 
                END AS status_info 
            FROM pagos p
                LEFT JOIN estudiantes e ON p.estudiante_id = e.id
                LEFT JOIN carreras c ON p.carrera_id = c.id
                LEFT JOIN gateways g ON p.gateway_id = g.id
        ");
        return $data;
    }



    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function get ( $id )
    {
        $data = Creative::get( 'Conexant' )->execute("
            SELECT 
                 p.*
                ,e.cedula estudiante_cedula
                ,e.nombre estudiante_nombre
                ,e.apellido estudiante_apellido
                ,c.nombre estudiante_carrera
                ,CONCAT(e.nombre,' ',e.apellido) estudiante
                ,g.nombre gateway
                ,CASE 
                    WHEN p.status = 0 THEN 'Activo' 
                    WHEN p.status = 1 THEN 'Inactivo' 
                END AS status_text, CASE 
                    WHEN p.status = 0 THEN 'danger' 
                    WHEN p.status = 1 THEN 'success' 
                END AS status_class, CASE 
                    WHEN p.status = 0 THEN 'Activo' 
                    WHEN p.status = 1 THEN 'Inactivo' 
                END AS status_info 
            FROM pagos p
                LEFT JOIN estudiantes e ON p.estudiante_id = e.id
                LEFT JOIN carreras c ON p.carrera_id = c.id
                LEFT JOIN gateways g ON p.gateway_id = g.id
            WHERE p.id = ?  ORDER BY p.nrecibo ASC
        ", [$id]);


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
<?php

class matriculasModel extends Model
{

    public function __construct()
    {
		$this->table = 'matriculas';
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
        $data = Creative::get( 'Conexant' )->execute("
            SELECT 
                 id
                ,anio
                ,sufijo
                ,autoiniciar
                ,created
                ,last_update
                ,CONCAT( anio, '-', sufijo ) matricula
                ,DATE_FORMAT(desde, '%Y-%m-%dT%H:%i') desde
                ,DATE_FORMAT(hasta, '%Y-%m-%dT%H:%i') hasta
                ,DATE_FORMAT(desde, '%d/%m/%Y') desde_short
                ,DATE_FORMAT(hasta, '%d/%m/%Y') hasta_short
                ,status
                ,CASE 
                    WHEN status = 0 THEN 'Inactivo' 
                    WHEN status = 1 THEN 'Activo' 
                END status_text 
                ,CASE 
                    WHEN status = 0 THEN 'danger' 
                    WHEN status = 1 THEN 'success' 
                END status_class 
                ,CASE 
                    WHEN status = 0 THEN 'Inactivo'  
                    WHEN status = 1 THEN 'Activo'  
                END status_info 
            FROM matriculas 
                ORDER BY matricula ASC
        ");


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
        $data = Creative::get( 'Conexant' )->execute("
            SELECT 
                 id
                ,anio
                ,sufijo
                ,autoiniciar
                ,created
                ,last_update
                ,CONCAT( anio, '-', sufijo ) matricula
                ,DATE_FORMAT(desde, '%Y-%m-%dT%H:%i') desde
                ,DATE_FORMAT(hasta, '%Y-%m-%dT%H:%i') hasta
                ,DATE_FORMAT(desde, '%d/%m/%Y') desde_short
                ,DATE_FORMAT(hasta, '%d/%m/%Y') hasta_short
                ,status
                ,CASE 
                    WHEN status = 0 THEN 'Inactivo' 
                    WHEN status = 1 THEN 'Activo' 
                END status_text 
                ,CASE 
                    WHEN status = 0 THEN 'danger' 
                    WHEN status = 1 THEN 'success' 
                END status_class 
                ,CASE 
                    WHEN status = 0 THEN 'Inactivo'  
                    WHEN status = 1 THEN 'Activo'  
                END status_info 
            FROM matriculas 
                WHERE id = :id
            ORDER BY matricula ASC
        ", [ 'id' => $this->pSQL($id) ]);


        if( is_array($data) AND count($data) )
        {
            return $data[0];
        }
        else 
        {
            return [];
        }
        
    }



    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function search_by_matricula ( $matricula )
    {
        $data = Creative::get( 'Conexant' )->execute("
            SELECT 
                 id
                ,anio
                ,sufijo
                ,autoiniciar
                ,created
                ,last_update
                ,CONCAT( anio, '-', sufijo ) matricula
                ,DATE_FORMAT(desde, '%Y-%m-%dT%H:%i') desde
                ,DATE_FORMAT(hasta, '%Y-%m-%dT%H:%i') hasta
                ,DATE_FORMAT(desde, '%d/%m/%Y') desde_short
                ,DATE_FORMAT(hasta, '%d/%m/%Y') hasta_short
                ,status
                ,CASE 
                    WHEN status = 0 THEN 'Inactivo' 
                    WHEN status = 1 THEN 'Activo' 
                END status_text 
                ,CASE 
                    WHEN status = 0 THEN 'danger' 
                    WHEN status = 1 THEN 'success' 
                END status_class 
                ,CASE 
                    WHEN status = 0 THEN 'Inactivo'  
                    WHEN status = 1 THEN 'Activo'  
                END status_info 
            FROM matriculas 
                WHERE CONCAT(anio,'-',sufijo) LIKE ?
            ORDER BY matricula ASC
        ", [ '%'.$this->pSQL($matricula).'%' ]);


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
<?php 

return [

    'name' => 'Creative',
    'company_name' => '',
    'version'=>1,
    
    'locale' => 'es',

    'compress' => false,


    /**
     * ------------------------------------------------------------------------------
     * Deleted Logic
     * ------------------------------------------------------------------------------
     * This property tells the system whether at the time of a request to delete a 
     * record from the database it is deleted from the table completely or it will
     * only change the Record Status to a value determined by the property 
     * "Logic Deleted Indicator". When set to TRUE, the record is not deleted from the database, 
     * it only changes its status to that indicated with the property "deleted_logic_indicator"
     * 
     * 
     * Esta propiedad le indica al sistema si al momento de una petición de eliminar 
     * algún registro de la base de datos se elimina de la tabla por completo o sólo 
     * cambiará el Estatus del Registro a un valor determinado por la propiedad 
     * "Indicador de Eliminado Lógico". Al ser establecido como TRUE, el registro no se
     * elimina de la base de datos, sólo cambia su estatus al indicado con la 
     * propiedad "deleted_logic_indicator"
     * 
     * @var bool
     */
    'deleted_logic' => true,



    /**
     * ------------------------------------------------------------------------------
     * Deleted Logic Indicator
     * ------------------------------------------------------------------------------
     * Value of the status assigned to a record that has been logically deleted
     * 
     * Valor del estatus asignado a un registro que ha sido eliminado de forma lógica
     * 
     * @var bool
     */
    'deleted_logic_indicator' => -100,



    /**
     * ------------------------------------------------------------------------------
     * Recordps per Page
     * ------------------------------------------------------------------------------
     * Sets the number of records per page that will be displayed by default 
     * in the pager of a query
     * 
     * Establece la cantidad de Registros por página que se mostraran
     *  por defecto en el paginador de una consulta
     * 
     * @var int
     */
    'records_per_page' => 25,

];

?>
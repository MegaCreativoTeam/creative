<?php
/** 
 * ------------------------------------------------------------------------
 * Controller dashboard
 * ------------------------------------------------------------------------
 * #
 * 
 * @category Controllers
 * @version 1.0.0
 * @author name <name@email.com>
 */
class inscripcionesController extends backendController 
{
    function __construct() {
		parent::__construct(__CLASS__);
		
		/**
		* Default template in which views are rendered
		*/
        $this->view->template ( 'default' );
        
        $this->view->theme( BACKEND );
		/**
		* This global variable saves an instance 
		* in a table that matches the class name
		*/
		$this->model = $this->load_model('inscripciones');

		/**
		* Avoid caching
		*/
        $this->no_cache();
    }



    /** 
     * ------------------------------------------------------------------------
     * Default Index Method
     * ------------------------------------------------------------------------
     * #
     * 
     * @author name <name@email.com>
     */
    public function index(){
	

      
      $this->view->template ( 'default' );        
      $this->view->theme( BACKEND );
      $this->view->ambit( BACKEND );

      $this->view->render(__FUNCTION__, [
          'active_menu' => 'management',
      ]);

    }
}


?>
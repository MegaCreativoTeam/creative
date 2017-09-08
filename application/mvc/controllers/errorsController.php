<?php
/** -----------------------------------------------------------------------
 * Index Controller
 * ------------------------------------------------------------------------
 * #
 * 
 * @category Controllers
 * @version 1.0.0
 * @author name <name@email.com>
 */
class errorsController extends Controller 
{
    function __construct() {
		parent::__construct(__CLASS__);
		
		/**
		* Default template in which views are rendered
		*/
        $this->view->template ( 'default' );

		/**
		* Avoid caching
		*/
        $this->no_cache();
    }



    /**
     * Undocumented function
     *
     * @return void
     */
    public function index( $eeror = '404' ){

        $this->view->render( '_http_.' . $eeror );
    }


    /** 
     * ------------------------------------------------------------------------
     * Default Index Method
     * ------------------------------------------------------------------------
     * #
     * 
     * @author name <name@email.com>
     */
    public function backend( $error = FALSE){
        //$this->view->template( 'default' );
        //$this->view->theme( BACKEND);
        $this->render_error( __FUNCTION__, $error );
    }


    /**
     * Undocumented function
     *
     * @param boolean $error
     * @return void
     */
    public function frontend( $error = FALSE){
        $this->render_error( __FUNCTION__, $error );
    }


    public function render_error( $ambit, $error ){
       $this->view->render( '_http_.' . $error);
    }
}


?>
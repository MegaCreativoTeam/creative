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
	
        Acl::access_module( __CLASS__ );

        $this->view->template ( 'default' );        
        $this->view->theme( BACKEND );
        $this->view->ambit( BACKEND );


        $html = Creative::get( 'Components' )->render('HtmlBasic');

		/*$panelbox = $html->panelbox([
            'label'=>'Datos personales',
            'style' => 'style="display: none;"'
		]);

        $registry = Registry::get( 'estudiantes_listado' );
		foreach ($registry['fields_info'] as $key => $attr) {
			$acl = Acl::access_field( 'estudiantes_listado', $key );
			if( $acl != 0 )
			{
				$comp = $html->component(
					$attr['type'],
					[
						'id'	=> $key,
						'col'	=> $attr['col'],
						'type'	=> $attr['type'],
						'label'	=> $attr['text'],
						'readonly'=> $acl == 2 ? TRUE : FALSE,
						'required'=> isset($attr['required']) ? $attr['required'] : FALSE,
						'items'	=> isset($attr['items']) ? $attr['items'] : NULL,
						'multiple'=> isset($attr['multiple']) ? $attr['multiple'] : NULL,
						'row'=> isset($attr['row']) ? $attr['row'] : NULL,
					]
				);
				$panelbox->add( $comp );	
			}	
		}
		
        $panelbox->write();*/
        


        $this->view->render(__FUNCTION__, [
        'active_menu' => 'management',
        ]);

    }
}


?>
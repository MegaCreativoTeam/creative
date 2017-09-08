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
class matriculasController extends backendController 
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
		$this->model = $this->load_model('matriculas');

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
		
		$ModalRecord = Creative::get( 'Components' )->render('ModalRecord', array(
            'add_record'			=> TRUE
          , 'controller_delete'	=> '/api/v1/'.$this->controller_name.'.json/'
          , 'controller_save' 	=> '/api/v1/'.$this->controller_name.'.json/'
          , 'controller_load'	=> '/api/v1/'.$this->controller_name.'.json/'
          , 'size' 				=> 'md'
          , 'text' 			=> $this->controller_name
        ));
      
      $registry = Registry::get( $this->controller_name );

      foreach ($registry['fields_info'] as $key => $attr) {
          $ModalRecord->add_field(
              [
                  'id'	=> $key,
                  'col'	=> $attr['col'],
                  'type'	=> $attr['type'],
                  'label'	=> $attr['text'],
                  'required'=> isset($attr['required']) ? $attr['required'] : FALSE,
                  'items'	=> isset($attr['items']) ? $attr['items'] : NULL,
                  'multiple'=> isset($attr['multiple']) ? $attr['multiple'] : NULL,
                  'placeholder'=> isset($attr['placeholder']) ? $attr['placeholder'] : NULL,
                  'min'=> isset($attr['min']) ? $attr['min'] : NULL,
                  'max'=> isset($attr['max']) ? $attr['max'] : NULL,
                  'maxlength'=> isset($attr['maxlength']) ? $attr['maxlength'] : NULL,
                  'default'=> isset($attr['default']) ? $attr['default'] : NULL,
                  'align'=> isset($attr['align']) ? $attr['align'] : NULL,
              ],
              $this->controller_name
          );
      }
      
      //Escribe el componente
      $ModalRecord->write();
      
      
      $this->view->assign('data'	, $this->model->_all() );
      
      $this->view->assign('title'	, ucfirst($this->controller_name) ); //Título de la Vista
      $this->view->assign('module'	, $this->controller_name ); //Título de la Vista
      $this->view->assign('filters'	, Registry::get( $this->controller_name )['filters']);
      
      //Prepara la tabla
      $this->view->assign('table', array(
          'columns'		=> array(
              'matricula'		=> array(
                  'text' 	=> 'Matricula',
                  'primary'	=> TRUE,
              ),
              'desde_short'	=> array(
                  'text' 	=> 'Desde',
                  'type' => 'date',
                  'format' => '%d/%m/%Y'
              ),
              'hasta_short'	=> array(
                  'text' => 'Hasta',
                  'type' => 'date',
                  'format' => '%d/%m/%Y'
              ),
              'status_text'	=> array(
                  'text' => 'Estatus',
                  'align' => 'center',
                  'type'	=> 'label',
                  'labelclass' => 'status_class',
                  'tooltips' => 'status_info'
              ),
          ), //Indica las columnas que se mostrarán
          
          'view'		=> TRUE, //Indica si se mostrará la columna de Visualizar
          'edit'		=> Acl::access_view_module( $this->controller_name, 'update' ), //Indica si se mostrará la columna de Editar
          'delete'	    => Acl::access_view_module( $this->controller_name, 'delete' )  //Indica si se mostrará la columna de Eliminar
      ));
      


      //Indica si se mostrará el botón de Agregar
      $this->view->assign('btn_add', Acl::access_view_module( $this->controller_name, 'created' ));

      //Indica si se mostrará el texto del botón Agregar
      $this->view->assign('btn_add_text', TRUE);			

      //Indica si se mostrará el botón de Imprimir
      $this->view->assign('btn_print', Acl::access_view_module( $this->controller_name, 'print' ));

      //Indica si se mostrará el botón de Compartir
      $this->view->assign('btn_shared', FALSE);

      //Indica si se mostrará el botón de Busqueda Avanzada
      $this->view->assign('btn_search_avanced', TRUE);

      //Indica si se mostrará las Opciones de busqueda
      $this->view->assign('search', TRUE);              
          
      
      $this->view->template ( 'default' );        
      $this->view->theme( BACKEND );
      $this->view->ambit( BACKEND );

      $this->view->render(__FUNCTION__, [
          'active_menu' => 'management',
      ]);

    }
}


?>
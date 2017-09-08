<?php

class materiasController extends backendController
{

	
	public function __construct()
	{
		parent::__construct();
		$this->no_cache();
		$this->module = __CLASS__;
		$this->module_name = str_ireplace('controller', '',  __CLASS__);
		$this->model = $this->load_model( Registry::get('materias')['table'] );
	}
	
	
	
	/**
	* 
	* 
	* @return
	*/
	public function index() {
		
			
		$ModalRecord = Creative::get( 'Components' )->render('ModalRecord', array(
			  'add_record'			=> TRUE
			, 'controller_delete'	=> '/api/v1/'.$this->controller_name.'.json/'
			, 'controller_save' 	=> '/api/v1/'.$this->controller_name.'.json/'
			, 'controller_load'		=> '/api/v1/'.$this->controller_name.'.json/'
			, 'size' 				=> 'sm'
			, 'text' 			=> $this->controller_name
		));
		
		$registry = Registry::get( 'materias' );

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
				],
				'materias'
			);
		}
		
		//Escribe el componente
		$ModalRecord->write();
		
		
		$this->view->assign('data'	, $this->model->all(array(
			"status_text" =>
				"CASE 
					WHEN status = 0 THEN '".Lang::get('dashboard.status.active')."' 
					WHEN status = 1 THEN '".Lang::get('dashboard.status.inactive')."' 
				END",
			"status_class" =>
				"CASE 
					WHEN status = 0 THEN 'danger' 
					WHEN status = 1 THEN 'success' 
				END",
			"status_info" => 
				"CASE 
					WHEN status = 0 THEN '".Lang::get('dashboard.status.active')."' 
					WHEN status = 1 THEN '".Lang::get('dashboard.status.inactive')."' 
				END",
			)
		));
		
		$this->view->assign('title'		, ucfirst($this->controller_name) ); //Título de la Vista
		$this->view->assign('module'	, $this->controller_name ); //Título de la Vista
		$this->view->assign('filters'	, Registry::get('materias')['filters']);
		
		//Prepara la tabla
		$this->view->assign('table', array(
			'columns'		=> array(
				'codigo'		=> array(
					'text' 	=> 'Cédula',
					'primary'	=> TRUE,
				),
				'nombre'	=> array(
					'text' 	=> 'Nombre',
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
			'edit'		=> Acl::access_view_module( 'profesores', 'update' ), //Indica si se mostrará la columna de Editar
			'delete'	=> Acl::access_view_module( 'profesores', 'delete' )  //Indica si se mostrará la columna de Eliminar
		));
		


		//Indica si se mostrará el botón de Agregar
		$this->view->assign('btn_add', Acl::access_view_module( 'profesores', 'created' ));

		//Indica si se mostrará el texto del botón Agregar
		$this->view->assign('btn_add_text', TRUE);			

		//Indica si se mostrará el botón de Imprimir
		$this->view->assign('btn_print', Acl::access_view_module( 'profesores', 'print' ));

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
			'active_menu' => 'materias',
		]);
	}
	
}


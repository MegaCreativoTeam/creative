<?php


class carrerasController extends backendController
{
	public function __construct() {
		parent::__construct();
		$this->no_cache();
		$this->module = __CLASS__;
		$this->module_name = str_ireplace('controller', '',  __CLASS__);		
		$this->model_module = $this->load_model($this->module_name);
	}
	
	
	/**
	* 
	* 
	* @return
	*/
	public function index()
	{
		
		$ModalRecord = Creative::get( 'Components' )->render('ModalRecord', array(
			'add_record' 	=> TRUE,
			'controller_delete'	=> '/api/v1/'.$this->controller_name.'.json/',
			'controller_save' 	=> '/api/v1/'.$this->controller_name.'.json/',
			'controller_load'	=> '/api/v1/'.$this->controller_name.'.json/',
			'size' 				=> 'sm'
			,'text' => $this->controller_name
		));
		

		$config = Registry::get('carreras')['fields_info'];


		foreach ($config as $key => $value) {
			$ModalRecord->add_field(
				[
					'id'	=> $key,
					'col'	=> $value['col'],
					'type'	=> $value['type'],
					'label'	=> $value['text'],
					'required'=> $value['required'],
					'items'	=> isset($value['items']) ? $value['items'] : NULL,
					'multiple'=> isset($value['multiple']) ? $value['multiple'] : NULL,
				],
				'carreras'
			);
		}
		

		$ModalRecord->write();
		

		$this->model = $this->load_model(Registry::get('carreras')['table']);

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
		
		$this->view->assign('title'		, ucfirst($this->module_name) ); //Título de la Vista
		$this->view->assign('module'	, $this->module_name ); //Título de la Vista
		$this->view->assign('filters'	, Registry::get('carreras')['filters']);
		
		//Prepara la tabla
		$this->view->assign('table', array(
			'columns'		=> array(
				'codigo'	=> array(
					'text' 	=> 'Código',
					'primary'=> TRUE,
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
			'edit'		=> Acl::access_view_module( 'carreras', 'update' ), //Indica si se mostrará la columna de Editar
			'delete'	=> Acl::access_view_module( 'carreras', 'delete' )  //Indica si se mostrará la columna de Eliminar
		));

		//Indica si se mostrará el botón de Agregar
		$this->view->assign('btn_add', Acl::access_view_module( 'carreras', 'created' ));

		//Indica si se mostrará el texto del botón Agregar
		$this->view->assign('btn_add_text', TRUE);			

		//Indica si se mostrará el botón de Imprimir
		$this->view->assign('btn_print', Acl::access_view_module( 'carreras', 'print' ));

		//Indica si se mostrará el botón de Compartir
		$this->view->assign('btn_shared', FALSE);

		//Indica si se mostrará el botón de Busqueda Avanzada
		$this->view->assign('btn_search_avanced', TRUE);

		//Indica si se mostrará las Opciones de busqueda
		$this->view->assign('search', TRUE);
			
			
		/*$this->add_btn_action_datatable('before', 
			array(			
				'color'=> 'success',
				'onclick' => "goto_detalle(this)",
				'tooltip' => 'Prueba',
				'icon' => 'info-circle',
			)*
		);*/
		
		$this->view->template ( 'default' );        
        $this->view->theme( BACKEND );
		$this->view->ambit( BACKEND );

		$this->view->render(__FUNCTION__, [
			'active_menu' => 'carreras',
		]);
	}	
	
}


<?php


class pensumController extends backendController
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
			'add_record' 	=> FALSE,
			'controller_delete'	=> '/api/v1/'.$this->controller_name.'.json/',
			/*'controller_save' 	=> '/api/v1/'.$this->controller_name.'.json/',*/
			/*'controller_load'	=> '/api/v1/'.$this->controller_name.'.json/',*/
			'size' 				=> 'lg'
			,'text' => $this->controller_name
		));
		

		$config = Registry::get( $this->controller_name )['fields_info'];


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
				$this->controller_name
			);
		}
        
        $source = $this->include_source_view( 'gestion_materias', 'pensum', 'backend');
        $ModalRecord->add_field(array(
			'col'	=> array('sm'=>12, 'md'=>12),
			'type'	=> 'source',
			'source'=> $source,
		));

		$ModalRecord->write();
		
		Creative::get( 'Components' )
					->render('HtmlBasic')
					->source_tpl( 'modules/backend/views/pensum/modal_addedit_materias.inc' );	
        
        $this->view->assign('materias'	,Creative::get( 'Components' )
                                            ->render( 'DataSource' )
                                            ->create( 'materias', [
                                                'source'=> 'materias',
                                                'key'	=> 'id',
                                                'value'	=> 'nombre'
                                            ])
                                            ->execute() );


		$this->model = $this->load_model(Registry::get( $this->controller_name )['table']);

		$this->view->assign('data'	, $this->model->_all() );
		
		$this->view->assign('title'		, ucfirst($this->module_name) ); //Título de la Vista
		$this->view->assign('module'	, $this->module_name ); //Título de la Vista
		$this->view->assign('filters'	, Registry::get( $this->controller_name )['filters']);
		
		//Prepara la tabla
		$this->view->assign('table', array(
			'columns'		=> array(
				'carrera_nombre'	=> array(
					'text' 	=> 'Carrera',
					'primary'=> TRUE,
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
			'delete'	=> Acl::access_view_module( $this->controller_name, 'delete' )  //Indica si se mostrará la columna de Eliminar
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
			
        $this->add_action_btn_datatable( 'before', [
			'onclick' => "detalles(this)"
        ] );
        
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
			'active_menu' => 'management',
		]);
	}	
	
}


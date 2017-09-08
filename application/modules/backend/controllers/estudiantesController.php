<?php


class estudiantesController extends backendController
{	
	public function __construct()
	{
		parent::__construct();
		$this->no_cache();
		$this->module = __CLASS__;
		$this->module_name = str_ireplace('controller', '',  __CLASS__);
	}
	
	
	public function index( )
	{

	}
	/**
	* 
	* 
	* @return
	*/
	public function listado( $page_settings = NULL )
	{
		Acl::access_module( 'estudiantes_listado' );

		$registry = Registry::get( 'estudiantes_listado' );
			
		//Crear Modal
		$ModalRecord = Creative::get( 'Components' )->render('ModalRecord', array(
			  'add_record'			=> TRUE
			, 'controller_delete'	=> '/api/v1/'.$this->controller_name.'.json/'
			, 'controller_save' 	=> '/api/v1/'.$this->controller_name.'.json/'
			, 'controller_load'		=> '/api/v1/'.$this->controller_name.'.json/'
			, 'size' 				=> 'lg'
			, 'text' 				=> $this->controller_name
		));
		
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
				'estudiantes_listado'
			);
		}
		
		//Escribe el componente
		$ModalRecord->write();
	
		
		$this->model = $this->load_model(Registry::get('estudiantes_listado')['table']);
		$data = $this->model->all(
			[
				"carrera" =>
					"(SELECT nombre FROM carreras WHERE id = carrera_id)",
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
			]
		);
		
		//Paginador
		$paginator = $this->load_librery('paginator', true);
		$page = 0;
		$offset = App::get( 'records_per_page' );

		//Verficar parametros del paginador
		$page_offset = $this->page_offset( $page_settings );
		$page = $page_offset['page'];
		$offset = $page_offset['offset'];

		//Preparar el paginador
		$data_pages = $paginator->initialize( $data, $page, $offset );
		$paginator_view = $paginator->render( 'default', "/backend/{$this->controller_name}/", $offset);

		$this->view->assign('data'	, $data_pages );
		$this->view->assign( 'paginator', $paginator_view );


		
		
		$this->view->assign('title'		, ucfirst($this->controller_name) ); //Título de la Vista
		$this->view->assign('module'	, $this->controller_name ); //Título de la Vista
		$this->view->assign('filters'	, Registry::get('estudiantes_listado')['filters']);
		
		//Prepara la tabla
		$this->view->assign('table', array(
			'columns'		=> array(
				'cedula'		=> array(
					'text' 	=> 'Cédula',
					'primary'	=> TRUE,
				),
				'nombre'	=> array(
					'text' 	=> 'Nombre',
				),	
				'apellido'	=> array(
					'text' 	=> 'Apellido',
				),
				'carrera'	=> array(
					'text' 	=> 'Carrera',
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
			'edit'		=> Acl::access_view_module( 'estudiantes', 'update' ), //Indica si se mostrará la columna de Editar
			'delete'	=> Acl::access_view_module( 'estudiantes', 'delete' )  //Indica si se mostrará la columna de Eliminar
		));
		

		$this->add_action_btn_datatable( 'before', [
			'onclick' => "detalles(this)"
		] );


		//Indica si se mostrará el botón de Agregar
		$this->view->assign('btn_add', Acl::access_view_module( 'estudiantes', 'created' ));

		//Indica si se mostrará el texto del botón Agregar
		$this->view->assign('btn_add_text', TRUE);			

		//Indica si se mostrará el botón de Imprimir
		$this->view->assign('btn_print', Acl::access_view_module( 'estudiantes', 'print' ));

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
			'active_menu' => 'estudiantes',
		]);
	}
	


	public function detalle_estudiante( $id = NULL )
	{
		Acl::access_module( 'estudiantes_listado' );

		$registry = Registry::get( 'estudiantes_listado' );
				
		
		$this->model = $this->load_model(Registry::get('estudiantes_listado')['table']);
		$data = $this->model->getdata_byid($id);

		$this->view->assign('data'		, $data);
		$this->view->assign('title'		, ucfirst($this->controller_name) ); //Título de la Vista
		$this->view->assign('module'	, $this->controller_name ); //Título de la Vista
		
		
		$html = Creative::get( 'Components' )->render('HtmlBasic');
		/*$panelbox = $html->panelbox([
			'label'=>'Datos personales'
		]);

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
						'value'=> $data[$key]
					]
				);
				$panelbox->add( $comp );	
			}	
		}
		
		$panelbox->write();*/
		
		
		$this->view->template ( 'default' );        
        $this->view->theme( BACKEND );
		$this->view->ambit( BACKEND );

		$this->view->render( 'detalle_estudiante', [
			'active_menu' => 'estudiantes',
		]);
	}
}


<?php

class pagosController extends backendController
{
	
	public function __construct()
	{
		parent::__construct();
		$this->no_cache();
		$this->module = __CLASS__;
		$this->module_name = str_ireplace('controller', '',  __CLASS__);
		$this->model = $this->load_model( Registry::get('pagos_gestion')['table'] );
	}
	

	/**
	* 
	* 
	* @return
	*/
	public function index()
	{
		$this->view->template ( 'default' );        
        $this->view->theme( BACKEND );
		$this->view->ambit( BACKEND );

		$this->view->render(__FUNCTION__, [
			'active_menu' => 'pagos',
		]);
	}
	



	public function listado( $page_settings = NULL )
	{
		
		Acl::access_module( 'pagos_gestion' );		

		$registry = Registry::get( 'pagos_gestion' );

		$this->model = $this->load_model(Registry::get('pagos_gestion')['table']);
		$data = $this->model->listar();
		
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
		$paginator_view = $paginator->render( 'default', "/backend/{$this->controller_name}/".__FUNCTION__."/", $offset);

		$this->view->assign('data'	, $data_pages );
		$this->view->assign( 'paginator', $paginator_view );

		$this->view->assign('fields_info', $registry['fields_info'] ); //Título de la Vista
		$this->view->assign('title'		, ucfirst($this->controller_name) ); //Título de la Vista
		$this->view->assign('module'	, $this->controller_name ); //Título de la Vista
		$this->view->assign('filters'	, Registry::get('pagos_gestion')['filters']);

		$this->view->assign('bancos'	, Creative::get( 'Components' )
											->render( 'DataSource' )
											->query( [
												'table' => 'bancos',
												'key'	=> 'id',
												'value'	=> 'nombre'
											]));

		$this->view->assign('gateways'	, Creative::get( 'Components' )
											->render( 'DataSource' )
											->query( [
												'table' => 'gateways',
												'key'	=> 'id',
												'value'	=> 'nombre'
											]));

		$this->view->assign('semestres'	, Creative::get( 'Components' )
											->render( 'DataSource' )
											->query( [
												'table' => 'semestres',
												'key'	=> 'id',
												'value'	=> 'nombre'
											]));
		
		//Prepara la tabla
		$this->view->assign('table', array(
			'columns'		=> array(
				'nrecibo'	=> array(
					'text' 	=> 'Recibo',
					'primary'	=> TRUE,
				),
				'fecha_recibo'	=> array(
					'text' => 'Fecha de recibo',
					'type' => 'date',
					'format' => '%d/%m/%Y'
				),
				'estudiante_cedula'	=> array(
					'text' 	=> 'Cédula',
				),
				'estudiante'	=> array(
					'text' 	=> 'Nombre',
				),
				'gateway'	=> array(
					'text' => 'Forma de pago',
				),
			), //Indica las columnas que se mostrarán
			
			'view'		=> TRUE, //Indica si se mostrará la columna de Visualizar
			'edit'		=> Acl::access_view_module( 'profesores', 'update' ), //Indica si se mostrará la columna de Editar
			'delete'	=> FALSE  //Indica si se mostrará la columna de Eliminar
		));
		


		//Indica si se mostrará el botón de Agregar
		$this->view->assign('btn_add', Acl::access_view_module( 'pagos_gestion', 'created' ));

		//Indica si se mostrará el texto del botón Agregar
		$this->view->assign('btn_add_text', TRUE);			

		//Indica si se mostrará el botón de Imprimir
		$this->view->assign('btn_print', Acl::access_view_module( 'pagos_gestion', 'print' ));

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
			'active_menu' => 'pagos',
		]);
	}
	
}


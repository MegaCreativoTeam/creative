<?php

/**
 * ------------------------------------------------------------------------
 * Class Managerment Controller
 * ------------------------------------------------------------------------
 * Provides an interface to manage system users of both the Backend and 
 * Frontend, user profiles, Lists of access controls to your application
 * 
 * 
 * Provee de una interfaz para gestionar usuarios del sistema tanto del 
 * Backend como del Frontend, perfiles de usuarios, Listas de controles 
 * de acceso a su aplicación * 
 * 
 * @copyright   © 2017 Brayan Rincon
 * @version     1.0.2
 * @author      Brayan Rincon <brayan262@gmail.com>
 */
class managementController extends backendController {
	
	private $_filters = array( 
		'Todos'		=> 'all',
		'Nombre'	=> 'name',
		'Módulo de inicio'	=> 'default_module',
	);
	
	private $_actions = array(
		'aprobar-transferencias'	=> 'Aprobar transferencias de dinero',
		'pagar-transferencias'		=> 'Pagar transferencias de dinero',
		'verficar-transferencias'	=> 'Verficar Transferencia pagada',
		'enviar-confirmacion'		=> 'Enviar confirmación de pago',
	);
	
	public function __construct() {
		parent::__construct();
		$this->no_cache();
		//$this->view->template = 'template.back';
		//$this->module = __CLASS__;
		$this->module_name = str_ireplace('controller', '',  __CLASS__);		
		$this->model_profiles = $this->load_model('profiles');
		
		$this->_fields_db = $this->database();
		
	}
	
	public function index(){
		
	}
	

	/**
	 * ------------------------------------------------------------------------
	 * Class Managerment Controller
	 * ------------------------------------------------------------------------
	 * Provides an interface to manage system users of both the Backend and 
	 * Frontend, user profiles, Lists of access controls to your application
	 * 
	 * 
	 * Provee de una interfaz para gestionar usuarios del sistema tanto del 
	 * Backend como del Frontend, perfiles de usuarios, Listas de controles 
	 * de acceso a su aplicación * 
	 * 
	 * @copyright   © 2017 Brayan Rincon
	 * @version     1.0.2
	 * @author      Brayan Rincon <brayan262@gmail.com>
	 */
	public function administrators() {

		Acl::access_module( __FUNCTION__ );

		$this->model = $this->load_model( __FUNCTION__ );
		$this->model_profiles = $this->load_model('profiles');
		
		$ModalRecord = Creative::get( 'Components' )->render('ModalRecord', [
			  'add_record' 	=> TRUE
			, 'size' 		=> 'lg'
			, 'text'		=> Lang::get('dashboard.modules.users')
		]);
		

		$info = Registry::get(__FUNCTION__)['fields_info'];
		

		//DNI
		$ModalRecord->add_field(
			[
				'id'		=> 'dni',
				'col'		=> $info['dni']['col'],
				'type'		=> $info['dni']['type'],
				'label'		=> $info['dni']['text'],
				'required'	=> $info['dni']['required'],
			],
			__FUNCTION__
		);
		//}


		//Nombre
		$ModalRecord->add_field(
			[
				'id'		=> 'name',
				'col'		=> $info['name']['col'],
				'type'		=> $info['name']['type'],
				'label'		=> $info['name']['text'],
				'required'	=> $info['name']['required'],
			],
			__FUNCTION__
		);
		
		
		//Apellido
		$ModalRecord->add_field(
			[
				'id'		=> 'last_name',
				'col'		=> $info['last_name']['col'],
				'type'		=> $info['last_name']['type'],
				'label'		=> $info['last_name']['text'],
				'required'	=> $info['last_name']['required'],
			],
			__FUNCTION__
		);			
		


		//Email
		$ModalRecord->add_field(
			[
				'col'	=> array('sm'=>6,'md'=>3),
				'id'	=> 'email',
				'type'	=> 'text',
				'label'	=> l('personal_attr.email'),
				'required'=> TRUE,
			],
			__FUNCTION__
		);
		


		$perfil = [];
		$profiles = $this->model_profiles->all();

		if( count($profiles) ){
			foreach ($profiles as $key => $value) {
				$perfil[$value['id']] = $value['name'];
			}			
		}

		//Perfil
		$ModalRecord->add_field(
			[
				'col'	=> array('sm'=>6,'md'=>3),
				'id'	=> 'profile_id',
				'type'	=> 'select',
				'label'	=> l('personal_attr.profile'),
				'items'	=>  $perfil,
				'required'=> TRUE,
			],
			__FUNCTION__
		);
		

		//pass			
		$ModalRecord->add_field(
			[
				'id'	=> 'pass',
				'col'	=> array('sm'=>6,'md'=>3),
				'type'	=> 'password',
				'label'	=> l('personal_attr.pass'),
			],
			__FUNCTION__
		);
		
		//pass
		$ModalRecord->add_field(
			[
				'col'	=> array('sm'=>6,'md'=>3),
				'id'	=> 'pass2',
				'alias_acl'	=> 'pass',
				'type'	=> 'password',
				'label'	=> l('personal_attr.repeat_pass'),
			],
			__FUNCTION__
		);
		

		//Alias	
		$ModalRecord->add_field(
			[
				'col'	=> array('sm'=>6,'md'=>3),
				'id'	=> 'nicname',
				'type'	=> 'text',
				'label'	=> l('personal_attr.alias'),
			],
			__FUNCTION__
		);
			
		
		//Estatus
		$ModalRecord->add_field(
			[
				'col'	=> array('sm'=>6,'md'=>3),
				'id'	=> 'status',
				'type'	=> 'select',
				'label'	=> l('personal_attr.status'),			
				'required'=> TRUE,
				'items'	=> array(
					'-1' => l('selection'),
					'1' => l('user_status.active'),
					'0' => l('user_status.inactive'),
				)
			],
			__FUNCTION__
		);
	
		
		$source = $this->include_source_view( 'permissions', 'management', 'backend' );
		$ModalRecord->add_field(array(
			'col'	=> array('sm'=>12),
			'type'	=> 'source',
			'source'=> $source,
		));
		
		
		//Escribe el componente
		$ModalRecord->write();
		
		$config = Auth::get('user_ambit')[BACKEND];
		$this->model_module = $this->load_model($config['table']);

		$this->view->assign('data', $this->model->search(
			array(
				"user_decp" =>
					"CONCAT(name, ' ', last_name)",
				"status_text" =>
					"CASE 
						WHEN status = 0 THEN '".Lang::get('dashboard.status.inactive')."' 
						WHEN status = 1 THEN '".Lang::get('dashboard.status.active')."' 
					END",
				"status_class" =>
					"CASE 
						WHEN status = 0 THEN 'danger' 
						WHEN status = 1 THEN 'success' 
					END",
				"status_info" => 
					"CASE 
						WHEN status = 0 THEN '".Lang::get('dashboard.status.inactive')."' 
						WHEN status = 1 THEN '".Lang::get('dashboard.status.active')."' 
					END",
				)
			)
		);
		$this->view->assign('title'		, Lang::get('dashboard.modules.users') ); //Título de la Vista
		$this->view->assign('module'	, $this->module_name ); //Título de la Vista
		$this->view->assign('filters'	, Registry::get('users')['filters']);
		$this->view->assign('fields_db'	, $this->_fields_db);
		
		//$fields = $this->database();
		//$this->view->assign('fields'	, $fields);
		
		//Prepara la tabla
		$this->view->assign('table', [
			'columns'		=> array(
				'user_decp'	=> array(
					'text' 	=> Lang::get('personal_attr.name'),
					'primary'	=> TRUE,
				),
				'email'	=> array(
					'text' 	=> Lang::get('personal_attr.email'),
				),
				'status_text'	=> array(
					'text' => Lang::get('personal_attr.status'),
					'align' => 'center',
					'type'	=> 'label',
					'labelclass' => 'status_class',
					'tooltips' => 'status_info',								
				),
			), //Indica las columnas que se mostrarán
			
			'view'		=> TRUE, //Indica si se mostrará la columna de Visualizar
			'edit'		=> Acl::access_view_module( __FUNCTION__, 'update' ), //Indica si se mostrará la columna de Editar
			'delete'	=> Acl::access_view_module( __FUNCTION__, 'delete' )  //Indica si se mostrará la columna de Eliminar
		]);
		
		$this->view->assign('btn_add', Acl::access_view_module( __FUNCTION__, 'created' ));				//Indica si se mostrará el botón de Agregar
		$this->view->assign('btn_add_text', TRUE);			//Indica si se mostrará el texto del botón Agregar
		$this->view->assign('btn_print', Acl::access_view_module( __FUNCTION__, 'print' ));				//Indica si se mostrará el botón de Imprimir
		$this->view->assign('btn_shared', FALSE);			//Indica si se mostrará el botón de Compartir
		$this->view->assign('btn_search_avanced', TRUE);	//Indica si se mostrará el botón de Busqueda Avanzada
		$this->view->assign('search', TRUE);				//Indica si se mostrará las Opciones de busqueda
				
		$this->view->template ( 'default' );        
        $this->view->theme( BACKEND );
		$this->view->ambit( BACKEND );

		$this->view->render(__FUNCTION__, [
			'active_menu' => 'management',
		]);
	}
	
	


	/**
	* 
	* 
	* @return
	*/
	public function profiles() {
		
		$this->model = $this->load_model('users');
		$this->model_profiles = $this->load_model('profiles');
		
		$ModalRecord = Creative::get( 'Components' )->render('ModalRecord', [
			  'add_record' => TRUE
			, 'size' 	=> 'lg'
			, 'text'	=> 'Perfiles'
		]);
		
		$info = Registry::get('profiles')['fields_info'];
	
		//Nombre
		$ModalRecord->add_field(
			[
				'id'		=> 'name',
				'col'		=> $info['name']['col'],
				'type'		=> $info['name']['type'],
				'label'		=> $info['name']['text'],
				'required'	=> $info['name']['required'],
			],
			__FUNCTION__
		);		
		

		//Modulo por defecto
		foreach( Registry::get_modules() as $key => $value)
		{
			$menu[$key] = $value['text'];
		}		
		$ModalRecord->add_field(
			[
				'id'		=> 'default_module',
				'col'		=> $info['default_module']['col'],			
				'type'		=> $info['default_module']['type'],
				'default'	=> $info['default_module']['default'],
				'label'		=> $info['default_module']['text'],
				'items'		=> $menu,
				'required'	=> $info['default_module']['required'],
			],
			__FUNCTION__
		);
		
				
		//Descripción
		$ModalRecord->add_field(
			[
				'id'	=> 'description',
				'col'	=> $info['description']['col'],			
				'type'	=> $info['description']['type'],
				'label'	=> $info['description']['text'],
			],
			__FUNCTION__
		);
		

		//Estatus
		$ModalRecord->add_field(
			[
				'id'		=> 'status',
				'col'		=> $info['status']['col'],
				'type'		=> $info['status']['type'],
				'label'		=> $info['status']['text'],			
				'required'	=> $info['status']['required'],
				'items'		=> [
					'-1' 	=> Lang::get('selection'),
					'1' 	=> Lang::get('user_status.active'),
					'0' 	=> Lang::get('user_status.inactive'),
				]
			],
			__FUNCTION__
		);
		
		
		$source = $this->include_source_view( 'permissions', 'management', 'backend');
		$ModalRecord->add_field(array(
			'col'	=> array('sm'=>12, 'md'=>12),
			'type'	=> 'source',
			'source'=> $source,
		));
		
		
		//Escribe el componente
		$ModalRecord->write();
		
		
		$this->view->assign('data'	, $this->model_profiles->all([
			"status_text" =>
				"CASE 
					WHEN status = 0 THEN '".Lang::get('dashboard.status.inactive')."' 
					WHEN status = 1 THEN '".Lang::get('dashboard.status.active')."' 
				END",
			"status_class" =>
				"CASE 
					WHEN status = 0 THEN 'danger' 
					WHEN status = 1 THEN 'success' 
				END",
			"status_info" => 
				"CASE 
					WHEN status = 0 THEN '".Lang::get('dashboard.status.inactive')."' 
					WHEN status = 1 THEN '".Lang::get('dashboard.status.active')."' 
				END"
		
		]));
		
		$this->view->assign('title'		, Lang::get('dashboard.modules.profiles') ); //Título de la Vista
		$this->view->assign('module'	, $this->module_name ); //Título de la Vista
		$this->view->assign('filters'	, Registry::get('profiles')['filters']);
		$this->view->assign('fields_db'	, $this->_fields_db);
		
		//Prepara la tabla
		$this->view->assign('table', array(
			'columns'	=> array(
				'name'	=> array(
					'text' 	=> Lang::get('dashboard.personal_attr.name'),
					'primary'	=> TRUE,
				),	
				'status_text'	=> array(
					'text' => Lang::get('dashboard.attrs.status'),
					'align' => 'center',
					'type'	=> 'label',					
					'labelclass' => 'status_class',
					'tooltips' => 'status_info'
				),
			), //Indica las columnas que se mostrarán
			
			'view'		=> TRUE, //Indica si se mostrará la columna de Visualizar
			'edit'		=> TRUE, //Indica si se mostrará la columna de Editar
			'delete'	=> TRUE  //Indica si se mostrará la columna de Eliminar
		));
		
		$this->view->assign('btn_add', TRUE);				//Indica si se mostrará el botón de Agregar
		$this->view->assign('btn_add_text', TRUE);			//Indica si se mostrará el texto del botón Agregar
		$this->view->assign('btn_print', TRUE);				//Indica si se mostrará el botón de Imprimir
		$this->view->assign('btn_shared', FALSE);			//Indica si se mostrará el botón de Compartir
		$this->view->assign('btn_search_avanced', TRUE);	//Indica si se mostrará el botón de Busqueda Avanzada
		$this->view->assign('search', TRUE);				//Indica si se mostrará las Opciones de busqueda
				
		$this->view->template ( 'default' );        
        $this->view->theme( BACKEND );
		$this->view->render(__FUNCTION__, array('active_menu'=>'management') );
	}
	

	
	private function database(){
		return true;
		$this->model_generic = $this->load_model('profiles');
		$data_db = $this->model_generic->exec('SHOW TABLES FROM '. DB_DATABASE);
		
		foreach( $data_db as $key => $value){
			$tables[] = $value['Tables_in_'.DB_DATABASE];
		}
		
		
		foreach( $tables as $key => $tabla){
			if( $tabla == 'configuration' OR
				$tabla == 'fields' OR
				$tabla == 'pages' OR
				$tabla == 'pages_meta' OR
				$tabla == 'profiles' OR
				$tabla == 'profiles_permissions' OR
				$tabla == 'sessions' OR
				$tabla == 'users' OR
				strpos($tabla, 'view_') !== FALSE OR
				$tabla == 'users_meta'){
				continue ;
			}
			$col = [];
			foreach( $this->model_generic->exec('SHOW COLUMNS FROM '. $tabla ) as $row => $attr){
				$col[$row] = $attr;
				$col[$row]['label'] = $this->replace_field($attr['Field']);
				$col[$row]['info'] = '';
			}
			$estrucura[$tabla] = $col; ;
		}
		
		return $estrucura;
		
		$structure_db = [];
		$str = "\$structure = array (\n";
		
		$_table = "
			array(
				'table' => '',
				'fields' => array(
					array('field' => '','description' => ''),
				)
			),";
		
		
		foreach( $data_db as $key => $value){
			$data_colums = $this->model_generic->exec('SHOW COLUMNS FROM '. $value['Tables_in_'.DB_DATABASE]);
			$structure_db[$value['Tables_in_'.DB_DATABASE]] = array(
				'field'			=> $value['Tables_in_'.DB_DATABASE],
				'description'	=> '',
				'columns' 		=> $data_colums,
			);
			
			/*
			$str .= "\tarray(\n";
			$str .= "\t\t'table' => '".$value['Tables_in_'.DB_DATABASE]."',\n";
			$str .= "\t\t'description' => '',\n";
			$str .= "\t\t'fields' => array(\n";
			 $str .= "\t\t\tarray(\n";
			 $str .= "\t\t\tarray(\n'field' => ''\n";
			 $str .= "\t\t\t'description' => ''\n";
			$str .= "\t\t\t),\n";
			$str .= "\t\t)\n";
			$str .= "\t),\n";	*/		
		}
		
		$str .= "array('','')";
		return $structure_db;
		
		$structure = array (
			'table' => array(
				array('field' => '','description' => ''),
			),
		);
	}
	
	
	private function replace_field( $text ){
		$patrones = array(
			'status'=>'Estatus',
			'user'=>'Usuario',
			'cion'=>'ción',
			'_id'=>'',
			'_'=>' ',
		);
		
		foreach($patrones as $key => $value){
			$p[] = $key;
			$r[] = $value;
		}
		
		return str_ireplace($p, $r, $text);
	}
	
}


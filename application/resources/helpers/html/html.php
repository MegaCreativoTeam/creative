<?php

if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

if (!defined('PATH_HTML_DOM'))
	define('PATH_HTML_DOM', realpath(dirname(__FILE__)) );
	
function autoload_html_elements( $file ){ 
   if(file_exists(PATH_HTML_DOM .DS. 'elements' .DS. strtolower($file).'.php')){
        include_once PATH_HTML_DOM .DS. 'elements' .DS. strtolower($file).'.php';
    }
}
spl_autoload_register("autoload_html_elements");



class html 
{

	/**
	 * Undocumented function
	 *
	 * @param [type] $text
	 * @param string $pos
	 * @return void
	 */
	public function tooltip( $title, $placement = 'top' )
	{
		return ' data-toggle="tooltip" data-placement="'.$placement.'" data-original-title="'.$title.'" ';
	}


	/**
	 * Undocumented function
	 *
	 * @param string $field
	 * @return void
	 */
	public function icon_required( $field = '' ){
		$tooltip = $this->tooltip( l('required', ['required'=>$field]) );
		return '<span class="fa fa-circle" style="font-size: 6px; color: #ce0000" '.$tooltip.'></span>';
	}
	

	/**
	 * Undocumented function
	 *
	 * @param [type] $text
	 * @param string $position
	 * @return void
	 */
	public function icon_help( $text, $position = 'top' ){
		$tooltips = $this->tooltip( $text, $position);
		$icon = '<span class="fa fa-question-circle" '.$tooltips.'></span>';

		return $icon;
	}
	

	/**
	 * Undocumented function
	 *
	 * @param boolean $attr
	 * @return void
	 */
	public function button_create( $attr = FALSE ){
		$html = new html_button();
		return $html->create( $attr );
	}
	
    public static function default_button() {
    	
    	$attr = array();
    	
        $attr = array(
            'id' 			=> "",
            'icon'	 		=> 'file',
            'class' 		=> "default",
            'action' 		=> "",
            'title' 		=> "",
            'option' 		=> "",
            'text' 			=> "",
            'type' 			=> "button",
            'action_param' 	=> "",
            'toggle' 		=> "tooltip"
        );

       /* foreach ($_attr as $key => $val) {
            $attr[$key] = $val;
        }*/

        return (object) $attr;
    }
    
    public function button_data_loading(){
		return "data-loading-text=\"<span class='fa fa-spinner fa-spin'></span>  Procesando\"" ;
	}
    
	
	
	/**
     * Metodo que crea los botones de las tablas o listados
     * @param string $id
     * @param string $type [view|edit|delete|print]
     * @param string $action
     * @return string
     */
    public function table_button_create($id='', $tipo='view', $accion='') {
    	
    	$title = '';
    	$opciones = self::default_button();
    	$opciones->action = $accion!='' ? $accion : '';
    	
    	switch( $tipo ){
			case 'view':
				$opciones->title = 'Visualizar los detalles del registro actuál';
				$opciones->icon = 'eye';
				$opciones->class = 'default';
				
			break;
			case 'edit':
				$opciones->title = 'Haga click para editar';
				$opciones->icon = 'edit';
				$opciones->class = 'success';
			break;
			case 'delete':
				$opciones->title = 'Haga click para eliminar';
				$opciones->icon = 'trash';
				$opciones->class = 'danger';
			break;
			case 'print':
				$opciones->title = 'Imprimir el registro actuál';break;
			default:
				$title = $opciones->title;
			break;
		}
		  
        return self::button_create($opciones);
    }
   
   
	public function table_label_create( $text, $class, $title = '' ){
		
		return '<span class="label label-'.$class.'" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$title.'">'.$text.'</span>';
	
	}
    
    
    public function popover($text, $title = '', $placement = 'top', $content='body'){
    	$text 		= $text ? $text : '';
    	$title		= $title ? $title : '';
    	
		$template = 'data-container="'.$content.'" '.
					'data-toggle="popover" '.
					'data-html="true" '.
					'data-trigger="hover" '.
					($title ? 'title="'.$title.'" ' : '').
					'data-placement="'.$placement.'" '.
					'data-content="'.$text.'"';
		return $template;
		
	}
	
    
	public static function link(){
		return '<a></a>';
	}
}
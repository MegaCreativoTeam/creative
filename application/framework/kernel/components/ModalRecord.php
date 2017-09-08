<?php



class ModalRecord {
	
	const SIZE_FULL 	= 'full';
	const SIZE_LARGE 	= 'lg';
	const SIZE_MEDIUM 	= 'md';
	const SIZE_SMALL 	= 'sm';
		
	const FORM_GROUP = '<div class="form-group">:content</div>';
	
	private 
		  $_attrs
 		, $_fields
 		, $_header
 		, $_modal
 		, $_data_fields = ''
 		, $_controller
 		, $_text
 		, $_property = []
	 	, $controller_load
		, $controller_save
		, $controller_delete,
		
		$template_default = array(
			'container_name'=> '',
            'col' 			=> ['xs'=>12, 'sm' => 12, 'md'=>12, 'lg'=>12],
            'label'	 		=> '',
            'id' 			=> '',
            'type' 			=> '',
            'guid'			=> NULL,
            'items' 		=> NULL,
            'default' 		=> NULL,
            'multiple'		=> FALSE,
            'readonly' 		=> '',
            'icon_required'	=> '',
            'required' 		=> '',
            'class'			=> '',
            
            'autocomplete' 	=> '', 
            'maxlength' 	=> '',            
            'min' 			=> '', 
            'max' 			=> '',
			'row' 			=> '2',

            'path'			=> NULL,
            'source'		=> NULL,
            'binding' 		=> NULL,
            
            'tooltip' 		=> '',
            
            
            'value' 		=> '', 
            'title' 		=> '', 
            'placeholder' 	=> '', 
            'parent' 		=> NULL,
            'is_container' 	=> FALSE,
            'childs' 		=> [],
		);
 	
 	function __construct() {}
	
	/**
	* 
	* @param undefined $property
	* 
	* @return
	*/
	public function initialize( $property = [] ){
		
		$this->_tpl_modal 	= $this->get_template( 'modal' );
 		$this->_tpl_header	= $this->get_template( 'modal.header' );
 		
 		$this->_tpl_input	= $this->get_template( 'input' );
 		$this->_tpl_select	= $this->get_template( 'select' );
 		
 		$this->_tpl_addrecord_handler		= $this->get_template( 'modal.addrecord_handler' );
 		$this->_tpl_asaverecord_handler		= $this->get_template( 'modal.saverecord_handler' );
 		$this->_tpl_editrecord_handler		= $this->get_template( 'modal.editrecord_handler' );
 		$this->_tpl_viewrecord_handler		= $this->get_template( 'modal.viewrecord_handler' );
 		$this->_tpl_deleterecord_handler	= $this->get_template( 'modal.deleterecord_handler' );
 		$this->_tpl_loaddata_handler		= $this->get_template( 'modal.loaddata_handler' );
 		$this->_tpl_searchrecord_handler	= $this->get_template( 'modal.searchrecord_handler' );
 		
		$this->_attrs = [];

		$this->_property = array_merge($this->_property, $property);

		//Colocar Texto del Header
		$this->_text = $property['text'] ? $property['text'] : '';	
 		$this->_tpl_header = str_ireplace(':text', $this->_text, $this->_tpl_header);
 		
 		//Colocar el Tamaño del modal
 		$this->_size = $property['size'] ? $property['size'] : 'md';
 		$this->_tpl_modal = str_ireplace(':size', $this->_size, $this->_tpl_modal);
 		
 		//Agregar Header
		$this->_tpl_modal = str_ireplace(':header', $this->_tpl_header, $this->_tpl_modal);
		
		return $this;
	}
	
	
	/**
	* Crea un template de los atributos necesario para el componente Modal
	* @param undefined $attrs
	* 
	* @return
	*/
	private function attrs_default( $attrs ){
		$id = substr(md5(time()), 0, 6);
		return (object) array_merge($this->template_default, $attrs) ;
	}
	
	
	
	/**
	* Obtiene el contenido de una template de un componente
	* @param undefined $template Nombre del Template
	* 
	* @return
	*/
	private function get_template( $template ){
		if( ! file_exists( PATH_KERNEL . 'components' .DS. 'templates' .DS. $template . '.tpl' ) ){
            return false;
        }
        return file_get_contents(  PATH_KERNEL . 'components' .DS. 'templates' .DS. $template . '.tpl' );
	}
	

	/**
	 * Undocumented function
	 *
	 * @param [type] $html
	 * @return void
	 */
	public function clean_attr( &$html )
	{
		foreach( $this->template_default as $key => $attr )
        {
            if( is_string($attr) )
            {
				$html = str_ireplace( ':'. $key, '', $html );
            }
		}
		return $html;
	} 


	/**
	* Agrega un nuevo campo de texto
	* @param undefined $attr
	* 
	* @return
	*/
 	public function add_field( $attrs, $module = NULL )
	{ 		
 		$attrs = $this->attrs_default($attrs);

		if( $module )
		{
			$id = isset($attrs->alias_acl) ? $attrs->alias_acl : $attrs->id;
			$acl = Acl::access_field( $module, $id );
			if( $acl == 0 )
			{
				return $this;
			}
			if( $acl == 2 )
			{
				$attrs->readonly = true;
			}
		}
 		 
 		switch( TRUE )
		 {
		 	case $attrs->type === 'text' or $attrs->type === 'email' or $attrs->type === 'tel':
				 $field = $this->_tpl_input;
				 if( $attrs->default )
				 {
					$field = str_ireplace(':placeholder', $attrs->default, $field);
					if( ! $attrs->value )
					{
						$field = str_ireplace(':value', $attrs->default, $field);
					}					
				 }
		 	break;
		 	
		 	case $attrs->type === 'hidden':
		 		$field = '<input id="@id" type="hidden" value="">';
		 	break;
		 	
		 	case $attrs->type === 'date':
		 		$field = $this->_tpl_input;
		 	break;
		 	
		 	case $attrs->type == 'number':
		 		$field = $this->_tpl_input;
		 		$field = str_ireplace('class="','class="numeric ',$field);
				$field = str_ireplace('input','input style="text-align:right"',$field);
				if( $attrs->default )
				{
					$field = str_ireplace(':placeholder', $attrs->default, $field);
					if( ! $attrs->value )
					{
						$field = str_ireplace(':value', $attrs->default, $field);
						$field = str_ireplace(':default', $attrs->default, $field);
					}					
				}
		 	break;
		 	
		 	case $attrs->type == 'select':
		 	
		 		$field = $this->_tpl_select;
		 		$option = '';
		 		
		 		//Si hay DataSources
				if( is_array($attrs->items) ){
					foreach($attrs->items as $key => $value){
						if( $attrs->default == $key )
							$option .= '<option selected default value="' .$key. '">' .$value. '</option>';
						else 
							$option .= '<option {if $key==-1}selected default{/if} value="' .$key. '">' .$value. '</option>';
					}
					$field = str_ireplace(':option',$option, $field);
				}
				
		 	break;
		 	
		 	case $attrs->type == 'include':
		 		/*$field = '{include file="'.$attrs->path.'"}';
		 		$this->_fields[] = $field;
		 		return $this;*/
		 	break;
		 	
		 	case $attrs->type == 'source':
		 		$col = '';
			 	foreach($attrs->col as $key => $value){
					$col .= 'col-' . $key .'-'. $value .' ';
				}
		 		$div = str_ireplace(':col',$col ,'<div class=":col"  style="margin-bottom:5px">');
		 		$this->_fields[] = $div . $attrs->source.'</div>';
		 		return $this;
		 	break;

			
			case $attrs->type == 'groupbutton':
		 		if( is_array($attrs->items) )
				{
					$button = '';
					foreach($attrs->items as $key => $value)
					{
						$button .= '
						
							<div class="col-sm-6 col-md-6" style="margin-top:5px">
								 <button type="button" class="btn btn-default">'.$value['value'].'</button>
							</div>
						';
					}
					$field = $button;
				}
		 	break;
		 	
		 	
		 	default:
		 		$field = $this->_tpl_input;
		 	break;
		}
 		
 			
 		$col = '';
 		
		if ( !empty($attrs->col) ){
			//Formate las columnas
			foreach($attrs->col as $key => $value){
				$col .= 'col-' . $key .'-'. $value .' ';
			}
			$attrs->col = $col;
		}

		//Formatear REQUIRED
		if( $attrs->required == TRUE )
		{
			$attrs->icon_required = Helper::get('html')->icon_required();
			$attrs->required = 'required';
		}
		

		//Fomatear READONLY
		if( $attrs->readonly == TRUE )
		{
			$attrs->readonly = 'readonly'; 
		}

		//Fomatear AUTOCOMPLETE
		if( $attrs->autocomplete == TRUE )
		{
			$attrs->autocomplete = 'autocomplete'; 
		}

		//Fomatear MIN
		if( $attrs->min )
		{
			$attrs->min = 'min="'.$attrs->min.'"'; 
		}

		//Fomatear MAX
		if( $attrs->max )
		{
			$attrs->max = 'max="'.$attrs->max.'"'; 
		}

		//Fomatear MAX
		if( $attrs->maxlength )
		{
			$attrs->maxlength = 'maxlength="'.$attrs->maxlength.'"'; 
		}

		//Fomatear TITLE
		if( $attrs->title )
		{
			$attrs->title = 'title="'.$attrs->title.'"'; 
		}

		//Fomatear VALUE
		if( $attrs->value )
		{
			$attrs->value = $attrs->value; 
		}

		//Fomatear PLACEHOLDER
		if( $attrs->placeholder )
		{
			$attrs->placeholder = $attrs->placeholder; 
		}

		//Determina si el campo es requerido
		if( $attrs->required ){
			$required = 'required';
			$required_info = '<span class="fa fa-circle" style="font-size: 6px; color: #ce0000"  data-toggle="tooltip" data-placement="top" title="Este campo es requerido"></span>';
		} else {
			$required = '';
			$required_info = '';
		}
		
		
		//Determina si el campo es requerido
		if( $attrs->guid ){
			$guid = 'value="' . substr(md5(time()-100).md5(time()+100), 0, $attrs->guid) . '" text-guid';
		} else {
			$guid = '';
		}
		
		
		//Determina si el campo es requerido
		if( $attrs->readonly ){
			$readonly = 'readonly';
		} else {
			$readonly = '';
		}
		
		if( $attrs->multiple ){
			$attrs->multipl = 'multiple="multiple"';
		} else {
			$attrs->multipl= '';
		}
		
		foreach( $attrs as $key => $attr )
        {
            if( is_string($attr) )
            {
                $field = str_ireplace( ':'. $key, $attr, $field);
            }
		}
		

		/*$field = str_ireplace(':placeholder', $attr->placeholder, $field);		
 		$field = str_ireplace(':col'			,$col			,$field);
 		$field = str_ireplace(':id'				,$attr->id		,$field);
 		$field = str_ireplace(':label'			,$attr->label	,$field);
 		$field = str_ireplace(':type'			,$attr->type	,$field);
 		$field = str_ireplace(':required'		,$required		,$field);
 		$field = str_ireplace(':icon_required'	,$required_info	,$field);
 		$field = str_ireplace(':readonly'		,$readonly		,$field);
 		$field = str_ireplace(':guid'			,$guid			,$field); 	
 		$field = str_ireplace(':multiple'		,$multiple		,$field); */
 		
		$this->clean_attr($field);

 		$field = trim($field);
 		
 		$this->_data_fields .= $attrs->id . ' : $("#'.$attrs->id.'").val(), ';
 		$this->_fields[] = $field;
 		$this->_attrs[] = $attrs;
 		
 		return $this;
	}
	
	
	/**
	* Imprime el componente
	* 
	* @return
	*/
	public function write()
	{
		
		$modal_body = '';

		if( count($this->_fields)>0 )
		{
			foreach( $this->_fields as $key => $value)
			{
				$modal_body .= $value;
			}
		}

		
		//---------------------
		
		
		//Agregar Body al modal
		$this->_tpl_modal = str_ireplace(':body', $modal_body, $this->_tpl_modal);		
		######################################################
		OuterHTML::add($this->_tpl_modal);
		
		//---------------------
		
		//SCRIPT Save Record
		if( isset($this->_property['controller_save']) )
		{
			$script_save_record = $this->_tpl_asaverecord_handler;
			$this->_data_fields = substr($this->_data_fields, 0, strlen($this->_data_fields)-2);
			$script_save_record = str_ireplace(':data_fields', $this->_data_fields, $script_save_record);
			$script_save_record = str_ireplace(':controller_save', $this->_property['controller_save'], $script_save_record);
			$script_save_record = str_ireplace(':text', $this->_text, $script_save_record);			
			
			OuterHTML::add($script_save_record);
			
		}

		//Agregar un nuevo registro
		if( isset($this->_property['add_record']) )
		{
			$script_add_record = $this->_tpl_addrecord_handler;
			$script_add_record = str_ireplace(':text', $this->_text, $script_add_record);

			OuterHTML::add($script_add_record);
		}



		//---------------------------------------------------------------------

		if( isset($this->_property['controller_load']) )
		{
			//script de carga de datos por AJAX
			$script_loaddata = str_ireplace(':controller_load', $this->_property['controller_load'], $this->_tpl_loaddata_handler);

			OuterHTML::add($script_loaddata);


			$script_search = str_ireplace(':controller_load', $this->_property['controller_load'], $this->_tpl_searchrecord_handler);
			$script_search = str_ireplace(':text', $this->_property['text'], $script_search);
		
			OuterHTML::add(str_ireplace(':controller_load', $this->_property['controller_load'], $script_search) );
		}

		//---------------------------------------------------------------------		

		//Eliminar información
		if( isset($this->_property['controller_delete']) )
		{
			$script_delete_record = str_ireplace(':text', $this->_text, $this->_tpl_deleterecord_handler);
			$script_delete_record = str_ireplace(':controller_delete', $this->_property['controller_delete'], $script_delete_record);

			OuterHTML::add($script_delete_record);
		
		}
		// --------------------

		
		//View Record
		OuterHTML::add(str_ireplace(':text', $this->_text, $this->_tpl_viewrecord_handler) );
		
			
		//Editar
		OuterHTML::add(str_ireplace(':text', $this->_text, $this->_tpl_editrecord_handler) );
				
		return $this;
		
		
	}
}

?>
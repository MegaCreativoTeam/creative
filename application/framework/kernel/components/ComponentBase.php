<?php


abstract class ComponentBase
{
	
	protected 
		$components = array(),
		$containers = array(),
		$class,
		$default_parent = '',
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
                       
            'min' 			=> '', 
            'max' 			=> '',
			'row' 			=> '2',

            'path'			=> NULL,
            'source'		=> NULL,
            'binding' 		=> NULL,
            
            'tooltip' 		=> '',
            'maxlength' 	=> '', 
            
            'value' 		=> '', 
            'title' 		=> '', 
            'placeholder' 	=> '', 
            'parent' 		=> NULL,
            'is_container' 	=> FALSE,
            'childs' 		=> [],
		);
		
	protected function get_template( $template )
	{
		if( ! file_exists( PATH_KERNEL . 'components' .DS. 'templates' .DS. $template . '.tpl' ) ){
            return false;
        }
        return file_get_contents(  PATH_KERNEL . 'components' .DS. 'templates' .DS. $template . '.tpl' );
	}
	


	/**
	 * Undocumented function
	 *
	 * @param [type] $attrs
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
	* 
	* @param undefined $attrs
	* 
	* @return
	*/
	protected function default_attr( $attrs ){

		$id 	= substr(md5(rand(111,999)), 0, 10);

		$default = $this->template_default;
		$default['id'] = $id;
		$default['label'] = $id;

		$default = array_merge($default, $attrs) ;
		$col = '';

		//Formatear las columnas
		if( count($default['col']) )
		{
			foreach( $default['col'] as $screem => $size)
			{
				$col .= 'col-' . $screem .'-'. $size .' ';
			}
			$default['col'] = trim($col);
		}


		//Formatear REQUIRED
		if( $default['required'] == TRUE )
		{
			$default['icon_required'] = Helper::get('html')->icon_required();
			$default['required'] = 'required';
		}
		

		//Fomatear READONLY
		if( $default['readonly'] == TRUE )
		{
			$default['readonly'] = 'readonly'; 
		}

		//Fomatear AUTOCOMPLETE
		if( $default['autocomplete'] == TRUE )
		{
			$default['autocomplete'] = 'autocomplete'; 
		}

		//Fomatear MIN
		if( $default['min'] )
		{
			$default['min'] = 'min="'.$default['min'].'"'; 
		}

		//Fomatear MAX
		if( $default['max'] )
		{
			$default['max'] = 'max="'.$default['max'].'"'; 
		}

		//Fomatear MAX
		if( $default['maxlength'] )
		{
			$default['maxlength'] = 'maxlength="'.$default['maxlength'].'"'; 
		}

		//Fomatear PLACEHOLDER
		if( $default['placeholder'] )
		{
			$default['placeholder'] = 'placeholder="'.$default['placeholder'].'"'; 
		}

		//Fomatear TITLE
		if( $default['title'] )
		{
			$default['title'] = 'title="'.$default['title'].'"'; 
		}

		//Fomatear VALUE
		if( $default['value'] )
		{
			$default['value'] = $default['value']; 
		}

		//Fomatear PLACEHOLDER
		if( $default['placeholder'] )
		{
			$default['placeholder'] = 'placeholder="'.$default['placeholder'].'"'; 
		}
		
		return (object) $default;
	}
	
	
	
}

?>
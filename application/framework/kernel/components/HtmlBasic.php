<?php



class HtmlBasic extends ComponentBase implements IComponent
{

	const DEFAULT_PARENT = 'body';
	
	public function initialize( $attrs = array() )
	{
		$this->class = __CLASS__;
		
		if( ! isset($attrs['parent']) )
		{
			$attrs['parent'] =self::DEFAULT_PARENT;
		} 
		$attrs = $this->default_attr($attrs);
		$attrs->is_container = TRUE;
		
		//$this->_components[$attrs->parent] = array( 'attrs' => $attrs, 'html'=> ':content');
		return $this;
	}
	
	/**
	 * Undocumented function
	 *
	 * @param [type] $component
	 * @param [type] $property
	 * @return void
	 */
	public function component( $component, $property ){

		if( $component == 'text' OR $component == 'tel' OR $component == 'email' OR $component == 'date' )
		{
			$component = 'input';
		}
		elseif( $component == 'textarea' )
		{
			$component = 'textarea';
		}

		include_once PATH_COMPS . $this->class .DS. $component .'.php';
		$component = new $component;
		$component->create($property);
		$this->_components[$component->getid()] = array( 'attrs' => $component->get_attrs(), 'html'=> $component->get_html());
		return $component;
	}


	/**
	* 
	* @param undefined $property
	* 
	* @return
	*/
	public function panelbox( $property = [] )
	{
		include_once PATH_COMPS . $this->class .DS. 'PanelBox.php';
		$component = new PanelBox();
		$component->create($property);
		$this->_components[$component->getid()] = array( 'attrs' => $component->get_attrs(), 'html'=> $component->get_html());
		return $component;
	}
	
	
	public function source_tpl( $file )
	{		
		if( ! file_exists( PATH_APP . $file . '.tpl' ) )
		{
			return $this;
		}

		$file =  file_get_contents( PATH_APP . $file . '.tpl' );
		OuterHTML::add( $file );
		return $this;
	}
	


	/**
	* Crea un nuevo Input
	* @param undefined $property
	* 
	* @return
	*/
	public function input( $property = array() ){		
		include_once PATH_COMPS . $this->class .DS. 'input.php';
		$component = new input();
		$component->create($property);
		$this->_components[$component->getid()] = array( 'attrs' => $component->get_attrs(), 'html'=> $component->get_html());
		return $component;
	}
	

	/**
	* Crea un nuevo Input
	* @param undefined $property
	* 
	* @return
	*/
	public function button( $property = array() ){
		
		$attr = $this->default_attr($property);	
		$attr->idname = __FUNCTION__;
			
		$input = $this->get_template( __FUNCTION__ );
		
		foreach( $attr as $key => $value ){
			$input = str_ireplace( '{*'.$key.'*}' , $value ,$input);
		}
		
		$this->_components[$attr->id] = array( 'attr' => $attr, 'html'=> $input);
		
		return $this;
	}


	/**
	* Crea un nuevo Input
	* @param undefined $property
	* 
	* @return
	*/
	public function form( $property = array() ){
		
		$attr = $this->default_attr($property);	
		$attr->idname = __FUNCTION__;
		$attr->iscontainer = TRUE;
			
		$component = $this->get_template( __FUNCTION__ );
		
		foreach( $attr as $key => $value ){
			$component = str_ireplace( '{*'.$key.'*}' , $value ,$component);
		}
		
		$this->_components[$attr->id] = array( 'attr' => $attr, 'html'=> $component);
		
		return $this;
	}
	
	
	/**
	* Crea Image Upload
	* @param undefined $property
	* 
	* @return
	*/
	public function image_upload( $property = array() ){
		
		$attr = $this->default_attr($property);	
		$attr->idname = 'imageupload';
			
		$input = $this->get_template( 'imageupload' );
		
		foreach( $attr as $key => $value ){
			$input = str_ireplace( '{*'.$key.'*}' , $value ,$input);
		}
		
		$this->_components[$attr->id] = array( 'attr' => $attr, 'html'=> $input);
		
		return $this;
	}
	
	/**
	* 
	* @param undefined $text
	* @param undefined $title
	* @param undefined $placement
	* @param undefined $content
	* 
	* @return
	*/
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
	
	
	/**
	* paraledepipedo
	* 
	* @return
	*/
	public function column( $property = array() ){
		$attr = $this->default_attr($property);
		$attr->iscontainer = TRUE;
		$attr->idname = 'column';
		$component = '<div class="{*col*}">
	{*content_column*}
</div>';
		
		foreach( $attr as $key => $value ){
			$component = str_ireplace( '{*'.$key.'*}' , $value ,$component);
		}
		
		$this->_components[$attr->id] = array( 'attr' => $attr, 'html'=> $component);
		
		return $this;
	}
	
	/**
	* paraledepipedo
	* 
	* @return
	*/
	public function row(){
		return '		<div class="row">
		{*content_row*}
		</div>';
	}	
	
	
	/**
	* 
	* @param undefined $property
	* 
	* @return
	*/
	public function write( $property = array() ){
		
		$html = '';
		$comp  = $this->_components;
		/*foreach( $comp as $id => $component)
		{
			//Si tiene hijos
			if ( isset($component['attrs']->childs) AND count($component['attrs']->childs) )
			{
				foreach( $component['attrs']->childs as $child_key => $childs)
				{
					$component['html'] = str_ireplace( 
						':content' /*. $childs['attrs']->container_name*, 
						$childs['html'] . ':content' /*. $childs['attrs']->container_name*, 
						$component['html']
					);
					unset( $component['attrs']->childs[$child_key] );
				}
			}
		}*/

		foreach( $this->_components as $parent_id => $component){
			OuterHTML::add( str_ireplace(':content','',$component['html']) );
		}

		
		return $this;

		$html = '';
		$parents = array();
		$childs = array();
				
		
		//recorrer cada componente
		foreach( $this->_components as $id => $component){
			if ( $component['attrs']->is_container === TRUE ){
				$parents[$component['attrs']->id] = $component;
			} else {
				$childs[$component['attrs']->id] = $component;
			}
		}

		foreach( $childs as $id => $component){
			
			$parent_id = $component['attrs']->parent;
			
			if( $parent_id != NULL ){
				
				$parent 		= $this->_components[$parent_id];
				$parent_attrs	= $parent['attrs'];
				$parent_html	= $parent['html'];
				$parent_content	= '{*content_'.$parent_attrs->idname.'*}';
				
				$parent_html = str_ireplace( $parent_content, $component['html'] . $parent_content, $parent_html);
				$this->_components[$parent_id]['html'] = $parent_html;
				unset($this->_components[$id]);
			}
			
		}
		
		
		foreach( $this->_components as $id => $component){
			
			$parent_id = $component['attrs']->parent;
			
			if( $parent_id != NULL ){
				
				$parent 		= $this->_components[$parent_id];
				$parent_attrs	= $parent['attr'];
				$parent_html	= $parent['html'];
				$parent_content	= '{*content_'.$parent_attr->idname.'*}';
				
				$parent_html = str_ireplace( $parent_content, $component['html'] . $parent_content, $parent_html);
				$this->_components[$parent_id]['html'] = $parent_html;
				unset($this->_components[$id]);
			}
			
		}
		

		
		foreach( $this->_components as $parent_id => $component){
			$html .= $component['html'];
		}
		
		
		$GLOBALS['CREATIVE']['echo'][] = $html;
		return $this;
		$html .= $this->get_html_container($component);
	}
	
	
	/**
	* 
	* @param undefined $component
	* 
	* @return
	*/
	public function get_html_container( $component ){
		
		
		/*$html = $component['html'];		
		$comp = '';
		
		if( $component['attr']->container !== NULL ){
			
			foreach( $component['attr']->container as $child_id => $child){
				
				if ( $this->_components[$child]['attr']->iscontainer === TRUE ){
					$comp .= $this->get_html_container($this->_components[$child]);
					unset($this->_components[$child]);
				}
				
				$comp .= $this->_components[$child]['html'];
				$html = str_ireplace( '{*content*}', $comp, $html);
			}
		} else {
			
		}
		
		
		return $html;*/
	}
	

	
	
}
?>
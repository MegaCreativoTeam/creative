<?php

include_once PATH_COMPS . 'ComponentBase.php';

class select extends ComponentBase
{

    private 
        $_html_component = '',
        $_attrs = [],
        $_container = [];


    /**
     * Undocumented function
     *
     * @param array $property
     * @return void
     */
    public function create ( $property = [] )
    {
        $this->class = 'HtmlBasic';
		$attrs = $this->default_attr($property);
		//$attrs->is_container = TRUE;
		//$attrs->container_name = __CLASS__;
        $this->_attrs = $attrs;
        
		$this->_html_component = $this->get_template( __CLASS__ );
		
        foreach( $attrs as $key => $attr )
        {
            if( is_string($attr) )
            {
                $this->_html_component = str_ireplace( ':'. $key, $attr, $this->_html_component);
            }
        }
       
        $option = '';
        
        //Si hay DataSources
        if( is_array($this->_attrs->items) )
        {
           foreach($this->_attrs->items as $key => $value)
           {
               if( $this->_attrs->default == $key )
                   $option .= '<option selected default value="' .$key. '">' .$value. '</option>';
               else 
                   $option .= '<option {if $key==-1}selected default{/if} value="' .$key. '">' .$value. '</option>';
           }
           $this->_html_component = str_ireplace(':option',$option, $this->_html_component);
       }

       $this->clean_attr($this->_html_component);
        return $this;
    }


    public function getid()
    {
        return $this->_attrs->id;
    }

    public function get_html()
    {
        return $this->_html_component;
    }

    public function get_attrs()
    {
        return $this->_attrs;
    }

}

?>
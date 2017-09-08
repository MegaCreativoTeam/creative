<?php

include_once PATH_COMPS . 'ComponentBase.php';

class PanelBox extends ComponentBase
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
		$attrs->is_container = TRUE;
		$attrs->container_name = 'panelbox';
        $this->_attrs = $attrs;
        
		$this->_html_component = $this->get_template( 'htmlbasic.panelbox' );
		
        foreach( $attrs as $key => $attr )
        {
            if( is_string($attr) )
            {
                $this->_html_component = str_ireplace( ':'. $key, $attr, $this->_html_component);
            }
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

    /**
     * Undocumented function
     *
     * @param [type] $component
     * @return void
     */
    public function add( $component )
    {

        $this->_html_component = str_ireplace( ':content', $component->get_html() . ':content', $this->_html_component );
        $this->_container[] = $component;
        return $this;
    }

    public function write()
    {
        OuterHTML::add( str_ireplace(':content','',$this->_html_component) );
    }


}

?>
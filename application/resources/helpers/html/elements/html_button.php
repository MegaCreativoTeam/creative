<?php


class html_button {
	
	function __construct() {
		
	}
	
	   /**
     * Metodo de como se crean los botones de forma predeterminada. 
     * @param array $option El array debe ser asociativo y puede tener cualquier atributo de la etiqueta button
     * @return object
     */
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
    
    /**
     * Metodo dedicado a crear los botones; ya que es el encargado de darle 
     * forma y crear la estructura del boton
     * @param array $option
     * @return string
     */
    public static function create( $attr = FALSE ) {

        $btn = "";
        $action = "";
        
		if( !$attr )
			$attr = self::default_button();
        
        if ($attr->action_param != "") {
            $action = $attr->action . "(" . implode(',', $attr->action_param) . ")";
        } else {
            $action = $attr->action;
        }

        $data_attr = "";
        foreach ($attr as $key => $value) {
            if (strpos($key, 'data') !== -1) {
                $data_attr .= " " .$key. '="' .$value. '"';
            }
        }




        $btn .= '<button id="' .$attr->id .'" '. 
        		'class="btn btn-' .$attr->class .'" '. 
        		($action!='' ? ' onclick="' .$action.'" ' : ''). 
        		'title="' .$attr->title .'" '. 
        		'type="' .$attr->type .'" '. 
        		'data-placement="top" data-toggle="' .$attr->toggle . '" '. 
        		$data_attr.'>';
        $btn .= '<span class="fa fa-' .$attr->icon. '"></span> ' .$attr->text;
        $btn .= '</button>';

        return $btn;
    }
    
    
}
?>
<?php

class Paginator
{
    const
        PAGINATOR_DEFAULT_LIMIT = 10;

    private 
          $_data = []
        , $_paginate;
   
    
    /**
	 * 
	 * @param array $data
	 * @param bool $page Es la página actual de la paginación
	 * @param bool $limit Límiote de registro por página. Cuantos registro devolverá por página
	 * @param bool $range Es el range de página que devolverá. Por ejemplo de 100 Páginas devolverá 10
	 * 
	 * @return
	 */
    public function initialize( $data, $page = false, $offset = seflf::PAGINATOR_DEFAULT_offset, $range = 10 )
    {
        if( $offset && is_numeric($offset) )
        {
            $offset = $offset;
        }
        else
        {
            $offset = 30;
        }
        

        if( $page && is_numeric($page) )
        {
            $page = $page;
            $begin = ($page - 1) * $offset;
        }
        else
        {
            $page = 1;
            $begin = 0;
        }
        
        
        $records = count($data);
        $total = ceil($records / $offset);
        
        #Guardar los registro que han sido paginados
        $this->_data = array_slice($data, $begin, $offset);
               
        $paginate = [
            'current' => $page,
            'range' => $range,
            'total' => $total,
            'offset' => $offset
        ];
        
        if($page > 1)
        {
            $paginate['first'] = 1;
            $paginate['previous'] = $page - 1;
        }
        else
        {
            $paginate['first'] = '';
            $paginate['previous'] = '';
        }
        

        if($page < $total)
        {
            $paginate['last'] = $total;
            $paginate['next'] = $page + 1;
        }
        else
        {
            $paginate['last'] = '';
            $paginate['next'] = '';
        }
        
        $this->_paginate = $paginate;
		$this->range( $range );
        
        return $this->_data;
    }
    
    
    /**
	* 
	* @param undefined $limit
	* 
	* @return
	*/
    private function range($limit = false)
    {
        if($limit && is_numeric($limit))
        {
            $limit = $limit;
        }
        else
        {
            $limit = 10;
        }
        
        $total_pages = $this->_paginate['total'];
        $page_selected = $this->_paginate['current'];
        $range = ceil($limit / 2);
        $pages = array();
        
        $range_right = $total_pages - $page_selected;
        
        if($range_right < $range)
        {
            $resto = $range - $range_right;
        }
        else
        {
            $resto = 0;
        }
        
        $range_izquierdo = $page_selected - ($range + $resto);
        
        for($i = $page_selected; $i > $range_izquierdo; $i--)
        {
            if($i == 0)
            {
                break;
            }            
            $pages[] = $i;
        }
        
        sort($pages);
        
        if($page_selected < $range)
        {
            $range_right = $limit;
        }
        else
        {
            $range_right = $page_selected + $range;
        }
        
        for($i = $page_selected + 1; $i <= $range_right; $i++)
        {
            if($i > $total_pages){
                break;
            }            
            $pages[] = $i;
        }
        
        $this->_paginate['range'] = $pages;
        
        return $this->_paginate;
        
    }
    

    /**
     * Undocumented function
     *
     * @param [type]  $view
     * @param boolean $link
     * @param integer $limit
     * @return void
     */
    public function render( $view, $link = false, $limit = 10)
    {
		$path_view = __DIR__ .DS. 'views' .DS. $view . '.php';
		
        if( $link )
        {
			$link = BASE_URL . $link ;
		}
			
        if(is_readable($path_view))
        {			
			#aperturar el buffer
			ob_start();	
					
			include $path_view;
			
			#lo que tenemos en el buffer se almacena en la variable
			$content = ob_get_contents();
			
			#Cerrar y limpiar el buffer
			ob_end_clean();
			
			return $content;
        } 
        else
        {
            throw new Exception('Error in paginate');	
        }
		
			
	}
}

?>

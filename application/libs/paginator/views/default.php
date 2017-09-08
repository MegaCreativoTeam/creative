<?php
if( isset($this->_paginate) ){

	echo '<div class="text-center">'.
			'<ul class="pagination">';

	//Create the go to First record button
	if( isset($this->_paginate['first']) )
	{
		echo '<li>'.
				'<a href="'. $link .'page-'. $this->_paginate['first'] .'-offset-'. $this->_paginate['offset'] . '/?tokenurl='.hash_url().'" aria-label="'.l('first').'">'.
					'<span aria-hidden="true" class="glyphicon glyphicon-step-backward"></span> '.l('first').
				'</a>'.
			'</li>';
	}
	else
	{
		echo l('first');
	}

	//Create the go to Previous record button
	if( isset($this->_paginate['previous']) ){
		echo '<li>'.
				'<a href="'. $link .'page-'. $this->_paginate['previous'] .'-offset-'. $this->_paginate['offset'] . '/?tokenurl='.hash_url().'" aria-label="'.l('previous').'">'.
					'<span aria-hidden="true" class="glyphicon glyphicon-chevron-left"></span>'.
				'</a>'.
			'</li>';
	}
	else
	{
		echo l('previous');
	}



	for( $i=0 ; $i < count($this->_paginate['range']) ; $i++ )
	{
		if( $this->_paginate['current']==$this->_paginate['range'][$i] )
		{
			echo 
				'<li class="active">' .
					'<a>'.$this->_paginate['range'][$i].'<span class="sr-only">(current)</span></a>'.
				'</li>';
		}
		else
		{
			echo 
				'<li>'.
					'<a href="'.$link .'page-'. $this->_paginate['range'][$i] . '-offset-'. $this->_paginate['offset'] .'/?tokenurl='.hash_url().'">'.
						$this->_paginate['range'][$i].
					'</a>'.
				'</li>';
		}
	}


	
	if( 
		/*(($this->_paginate['current'] + 1) < $this->_paginate['total']) OR 	*/
		( (end($this->_paginate['range'])) < $this->_paginate['total'] ) 
	)
	{
		echo 
			'<li>'.
				'<a>'.
					'<span class="sr-only">(current)</span> ...'.
				'</a>'.
			'</li>';

		$minus = 1;
		$total = $this->_paginate['total'] - $minus;
		for( $i=$total ; $i < $this->_paginate['total']+1 ; $i++ )
		{
			echo 
				'<li>'.
					'<a href="'.$link .'page-'. $i . '-offset-'. $this->_paginate['offset'] .'/?tokenurl='.hash_url().'">'.
						$i.
					'</a>'.
				'</li>';
		}		
	}




	if( isset($this->_paginate['next']) )
	{
		echo '<li>
				<a href="'.$link .'page-'. $this->_paginate['next'] . '-offset-'. $this->_paginate['offset'] . '/?tokenurl='.hash_url().'" aria-label="'.l('next').'">
					<span aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</li>';
	}
	else
	{
		echo l('next');
	}



	if( isset($this->_paginate['last']) )
	{
		echo '<li>
				<a href="'.$link .'page-'. $this->_paginate['last'] . '-offset-'. $this->_paginate['offset'] .'/?tokenurl='.hash_url().'" aria-label="'.l('last').'">
					Último <span aria-hidden="true" class="glyphicon glyphicon-step-forward"></span>
				</a>
			</li>';
	}
	else
	{
		echo l('last');
	}


	echo 
	'</ul>'.
	'</div>';
}

?>
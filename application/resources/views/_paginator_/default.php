<?php
if( isset($this->_paginate) ){

	echo '<div class="text-center">'.
			'<ul class="pagination">';

	//Create the go to First record button
	if( isset($this->_paginate['first']) )
	{
		echo '<li>'.
				'<a href="'. $link . $this->_paginate['first'].'" aria-label="'.l('first').'">'.
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
				'<a href="'. $link . $this->_paginate['previous'].'" aria-label="'.l('previous').'">'.
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
					'<a href="'.$link . $this->_paginate['range'][$i].'">'.
						$this->_paginate['range'][$i].
					'</a>'.
				'</li>';
		}
	}


	if( isset($this->_paginate['next']) )
	{
		echo '<li>
				<a href="'.$link . $this->_paginate['next'].'" aria-label="'.l('next').'">
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
				<a href="'.$link . $this->_paginate['last'].'" aria-label="'.l('last').'">
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
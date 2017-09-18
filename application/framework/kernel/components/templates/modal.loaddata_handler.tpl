<script>

/**
* Traer los datos mediante Ajax
*/
function loaddata_handler( id ){
	
	$.ajax({
		url : "{$registry.$module.api}/find/" + id + '/?nocache=' + Math.random(),
		data : {
			id 		: id,
			token 	: _token,
	    },
	    beforeSend: function( e ) {
			$.loading({ text: "{Lang::get('processing')}..."  });
		},
		type : "GET",		 
		dataType : "json",		 
		success : function(data) {
			
			$.loading( "hide" );			
	    	if( data.status == 200 ){
	    		$.each(data.data, function( index, item ){
	    			
	    			//Si es un Select se le agrega el target
	    			if( $("#"+index).is("select") ){
	    				
	    				if( ex.isArray(item) ){
	    					var _items = [];
	    					//Parsear los datos para obtener un array con los ID
	    					$.each(item, function( index_item, item_item ){
								_items.push(item_item["id"]);
							});
							$("#"+index).val(_items).change();
						} else {
							if( new String(item).contains(",") ){
								var it = item.toArray(",");
								$("#"+index).val(it).change();
							} else {
								$("#"+index).val(item).change();
							}
						}
						
	    			} else if( $("#"+index).is("[type='date']") || $("#"+index).is("[type='datetime-local']") ){
						var date = item;
						$("#"+index).val(date);
						
					} else {
	    				$("#"+index).val(item);
	    			}
	    		});
				//_token = data.response.token;				
			} else {					
				ex.notify(data.statusText, data.icon);
			}	
			$(".select2[readonly]").select2({ "disabled": true });			
	    }
	});
}
</script>
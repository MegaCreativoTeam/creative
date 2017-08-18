<script>
	
/**
* Envia una peticion para crear un nuevo registro
*/
function saverecord_handler( e ){
	
	e.preventDefault()
	
	var $btn= $(this);
	$(".form-control").parent().removeClass("has-error");
	
	var data = {
			id : $("#id").val(),
			:data_fields
		},
		action 			= "",
		ajax_url 		= ":controller_save";
	
	
	//Nuevo Registro
	if( data.id <= "-1" ){
		action 		= "insert";
		ajax_type = "POST";
	//Actualización de registro
	} else {
		action 	= "update";
		ajax_type = "PUT";
	}

	if( $(data.field).is('select') ){
		$(data.field).focus().parent().parent().addClass("has-error");
	} else {
		$(data.field).focus().parent().addClass("has-error");
	}
		
	$.ajax({
		url : ajax_url,
		data : data,
	    beforeSend: function( e ) {
			$.loading({ text: '{l("processing")}...' });
		},
		type : ajax_type,		 
		dataType : "json",		 
		success : function(data) {
			
			$.loading( "hide" );
			_token = data.token;
			console.log(data.statusText);
			
			//Created - Creado con exito
	    	if( data.status == 201 ){
	    		
				$("#modal_wiewrecord").modal("hide");
				ex.notify(data.statusText, data.icon);
				edit_mode = false;
				
				if (action == "update"){
					var row = $("#tr_" + data.data.id);
					_dt_data.row(row).remove().draw();
				}
				
				var columns = [];
				$.each(_datable_columns,function(index, item){
					if( _datable_columns_pk == item){
						columns.push( '<a href="javascript:viewrecord_handler(data.data.id)">'+data.data[item]+'</a>' );
					} else {
						columns.push( data.data[item] );
					}
				});
				
				//Template de Estatus
				columns[columns.length-1] = _template_status
			        .replace(":status_text", data.data.status_text)
			        .replace(":status_help", data.data.status_help)
			        .replace(":status_class", data.data.status_class)
			    ;
			    
			    //Tempalte de Acciones
			    columns.push(
			        _template_action
			        	.replace(":id", data.data.id) //View
			        	.replace(":id", data.data.id) //Edit
			        	.replace(":id", data.data.id) //Delete
			    );
				
				var _row_node = _dt_data.row.add(columns).draw().node();
					$(_row_node).attr("id", "tr_" + data.data.id);
					
				$(_row_node).addClass("save_success");

				setTimeout(function(){
					$(_row_node).removeClass("save_success");
				}, 5500);

	    	} else if( data.status == 422 ){
				//Unprocessable Entity - Parametros incorrectos				
	    		ex.notify(data.statusText, data.icon);
				if( $(data.field).is('select') ){
					$(data.field).focus().parent().parent().addClass("has-error");
				} else {
					$(data.field).focus().parent().addClass("has-error");
				}
	    		

	    		return false;
				
	    	} else {
				ex.notify(data.statusText, data.icon);
				console.log( data.status + ': '+ data.statusTex);
	    		return false;
			}
	    }
	});
	
}
	
$(document).ready(function(){
	$("#modal_wiewrecord_form").submit(saverecord_handler);
	$("#modal_wiewrecord").on("shown.bs.modal", function () {
	    $(this).find("input:text:visible:first").focus();
	});
});	
	
</script>
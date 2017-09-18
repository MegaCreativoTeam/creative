
<div class="row" style="padding-top:15px">
    <div class="col-md-12" style="margin-bottom:5px">
        <a id="btn_addedit_materias" type="buttom" class="btn btn-default">
            <span class="fa fa-plus"></span> Agregar materia
        </a>
    </div>
</div>

<table id="table_materias" class="table display table-fixed" cellspacing="0" width="100%">
	<thead>
	    <tr>
	    	<th class="text-left">Materia</th>
            <th class="text-center">Semestre</th>
			<th class="text-center">U.C.</th>
            <!--<th class="text-left">Prelación</th>-->
            <th class="text-center">Acciones</th>
	    </tr>
	</thead>
	<tfoot>
	    <tr>
	    	<th class="text-left">Materia</th>
            <th class="text-center">Semestre</th>
			<th class="text-center">U.C.</th>
            <!--<th class="text-left">Prelación</th>-->
            <th class="text-center">Acciones</th>
	    </tr>
	</tfoot>
    <tbody>        
    </tbody>
</table>


<script>

var listado_materias = {};


function show_addedit_materia(){
    $('#modal_addedit_materias').modal('show');
}



function add_materia( e ){

    e.preventDefault();

    var materia = $('#materias_list').val();
    var materia_text = $('#materias_list').select2('data')[0].text;
    var uc = $('#materias_uc').val();
	var semestre = $('#materias_semestre').val();
    var prelacion = $('#materias_prelacion').val()
    var pre = '';

    if( materia_text == '' ){
        $('#materias_list').focus();
        return false;
    }
    
    if( uc == '' ){
        $('#materias_uc').focus();
        return false;
    }

	if( semestre == '' ){
        $('#materias_semestre').focus();
        return false;
    }

    $.each( $('#materias_prelacion').select2('data'), function(index, item){
        pre += '<span class="label label-primary" style="margin-bottom:4px !important;display: inline-block !important;">' + item.text + '</span> ';
    });


    listado_materias[materia] = {
        text : materia_text,
		semestre : semestre,
        uc : uc,
        prelacion : prelacion,
        prelacion_text : pre
    };

    $('#materias_uc').val('');
	$('#materias_semestre').val('');
    $('#materias_prelacion, #materias_list').val('').change();

    refresh_lista_materias();

    $('#modal_addedit_materias').modal('hide');
}


function edit_materia( id ){

    $('#materias_list').val( id ).change();
    $('#materias_prelacion').val( listado_materias[id].prelacion ).change();
    $('#materias_uc').val( listado_materias[id].uc );
	$('#materias_semestre').val( listado_materias[id].semestre );
    show_addedit_materia();
}


function refresh_lista_materias(){

    $('#table_materias > tbody').html ('');

    $.each( listado_materias, function(index, item){
        $('#table_materias > tbody:last-child').append (
            '<tr id="tr_">'+
                '<td align="left">'+item.text+'</td>'+
				'<td align="center">'+item.semestre+'</td>'+
                '<td align="center">'+item.uc+'</td>'+
                /*'<td align="left">'+item.prelacion_text+'</td>'+*/
                '<td align="center">'+
                    ' <button class="btn btn-info" onclick="javascript:edit_materia('+index+');" title="" type="button"><span class="fa fa-edit"></span> </button>'+
                    ' <button class="btn btn-danger" onclick="javascript:delete_materia('+index+')"  type="button"><span class="fa fa-trash"></span>'+
                '</td>'+
            '</tr>'
        );
    });
}


function delete_materia( id ){
    delete (listado_materias[id]);
    refresh_lista_materias();
}


function saverecord_handler( e ){
	
	e.preventDefault()
	
	var $btn= $(this);
	$(".form-control").parent().removeClass("has-error");
	
	var data = {
			id : $("#id").val(),
			carrera_id : $("#carrera_id").val(),
			sede_id : $("#sede_id").val(),
			status : $("#status").val(),
			materias : listado_materias
		},
		action 		= "",
		ajax_url 	= "/api/v1/pensum.json/" + '?nocache=' + Math.random();
	
	
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
			
			
			_token = data.token;
			console.log(data.statusText);
			
			//Created - Creado con exito
	    	if( data.status == 201 ){
	    		
                $("#modal_wiewrecord").modal("hide");
				ex.notify(data.statusText, data.icon);
                location.reload();
                return true;

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
                
                $.loading( "hide" );

				//Unprocessable Entity - Parametros incorrectos				
	    		ex.notify(data.statusText, data.icon);
				if( $(data.field).is('select') ){
					$(data.field).focus().parent().parent().addClass("has-error");
				} else {
					$(data.field).focus().parent().addClass("has-error");
				}
	    		

	    		return false;
				
	    	} else {
                $.loading( "hide" );
				ex.notify(data.statusText, data.icon);
				console.log( data.status + ': '+ data.statusTex);
	    		return false;
			}
	    }
	});
	
}


$(function() {
    $('#modal_addedit_materias_form').submit(add_materia);
    $('#btn_addedit_materias').click(show_addedit_materia);
	$('#modal_wiewrecord_form').submit(saverecord_handler);
});


</script>



<script>

/**
* Traer los datos mediante Ajax
*/
function loaddata_handler( id ){
	
	$.ajax({
		url : "/api/v1/pensum.json/find/" + id + '/?nocache=' +  Math.random(),
		data : {
			id 		: id,
			token 	: _token,
	    },
	    beforeSend: function( e ) {
			$.loading({ text: "{l('processing')}..."  });
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

				pre='';
				$.each( data.data.materias, function(index, item){

					prelacion = item.prelacion.toArray(',');

					//pre += '<span class="label label-primary" style="margin-bottom:4px !important;display: inline-block !important;">' + item.text + '</span> ';
					
					listado_materias[item.materia_id] = {
						text : _materias[item.materia_id],
						semestre : item.semestre,
						uc : item.uc,
						prelacion : prelacion,
						prelacion_text : pre
					};
				
				});

				refresh_lista_materias();
				

				//_token = data.response.token;				
			} else {					
				ex.notify(data.statusText, data.icon);
			}	
			$(".select2[readonly]").select2({ "disabled": true });			
	    }
	});
}
</script>
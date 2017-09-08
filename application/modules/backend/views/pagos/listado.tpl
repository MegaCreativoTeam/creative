{include file="includes/data.table.tpl" 
	data=$data 
	table=$table
	dt_notpaginate=true}

{if $search}
	{include file="includes/modal-search.tpl" 
		data=$data 
		table=$table 
		controller='/backend/'|cat:$module|cat:'/'}
{/if}

{include file="includes/scripts.tpl"}


<input id="id" type="hidden" value="-1"/>

<div id="modal_wiewrecord" class="modal fade" role="dialog" aria-labelledby="modal_wiewrecord_title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<!-- header modal -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal_wiewrecord_title" style="text-transform: uppercase;">PAGOS</h4>
			</div>
			<form id="modal_wiewrecord_form" class="form-view" action="" method="post" enctype="multipart/form-data" data-success="" data-toastr-position="top-right">
				<fieldset>							
					<!-- body modal -->
					<div class="modal-body">

						<div class="row">
							
							<div class="col-xs-12">
								<h4>Datos del estudiante</h4>
							</div>

							<input id="estudiante_id" type="hidden">
							<input id="carrera_id" type="hidden">

							<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2" style="margin-bottom:5px">
								<label for="estudiante_cedula">Cédula</label>
								<input id="estudiante_cedula" type="text" value="" class="form-control" readonly>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:5px">
								<label for="estudiante_nombre">Nombre</label>
								<input id="estudiante_nombre" type="text" value="" class="form-control" readonly>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:5px">
								<label for="estudiante_apellido">Apellido</label>
								<input id="estudiante_apellido" type="text" value="" class="form-control" readonly>
							</div>

							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="margin-bottom:5px">
								<label for="estudiante_carrera">Carrera</label>
								<input id="estudiante_carrera" type="text" value="" class="form-control" readonly>
							</div>

							<div class="col-xs-12">
								<h4>Datos del pago</h4>
							</div>
									
							<div class="col-md-8">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin-bottom:5px">
										<label for="gateway_id">Forma de pago</label>
										<select id="gateway_id" class="form-control required select2" required="" style="width:100%" tabindex="-1" aria-hidden="true">
											<option value="-1">Seleccione</option>

											{if isset($gateways) AND count($gateways)}
												{foreach $gateways as $key => $value}
													<option value="{$key}">{$value}</option>
												{/foreach}
											{/if}
										</select>
									</div>

									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="margin-bottom:5px">
										<label for="banco">Banco {Helper::get('html')->icon_required()} </label>
										<select id="banco" class="form-control required select2" required="" style="width:100%" tabindex="-1" aria-hidden="true">
											<option value="-1">Seleccione</option>
											
											{if isset($bancos) AND count($bancos)}
												{foreach $bancos as $key => $value}
													<option value="{$key}">{$value}</option>
												{/foreach}
											{/if}

										</select>
									</div>

									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-bottom:5px">
										<label for="control">N° de control {Helper::get('html')->icon_required()} </label>
										<input id="control" type="text" value="" class="form-control required" required>
									</div>

									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-bottom:5px">
										<label for="fecha_realizado">Fecha de realización {Helper::get('html')->icon_required()} </label>
										<input id="fecha_realizado" type="datetime" value="" class="form-control required" required>
									</div>

									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-bottom:5px">
										<label for="monto">Total {Helper::get('html')->icon_required()} </label>
										<input id="monto" type="text" value="0.0" class="numeric form-control required" required style="text-align:right">
									</div>

									<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2" style="margin-bottom:5px">
										<label for="semestre">Semestre {Helper::get('html')->icon_required()} </label>
										<select id="semestre" class="form-control required select2" required="" style="width:100%" tabindex="-1" aria-hidden="true">
											<option value="-1">Seleccione</option>											
											{if isset($semestres) AND count($semestres)}
												{foreach $semestres as $key => $value}
													<option value="{$key}">{$value}</option>
												{/foreach}
											{/if}
										</select>
									</div>

									<div class="col-xs-12 col-sm-4 col-md-2 col-lg-2" style="margin-bottom:5px">
										<label for="periodo">Periodo {Helper::get('html')->icon_required()} </label>
										<input id="periodo" type="text" min="0" max="1" value="" class="form-control required" required style="text-align:center">
									</div>								

									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-bottom:5px">
										<label for="nrecibo">N° de recibo {Helper::get('html')->icon_required()} </label>
										<input id="nrecibo" type="text" value="" class="numeric form-control required" required>
									</div>

									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" style="margin-bottom:5px">
										<label for="fecha_recibo">Fecha recibo {Helper::get('html')->icon_required()} </label>
										<input id="fecha_recibo" type="date" value="" class="form-control required" required>
									</div>

									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:5px">
										<label for="observaciones">Observaciones </label>
										<textarea id="observaciones" row="2" class="form-control"></textarea>
									</div>
								</div>
							</div>


							<div class="col-md-4">
								
							</div>

						</div>
					</div>

					<!-- Modal Footer -->
					<div class="modal-footer">
						<button id="modal_wiewrecord_cancel" class="btn btn-danger pull-left" data-dismiss="modal"><span class="fa fa-ban"></span> Cerrar</button>
						<button id="modal_wiewrecord_submit" type="submit" class="btn btn-success"><span class="fa fa-check"></span> Aceptar</button>
					</div>
				</fieldset>
			</form>
			
		</div>
	</div>
</div>


<div id="modal_search_estudiante" class="modal fade" role="dialog" aria-labelledby="modal_search_estudiante_title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="modal_wiewrecord_title" style="text-transform: uppercase;">Buscar Estudiante</h4>
			</div>
									
					<!-- body modal -->
					<div class="modal-body">
						<div class="row">
						
							<div class="col-md-12" style="margin-bottom:5px">
								<label for="search_estudiante_cedula">Cédula</label>
								<input id="search_estudiante_cedula" type="text" value="" class="form-control" onkeyup="javascript:buscar_estudiante_handler()">
							</div>

							<div class="col-md-12">

							<table datatable id="dt_data_estudiante" class="display data-table compact" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th align="left">Cédula</th>
										<th align="left">Apellido</th>
										<th align="left">Nombre</th>
										<th align="left">Carrera</th>
										<th align="left"></th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th align="left">Cédula</th>
										<th align="left">Apellido</th>
										<th align="left">Nombre</th>
										<th align="left">Carrera</th>
										<th align="left"></th>
									</tr>
								</tfoot>
								<tbody>
								</tbody>
							</table>

							</div>



						</div>
					</div>

					<!-- Modal Footer -->
					<div class="modal-footer">
						<button id="modal_search_estudiante_cancel" class="btn btn-danger pull-left" data-dismiss="modal"><span class="fa fa-ban"></span> Cerrar</button>
						<button id="modal_search_estudiante_submit" type="submit" class="btn btn-success"><span class="fa fa-check"></span> Aceptar</button>
					</div>
				
			
		</div>
	</div>
</div>



<script>

	$(function() {
		$('#monto').numeric({ decimal: true, negative: false, decimalPlaces: 2 });
	});

	function buscar_estudiante_handler(){	

		var value  = $("#search_estudiante_cedula").val();	
		if( value == " " ){
			return ;
		}

		$.ajax({
			url : "/api/v1/estudiantes.json/search/cedula/" + value + '/?nocache=' + Math.random(),
			type : "GET",
			dataType : "json",		 
			success : function(data) {			
				
				_dt_data_estudiante.clear().draw();
							
				$.each(data.data,function(index, item){				
					var columns = [
						item['cedula']
						,item['apellido']
						,item['nombre']
						,item['carrera']
						,'<button '+
							' data-id="'+item['id']+'" '+
							' data-cedula="'+item['cedula']+'" '+
							' data-nombre="'+item['nombre']+'" '+
							' data-apellido="'+item['apellido']+'" '+
							' data-carrera="'+item['carrera']+'" '+
							' data-carrera_id="'+item['carrera_id']+'" '+
							'class="btn btn-default" onclick="javascript:load_estudiante_handler(this);"><span class="fa fa-check"></span> </button>'//View
					];					
					_dt_data_estudiante.row.add(columns).draw();
					
				});
			}
		});	
	}

</script>



<script>
	_option_dt_search_estudiante = {
		
		"language": {
			"info": "Registros <strong>_START_</strong> al <strong>_END_</strong> de un total de <strong>_TOTAL_</strong> registros",
			"infoFiltered": " - filtrado de _MAX_ registros",
			"processing": "Procesando...",
			"search": "",
			"sEmptyTable":"Sin datos para mostrar...",
			"sLoadingRecords": "Cargando...",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sZeroRecords": "No se encontraron resultados",
			"sSearchPlaceholder": "Filtar resultados...",
			"sDecimal": ",",
			"sInfoThousands":  ",",	
			"searchDelay": 100,	
			"lengthMenu": 
				'Mostrar <select class="form-control" style="display: inline-block;width: auto;">'+
				'<option value="10">10</option>'+
				'<option value="25">25</option>'+
				'<option value="50">50</option>'+
				'<option value="-1">Todos</option>'+
				'</select> páginas',
			"paginate": {
					"sFirst": '<span class="fa fa-square-o-left"></span>',
					"sLast": '<span class="fa fa-square-o-right"></span>',
					"sNext": '<span class="fa fa-caret-right"></span>',
					"sPrevious": '<span class="fa fa-caret-left"></span>'
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	}

	var _dt_data_estudiante;
	$(document).ready(function(){
		_dt_data_estudiante = $('#dt_data_estudiante').DataTable(_option_dt_search_estudiante);
		$('#modal_search_estudiante .dataTables_filter input').hide();
		$('#modal_search_estudiante #dt_data_estudiante_length').hide();
	});
</script>

<script>
	
	/**
	* Prepara el formulario para insertar un nuevo registro*
	* @param string title Titulo del Modal
	* @return
	*/
	function addrecord_handler( title ){
		
		title = Object.isString(title) ? title : "PAGOS - <small>Agregar nuevo</small>";
		
		//Inicializar los valores por defecto
		$("#id").val(-1);
		
		bloquear_handler( false );
		clear_handler();
		$(".select2[readonly]").select2({ "disabled": true });

		$("#modal_search_estudiante").modal("show");
		$("#modal_wiewrecord_title").html(title);

	}

	function load_estudiante_handler( e ){
		var base = $(e);

		$("#estudiante_id").val( $(base).data('id') );
		$("#estudiante_cedula").val( $(base).data('cedula') );
		$("#estudiante_nombre").val( $(base).data('nombre') );
		$("#estudiante_apellido").val( $(base).data('apellido') );
		$("#carrera_id").val( $(base).data('carrera_id') );
		$("#estudiante_carrera").val( $(base).data('carrera') );

		$("#modal_search_estudiante").modal("hide");
		$("#modal_wiewrecord").modal("show");
	}


</script>



<script>
	
	function saverecord_handler( e ){
		
		e.preventDefault()
		
		var $btn= $(this);
	
		if( $(".form-control").is('select') ){
			$(".form-control").parent().parent().removeClass("has-error");
		} else {
			$(".form-control").parent().removeClass("has-error");
		}

		var data = {
				  id 			: $("#id").val()
				, estudiante_id : $("#estudiante_id").val()
				, gateway 		: $("#gateway").val()
				, control 		: $("#control").val()
				, fecha_realizado	: $("#fecha_realizado").val()
				, monto 		: $("#monto").val()
				, semestre 		: $("#semestre").val()
				, carrera_id 	: $("#carrera_id").val()
				, periodo 		: $("#periodo").val()
				, banco 		: $("#banco").val()
				, nrecibo 		: $("#nrecibo").val()
				, fecha_recibo 	: $("#fecha_recibo").val()
				, observaciones : $("#observaciones").val()
			},
			action 		= "",
			ajax_url 	= "/api/v1/pagos.json/";
		
		
		//Nuevo Registro
		if( data.id <= "-1" ){
			action 		= "insert";
			ajax_type = "POST";
		//Actualización de registro
		} else {
			action 	= "update";
			ajax_type = "PUT";
		}		
			
		$.ajax({
			url : ajax_url,
			data : data,
			beforeSend: function( e ) {
				$.loading({ text: 'Procesando...' });
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
								
					ex.notify(data.statusText, data.icon);
					if( $(data.field).is('select') ){
						$(data.field).focus().parent().addClass("has-error");
					} else {
						$(data.field).focus().addClass("has-error");
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

	$('#modal_wiewrecord_form').submit(saverecord_handler);

</script>


<script>
	/**
	* Visualizar la informacion de un registro
	* 
	* @return
	*/
	function viewrecord_handler(id){
		edit_mode = false;
		
		clear_handler();
		
		$("#id").val(id);
		loaddata_handler( id );
		bloquear_handler( true );
		
		$("#modal_wiewrecord_cancel").prop('disabled', false);
		$("#modal_wiewrecord_submit").hide();

		$("#modal_wiewrecord_title").html("PAGOS - <small>{l('dashboard.actions.visualize')}</small>");
		$("#modal_wiewrecord").modal("show");
	}
</script>



<script>

/**
* Traer los datos mediante Ajax
*/
function loaddata_handler( id ){
	
	$.ajax({
		url : "/api/v1/pagos/find/" + id + '/?nocache=' + Math.random(),
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
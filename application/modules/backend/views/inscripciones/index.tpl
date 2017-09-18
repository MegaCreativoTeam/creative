<div id="toollbar" class="row" style="display: none;margin-bottom:15px">
    <div class="col-md-12">
        <button id="btn_procesar_inscripcion" type="buttom" class="btn btn-success pull-left"><span class="fa fa-ban"></span> Procesar</button>
        <button id="btn_cancelar_inscripcion" type="buttom" class="btn btn-danger pull-right"><span class="fa fa-ban"></span> Cancelar inscripción</button>
    </div>
</div>



<div id="content-info" style="display:none">
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Datos personales</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Record académico</a></li>
    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
</ul>

<div class="tab-content" >
    <div role="tabpanel" class="tab-pane active" id="profile">
        
        <div class="box box-default">
            <div id="panelbox-content" class="box-body">
                <div class="row">
                    <form id="89fcd07f20" class="form-view" action="" method="post" enctype="multipart/form-data" data-success="" data-toastr-position="top-right">
                        <fieldset>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:5px">
                                <label for="cedula">Cédula <span class="fa fa-circle" style="font-size: 6px; color: #ce0000" data-toggle="tooltip" data-placement="top" data-original-title="El campo  es requerido."></span> </label>
                                <input id="cedula" type="text" value="" class="form-control required" required="" readonly="">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:5px">
                                <label for="nombre">Nombre <span class="fa fa-circle" style="font-size: 6px; color: #ce0000" data-toggle="tooltip" data-placement="top" data-original-title="El campo  es requerido."></span> </label>
                                <input id="nombre" type="text" value="" class="form-control required" required="">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:5px">
                                <label for="apellido">Apellido <span class="fa fa-circle" style="font-size: 6px; color: #ce0000" data-toggle="tooltip" data-placement="top" data-original-title="El campo  es requerido."></span> </label>
                                <input id="apellido" type="text" value="" class="form-control required" required="">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom: 5px; display: none;">
                                <label for="status">Estatus <span class="fa fa-circle" style="font-size: 6px; color: #ce0000" data-toggle="tooltip" data-placement="top" data-original-title="El campo  es requerido."></span></label>
                                <select id="status" class="form-control required select2" required="" style="width:100%" tabindex="-1" aria-hidden="true">
                                    <option value="-1">Seleccione</option><option value="1">Activo</option><option selected="" default="" value="0">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:5px">
                                <label for="email">Correo electrónico  </label>
                                <input id="email" type="email" value=""  class="form-control ">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:5px">
                                <label for="tel_movil">Teléfono móvil  </label>
                                <input id="tel_movil" type="tel" value=""  class="form-control ">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:5px">
                                <label for="tel_habitacion">Teléfono de Hab.  </label>
                                <input id="tel_habitacion" type="tel" value=""  class="form-control ">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:5px">
                                <label for="estado">Estado  </label>
                                <input id="estado" type="tel" value=""  class="form-control ">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom:5px">
                                <label for="ciudad">Ciudad  </label>
                                <input id="ciudad" type="tel" value=""  class="form-control ">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="margin-bottom: 5px; display: none;">
                                <label for="parroquia">Parroquia  </label>
                                <input id="parroquia" type="tel" value=""  class="form-control ">
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:5px">
                                <label for="direccion">Dirección  </label>
                                <textarea id="direccion" type="textarea" class="form-control " row=""></textarea>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>


    </div>

    <div role="tabpanel" class="tab-pane" id="messages">
        <div class="box box-default">
               <div id="panelbox-content" class="box-body">
                <div class="row">  

                    <table id="table_record_academico" class="table display table-fixed" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-left">Semestre</th>
                                <th class="text-left">Código</th>
                                <th class="text-left">Materia</th>
                                <th class="text-center">U.C.</th>
                                <th class="text-center">Nota</th>
                                <th class="text-center">Condición</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th class="text-left">Semestre</th>
                                <th class="text-left">Código</th>
                                <th class="text-left">Materia</th>
                                <th class="text-center">U.C.</th>
                                <th class="text-center">Nota</th>
                                <th class="text-center">Condición</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>        
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

<div role="tabpanel" class="tab-pane" id="settings">...</div>
</div>

</div>



<div class="row">
    <div id="modal_busqueda_record_academico" class="modal fade" role="dialog" aria-labelledby="modal_wiewrecord_title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_busqueda_record_academico_title" style="text-transform: uppercase;">Buscar Estudiante</h4>
                </div>
                <form id="modal_busqueda_record_academico_form" class="form-view" action="" method="post" enctype="multipart/form-data" data-success="" data-toastr-position="top-right">
                    <fieldset>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-sm-12" style="margin-bottom:5px">
                                    <label for="buscar_cedula">Cédula</label>
                                    <input id="buscar_cedula" align="center" type="text" placeholder="Cédula de identidad" class="form-control">
                                </div>
                            </div>

                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button id="modal_busqueda_record_academico_submit" type="submit" class="btn btn-success"><span class="fa fa-check"></span> Aceptar</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $('#modal_busqueda_record_academico').modal('show');
        $('#modal_busqueda_record_academico_form').submit(buscar_record);
        $('#status').parent().hide();
        $('#parroquia').parent().hide();

        $('#btn_cancelar_inscripcion').click(function() {
            $('#content-info').hide();
            $('#toollbar').hide();
            $('#modal_busqueda_record_academico').modal('show');
        });

    });
var prelacion = [];
    function buscar_record(e) {
        e.preventDefault();

        var cedula = $("#buscar_cedula").val();

        $.ajax({
            url: "/api/v1/estudiantes.json/search_por_cedula/" + cedula + '&nocache=' + Math.random(),
            beforeSend: function(e) {
                $.loading({
                    text: "{l('processing')}..."
                });
            },
            type: "GET",
            dataType: "json",
            success: function(data) {

                if (data.status == 200) {
                    $.each(data.data, function(index, item) {

                        //Si es un Select se le agrega el target
                        if ($("#" + index).is("select")) {

                            if (ex.isArray(item)) {
                                var _items = [];
                                //Parsear los datos para obtener un array con los ID
                                $.each(item, function(index_item, item_item) {
                                    _items.push(item_item["id"]);
                                });
                                $("#" + index).val(_items).change();
                            } else {
                                if (new String(item).contains(",")) {
                                    var it = item.toArray(",");
                                    $("#" + index).val(it).change();
                                } else {
                                    $("#" + index).val(item).change();
                                }
                            }

                        } else if ($("#" + index).is("[type='date']") || $("#" + index).is("[type='datetime-local']")) {
                            var date = item;
                            $("#" + index).val(date);

                        } else {
                            $("#" + index).val(item);
                        }
                    });

                    
                    prelacion = [];
                    $.each( data.data.record_academico, function(index, item){
                        if( item.prelacion != '' ){
                            prelacion.push( {    
                                materia_id : item.materia_id,
                                nota : item.nota,
                                prelacion: item.prelacion.split(',')                               
                            } );
                        }
                    });

                    $('#table_record_academico > tbody').html ('');
                    $.each( data.data.record_academico, function(index, item){

                        var klass = 'success';
                        if (item.condicion == 0 || item.condicion == ''){
                            klass = 'danger'
                        }

                        var acciones = '<td align="center"></td>';

                        if( (data.data.semestre+1) == item.semestre ){
                            
                            for( var i=0; i<prelacion.length; i++){
                                if( $.inArray( item.materia_id+'', prelacion[i].prelacion) === -1 ){
                                           acciones = '<td align="center">'+
                                            '<button class="btn btn-info" onclick="javascript:delete_materia('+item.materia_id+')"  type="button"><span class="fa fa-"></span>'+
                                        '</td>';     break ;                       
                                } else {
                                    if( prelacion[i].nota > 9 ){
                                        acciones = '<td align="center">'+
                                            '<button class="btn btn-info" onclick="javascript:delete_materia('+item.materia_id+')"  type="button"><span class="fa fa-plus"></span>'+
                                        '</td>';  
                                        break ;
                                    } 
                                }
                            };

                        }
                        
                        

                        $('#table_record_academico > tbody:last-child').append (
                            '<tr id="tr_">'+
                                '<td align="center">'+item.semestre+'</td>'+
                                '<td align="left">'+item.codigo+'</td>'+
                                '<td align="left">'+item.nombre+'</td>'+
                                '<td align="center">'+item.uc+'</td>'+
                                '<td align="center">'+ item.nota +'</td>'+
                                '<td align="center" class="text-'+klass+'">'+item.condicion_text+'</td>'+
                                    acciones + 
                            '</tr>'
                        );
                    });


                    $('#content-info').show();
                    $('#toollbar').show();
                    $('#modal_busqueda_record_academico').modal('hide');

                } else if (data.status == 204) {
                    //_token = data.response.token;				
                    ex.notify(data.statusText, data.icon);
                } else if (data.status == 404) {
                    //_token = data.response.token;				
                    ex.notify(data.statusText, data.icon);
                }

                $("#btn_search").prop("disabled", false);
                $.loading("hide");
            }
        });
    }
</script>

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
            <th class="text-left">U.C.</th>
            <th class="text-left">Prelación</th>
            <th class="text-left">Acciones</th>
	    </tr>
	</thead>
	<tfoot>
	    <tr>
	    	<th class="text-left">Materia</th>
            <th class="text-left">U.C.</th>
            <th class="text-left">Prelación</th>
            <th class="text-left">Acciones</th>
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
$('#btn_addedit_materias').click(show_addedit_materia);


function add_materia(){

    var val = $('#materias_list').val();
    var text = $('#materias_list').select2('data')[0].text;
    var uc = $('#materias_uc').val();
    var prelacion = $('#materias_prelacion').val()
    var pre = '';

    $.each( $('#materias_prelacion').select2('data'), function(index, item){
        pre += '<span class="label label-primary" style="margin-bottom:6x;display: inline-block;">' + item.text + '</span> ';
    });

    listado_materias[val] = {
        text : text,
        uc : uc,
        prelacion : prelacion,
        prelacion_text : pre
    };

    $('#materias_uc').val('');
    $('#materias_prelacion, #materias_list').val('').change();

    refresh_lista_materias();
}


function edit_materia( id ){
    $('#materias_list').val( id ).change();
    $('#materias_prelacion').val( listado_materias[id].prelacion ).change();
     $('#materias_uc').val( listado_materias[id].uc );
}


function refresh_lista_materias(){
    $('#table_materias > tbody').html ('');
    $.each( listado_materias, function(index, item){

        $('#table_materias > tbody:last-child').append (
            '<tr id="tr_">'+
                '<td align="left">'+item.text+'</td>'+
                '<td align="center">'+item.uc+'</td>'+
                '<td align="left">'+item.prelacion_text+'</td>'+
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

$('#btn_add_mat').click(add_materia);


</script>
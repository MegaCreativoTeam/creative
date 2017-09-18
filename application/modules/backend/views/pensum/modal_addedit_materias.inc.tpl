
<div id="modal_addedit_materias" class="modal fade" role="dialog" aria-labelledby="modal_wiewrecord_title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<!-- header modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_addedit_materias_title" style="text-transform: uppercase;">Materias</h4>
            </div>
			<form id="modal_addedit_materias_form" class="form-view" action="" method="post" enctype="multipart/form-data" data-success="" data-toastr-position="top-right">
				<fieldset>							
					<!-- body modal -->
					<div class="modal-body">

						<div class="row" style="padding-top:15px">
                            
                            <div class="col-sm-12 col-md-8 col-lg-8" style="margin-bottom:5px">
                                <label for="materias_list">Materias</label>
                                <select id="materias_list" class="form-control select2"  style="width:100%">                
                                    {foreach $materias as $key => $value}
                                    <option value="{$key}">{$value}</option>
                                    {/foreach}
                                </select>
                            </div>

                            <div class="col-sm-6 col-md-2 col-lg-2" style="margin-bottom:5px">
                                <label for="materias_uc">U.C.</label>
                                <input id="materias_uc" align="center" type="number" placeholder="Unidades de crédito" class="form-control">
                            </div>

                            <div class="col-sm-6 col-md-2 col-lg-2" style="margin-bottom:5px">
                                <label for="materias_semestre">Semestre</label>
                                <input id="materias_semestre" align="center" type="number" min="1" max="10" placeholder="Semestre" class="form-control">
                            </div>

                            <div class="col-sm-12 col-md-12" style="margin-bottom:5px">
                                <label for="materias_prelacion">Prelación</label>
                                <select id="materias_prelacion" class="form-control select2 multiple" multiple="multiple"  style="width:100%">                
                                    {foreach $materias as $key => $value}
                                    <option value="{$key}">{$value}</option>
                                    {/foreach}
                                </select>                                
                            </div>   

                        </div>

					</div>

					<!-- Modal Footer -->
					<div class="modal-footer">
						<button id="modal_addedit_materias_cancel" class="btn btn-danger pull-left" data-dismiss="modal"><span class="fa fa-ban"></span> Cerrar</button>
						<button id="modal_addedit_materias_submit" type="submit" class="btn btn-success"><span class="fa fa-check"></span> Aceptar</button>
					</div>
				</fieldset>
			</form>
			
		</div>
	</div>
</div>


<script>
var _materias = [];
{foreach $materias as $key => $value}
    _materias['{$key}'] = '{$value}';
{/foreach}

</script>
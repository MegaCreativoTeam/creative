
<div id="modal_addedit_materias" class="modal fade" role="dialog" aria-labelledby="modal_wiewrecord_title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<!-- header modal -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_addedit_materias_title" style="text-transform: uppercase;">Materias</h4>
            </div>
			<form id="modal_wiewrecord_form" class="form-view" action="" method="post" enctype="multipart/form-data" data-success="" data-toastr-position="top-right">
				<fieldset>							
					<!-- body modal -->
					<div class="modal-body">

						<div class="row" style="padding-top:15px">
                            <div class="col-md-12" style="margin-bottom:5px">
                                <label for="materias_list">Materias</label>
                                <select id="materias_list" class="form-control select2"  style="width:100%">                
                                    {foreach $materias as $key => $value}
                                    <option value="{$key}">{$value}</option>
                                    {/foreach}
                                </select>
                            </div>

                            <div class="col-md-12" style="margin-bottom:5px">
                                <label for="materias_prelacion">Prelación</label>
                                <select id="materias_prelacion" class="form-control select2 multiple" multiple="multiple"  style="width:100%">                
                                    {foreach $materias as $key => $value}
                                    <option value="{$key}">{$value}</option>
                                    {/foreach}
                                </select>                                
                            </div>   

                            <div class="col-md-12" style="margin-bottom:5px">
                                <label for="materias_uc">Unidades de Créditos</label>
                                <div class="input-group">      
                                    <input id="materias_uc" align="center" type="number" placeholder="U.C." class="form-control">
                                    <span class="input-group-btn">
                                        <button id="btn_add_mat" class="btn btn-default" type="button"><span class="fa fa-plus"></span> Agregar</button>
                                    </span>
                                </div>
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

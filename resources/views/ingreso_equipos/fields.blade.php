<?php
    if( isset($reg) ){
      $vl=1;///SI VIENE DE EDITAR
    }else{
      $vl=0;///SI VIENE DE NUEVO
    }
?>

<style>
    #mdl_body_modal{
        height:500px;
        overflow-y:auto;
    }
    .input-group{
      margin-top:7px;
    }
    .input-group-addon{
      font-weight:bolder;
      background:#eee !important;
    }

.upload-btn-wrapper {
  position: relative;
  overflow: hidden;
  display: inline-block;
  border:solid 1px;
  border-radius:5px;
}
.upload-btn-wrapper input[type=file] {
  font-size: 100px;
  position: absolute;
  left: 0;
  top: 0;
  opacity: 0;
  cursor:pointer;
}
#tbl_datos_review th{
  padding:5px;
  text-align:center;
}
.img_comp{
  width:30px;
}
#tbl_datos_review tbody tr:nth-child(even){
  background:#ccc;
}
#tbl_datos_review tbody tr:hover{
cursor:pointer;
background:#82CFE0;
}

</style>

{{csrf_field()}}
  <script src="{{asset('js/ingreso_equipos.js')}}"></script>
                  <div class="row">
                    <div class="col-md-6" style="border:solid 1px teal;padding:10px;border-radius:10px;" >
                        <h3 class="bg-blue text-center" style="border-radius:2px;" >Equipo</h3>
                        <div class="row">
                          <div class="col-md-8">
                            <div class="input-group">
                              <span class="input-group-addon">Serie &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="hidden" id="eqp_id" class="form-control" value="{{ $vl==1 ? $reg->eqp_id : 0 }}"  >
                              <input type="text" id="eqp_serie" class="form-control" value="{{ $vl==1 ? $reg->eqp_serie : "" }}" placeholder="Tipo/Marca/Serie">
                            </div>
                          </div>

                          <div class="col-md-10">
                            <div class="input-group">
                              <span class="input-group-addon">Tipo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="hidden" id="eqp_tip_id_aux" class="form-control" value="{{ $vl==1 ? $reg->eqp_tip_id : 0 }}" placeholder="Marca">
                              <select id="eqp_tip_id" class="form-control " >
                                <option value="0">-Seleccione-</option>
                              </select>
                              <span class="input-group-addon"> <button class="btn btn-primary btn-xs fa fa-plus btn_add_tipo"></button> </span>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">Marca &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="text" id="eqp_marca" class="form-control" value="{{ $vl==1 ? $reg->eqp_marca : "" }}" placeholder="Marca">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">Modelo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="text" id="eqp_modelo" class="form-control" value="{{ $vl==1 ? $reg->eqp_modelo : "" }}" placeholder="Modelo">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">Color  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="text" id="eqp_color" class="form-control" value="{{ $vl==1 ? $reg->eqp_color : "" }}" placeholder="Color">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">Medida &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="text" id="eqp_medida" class="form-control" value="{{ $vl==1 ? $reg->eqp_medida : "" }}" placeholder="Medida">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="input-group">
                              <span class="input-group-addon">Generales&nbsp;</span>
                              <input type="text" id="eqp_adicional" value="{{ $vl==1 ? $reg->eqp_adicional : "" }}" class="form-control" placeholder="Características generales del equipo">
                            </div>
                          </div>
                        </div>
                        <div class="row" hidden >
                          <div class="col-md-12">
                            <div class="input-group" >
                              <span class="input-group-addon">Obs &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
                              <textarea id="eqp_obs" value="{{ $vl==1 ? $reg->eqp_obs : "" }}" class="form-control " placeholder="Observacion"></textarea>
                            </div>
                          </div>
                        </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="input-group">
                            <span class="input-group-addon">Fecha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input type="hidden" id="rgi_id" value="{{ $vl==1 ? $reg->rgi_id : 0 }}" class="form-control " value="0">
                            <input type="date" id="rgi_fecha" value="{{ $vl==1 ? $reg->rgi_fecha : date('Y-m-d') }}" class="form-control " placeholder="Fecha">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="input-group">
                            <span class="input-group-addon">Hora &nbsp;</span>
                            <input type="time" id="rgi_hora" value="{{ $vl==1 ? $reg->rgi_hora : date('H:i') }}" class="form-control " placeholder="Hora">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon">Imagen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <input type="file" id="rgi_imagen" value="{{ $vl==1 ? $reg->rgi_imagen : "" }}" class="form-control " >
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="input-group">
                            <span class="input-group-addon" > <span>Diagnostico.Inicial</span> </span>
                            <textarea  id="rgi_diagnostico_inicial" class="form-control " placeholder="Diagnostico Inicial" cols="" rows="1" > {{ $vl==1 ? $reg->rgi_diagnostico_inicial : '' }} </textarea>
                          </div>
                        </div>
                      </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">Estado &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="hidden" id="rgi_estado_aux" class="form-control" value="{{ $vl==1 ? $reg->rgi_estado : 0 }}" placeholder="Marca">
                              <select id="rgi_estado" value="" class="form-control "  >
                                <option value="0" >Funcional</option>
                                <option value="1" >No Funcional</option>
                              </select>
                            </div>
                          </div>
                        </div>
                     <div class="row" style="margin-left:3px;margin-right:3px; margin-top:10px  " >
                            <button class="btn btn-primary btn_guarda_actualiza_equipo"> <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Guardar/Actualizar</button>
                            <button class="btn btn-info pull-right btn_review_components "><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp; Revision de equipos</button>
                     </div>
                    </div>

                    <div class="col-md-6" style="border:solid 1px teal;padding:10px;border-radius:10px  " >
                        <h3 class="bg-blue text-center" style="border-radius:2px;" >Cliente</h3>
                     <div class="row">
                        <div class="col-md-6">
                          <div class="input-group">
                              <span class="input-group-addon">Cedula/Ruc</span>
                              <input type="hidden" id="cli_id" value="{{ $vl==1 ? $reg->cli_id : 0 }}" >
                              <input type="text" id="cli_ced_ruc" value="{{ $vl==1 ? $reg->cli_ced_ruc : "" }}" class="form-control " placeholder="Cedula/Ruc">
                          </div>
                       </div>
                     </div>
                     <div class="row">
                        <div class="col-md-9">
                          <div class="input-group">
                              <span class="input-group-addon">Apellidos &nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="text" id="cli_apellidos" value="{{ $vl==1 ? $reg->cli_apellidos : "" }}" class="form-control cls_input_cliente" placeholder="Apellidos">
                          </div>
                       </div>
                     </div>
                     <div class="row">
                        <div class="col-md-9">
                          <div class="input-group">
                              <span class="input-group-addon">Nombres &nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="text" id="cli_nombres" value="{{ $vl==1 ? $reg->cli_nombres : "" }}" class="form-control cls_input_cliente" placeholder="Nombres">
                          </div>
                       </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                          <div class="input-group">
                              <span class="input-group-addon">Ciudad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="text" id="cli_canton" value="{{ $vl==1 ? $reg->cli_canton : "" }}" class="form-control cls_input_cliente" placeholder="Ciudad" >
                          </div>
                       </div>
                     </div>

                     <div class="row">
                        <div class="col-md-9">
                          <div class="input-group">
                              <span class="input-group-addon">Direccion &nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="text" id="cli_calle_prin" value="{{ $vl==1 ? $reg->cli_calle_prin : "" }}" class="form-control cls_input_cliente" placeholder="Direccion">
                          </div>
                       </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6">
                          <div class="input-group">
                              <span class="input-group-addon">Telefono &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="text" id="cli_telefono" value="{{ $vl==1 ? $reg->cli_telefono : "" }}" class="form-control cls_input_cliente" placeholder="telefono">
                          </div>
                       </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6">
                          <div class="input-group">
                              <span class="input-group-addon">Correo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              <input type="email" id="cli_email" value="{{ $vl==1 ? $reg->cli_email : "" }}" class="form-control cls_input_cliente" placeholder="Correo">
                          </div>
                       </div>
                     </div>
                     <div class="row" style="margin-left:3px;margin-top:10px  " >
                            <button class="btn btn-primary btn_guarda_actualiza_cliente"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Guardar/Actualizar</button>
                     </div>
                     <div class="row" style="margin-top:50px; " >
                      <div class="col-md-6">
                        @isset($reg)
                              @isset($reg->ord_id)
                                  <strong class="txt_orden">No de Ord: 000{{$reg->ord_id}}</strong>
                                  <br>
                                  <strong class="txt_orden">Técnico: {{$reg->usu_person}} </strong>
                                @else
                                  <strong class="txt_orden">No existe orden</strong>
                              @endisset
                            @else
                            <strong class="txt_orden">No existe orden</strong>
                        @endisset
                        <input type="hidden" id="ord_id" value="{{ $vl==1 ? $reg->ord_id : "" }}">
                      </div>
                      <div class="col-md-6">
                       <button class="btn btn-success fa fa-file-pdf-o btn_genera_orden" > Generar Orden de Trabajo</button>
                      </div>
                     </div>

                    </div>
                  </div>{{-- fin de la row1 --}}





{{-- MODAL CARGAR CLIENTES --}}

<div class="modal fade" id="modal_clientes" tabindex="-1" role="dialog" aria-labelledby="lbl_modal_clientes" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center bg-primary"  id="lbl_modal_clientes">
            LISTA DE CLIENTES
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </h5>
      </div>
    <div class="modal-body" id="mdl_body_modal">
        <table id="tbl_mdl_clientes" class="table" >
        </table>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

{{-- MODAL CARGAR EQUIPOS --}}

<div class="modal fade" id="modal_equipos" tabindex="-1" role="dialog" aria-labelledby="lbl_modal_equipos" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center bg-primary"  id="lbl_modal_equipos">
            LISTA DE CLIENTES
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
      </h5>
      </div>
    <div class="modal-body" id="mdl_body_modal_equipos">
        <table id="tbl_mdl_equipos" class="table" >
        </table>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

{{-- MODAL REVISION DE EQUIPOS --}}

<div class="modal fade" id="mdl_review_components" tabindex="-1" role="dialog" aria-labelledby="lbl_review_components" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center bg-primary"  id="lbl_review_components">REVISIÓN DE COMPONENTES
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
       </h5>
      </div>
      <div class="modal-body" id="mdl_body_review_components">
        <table id="tbl_datos_review" class="table" >
          <thead>
          <tr class="bg-navy" >
            <th colspan="2">No</th>
            <th>COMPONENTE</th>
            <th>FUNCIONALIDAD</th>
            <th>SERVICIO TÉCNICO</th>
            <th>OBS/DESCRIPCION</th>
            <th></th>
            <th></th>
          </tr>
          <tr style='background:#ccc'>
            <td></td>
            <td>
              <div class="upload-btn-wrapper">
                <button class="btn">Foto</button>
                <input type="file" id="rvc_imagen" />
              </div>
            </td>
            <td><input type="text" id="rvc_nombre" class="form-control"></td>
            <td>
              <select  id="rvc_funcionalidad" class="form-control">
                <option value="0">BUENO</option>
                <option value="1">REGULAR</option>
                <option value="2">MALO</option>
              </select>
            </td>
            <td>
              <select  id="rvc_reemplazo_reparacion" class="form-control">
                <option value="0">NINGUNO</option>
                <option value="1">REPARACIÓN</option>
                <option value="1">CAMBIO</option>
              </select>
            </td>
            <td><input type="text" id="rvc_descripcion" class="form-control"></td>
            <td> <i class="btn btn-info fa fa-plus btn_add_component"></i> </td>
          </tr>
        </thead>
        <tbody>

        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

{{-- MODAL ORDEN DE TRABAJO --}}

<!-- Modal -->
<div class="modal fade" id="mld_tecnicos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title bg-primary text-center" >TÉCNICOS</h5>
      </div>
      <div class="modal-body" style="height:400px;overflow-y:auto; ">
        <table class="table">
          <thead>
            <tr>
              <td>No</td>
              <td>Nombres</td>
              <td class="text-center">Seleccionar</td>
            </tr>
          </thead>
          <tbody id="tbody_tecnicos">

          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <span class="input-group-addon">Fecha Inicio</span>
              <input type="date" class="form-control" id="ord_fecha_inicio" >
              <span class="input-group-addon">Hora Inicio</span>
              <input type="time" class="form-control" id="ord_hora_inicio" >
            </div>
            <div class="input-group">
              <span class="input-group-addon">Fecha Fin &nbsp;&nbsp;&nbsp;</span>
              <input type="date" class="form-control" id="ord_fecha_fin">
              <span class="input-group-addon">Hora Fin &nbsp;&nbsp;&nbsp;</span>
              <input type="time" class="form-control" id="ord_hora_fin">
            </div>
              <textarea class="form-control" id="ord_obs" rows="2" placeholder="Observaciones"></textarea>


          </div>
        </div>
        <button type="button" class="btn btn-success btn_confirma_genera_orden" >Generar</button>
      </div>


    </div>
  </div>
</div>
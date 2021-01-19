const url=window.location;
const token=$("input[name=_token]").val();
const mostrar_mensaje=(icon,title,pos='')=>{
  Swal.fire({
    position:pos,
    icon: icon,
    title: title,
    showConfirmButton: true,
    timer: 3000
  })
}
$(function(){
  cargar_combo_tipos();
  cargar_revision_componente();
  limpiar_rev_componente();
})
//*****************************************************/////
                          // CLIENTE
//*****************************************************/////
$(document).on("change","#cli_ced_ruc",()=>{
                     const ruc=$("#cli_ced_ruc").val();
                    $.ajax({
                        url: url+'/busca_cliente',
                        headers:{'X-CSRF-TOKEN':token},
                        type: 'POST',
                        dataType: 'json',
                        data: {ruc:ruc},
                        beforeSend:function(){
                        },
                        success:function(dt){
                            mostrar_clientes(dt);
                        }
                    })
})

$(document).on("click",".btn_guarda_actualiza_cliente",function(){

    const datos={ cli_id:$("#cli_id").val().toUpperCase(),
                  cli_ced_ruc:$("#cli_ced_ruc").val().toUpperCase(),
                  cli_apellidos:$("#cli_apellidos").val().toUpperCase(),
                  cli_nombres:$("#cli_nombres").val().toUpperCase(),
                  cli_telefono:$("#cli_telefono").val().toUpperCase(),
                  cli_canton:$("#cli_canton").val().toUpperCase(),
                  cli_calle_prin:$("#cli_calle_prin").val().toUpperCase(),
                  cli_email:$("#cli_email").val().toLowerCase() }

                    $.ajax({
                        url: url+'/guarda_actualiza_cliente',
                        headers:{'X-CSRF-TOKEN':token},
                        type: 'POST',
                        dataType: 'json',
                        data:datos,
                        beforeSend:function(){
                          if($("#cli_ced_ruc").val().length<9){
                            mostrar_mensaje('error','Cedula o ruc incorrectos favor revise');
                            return false;
                          }
                          if($("#cli_apellidos").val().length<5){
                            mostrar_mensaje('error','Apellido incorrecto favor revise');
                            return false;
                          }
                          if($("#cli_nombres").val().length<5){
                            mostrar_mensaje('error','Nombre incorrecto favor revise');
                            return false;
                          }
                          if($("#cli_canton").val().length<4){
                            mostrar_mensaje('error','Ciudad incorrecta favor revise');
                            return false;
                          }
                          if($("#cli_calle_prin").val().length<6){
                            mostrar_mensaje('error','Direccion incorrecta favor revise');
                            return false;
                          }
                          if($("#cli_telefono").val().length<9){
                            mostrar_mensaje('error','Telefono incorrecto favor revise');
                            return false;
                          }
                          if($("#cli_email").val().length<10){
                            mostrar_mensaje('error','Correo incorrecto favor revise');
                            return false;
                          }

                        },
                        success:function(dt){
                          let icon='error';
                          let title='Algun proceso ha fallado, intente nuevamente';
                          $("#cli_id").val(0);
                          if(dt>0){
                                 icon='success';
                                 title='Guardado/Actualizado correctamente';
                                 $("#cli_id").val(dt);
                          }
                          mostrar_mensaje(icon,title);

                        }
                    })

})

$(document).on("click",".btn_select_cliente",function(){
            const cli_id=$(this).attr('cli_id');
                    $.ajax({
                        url: url+'/busca_un_cliente',
                        headers:{'X-CSRF-TOKEN':token},
                        type: 'POST',
                        dataType: 'json',
                        data: {cliid:cli_id},
                        beforeSend:function(){
                        },
                        success:function(cli){
                            mostrar_cliente(cli);
                        }
                    })

})

const mostrar_cliente=(cli)=>{
    $("#cli_id").val(cli.cli_id);
    $("#cli_ced_ruc").val(cli.cli_ced_ruc);
    $("#cli_apellidos").val(cli.cli_apellidos);
    $("#cli_nombres").val(cli.cli_nombres);
    $("#cli_telefono").val(cli.cli_telefono);
    $("#cli_canton").val(cli.cli_canton);
    $("#cli_calle_prin").val(cli.cli_calle_prin);
    $("#cli_email").val(cli.cli_email.toLowerCase());
    $("#modal_clientes").modal("hide");
}

const limpiar_cliente=()=>{
    $("#cli_ced_ruc").val(null);
    $("#cli_apellidos").val(null);
    $("#cli_nombres").val(null);
    $("#cli_telefono").val(null);
    $("#cli_canton").val(null);
    $("#cli_calle_prin").val(null);
    $("#cli_email").val(null);
    $("#modal_clientes").modal("hide");
}


const mostrar_clientes=(clientes)=>{
              $("#tbl_mdl_clientes").html(null);
         let rst=`<tr> <td>No</td> <td>CI/RUC</td> <td>Cliente</td> <td>...</td> </tr>`;
         let c=0;
         if(clientes.length>0){
                 clientes.map((cli)=>{
                       c++;
                      rst+=`<tr>
                              <td>${c}</td>
                              <td>${cli.cli_ced_ruc}</td>
                              <td>${cli.cli_apellidos} ${cli.cli_nombres!=null?cli.cli_nombres:''}</td>
                              <td>
                                   <button class='btn btn-info btn-xs btn_select_cliente' cli_id=${cli.cli_id} > <i class='fa fa-check'></i>  </botton>
                              </td>
                      </tr>`;
                 })
                 $("#modal_clientes").modal("show");
                 $("#tbl_mdl_clientes").html(rst);

         }else{

                      Swal.fire({
                        title: 'No existe ningun cliente',
                        text: "Desea registrar uno nuevo",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Regsitrar, Nuevo'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          // $(".cls_input_cliente").attr('disabled',false);
                        }
                      })

      }
}
//*****************************************************/////
                    // EQUIPO
//*****************************************************/////
$(document).on("change","#eqp_serie",()=>{
                     const eqp_serie=$("#eqp_serie").val();
                    $.ajax({
                        url: url+'/busca_equipos',
                        headers:{'X-CSRF-TOKEN':token},
                        type: 'POST',
                        dataType: 'json',
                        data: {eqp_serie:eqp_serie},
                        beforeSend:function(){
                        },
                        success:function(dt){
                            mostrar_equipos(dt);
                        }
                    })
})

$(document).on("click",".btn_add_tipo",()=>{

  Swal.fire({
    title: "Descripcion del nuevo tipo",
    input: "text",
    showCancelButton: true,
    confirmButtonText: "Guardar",
    cancelButtonText: "Cancelar",
    inputValidator: nombre => {
                // Si el valor es válido, debes regresar undefined. Si no, una cadena
                if (!nombre) {
                  return "Descripcion es obligatoria";
                } else {
                  return undefined;
                }
              }
            }).then(resultado => {
              if (resultado.value) {
                let nombre = resultado.value;
                crear_nuevo_tipo(nombre);
              }
            });

})

$(document).on("click",".btn_guarda_actualiza_equipo",()=>{
  const datos={ eqp_id:$("#eqp_id").val(),
                eqp_serie:$("#eqp_serie").val().toUpperCase(),
                eqp_tip_id:$("#eqp_tip_id").val(),
                eqp_marca:$("#eqp_marca").val().toUpperCase(),
                eqp_modelo:$("#eqp_modelo").val().toUpperCase(),
                eqp_color:$("#eqp_color").val().toUpperCase(),
                eqp_medida:$("#eqp_medida").val().toUpperCase(),
                eqp_adicional:$("#eqp_adicional").val().toUpperCase(),

                cli_id:$("#cli_id").val(),
                rgi_id:$("#rgi_id").val(),
                rgi_fecha:$("#rgi_fecha").val(),
                rgi_hora:$("#rgi_hora").val(),
                rgi_imagen:$("#rgi_imagen").val(),
                rgi_diagnostico_inicial:$("#rgi_diagnostico_inicial").val(),
                rgi_estado:$("#rgi_estado").val()
              }

                    $.ajax({
                        url: url+'/guarda_actualiza_equipos',
                        headers:{'X-CSRF-TOKEN':token},
                        type: 'POST',
                        dataType: 'json',
                        data: datos,
                        beforeSend:function(){

                          if($("#cli_id").val()==0){
                            mostrar_mensaje('error','Debe seleccionar y guardar un cliente ');
                            return false;
                          }

                          if($("#eqp_serie").val().length<6){
                            mostrar_mensaje('error','Serie incorrecta favor revise');
                            return false;
                          }
                          if($("#eqp_tip_id").val()==0){
                            mostrar_mensaje('error','Seleccion el tipo');
                            return false;
                          }
                          if($("#eqp_marca").val().length<2){
                            mostrar_mensaje('error','Marca incorrecta favor revise');
                            return false;
                          }
                          if($("#eqp_modelo").val().length<2){
                            mostrar_mensaje('error','Modelo incorrecto favor revise');
                            return false;
                          }
                          if($("#eqp_color").val().length<3){
                            mostrar_mensaje('error','Colore incorrecto favor revise');
                            return false;
                          }
                          if($("#eqp_medida").val().length==0){
                            mostrar_mensaje('error','Medida incorrecta favor revise');
                            return false;
                          }


                        },
                        success:function(dt){
                            // console.log(dt);
                            if(dt){
                              $("#eqp_id").val(dt[0]);
                              $("#rgi_id").val(dt[1]);
                              mostrar_mensaje('success','Registro/Actualizacion correcta');
                            }
                        },
                        error:function(err){
                            mostrar_mensaje('error','Numero de serie ya existe');
                        }
                    })
})

$(document).on("click",".btn_select_equipo",function(){
       const eqp_id=$(this).attr('eqp_id');
                    $.ajax({
                        url: url+'/busca_un_equipo',
                        headers:{'X-CSRF-TOKEN':token},
                        type: 'POST',
                        dataType: 'json',
                        data: {eqp_id:eqp_id},
                        beforeSend:function(){
                        },
                        success:function(dt){
                          mostrar_un_equipo(dt);
                          $("#modal_equipos").modal("hide");
                        }
                    })
})


const mostrar_un_equipo=(equipo)=>{

                $("#eqp_id").val(equipo.eqp_id);
                $("#eqp_serie").val(equipo.eqp_serie);
                $("#eqp_tip_id").val(equipo.eqp_tip_id);
                $("#eqp_marca").val(equipo.eqp_marca);
                $("#eqp_modelo").val(equipo.eqp_modelo);
                $("#eqp_color").val(equipo.eqp_color);
                $("#eqp_medida").val(equipo.eqp_medida);
                $("#eqp_adicional").val(equipo.eqp_adicional);
                $("#eqp_obs").val(equipo.eqp_obs);
                $("#eqp_estado").val(equipo.eqp_estado);

}
const mostrar_equipos=(equipos)=>{
         $("#tbl_mdl_equipos").html(null);
         let rst=`<tr> <td>No</td> <td>Serie</td> <td>Tipo</td> <td>Marca/Modelo/Color</td> <td>...</td> </tr>`;
         let c=0;
         if(equipos.length>0){
                 equipos.map((eqp)=>{
                       c++;
                      rst+=`<tr>
                              <td>${c}</td>
                              <td>${eqp.eqp_serie}</td>
                              <td>${eqp.tip_descripcion}</td>
                              <td>${eqp.eqp_marca} / ${eqp.eqp_modelo} / ${eqp.eqp_color}</td>
                              <td>
                                   <button class='btn btn-info btn-xs btn_select_equipo' eqp_id=${eqp.eqp_id} > <i class='fa fa-check'></i>  </botton>
                              </td>
                      </tr>`;
                 })
                  $("#modal_equipos").modal("show");
                  $("#tbl_mdl_equipos").append(rst);

         }else{

                      Swal.fire({
                        title: 'No existe ningun equipo',
                        text: "Desea registrar uno nuevo?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Regsitrar, Nuevo'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          limpiar_equipo();
                        }
                      })

      }
}

const crear_nuevo_tipo=(tip_descripcion)=>{

  $.ajax({
    url: url+'/guarda_actualiza_tipo',
    headers:{'X-CSRF-TOKEN':token},
    type: 'POST',
    dataType: 'json',
    data: {tip_descripcion:tip_descripcion},
    beforeSend:function(){
    },
    success:function(dt){
      if(dt!=0){
        cargar_combo_tipos();
      }else{
        mostrar_mensaje('warning','Ya tipo ya existe');
      }
    }
  })

}

const cargar_combo_tipos=()=>{

  $.ajax({
    url: url+'/cargar_combo_tipos',
    headers:{'X-CSRF-TOKEN':token},
    type: 'POST',
    dataType: 'json',
    data: {op:0},
    beforeSend:function(){
    },
    success:function(dt){
      //alert(dt[0]['tip_id']);
      let combo=`<option value='0'>-Seleccione-</option>`;
      dt.map((d)=>{
        combo+=`<option value='${d.tip_id}'>${d.tip_descripcion}</option>`;
      });

       $("#eqp_tip_id").html(combo);
       cargar_datos_default();
    }
  })

}

const limpiar_equipo=()=>{

                $("#eqp_id").val(0);
                // $("#eqp_serie").val(null);
                $("#eqp_tip_id").val('0');
                $("#eqp_marca").val(null);
                $("#eqp_modelo").val(null);
                $("#eqp_color").val(null);
                $("#eqp_medida").val(null);
                $("#eqp_adicional").val(null);
                $("#eqp_obs").val(null);
                $("#eqp_estado").val('0');

}
const cargar_datos_default=()=>{
  $("#rgi_estado").val( $("#rgi_estado_aux").val() );
  $("#eqp_tip_id").val( $("#eqp_tip_id_aux").val() );
}

// REVISION DE COMPONENTES

$(document).on("click",".btn_review_components",function(){
    $("#mdl_review_components").modal("show");
})

$(document).on("click",".btn_add_component",function(){

  const rgi_id = $('#rgi_id').val();
  const rcv_imagen = $('#rvc_imagen').prop('files')[0];
  const rvc_nombre = $("#rvc_nombre").val();
  const rvc_funcionalidad = $("#rvc_funcionalidad").val();
  const rvc_reemplazo_reparacion = $("#rvc_reemplazo_reparacion").val();
  const rvc_descripcion = $("#rvc_descripcion").val();
  const formData = new FormData();
  formData.append('rev_rgi_id', rgi_id);
  formData.append('rvc_imagen', rvc_imagen);
  formData.append('rvc_nombre', rvc_nombre);
  formData.append('rvc_funcionalidad', rvc_funcionalidad);
  formData.append('rvc_reemplazo_reparacion', rvc_reemplazo_reparacion);
  formData.append('rvc_descripcion', rvc_descripcion);

          $.ajax({

            url: url+'/guarda_actualiza_componentes',
            headers:{'X-CSRF-TOKEN':token},
            type: "POST",
            dataType: 'json',
            data: formData,
            contentType:false,
            cache: false,
            processData: false,
            beforeSend:function(){
              if(rgi_id==0){
                mostrar_mensaje('warning','Debe guardar el ingreso');
                return false;
              }
              if(rvc_nombre.length<3){
                mostrar_mensaje('warning','Nombre es Obligatorio');
                return false;
              }

            },
            success: function(dt){
  //const ${dt['rcv_imagen']}
                  let func = "";
                  if(dt['rvc_funcionalidad']==0){ func='BUENO'; }
                  if(dt['rvc_funcionalidad']==1){ func='REGULAR'; }
                  if(dt['rvc_funcionalidad']==2){ func='MALO'; }
                  let sev_tec = "";
                  if(dt['rvc_reemplazo_reparacion']==0){ sev_tec='NINGUNO'; }
                  if(dt['rvc_reemplazo_reparacion']==1){ sev_tec='REPARACIÓN'; }
                  if(dt['rvc_reemplazo_reparacion']==2){ sev_tec='CAMBIO'; }

                    const row = `<tr>
                                  <td>-</td>
                                  <td><img class='img_comp' src="${ dt['rvc_imagen']!=null?dt['rvc_imagen']:'/sae_ingresos/public/img/no_image.png' }" ></td>
                                  <td>${dt['rvc_nombre']}</td>
                                  <td>${func}</td>
                                  <td>${sev_tec}</td>
                                  <td>${ dt['rvc_descripcion']!=null?dt['rvc_descripcion']:''}</td>
                                  <td>Registrado</td>
                                  <td>
                                  <i class='btn btn-danger btn-xs fa fa-close btn_elimina_revision' rvc_id=${dt['rvc_id']} ></i>
                                  </td>
                                 </tr>`;

                   $("#tbl_datos_review tbody").append(row);
                   limpiar_rev_componente();

            }
          });
})

$(document).on("click",".btn_edit_revision",function(){

})
$(document).on("click",".btn_elimina_revision",function(){

  Swal.fire({
    icon: 'warning',
    title: 'Desea eliminar item',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#9E9E9E',
    confirmButtonText: 'Eliminar'
  }).then((result) => {
    if (result.isConfirmed) {

              const obj_row=$(this);
              const rvc_id=$(this).attr('rvc_id')
              $.ajax({
                url: url+'/elimina_revision_componente',
                headers:{'X-CSRF-TOKEN':token},
                type: 'POST',
                dataType: 'json',
                data: {rvc_id:rvc_id},
                beforeSend:function(){
                },
                success:function(dt){
                  if(dt==0){
                    // mostrar_mensaje('success','Eliminado','Eliminado Correctamente');
                    $(obj_row).parent().parent().remove();
                  }else{
                    mostrar_mensaje('error','Error','Error al eliminar');
                  }
                }
              })

    }
  })

})

const cargar_revision_componente=()=>{

                    $.ajax({
                        url: url+'/cargar_revision_componentes',
                        headers:{'X-CSRF-TOKEN':token},
                        type: 'POST',
                        dataType: 'json',
                        data: {rgi_id:$('#rgi_id').val()},
                        beforeSend:function(){
                        },
                        success:function(dt){
                          cargar_revision_componentes_tabla(dt);
                        }
                    })
}

const cargar_revision_componentes_tabla=(dt)=>{
          let row="";
          let count=0;
          dt.map((dt)=>{
            count ++;
                  let func = "";
                  if(dt['rvc_funcionalidad']==0){ func='BUENO'; }
                  if(dt['rvc_funcionalidad']==1){ func='REGULAR'; }
                  if(dt['rvc_funcionalidad']==2){ func='MALO'; }
                  let sev_tec = "";
                  if(dt['rvc_reemplazo_reparacion']==0){ sev_tec='NINGUNO'; }
                  if(dt['rvc_reemplazo_reparacion']==1){ sev_tec='REPARACIÓN'; }
                  if(dt['rvc_reemplazo_reparacion']==2){ sev_tec='CAMBIO'; }


                row = `<tr>
                <td>${count}</td>
                <td><img class='img_comp' src="${ dt['rvc_imagen']!=null?dt['rvc_imagen']:'/sae_ingresos/public/img/no_image.png' }" ></td>
                <td>${dt['rvc_nombre']}</td>
                <td>${func}</td>
                <td>${sev_tec}</td>
                <td>${ dt['rvc_descripcion']!=null?dt['rvc_descripcion']:''}</td>
                <td>Registrado</td>
                <td  style='width:80px'  >
                      <i class='btn btn-danger btn-xs fa fa-close btn_elimina_revision' rvc_id=${dt['rvc_id']} ></i>
                </td>
                </tr>`;
                $("#tbl_datos_review tbody").append(row);
          })
}
const limpiar_rev_componente=()=>{
      $('#rvc_imagen').val(null);
      $('#rvc_nombre').val(null);
      $('#rvc_funcionalidad').val(0);
      $('#rvc_reemplazo_reparacion').val(0);
      $('#rvc_descripcion').val(null);
}

// ORDEN DE TRABAJO

$(document).on("click",".btn_genera_orden",function(){
    $("#mld_tecnicos").modal('show');
                    $.ajax({
                        url: url+'/cargar_tecnicos',
                        headers:{'X-CSRF-TOKEN':token},
                        type: 'POST',
                        dataType: 'json',
                        data: {op:0},
                        beforeSend:function(){
                        },
                        success:function(dt){
                          let rs='';
                          let x=0;
                          dt.map((u)=>{
                            x++;
                            rs+=`<tr>
                                    <td>${x}</td>
                                    <td>${u['usu_person']}</td>
                                    <td class='text-center'> <input name='rdo_tecnicos' class='rdo_tecnicos' type='radio' usu_id=${u['usu_id']} /> </td>
                                </tr>`;
                          })
                          $("#tbody_tecnicos").html(rs);
                        }
                    })
})

$(document).on("click",".btn_confirma_genera_orden",function(){

                    $.ajax({
                        url: url+'/genera_orden',
                        headers:{'X-CSRF-TOKEN':token},
                        type: 'POST',
                        dataType: 'json',
                        data: {tec_ord_usu_id:tecnico_seleccionado(),
                          ord_rgi_id:$("#rgi_id").val(),
                          ord_fecha_inicio:$("#ord_fecha_inicio").val(),
                          ord_hora_inicio:$("#ord_hora_inicio").val(),
                          ord_fecha_fin:$("#ord_fecha_fin").val(),
                          ord_hora_fin:$("#ord_hora_fin").val(),
                          ord_obs:$("#ord_obs").val(),
                          ord_id:$("#ord_id").val()
                           },
                        beforeSend:function(){
                        },
                        success:function(dt){
                          if(dt['ord_id']>0){
                            $("#mld_tecnicos").modal('hide');
                            $('#ord_id').val(dt['ord_id']);
                            $('.txt_orden').text(`Orden No :0000${dt['ord_id']}`);
                          }else{
                            alert('Algun error sucedió');
                          }
                        }
                    })
})

const tecnico_seleccionado=()=>{
  const tecnicos=$(".rdo_tecnicos");
  const tecId=0;
  $(tecnicos).each(function(){
    if( $(this).prop('checked') ){
     tectId=$(this).attr('usu_id');
    }
  })
  return tectId;
}
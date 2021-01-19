<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{

    protected $table='eqp_orden_trabajo';
    protected $primaryKey='ord_id';
    public $timestamps = false;
    protected $fillable=[
    'ord_usu_id',//Usuario que registra
    'tec_ord_usu_id',//Tecnico para la reparacion
    'ord_rgi_id',//Orden de registro
    'ord_fecha_reg',
    'ord_hora_reg',
    'ord_fecha_inicio',
    'ord_hora_inicio',
    'ord_fecha_fin',
    'ord_hora_fin',
    'ord_obs',
    'ord_tipo_orden',
    'ord_estado',
];



}

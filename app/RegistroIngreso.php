<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroIngreso extends Model
{
    protected $table='eqp_registro_ingresos';
    protected $primaryKey='rgi_id';
    public $timestamps = false;

    protected $fillable=[
   'rgi_usu_id'  ,
   'rgi_cli_id'  ,
   'rgi_eqp_id'  ,
   'rgi_fecha'   ,
   'rgi_hora'    ,
   'rgi_imagen'  ,
   'rgi_video'   ,
   'rgi_diagnostico_inicial',
   'rgi_obs'     ,
   'rgi_estado'
];

}

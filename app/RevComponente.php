<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevComponente extends Model
{

    protected $table='eqp_rev_componentes';
    protected $primaryKey='rvc_id';
    public $timestamps = false;

    protected $fillable=[
   'rev_rgi_id'  ,
   'rvc_imagen'  ,
   'rvc_nombre'  ,
   'rvc_funcionalidad'   ,
   'rvc_reemplazo_reparacion'    ,
   'rvc_descripcion'
   ];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{

    protected $table='eqp_equipos';
    protected $primaryKey='eqp_id';
    public $timestamps = false;
    protected $fillable=['eqp_tip_id','eqp_marca','eqp_modelo','eqp_serie','eqp_color','eqp_medida','eqp_adicional'];


}

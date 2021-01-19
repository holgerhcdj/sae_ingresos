<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class TipoEquipo extends Model
{
    protected $table='eqp_tipo';
    protected $primaryKey='tip_id';
    public $timestamps = false;
    protected $fillable=['tip_descripcion','tip_estado'];

}

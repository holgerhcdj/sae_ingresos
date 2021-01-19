<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table='erp_i_cliente';
    protected $primaryKey='cli_id';
    public $timestamps = false;
    protected $fillable=['cli_ced_ruc','cli_apellidos','cli_nombres','cli_telefono','cli_canton','cli_calle_prin','cli_email'];

}

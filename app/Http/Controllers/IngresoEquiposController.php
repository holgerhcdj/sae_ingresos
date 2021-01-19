<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Cliente;
use App\TipoEquipo;
use App\Equipo;
use App\RegistroIngreso;
use App\RevComponente;
use App\User;
use App\OrdenTrabajo;
use DB;
use Auth;

class IngresoEquiposController extends Controller
{


    public function index()
    {
        $registro=DB::select("SELECT * FROM eqp_registro_ingresos rg
                             JOIN eqp_equipos eq on rg.rgi_eqp_id=eq.eqp_id
                             JOIN erp_i_cliente cl on rg.rgi_cli_id=cl.cli_id
                             order by rg.rgi_fecha
        ");
        return view('ingreso_equipos.index')
        ->with('registro',$registro)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingreso_equipos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $registro=DB::select("SELECT * FROM eqp_registro_ingresos rg
                             JOIN eqp_equipos eq on rg.rgi_eqp_id=eq.eqp_id
                             JOIN erp_i_cliente cl on rg.rgi_cli_id=cl.cli_id
                             LEFT JOIN eqp_orden_trabajo ot on rg.rgi_id=ot.ord_rgi_id
                             LEFT JOIN erp_users us on us.usu_id=ot.tec_ord_usu_id
                             where rg.rgi_id=$id
        ");
        //dd($registro);
        return view('ingreso_equipos.edit')
        ->with('reg',$registro[0]);
        ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function busca_cliente(Request $rq)
    {
        $dt=$rq->all();
        $ruc=$dt['ruc'];
        $rst=DB::select("SELECT * from erp_i_cliente where cli_ced_ruc ilike '%$ruc%' or cli_apellidos  ilike '%$ruc%'");
        //$rst= Cliente::find(['cli_ced_ruc','ilike','%$ruc%'])->get();
        return Response()->json($rst);
    }

    public function busca_un_cliente(Request $rq ){
         $dt=$rq->all();
         $cli_id=$dt['cliid'];
         $rst= Cliente::find($cli_id);
         return Response()->json($rst);

    }
    public function guarda_actualiza_cliente(Request $rq ){
          $dt=$rq->all();
          //dd($dt);
          $cliente=Cliente::find($dt['cli_id']);
          if($dt['cli_id']==0){
            $cliente=Cliente::create($dt);
          }else{
            $cliente->update($dt);
          }
          return $cliente->cli_id;
    }


//*********************EQUIPOS*******************///
    public function busca_equipos(Request $rq ){
        $dt=$rq->all();
        $tx=$dt['eqp_serie'];
        $rst=DB::select("SELECT * FROM eqp_equipos eq
                        JOIN eqp_tipo tp on tp.tip_id=eq.eqp_tip_id
                        where eq.eqp_marca ilike '%$tx%'
                        or eq.eqp_serie  ilike '%$tx%'
                        or tp.tip_descripcion  ilike '%$tx%'         ");

        return $rst;
    }

    public function guarda_actualiza_tipo(Request $rq){

        $dt=$rq->all();
        $tipo_equipo = TipoEquipo::where('tip_descripcion',strtoupper($dt['tip_descripcion']) )->first();
        //select levenshtein('CONTROLADOR','CONTROLADORAS') NUMERO DE DIFERENCIA DE LETRAS
        if(empty($tipo_equipo)){
            $tipo_equipo=TipoEquipo::create([
               'tip_descripcion'=>strtoupper($dt['tip_descripcion']),
               'tip_estado'=>0
            ]);
        }else{
            return 0;
        }
        $tipo_equipos=$this->cargar_combo_tipos();
        return Response()->json($tipo_equipos);
    }

    public function cargar_combo_tipos(){
        return $tipo_equipos=TipoEquipo::all();
        //dd($tipo_equipos);
        //return Response()->json($tipo_equipos);
    }

    public function busca_un_equipo(Request $rq){
        $dt=$rq->all();
        $eqp_id=$dt['eqp_id'];
        $equipo=Equipo::find($eqp_id);
        return $equipo;

    }
    public function guarda_actualiza_equipos(Request $rq){

         $dt=$rq->all();
            $equipo=Equipo::find($dt['eqp_id']);
            if($dt['eqp_id']==0){
                $equipo=Equipo::create($dt);
            }else{
                $equipo->update($dt);
            }

            $rging=RegistroIngreso::find($dt['rgi_id']);
            $dt['rgi_usu_id']=Auth::user()->usu_id;
            $dt['rgi_cli_id']=$dt['cli_id'];
            $dt['rgi_eqp_id']=$equipo->eqp_id;

            if($dt['rgi_id']==0){
                $rging=RegistroIngreso::create($dt);
            }else{
                $rging->update($dt);
            }
            return [$equipo->eqp_id,$rging->rgi_id];
 }

 public function guarda_actualiza_componentes(Request $rq){
    $dt=$rq->all();
    $dt['rvc_imagen']=null;
    //$img=$dt['rvc_imagen'];
    return $componentes=RevComponente::create($dt);
// array:6 [
//   "rgi_id" => "10"
//   "rvc_imagen" => "[object HTMLInputElement]"
//   "rvc_nombre" => "SADASD"
//   "rvc_funcionalidad" => "0"
//   "rvc_reemplazo_reparacion" => "0"
//   "rvc_descripcion" => "SADASDA"
// ]
 }

 public function elimina_revision_componente(Request $rq){
    $dt=$rq->all();
    $rvc_id=$dt['rvc_id'];
    RevComponente::destroy($rvc_id);
    return 0;
 }

 public function cargar_revision_componentes(Request $rq){
    $dt=$rq->all();
    $rgi_id=$dt['rgi_id'];
    $componentes=DB::select("SELECT * FROM eqp_rev_componentes rv JOIN eqp_registro_ingresos ie on ie.rgi_id=rv.rev_rgi_id
                             WHERE rv.rev_rgi_id=$rgi_id ");
    return $componentes;
 }

 public function cargar_tecnicos(){
    return $users=User::all();
 }

 public function genera_orden(Request $rq){
    $dat=$rq->all();
    $ord_rgi_id=$dat['ord_rgi_id'];
    $regingreso=RegistroIngreso::find($ord_rgi_id);

    $dat['ord_usu_id']=Auth::user()->usu_id;
    $dat['ord_fecha_reg']=date('Y-m-d');
    $dat['ord_hora_reg']=date('H:s');
    $dat['ord_tipo_orden']=0;
    $dat['ord_estado']=0;
    $orden=OrdenTrabajo::create($dat);
    return Response()->json($orden);


 }


}

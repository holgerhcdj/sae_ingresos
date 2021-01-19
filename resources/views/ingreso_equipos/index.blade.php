@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Ingreso de Equipos</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{route('ingreso_equipos.create')}}">Nuevo Ingreso</a>
        </h1>
    </section>

    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Cliente</th>
                        <th>Equipo</th>
                        <th>Serie</th>
                        <th>Diagnostico</th>
                        <th>Estado</th>
                        <th>...</th>
                    </tr>
                    <?php $x=1;?>
                    @foreach ($registro as $rg)
                    <tr>
                        <td>{{$x++}}</td>
                        <td>{{$rg->cli_apellidos.' '.$rg->cli_nombres}}</td>
                        <td>{{$rg->eqp_marca.' '.$rg->eqp_modelo}}</td>
                        <td>{{$rg->eqp_serie}}</td>
                        <td>{{$rg->rgi_diagnostico_inicial}}</td>
                        <td>
                            @if($rg->rgi_estado==0)
                            {{'Registrado'}}
                            @else
                            {{'Finalizado'}}
                            @endif
                        </td>
                        <td>
                            <a href="{{route('ingreso_equipos.edit',$rg->rgi_id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>

@endsection
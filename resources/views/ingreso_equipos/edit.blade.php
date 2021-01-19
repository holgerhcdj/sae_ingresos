@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Modificar Ingreso</h1>
    </section>
    <div class="content" style="margin-top:15px; ">
        <div class="box box-primary">
            <div class="box-body">
              @include('ingreso_equipos.fields')
          </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel administrador</div>
                <div class="card-body">                    
                    <a href="{{route('usuarios_index')}}" class="btn btn-primary"> Lista de usuarios </a>
                    <a href="{{route('servicios_index')}}" class="btn btn-primary"> Lista de Servicios </a>             
                    <a href="{{route('evento_admin')}}" class="btn btn-primary"> Lista de Eventos </a>             
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection

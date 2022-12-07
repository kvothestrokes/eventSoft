@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif        
        <div class="col-md-10">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora Inicio</th>
                    <th scope="col">Hora Fin</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                    <th scope="col">Revisar</th>                       
                    </tr>
                </thead>
                <tbody>
                   @foreach($eventos as $e)
                    <tr>
                        <th scope="row">{{$loop->index + 1}}</th>
                        <td>
                            <a href="{{route('detalle_evento', ['id' => $e->id])}}"> {{$e->nombre}} </a>
                        </td>
                        <td>{{$e->fecha_evento_inicio}}</td>
                        <td>{{$e->hora_evento_inicio}}</td>
                        <td>{{$e->hora_evento_fin}}</td>
                        <td>{{$e->estado}}</td>                        
                        <td>
                            <a href="{{route('evento_edit', ['id' => $e->id])}}" class="btn btn-primary">Actualizar</a> 
                            @if($e->estado != 'aceptado')
                                <a href="{{route('evento_destroy', ['id' => $e->id])}}" class="btn btn-danger">Eliminar</a> 
                            @endif
                        </td>
                        <td>
                            @if($e->estado == 'pendiente')
                                <a href="{{route('evento_cambiar_estado', ['id' => $e->id, 'estado' => 'aceptado'])}}" class="btn btn-success">Aceptar</a>                                 
                                <a href="{{route('evento_cambiar_estado', ['id' => $e->id, 'estado' => 'rechazado'])}}" class="btn btn-danger">Rechazar</a>                                                                 
                            @endif
                        </td>                                                   
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>
</div>
@endsection

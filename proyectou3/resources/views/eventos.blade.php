@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif        
        <div class="col-md-8">
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
                    </tr>
                </thead>
                <tbody>
                   @foreach($eventos as $e)
                    <tr>
                        <th scope="row">{{$loop->index + 1}}</th>
                        <td>{{$e->nombre}}</td>
                        <td>{{$e->fecha_evento_inicio}}</td>
                        <td>{{$e->hora_evento_inicio}}</td>
                        <td>{{$e->hora_evento_fin}}</td>
                        <td>{{$e->estado}}</td>
                        <td>
                            @if($e->estado == 'pendiente')
                                <a href="{{route('evento_edit', ['id' => $e->id])}}" class="btn btn-primary">Actualizar</a> 
                                <a href="{{route('evento_destroy', ['id' => $e->id])}}" class="btn btn-danger">Eliminar</a>                                 
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

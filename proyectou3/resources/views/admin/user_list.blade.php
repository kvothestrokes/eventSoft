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
            <a href="{{route('usuarios_create')}}" class="btn btn-primary">Crear Usuario</a> 
        </div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($users as $u)
                    <tr>
                        <th scope="row">{{$loop->index + 1}}</th>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->rol}}</td>
                        <td>
                            <a href="{{route('usuarios_edit', ['id' => $u->id])}}" class="btn btn-primary">Actualizar</a> 
                            <a href="{{route('usuarios_destroy', ['id' => $u->id])}}" class="btn btn-danger">Eliminar</a> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>
</div>
@endsection

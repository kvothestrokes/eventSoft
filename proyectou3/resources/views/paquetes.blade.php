@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @foreach($paquetes as $p)    
                <div class="card">
                    <div class="card-header">{{$p->nombre}}</div>                           
                    <div class="card-body">
                    <b>Descripcion: </b>{{$p->descripcion}} <br>
                    <b>Precio: </b>{{$p->precio}} <br>                                        
                    <img src="data:image/png;base64,{{$p->imagen}}" alt="" width="200">
                    <div class="">Servicios</div>                           
                        <div class="">
                            @foreach($p->services as $s)
                                Nombre: {{$s->servicio->nombre}} <br>
                                Precio: {{$s->servicio->precio}}
                            @endforeach
                        </div>                        
                        @if($rol == "cliente")
                            <a href="{{route('reservarPaquete', $p->id)}}" class="btn btn-primary">Reservar</a>
                        @elseif($rol == "")
                            <a href="#"  onclick="loginFirst()" class="btn btn-primary">Reservar</a>
                        @elseif($rol == "admin")
                            <a href="{{route('eliminarPaquete', $p->id)}}" class="btn btn-danger">Eliminar</a>
                        @endif

                    </div>
                </div>                         
            @endforeach
        </div>
    </div>
</div>
@endsection

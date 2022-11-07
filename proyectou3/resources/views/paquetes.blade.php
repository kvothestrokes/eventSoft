@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($paquetes as $p)    
        <div class="col-md-4">
                <div class="card cards">
                    <div class="card-header">{{$p->nombre}}</div>                           
                    <div class="card-body">
                    <b>Descripcion: </b>{{$p->descripcion}} <br>
                    <b>Precio: </b>{{$p->precio}} <br>                                        
                    <img src="data:image/png;base64,{{$p->imagen}}" alt="" width="200">
                    <p style="text-align: center;margin-top: 10px;border:1px solid black;background:#4384d3;"><b>Servicios</b></p>
                    <div class="">
                        @foreach($p->services as $s)
                            {{$s->servicio->nombre}} - ${{$s->servicio->precio}}
                        @endforeach
                        @if(count($p->services) == 0)
                            No hay servicios
                        @endif
                    </div>                        
                    @if($rol == "cliente")
                        <a href="{{route('reservarPaquete', $p->id)}}" class="btn btn-primary">Reservar</a>
                    @elseif($rol == "")
                        <a href="#"  onclick="loginFirst()" class="btn btn-primary">Reservar</a>
                    @elseif($rol == "admin")
                        <a href="{{route('paquetes_edit', ['id' => $p->id])}}" class="btn btn-primary">Actualizar</a> 
                        <a href="{{route('paquetes_destroy', ['id' => $p->id])}}" class="btn btn-danger">Eliminar</a> 
                    @endif

                    </div>
                </div>                         
            </div>
            @endforeach
    </div>
</div>
@endsection

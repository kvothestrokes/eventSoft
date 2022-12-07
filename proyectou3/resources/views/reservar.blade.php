@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reservar Paquete</div>

                <div class="card-body">
                    <!-- mostrar paquete -->
                    <p>Paquete: {{ $paquete->nombre }}</p>
                    <p>Descripcion: {{ $paquete->descripcion }}</p>
                    <p>Precio: {{ $paquete->precio }}</p>
                    <img src="data:image/png;base64,{{$paquete->imagen}}" alt="" width="200">
                    <div class="">
                        @foreach($paquete->services as $s)
                            {{$s->servicio->nombre}} - ${{$s->servicio->precio}}
                            <br>
                        @endforeach
                        @if(count($paquete->services) == 0)
                            No hay servicios
                        @endif
                    </div>     
                    <form method="POST" action="{{ route('evento_store') }}">
                        @csrf   
                        <input type="hidden" name="id_paquete" value="{{ $paquete->id }}">
                        <div class="row mb-3">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre del evento: </label>
                            <div class="col-md-6">
                                <input id="nombre" type="text"  class="form-control @error('nombre') is-invalid @enderror" name="nombre" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end">Cantidad de invitados: </label>
                            <div class="col-md-6">
                                <input id="invitados" type="number"  class="form-control @error('invitados') is-invalid @enderror" name="invitados" required autofocus>                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="proposito" class="col-md-4 col-form-label text-md-end">Proposito del evento: </label>
                            <div class="col-md-6">
                                <input id="proposito" type="text"  class="form-control @error('proposito') is-invalid @enderror" name="proposito" required autocomplete="proposito" autofocus>                               
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="fecha" class="col-md-4 col-form-label text-md-end">Fecha de evento: </label>
                            <div class="col-md-6">
                                <input id="fecha" type="date"  class="form-control @error('fecha') is-invalid @enderror" name="fecha" required autocomplete="fecha" autofocus>

                                @error('fecha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="hora_inicio" class="col-md-4 col-form-label text-md-end">Hora de inicio del evento: </label>
                            <div class="col-md-6">
                                <input id="hora_inicio" type="time"  class="form-control @error('hora_inicio') is-invalid @enderror" name="hora_inicio" required autocomplete="hora_inicio" autofocus>

                                @error('hora_inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        
                        <div class="row mb-3">
                            <label for="hora_fin" class="col-md-4 col-form-label text-md-end">Hora de evento: </label>
                            <div class="col-md-6">
                                <input id="hora_fin" type="time"  class="form-control @error('hora_fin') is-invalid @enderror" name="hora_fin" required autocomplete="hora_fin" autofocus>

                                @error('hora_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                                          

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

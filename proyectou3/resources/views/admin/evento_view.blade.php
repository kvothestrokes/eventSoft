@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ver Evento</div>

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
                                        
                    <div class="row mb-3">
                        <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre del evento: </label>
                        <div class="col-md-6">
                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" required autocomplete="nombre" value="{{$evento->nombre}}" autofocus disabled>

                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="fecha" class="col-md-4 col-form-label text-md-end">Fecha de evento: </label>
                        <div class="col-md-6">
                            <input id="fecha" type="date"  class="form-control @error('fecha') is-invalid @enderror" name="fecha" required autocomplete="fecha" value="{{$evento->fecha_evento_inicio}}" disabled>

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
                            <input id="hora_inicio" type="time"  class="form-control @error('hora_inicio') is-invalid @enderror" name="hora_inicio" required autocomplete="hora_inicio" value="{{$evento->hora_evento_inicio}}" disabled>

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
                            <input id="hora_fin" type="time"  class="form-control @error('hora_fin') is-invalid @enderror" name="hora_fin" required autocomplete="hora_fin" value="{{$evento->hora_evento_fin}}" disabled>

                            @error('hora_fin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                                
                    <!-- abonos -->
                    <div class="row mb-3">
                        <label for="abonos" class="col-md-4 col-form-label text-md-end">Abonos: </label>
                        <div class="col-md-6">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($abonos as $a)
                                        <tr>                                                
                                            <td style="color:green; font-weight:bold" >+ {{$a->monto}}</td>                                            
                                            <td> {{$a->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    <!-- total -->
                                    <tr>
                                        <td style="color:blue; font-weight:bold" >Total abono: {{$total_abonos}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="color:crimson; font-weight:bold" >Restante: {{$total}}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <form method="POST" action="{{ route('abonar') }}">
                                @csrf
                                <input type="hidden" name="id_evento" value="{{$evento->id}}">
                                <div class="row mb-3">
                                    <label for="monto" class="col-md-4 col-form-label text-md-end">Monto: </label>
                                    <div class="col-md-6">
                                        <input id="monto" type="number"  class="form-control @error('monto') is-invalid @enderror" name="monto" required autocomplete="monto" value="{{ old('monto') }}" autofocus>

                                        @error('monto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- sumbit -->
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">
                                            Abonar
                                        </button>
                                </div>    
                            </form>
                        </div> 
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

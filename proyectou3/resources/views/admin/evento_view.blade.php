@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="evento-tab" data-bs-toggle="tab" data-bs-target="#evento" type="button" role="tab" aria-controls="evento" aria-selected="true">Evento</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="fotos-tab" data-bs-toggle="tab" data-bs-target="#fotos" type="button" role="tab" aria-controls="fotos" aria-selected="false">Fotos</button>
                </li>
                <!-- si el usuario es admin     -->
                @if(Auth::user()->rol == 'admin')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="gastos-tab" data-bs-toggle="tab" data-bs-target="#gastos" type="button" role="tab" aria-controls="gastos" aria-selected="false">Gastos</button>
                    </li>
                @endif
            </ul>            
            
            <div class="tab-content" id="TabContent">

                <div class="tab-pane fade" id="gastos" role="tabpanel" aria-labelledby="gastos-tab">
                    <!-- tabla de gastos con concepo, monto y fecha-->                    
                    <div class="card-body">
                        <div class="row">                           
                            <div class="col-md-6">
                                <!-- form agregar gasto -->
                                <form action="{{route('gasto_create')}}" method="POST">
                                    @csrf   
                                    <div class="row">
                                        <div class="col-md-4">                                                                                                                                  
                                            <label for="nombre">Concepto</label>
                                            <input type="text" class="form-control" id="concepto" name="concepto" >                                                                                                
                                        </div>
                                        <div class="col-md-4">
                                            <label for="nombre">Monto (MXN)</label>
                                            <input type="text" class="form-control" id="monto" name="monto" >
                                        </div>
                                        <input type="hidden" name="id_evento" value="{{$evento->id}}">
                                        <button type="submit" style="margin-left:100px;margin-top:10px" class="btn btn-primary col-md-3">Guardar</button>     
                                    </div>                                                                                          
                                </form>
                                
                            </div>
                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gastos as $gasto)
                                    <tr>
                                        <td>{{$gasto->concepto}}</td>
                                        <td>$ {{$gasto->monto}} MXN</td>
                                        <td>{{$gasto->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                                
                </div>

                <div class="tab-pane fade show active" id="evento">                                
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
                        
                        @if($evento->estado == "aceptado")
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
                                            @if(Auth::user()->rol != 'cliente')
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
                                            @endif
                                        </div>    
                                    </form>
                                </div> 
                            </div>                   
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="fotos" role="tabpanel" aria-labelledby="fotos-tab">
                <div class="row">
                        <div class="col-md-8">
                            <!-- crear foto form-->
                            <form action="{{route('fotos_create')}}" method="POST" enctype="multipart/form-data">
                                @csrf                                
                                <div class="row">         
                                    <input type="hidden" name="id_evento" value="{{$evento->id}}">           
                                    <div class="col-md-4">                  
                                        <label for="nombre">Descripcion</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" >
                                    </div>
                                        <div class="col-md-7">
                                            <label for="imagen">Imagen</label>
                                            <input id="imagen" type="file" class="form-control" name="imagen">                               
                                         </div>
                                    <div class="col-md-12 m-2">                                        
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    <div>                                        
                                </div>                                  
                            </form>
                        <div>

                        <hr>

                        <!-- galeria de fotos bootstrap -->                        
                        <div class="col-md-12">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach($fotos as $f)
                                        <div class="carousel-item {{$loop->index == 0 ? 'active' : ''}}">
                                            <img src="data:image/png;base64,{{$f->imagen}}" class="d-block w-100"  alt="...">
                                            <form action="{{route('fotos_update', ['id'=>$f->id])}}" method="POST">
                                                @csrf                                                                                                                                     
                                                <label for="nombre">Descripcion</label>
                                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="{{$f->descripcion}}" >                                                                                                
                                                <button type="submit" style="margin-left:250px;margin-top:10px" class="btn btn-primary">Guardar</button>                                                                                               
                                             </form>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">                                    
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previa</span>
                                </button>
                            </div>
                        </div>
                    <div>  
                </div>            


            </div>
        </div>
    </div>
</div>
@endsection

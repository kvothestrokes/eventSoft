@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Servicio</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('servicios_update', ['id'=> $servicio->id]) }}">
                        @csrf                        
                        <div class="row mb-3">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre: </label>
                            <div class="col-md-6">
                                <input id="nombre" type="text"  class="form-control @error('nombre') is-invalid @enderror" value="{{$servicio->nombre}}" name="nombre" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="descripcion" class="col-md-4 col-form-label text-md-end">Descripcion</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" value="{{$servicio->descripcion}}" name="descripcion" required>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                        

                        <div class="row mb-3">
                            <label for="precio" class="col-md-4 col-form-label text-md-end">Precio</label>

                            <div class="col-md-6">
                                <input id="precio" type="number" class="form-control @error('precio') is-invalid @enderror" value="{{$servicio->precio}}" name="precio" >

                                @error('precio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>                       

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar
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

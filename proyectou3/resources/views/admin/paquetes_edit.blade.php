@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Actualizar Paquete</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('paquetes_update', ['id'=> $paquete->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <input id="id" type="hidden" name="id" value="{{$paquete->id}}" >
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre del paquete: </label>

                            <div class="col-md-6">
                                <input id="name" type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{$paquete->nombre}}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="desc" class="col-md-4 col-form-label text-md-end">Descripcion</label>

                            <div class="col-md-6">
                                <input id="desc" type="text" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{$paquete->descripcion}}" required>

                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="precio" class="col-md-4 col-form-label text-md-end">Precio</label>

                            <div class="col-md-6">
                                <input id="precio" type="number" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{$paquete->precio}}" required>

                                @error('precio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="imagen" class="col-md-4 col-form-label text-md-end">Imagen</label>

                            <div class="col-md-6">
                                <input id="imagen" type="file" class="form-control" name="imagen"  required>                               
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">                                    
                                    <label class="form-check-label" for="status">
                                        Activo
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="status" id="status">
                                </div>
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

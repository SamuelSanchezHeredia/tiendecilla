@extends('app.base')

@section('contenido')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="container-fluid">
                            <div class="table-responsive small">
                                <form action="{{ url('producto/' . $producto->id) }}" method="post" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    
                                    <div class="mb-3">

                                        <label for="nombre" class="form-label">Producto Nombre</label>
                                
                                        <input type="text" class="form-control" id="nombre" name="nombre" maxlength="60" required value="{{ old('nombre', $producto->nombre) }}">
                                
                                    </div>
                                    
                                    <div class="mb-3">

                                        <label for="descripcion" class="form-label">Producto Descripción</label>
                                
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="180" required value="{{ old('descripcion', $producto->descripcion) }}">
                                
                                    </div>
                                    
                                    <div class="mb-3">

                                        <label for="categoria" class="form-label">Producto Categoria</label>
                                
                                        <input type="text" class="form-control" id="categoria" name="categoria" maxlength="40" value="{{ old('categoria', $producto->categoria) }}">
                                
                                    </div>
                                    
                                    <div class="mb-3">

                                        <label for="precio" class="form-label">Producto Precio</label>
                                
                                        <input type="number" class="form-control" id="precio" name="precio" step="0.1" min="0" max="99999" required value="{{ old('precio', $producto->precio) }}">
                                
                                    </div>
                                    
                                   <div class="mb-3">
                                        <label for="cover" class="form-label">Producto imagen</label>
                                        <input type="file" class="form-control" id="cover" name="cover">
                                    </div>

                                    
                                    <button type="submit" class="btn btn-dark"><i class="zmdi zmdi-edit"></i>Editar producto</button>
                                    <a href="{{ url('producto') }}" class="btn btn-light"><i class="zmdi zmdi-long-arrow-return"></i>Atras</a>
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
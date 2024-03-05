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
                                <table class="table table-striped table-sm">
                                    <tbody>
                                        <tr>
                                            <td>Nombre</td>
                                            <td>{{ $producto->nombre }}</td>
                                        </tr>
                                        <tr>
                                            <td>Descripción</td>
                                            <td>{{ $producto->descripcion }}</td>
                                        </tr>
                                        <tr>
                                            <td>Categoria</td>
                                            <td>{{ $producto->categoria }}</td>
                                        </tr>
                                        <tr>
                                            <td>Precio</td>
                                            <td>{{ $producto->precio }} €</td>
                                        </tr>
                                        <tr>
                                            <td>Imagen</td>
                                            <td>
                                                @if($producto->cover !=null)
                                                <img class="img-backed" src="data:image/jpeg;base64, {{ $producto->cover }}">
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="btn-dark btn" href="{{ url('producto/' . $producto->id . '/edit') }}"><i class="zmdi zmdi-edit"></i>Editar</a>
                                <a href="{{ url('producto') }}" class="btn btn-light"><i class="zmdi zmdi-long-arrow-return"></i>Atras</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
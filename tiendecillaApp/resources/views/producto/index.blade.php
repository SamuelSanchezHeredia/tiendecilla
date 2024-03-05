@extends('app.base')

@section('contenido')
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            
            <!-- DataTales Example -->
            <div class="boton">
                 <a class="btn-dark btn" href="{{ url('producto/create') }}"><i class="zmdi zmdi-plus-circle-o"></i>Nuevo producto</a>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row"></div>
                            <div class="row" style="width: 100% !important;">
                                <div class="col-sm-12"  style="width: 100% !important;">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%"
                                        cellspacing="0" role="grid" aria-describedby="dataTable_info"
                                        style="width: 100% !important;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable"
                                                    rowspan="1" colspan="1" style="width: 57px;" aria-sort="ascending"
                                                    aria-label="nombre: activate to sort column descending">Nombre</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" style="width: 61px;"
                                                    aria-label="Descripción: activate to sort column ascending">Descripción
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" style="width: 49px;"
                                                    aria-label="Categoria: activate to sort column ascending">Categoria</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" style="width: 31px;"
                                                    aria-label="Precio: activate to sort column ascending">Precio</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1"
                                                    colspan="1" style="width: 68px;"
                                                    aria-label="Imagen: activate to sort column ascending">Imagen</th>
                                                <th style="width: 68px;">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                    @foreach($productos as $producto)
                                                        <tr>
                                                            <td>{{ $producto->nombre }}</td>
                                                            <td>{{ $producto->descripcion }}</td>
                                                            <td>{{ $producto->categoria }}</td>
                                                            <td>{{ $producto->precio }} €</td>
                                                            <td>
                                                                @if($producto->cover !=null)
                                                                  <img class="img-backed" src="data:image/jpeg;base64, {{ $producto->cover }}">
                                                                @endif
                                                            </td>
                                                             <td>
                                                                <a class="btn-dark btn" href="{{ url('producto/' . $producto->id) }}"><i class="zmdi zmdi-eye"></i>Ver Producto</a>
                                                                <a class="btn-dark btn" href="{{ url('producto/' . $producto->id . '/edit') }}"><i class="zmdi zmdi-edit"></i>Editar Producto</a>
                                                                <form data-name="{{ $producto->nombre }}" class="formDelete" action="{{ url('producto/' . $producto->id) }}" method="post" style="display: inline-block">
                                                                  @csrf
                                                                  @method('delete')
                                                                  <button type="submit" class="btn btn-danger"><i class="zmdi zmdi-delete"></i>Borrar Producto</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
  const forms = document.querySelectorAll(".formDelete");
  forms.forEach(function(form) {
      form.onsubmit = (event) => {
        return confirm('Seguro que quieres borrar ' + event.target.dataset.name + '?');
      };
  });
</script>
@endsection
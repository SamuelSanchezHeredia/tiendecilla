@extends('app.base')

@section('contenido')
    		<div class="row isotope-grid" id="contenidoAjax">
                

			</div>

@endsection

@section('paginacion')
            <div class="pagination justify-content-center mt-100">
                <nav>
                    <ul class="pagination m-0 d-flex align-items-center" id="paginacionAjax">
                        
                    </ul>
                </nav>
            </div>
@endsection


@section('script')
  <script src="{{ url('tiendaassets/paginate.js?rnd=' . rand(0, 1000000) ) }}"></script>
@endsection
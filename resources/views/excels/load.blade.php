@extends('layouts.app')

@section('content')

<div class="container-fluid">
    @if (session('Exito'))
        <div class="alert alert-success" style="width: 100%; text-align:center">
            {{ session('Exito') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" style="width: 100%; text-align: center;">
            <ol>
                @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif
    <div class="row mb-2">        
      <div class="col-sm-12">          
          
          <div class="col-md-12">
              <!-- general form elements disabled -->
              <div class="card card-info">                        
                <div class="card-header">
                  <h3 class="card-title">Cargar Excel de facturas</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">                                        
                    <form action="{{route('UpdaloadExcel')}}" method="POST" enctype="multipart/form-data">
                        @csrf                        
                        <div class="row">
                            <div class="col-sm-4 offset-md-1">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Excel</label>
                                    <input name="excel" id="excel" class="form-control"  type="file" />
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Tipo de documento</label>
                                    <select name="documento" id="documento" class="form-control" >
                                        <option value="33">Factura Electrónica</option>                                        
                                        <option value="39">Boleta Electrónica</option>                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">                    
                            <div class="col-4-6 offset-md-4">
                                <br><br>
                                <!-- text input -->
                                <button id="enviar" type="submit" class="btn btn-primary">
                                    {{ __('Cargar Documentos') }}
                                </button>
                            </div> 
                        </div>
                    </form>        
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->                   
          </div>                
      </div>
    </div>
</div><!-- /.container-fluid -->
@endsection
@section('scripts')
<script>
    $('#ayuda').on('click', function(){
        alertify.alert('Información','Selecciones el área que podrá ver este video tutorial');
    });
  
</script>
@endsection
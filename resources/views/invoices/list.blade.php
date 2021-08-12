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
                    <table id="documentosEnviados" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10% !important">Factura</th>
                                <th style="text-align:center">Titular</th>
                                <th style="text-align:center">Total</th>
                                <th style="text-align:center">estado</th>
                                <th style="text-align:center">Pdf</th>
                                <th style="text-align:center">Xml</th>
                            </tr>
                        </thead>            
                        @foreach($invoices as $invoice)
                            <tr id="{{ $invoice->id }}" class="rem1">
                                <td style="width: 10% !important" id="id{{$invoice->id}}">{{ 
                                    $invoice->folio }}</td>                                
                                <td id="de{{$invoice->id}}" >{{ $Invoice->GetClientName($invoice->id) }}</td>
                                <td id="pr{{$invoice->id}}" >{{ $Invoice->GetTotal($invoice->id) }}</td>                                
                                <td id="to{{$invoice->id}}" @if($invoice->estado=='1') style="color:green" @elseif($invoice->estado=='2') style="color:red" @else style="color:yellow" @endif >@if($invoice->estado=='1') 'Exito' @elseif($invoice->estado=='2') 'Fallido' @endif</td>
                                <td style="width: 15% !important; text-align:center">
                                    <a href="{{ url('PDF/'.base64_encode($invoice->id)) }}" target="_blank"  title="Descargar PDF">
                                        <img class="little-icon" src="{{asset('img/pdf.png')}}" alt="">
                                    </a>
                                </td>
                                <td style="width: 15% !important; text-align:center">
                                    <a href="{{ url('XML/'.base64_encode($invoice->id)) }}" target="_blank" title="Descargar XML">
                                        <img class="little-icon"  src="{{asset('img/xml.png')}}" alt="">
                                    </a>
                                </td>                                
                            </tr>                
                        @endforeach                      
                    </table>              
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
    $( document ).ready(function() {
        $('#documentosEnviados').DataTable({ 
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "Nada encontrado - lo siento",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                "search": "Buscar",
                "previous": "Anterior",
                "next": "Siguiente"
            }
        })
    });
  
</script>
@endsection
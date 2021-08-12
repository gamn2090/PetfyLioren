@extends('layouts.app')

@section('css')
<style> 
    .button-acciones{
        cursor: pointer;        
    }
</style>
@endsection
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
                                <th style="text-align:center">Referencia</th>
                                <th style="text-align:center">Detalle</th>
                            </tr>
                        </thead>            
                        @foreach($invoices as $invoice)
                            <tr id="{{ $invoice->id }}" class="rem1">
                                <td style="width: 10% !important" id="id{{$invoice->id}}">{{ 
                                    $invoice->folio }}</td>                                
                                <td id="de{{$invoice->id}}" >{{ $Invoice->GetClientName($invoice->id) }}</td>
                                <td id="pr{{$invoice->id}}" >{{ $Invoice->GetTotal($invoice->id) }}</td> 
                                <td style="width: 15% !important; text-align:center">
                                    <div class="btn btn-info referencias"><i class="fa fa-eye button-acciones referencias" title="Características"> </i></div>
                                    
                                </td>
                                <td style="width: 15% !important; text-align:center">
                                    <div class="btn btn-info detalles"><i class="fa fa-eye button-acciones " title="Características"> </i></div>
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
@include('invoices.partials.refs')
@include('invoices.partials.dets')
@endsection
@section('scripts')
<script>
    $( document ).ready(function() {
        $('#documentosEnviados').DataTable({
            'lengthMenu': [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
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

    $('.referencias').on('click', function(){        
        var id = $(this).parents('tr').attr('id')
        
        var data = {id,data}
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var request = $.ajax({
            url:  'findRefs',
            type: "POST",
            data: data,
            dataType:"json"
        });

        request.done(function( data ) {
            $("#Refs").find("tr:gt(0)").remove();
            $.each(data, function( index, datas ) {               
                $('#Refs').append( '<tr><td>'+datas.tipoDocumentoRef+'</td><td>'+datas.folioReferencia+'</td></tr>');
            });
            $('#Referencias').modal('show');
        });
    });

    $('.detalles').on('click', function(){        
        var id = $(this).parents('tr').attr('id')
        
        var data = {id,data}
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var request = $.ajax({
            url:  'findDets',
            type: "POST",
            data: data,
            dataType:"json"
        });

        request.done(function( data ) {
            $("#Dets").find("tr:gt(0)").remove();
            $.each(data, function( index, datas ) {               
                $('#Dets').append( '<tr><td>'+datas.codigoItem+'</td><td>'+datas.folio+'</td><td>'+datas.nombreItem+'</td><td>'+datas.cantidad+'</td></tr>');
            });
            $('#Detalles').modal('show');
        });
    });
  
</script>
@endsection
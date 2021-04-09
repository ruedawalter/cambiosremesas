<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Bancos - Cambios y Remesas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Cambios y Remesas') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('fonts/awesome/font-awesome.min.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.5/js/responsive.bootstrap.min.js"></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <script>
        error=false

        function validate()
        {
            if(document.bancoForm.nom_banco.value !='' )
            document.bancoForm.btnsave.disabled=false
            else
            document.bancoForm.btnsave.disabled=true


        }
    </script>
</head>
<body>
<div class="container">
    <h1>Cambios y Remesas<br/>Bancos</h1>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success mb-2" id="new-banco" data-toggle="modal">Nuevo</a>
            </div>
        </div>
    </div>
     <div class="alert Alert-success">
        <span><label type="hidden" name="alert" id="alert"></label></span>
      </div>

    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th width="80px">No</th>
                <th>Banco</th>
                <th width="120px">Acción</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!--Modal de agregar y editar banco -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
        <div class="modal-body">
            <form name="bancoForm" id="bancoForm"> {{--action="{{ route('bancos.store') }}" method="POST"> --}}
                     {{-- @csrf --}}
            <input type="hidden" name="id" id="id" >
            {{-- @csrf --}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banco:</strong>
                        <input type="text" name="nombanco" id="nom_banco" class="form-control" placeholder="Ingrese el Nombre del banco" onchange="validate()" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                    </div>
                </div>
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" onchange="validate()">
                </div>
            </div> --}}

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled>{{__('Save')}}</button>
                        <a href="" id="btn-cancel" name="btncancel" class="btn btn-danger">{{__('Cancel')}}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
{{-- Fin de modal --}}

</body>
<script type="text/javascript">

  $(function () {
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        language: {"url": "js/Spanish.json"},
        ajax: "{{ route('bancos.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nom_banco', name: 'nom_banco'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    //agregar banco
    /* When click New customer button */
        $('#new-banco').click(function () {
            // $('#btn-save').val('create-banco');
            $('#id').val('');
            $('#nom_banco').val('');
            $('#bancoForm').trigger('reset');
            $('#userCrudModal').html('Agregar Banco');
            $('#crud-modal').modal('show');
        });
    //fin
    //Save boton
         $('#btn-save').click(function (e) {
            e.preventDefault();
            $(this).html('Guardando....');
            $.ajax({
              data: $('#bancoForm').serialize(),
              url: "{{ route('bancos.store') }}",
              type: "POST",
              dataType: 'json',
              success: function (data) {
                  $("#alert").show();
                    $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">Banco  guardado  correctamente</h6>');
                    setTimeout(function() {
                    $('#alert').fadeOut('slow');
                    }, 2500);

                  $('#bancoForm').trigger('reset');
                  $('#crud-modal').modal('hide');
                  table.draw();
            },
              error: function (data) {
                var banco = $('#nom_banco').val();
                $('#bancoForm').trigger('reset');
                $('#crud-modal').modal('hide');
                  table.draw();
                alert('El banco ' + banco + ' se encuentra registrado' );
                //   $('#userCrudModal').html("Bancos");
                //   console.log('Error:', data);
               $('#btn-save').html('Guardar');
              }
      });
    });
    //fin
    //inicio boton cancelar
         $('#btn-cancel').click(function () {
            $(this).html('Cancelando....');
            $('#bancoForm').trigger('reset');
            $('#crud-modal').modal('hide');
             // table.draw();
             $(this).html('Cancelar');
            });

    // fin boton cancelar
  });
</script>
</html>
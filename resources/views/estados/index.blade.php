
    @include('layouts._head_table')

<body>
    @include('layouts._nav_table')
<div class="container">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="card-header shadow">
                <h3 class="card-title"><i class="fas fa-info"></i>  {{($titulo)}}</h3>
               {{--  <h4 class="card-subtitle"><i class="fas fa-plus"></i>  Agregar y <i class="fas fa-pencil-square-o"></i>  Editar</h4> --}}

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn boton mb-2" id="new-estado" data-toggle="modal"><i class="fas fa-plus"></i> Nuevo</a>
                        </div>
                    </div>
                </div>
            </div>
                 <div class="alert Alert-success">
                    <span><label type="hidden" name="alert" id="alert"></label></span>
                  </div>

                <table class="table table-bordered table-hover data-table table-responsive mx-auto nowrap table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th width="3%">No</th>
                            <th width="3%">Identificador</th>
                            <th>estado</th>
                            <th width="100px">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
        </div>
    </div>
</div>

<!--Modal de agregar y editar estado -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
        <div class="modal-body">
            <form name="estadoForm" id="estadoForm"> {{--action="{{ route('estados.store') }}" method="POST"> --}}
                     {{-- @csrf --}}
            <input type="hidden" name="id" id="id" >
            {{-- @csrf --}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Estado:</strong>
                        <input type="text" name="estado" id="estado" class="form-control" placeholder="Ingrese el Nombre del estado" onchange="validate()" onkeyup="javascript:this.value=this.value.toUpperCase();" >
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
                        <a href="" id="btn-cancel" name="btncancel" class="btn btn-danger" data-dismiss="modal">{{__('Cancel')}}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
{{-- Fin de modal --}}
{{-- Inicio de modal View --}}
<!-- Show user modal -->
<div class="modal fade" id="crud-modal-show" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal-show"></h4>
            </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-2 col-sm-2 col-md-2"></div>
                    <div class="col-xs-10 col-sm-10 col-md-10 ">
                        <table class="table-responsive ">
                            <tr height="50px"><td><strong>Identificador:</strong></td><h3><td id="snestado"></td></h3></tr>
                            <tr height="50px"><td><strong>estado:</strong></td><h3><td id="sestado"></td></h3></tr>
                            <tr><td></td></tr>
                        </table>
                        <div class="justify-content-center">
                            <a href="" class="btn btn-primary" data-dismiss="modal" id="btn-ok">OK</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Fin de View --}}
</body>
@include('layouts._footer')
<script type="text/javascript">
error=false

        function validate()
        {
            if(document.estadoForm.estado.value !='' )
            document.estadoForm.btnsave.disabled=false
            else
            document.estadoForm.btnsave.disabled=true


        }

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
        ajax: "{{ route('estados.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'id'},
            {data: 'estado', name: 'estado', orderable: false, searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    //agregar estado
    /* When click New customer button */
        $('#new-estado').click(function () {
            // $('#btn-save').val('create-estado');
            $('#id').val('');
            $('#estado').val('');
            $('#estadoForm').trigger('reset');
            $('#userCrudModal').html('Agregar estado');
            $('#crud-modal').modal('show');
        });
    //fin
    //Save boton
         $('#btn-save').click(function (e) {
            e.preventDefault();
            $(this).html('Guardando....');
            $.ajax({
              data: $('#estadoForm').serialize(),
              url: "{{ route('estados.store') }}",
              type: "POST",
              dataType: 'json',
              success: function (data) {
                  $("#alert").show();
                    $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">estado  guardado  correctamente</h6>');
                    setTimeout(function() {
                    $('#alert').fadeOut('slow');
                    }, 2500);

                  $('#estadoForm').trigger('reset');
                  $('#crud-modal').modal('hide');
                  $('#btn-save').html('Guardar');
                  table.draw();
            },
              error: function (data) {
                var estado = $('#estado').val();
                $('#btn-save').html('Guardar');
                $('#estadoForm').trigger('reset');
                $('#crud-modal').modal('hide');
                  table.draw();
                alert('El estado ' + estado + ' se encuentra registrado' );
                //   $('#userCrudModal').html("estados");
                  console.log('Error:', data);

              }
      });
    });
    //fin
    //editar estado
    /* Edit customer */
$('body').on('click','.edit-estado', function () {
    var estado_id = $(this).data('id');
    $.get('estados/'+estado_id+'/edit', function (data) {
        $('#userCrudModal').html("Editar estado");
        $('#btn-update').val("Update");
        $('#btn-save').prop('disabled',false);
        $('#btn-save').html('Guardar');
        $('#crud-modal').modal('show');
        $('#id').val(data.id);
        $('#estado').val(data.estado);
    })
});
    //fin editar estado
    //comienzo de view
    /* Show customer */
$('body').on('click', '.view-estado', function () {
    var estado_id = $(this).data('id');
   $.get('estados/'+estado_id+'/edit', function (data) {

    $('#snestado').html(data.id);
    $('#sestado').html(data.estado);
    })
    $('#userCrudModal-show').html("Detalle estado");
    $('#crud-modal-show').modal('show');
});
    //fin de view

  });
</script>
</html>
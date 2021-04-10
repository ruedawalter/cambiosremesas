
    @include('layouts._head_table')

<body>
    @include('layouts._nav_table')
<div class="container">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="card-header shadow">
                <h3 class="card-title"><i class="fas fa-globe"></i>  {{($titulo)}}</h3>
                <h4 class="card-subtitle"><i class="fas fa-plus"></i>  Agregar y <i class="fas fa-pencil-square-o"></i>  Editar</h4>

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-primary mb-2" id="new-pais" data-toggle="modal"><i class="fas fa-plus"></i> Nuevo</a>
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
                            <th>Pais</th>
                            <th width="100px">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
        </div>
    </div>
</div>

<!--Modal de agregar y editar pais -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
        <div class="modal-body">
            <form name="paisForm" id="paisForm"> {{--action="{{ route('paiss.store') }}" method="POST"> --}}
                     {{-- @csrf --}}
            <input type="hidden" name="id" id="id" >
            {{-- @csrf --}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pais:</strong>
                        <input type="text" name="nom_pais" id="nom_pais" class="form-control" placeholder="Ingrese el Nombre del pais" onchange="validate()" onkeyup="javascript:this.value=this.value.toUpperCase();" >
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
                            <tr height="50px"><td><strong>Identificador:</strong></td><h3><td id="snpais"></td></h3></tr>
                            <tr height="50px"><td><strong>pais:</strong></td><h3><td id="spais"></td></h3></tr>
                            <tr><td></td><td style="text-align: right "><a href="" class="btn btn-primary" id="btn-ok">OK</a> </td></tr>
                        </table>
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
            if(document.paisForm.nom_pais.value !='' )
            document.paisForm.btnsave.disabled=false
            else
            document.paisForm.btnsave.disabled=true


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
        ajax: "{{ route('paises.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'id'},
            {data: 'nom_pais', name: 'nom_pais', orderable: false, searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    //agregar pais
    /* When click New customer button */
        $('#new-pais').click(function () {
            // $('#btn-save').val('create-pais');
            $('#id').val('');
            $('#nom_pais').val('');
            $('#paisForm').trigger('reset');
            $('#userCrudModal').html('Agregar pais');
            $('#crud-modal').modal('show');
        });
    //fin
    //Save boton
         $('#btn-save').click(function (e) {
            e.preventDefault();
            $(this).html('Guardando....');
            $.ajax({
              data: $('#paisForm').serialize(),
              url: "{{ route('paises.store') }}",
              type: "POST",
              dataType: 'json',
              success: function (data) {
                  $("#alert").show();
                    $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">pais  guardado  correctamente</h6>');
                    setTimeout(function() {
                    $('#alert').fadeOut('slow');
                    }, 2500);

                  $('#paisForm').trigger('reset');
                  $('#crud-modal').modal('hide');
                  $('#btn-save').html('Guardar');
                  table.draw();
            },
              error: function (data) {
                var pais = $('#nom_pais').val();
                $('#btn-save').html('Guardar');
                $('#paisForm').trigger('reset');
                $('#crud-modal').modal('hide');
                  table.draw();
                alert('El pais ' + pais + ' se encuentra registrado' );
                //   $('#userCrudModal').html("paiss");
                  console.log('Error:', data);

              }
      });
    });
    //fin
    //inicio boton cancelar
         $('#btn-cancel').click(function () {
            $(this).html('Cancelando....');
            $('#paisForm').trigger('reset');
            $('#crud-modal').modal('hide');
             // table.draw();
             $(this).html('Cancelar');
            });

    // fin boton cancelar
    //editar pais
    /* Edit customer */
$('body').on('click','.edit-pais', function () {
    var pais_id = $(this).data('id');
    $.get('paises/'+pais_id+'/edit', function (data) {
        $('#userCrudModal').html("Editar pais");
        $('#btn-update').val("Update");
        $('#btn-save').prop('disabled',false);
        $('#btn-save').html('Guardar');
        $('#crud-modal').modal('show');
        $('#id').val(data.id);
        $('#nom_pais').val(data.nom_pais);
    })
});
    //fin editar pais
    //comienzo de view
    /* Show customer */
$('body').on('click', '.view-pais', function () {
    var pais_id = $(this).data('id');
   $.get('paises/'+pais_id+'/edit', function (data) {

    $('#snpais').html(data.id);
    $('#spais').html(data.nom_pais);
    })
    $('#userCrudModal-show').html("Detalle pais");
    $('#crud-modal-show').modal('show');
});
    //fin de view
//inicio boton Ok view
    //inicio boton cancelar
         $('#btn-ok').click(function () {
            $('#spais').html('');
            $('#snpais').html('');
            $('#crud-modal-show').modal('hide');
            });

    // fin boton cancelar
//Fin boton ok view

  });
</script>
</html>
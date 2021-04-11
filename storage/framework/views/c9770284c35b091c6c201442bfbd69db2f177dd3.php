
    <?php echo $__env->make('layouts._head_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body>
    <?php echo $__env->make('layouts._nav_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="card-header shadow">
                <h3 class="card-title"><i class="far fa-id-card"></i>  <?php echo e(($titulo)); ?></h3>
                <h4 class="card-subtitle"><i class="fas fa-plus"></i>  Agregar y <i class="fas fa-pencil-square-o"></i>  Editar</h4>

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn boton mb-2" id="new-documento" data-toggle="modal"><i class="fas fa-plus"></i> Nuevo</a>
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
                            <th>Documento</th>
                            <th width="100px">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
        </div>
    </div>
</div>

<!--Modal de agregar y editar documento -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
        <div class="modal-body">
            <form name="documentoForm" id="documentoForm"> 
                     
            <input type="hidden" name="id" id="id" >
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>documento:</strong>
                        <input type="text" name="documento" id="documento" class="form-control" placeholder="Ingrese el Nombre del documento" onchange="validate()" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                    </div>
                </div>
            

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary" disabled><?php echo e(__('Save')); ?></button>
                        <a href="" id="btn-cancel" name="btncancel" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('Cancel')); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>


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
                            <tr height="50px"><td><strong>Identificador:</strong></td><h3><td id="sndocumento"></td></h3></tr>
                            <tr height="50px"><td><strong>documento:</strong></td><h3><td id="sdocumento"></td></h3></tr>
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


</body>
<?php echo $__env->make('layouts._footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
error=false

        function validate()
        {
            if(document.documentoForm.nom_documento.value !='' )
            document.documentoForm.btnsave.disabled=false
            else
            document.documentoForm.btnsave.disabled=true


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
        ajax: "<?php echo e(route('documentos.index')); ?>",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'id'},
            {data: 'documento', name: 'documento', orderable: false, searchable: true},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    //agregar documento
    /* When click New customer button */
        $('#new-documento').click(function () {
            // $('#btn-save').val('create-documento');
            $('#id').val('');
            $('#documento').val('');
            $('#documentoForm').trigger('reset');
            $('#userCrudModal').html('Agregar documento');
            $('#crud-modal').modal('show');
        });
    //fin
    //Save boton
         $('#btn-save').click(function (e) {
            e.preventDefault();
            $(this).html('Guardando....');
            $.ajax({
              data: $('#documentoForm').serialize(),
              url: "<?php echo e(route('documentos.store')); ?>",
              type: "POST",
              dataType: 'json',
              success: function (data) {
                  $("#alert").show();
                    $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">documento  guardado  correctamente</h6>');
                    setTimeout(function() {
                    $('#alert').fadeOut('slow');
                    }, 2500);

                  $('#documentoForm').trigger('reset');
                  $('#crud-modal').modal('hide');
                  $('#btn-save').html('Guardar');
                  table.draw();
            },
              error: function (data) {
                var documento = $('#documento').val();
                $('#btn-save').html('Guardar');
                $('#documentoForm').trigger('reset');
                $('#crud-modal').modal('hide');
                  table.draw();
                alert('El documento ' + documento + ' se encuentra registrado' );
                //   $('#userCrudModal').html("documentos");
                  console.log('Error:', data);

              }
      });
    });
    //fin
    //editar documento
    /* Edit customer */
$('body').on('click','.edit-documento', function () {
    var documento_id = $(this).data('id');
    $.get('documentos/'+documento_id+'/edit', function (data) {
        $('#userCrudModal').html("Editar documento");
        $('#btn-update').val("Update");
        $('#btn-save').prop('disabled',false);
        $('#btn-save').html('Guardar');
        $('#crud-modal').modal('show');
        $('#id').val(data.id);
        $('#documento').val(data.documento);
    })
});
    //fin editar documento
    //comienzo de view
    /* Show customer */
$('body').on('click', '.view-documento', function () {
    var documento_id = $(this).data('id');
   $.get('documentos/'+documento_id+'/edit', function (data) {

    $('#sndocumento').html(data.id);
    $('#sdocumento').html(data.documento);
    })
    $('#userCrudModal-show').html("Detalle documento");
    $('#crud-modal-show').modal('show');
});
    //fin de view


  });
</script>
</html><?php /**PATH C:\laragon\www\cambios\resources\views/documentos/index.blade.php ENDPATH**/ ?>
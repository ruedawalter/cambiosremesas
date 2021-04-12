
    @include('layouts._head_table')

<body>
    @include('layouts._nav_table')
<div class="container">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <div class="card-header shadow">
                <h3 class="card-title"><i class="far fa-address-card"></i>  {{($titulo)}}</h3>
               {{--  <h4 class="card-subtitle"><i class="fas fa-plus"></i>  Agregar y <i class="fas fa-pencil-square-o"></i>  Editar</h4> --}}

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn boton" id="new-titular" data-toggle="modal"><i class="fas fa-plus"></i> Nuevo</a>
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
                            <th width="3%">Id</th>
                            <th width="30%">Titular</th>
                            <th width="5%">Documento</th>
                            <th width="20%">Teléfono</th>
                            <th width="30%">Email</th>
                            <th width="100px">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
        </div>
    </div>
</div>

<!--Modal de agregar y editar titular -->
<div class="modal fade" id="crud-modal" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
            </div>
        <div class="modal-body">
            <form name="titularForm" id="titularForm"> {{--action="{{ route('titulars.store') }}" method="POST"> --}}
                     {{-- @csrf --}}
            <input type="hidden" name="id" id="id" >
            {{-- @csrf --}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>titular:</strong>
                        <input type="text" name="nom_tit" id="nom_tit" class="form-control" placeholder="Ingrese el Nombre del titular" onchange="validate()" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                    </div>
                </div>

                <div class="form-group row">
                            <label for="id_doc_tit" class="col-md-4 col-form-label text-md-right">{{ __('Type document') }}</label>

                            <div class="col-sm-2 col-md-4 col-lg-4">
                                <select class="form-control bg-light shadow-sm col-8" name ="id_doc_tit" id="id_doc_tit"  class="form-control" required>
                                <option value="">--{{__('Select')}}--</option>
                                @foreach($doc as $documento)
                                    <option value="{{$documento->id}}">{{$documento->documento}}</option>
                                @endforeach
                            </select>
                           </div>
                        </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>N° Documento:</strong>
                        <input type="tel" name="doc_tit" id="doc_tit" class="form-control" placeholder="Ingrese el N° de documento" onchange="validate()" onkeyup="javascript:this.value=this.value.toUpperCase();" >
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Teléfono:</strong>
                        <input type="tel" name="tel_tit" id="tel_tit" class="form-control" placeholder="Ingrese el N° de Teléfono" onchange="validate()"  >
                    </div>
                </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="email_tit" id="email_tit" class="form-control @error('email') is-invalid @enderror" placeholder="Ingrese el Mail ejemplo@ejemplo.com" onkeyup="validarEmail()" required style="text-transform:lowercase;" >
                    <span id="emailOK"></span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

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
                            <tr height="50px"><td><strong>Identificador:  </strong></td><h3><td id="sntit"></td></h3></tr>
                            <tr height="50px"><td><strong>Titular:  </strong></td><h3><td id="stit"></td></h3></tr>
                            <tr height="50px"><td><strong>Documento:  </strong></td><h3><td id="sdoc_tit"></td></h3></tr>
                            <tr height="50px"><td><strong>Teléfono:  </strong></td><h3><td id="stel_tit"></td></h3></tr>
                            <tr height="50px"><td><strong>Email:  </strong></td><h3><td id="semail_tit"></td></h3></tr>
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

        form = document.querySelector('#titularForm');
        form.tel_tit.addEventListener('keypress', function (e){
            if (!soloNumeros(event)){
            e.preventDefault();
          }
        })
        form.doc_tit.addEventListener('keypress', function (e){
            if (!soloNumeros(event)){
            e.preventDefault();
          }
        })

        //Solo permite introducir numeros.
        function soloNumeros(e){
            var key = e.charCode;
            console.log(key);
            return key >= 48 && key <= 57;
        }

        function validarEmail() {
            valor = document.titularForm.email_tit.value;
            valido = document.getElementById('emailOK');
            // /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/
            if (/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i.test(valor)){
                valido.innerText = "La dirección " + valor + " es correcta.";
                document.titularForm.btnsave.disabled=false
            } else {
                valido.innerText = "La dirección " + valor + " es incorrecta.";
                document.titularForm.btnsave.disabled=true
            }
        }
        error=false
        function validate()
        {
            if(document.titularForm.nom_tit.value !='' && document.titularForm.doc_tit.value !='' && document.titularForm.tel_tit.value !='' && document.titularForm.email_tit.value !='')
            document.titularForm.btnsave.disabled=false
            else
            document.titularForm.btnsave.disabled=true


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
        ajax: "{{ route('titulares.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'id', name: 'id'},
            {data: 'nom_tit', name: 'nom_tit', orderable: false, searchable: true},
            {data: 'doct', name: 'doct'},
            {data: 'tel_tit', name: 'tel_tit'},
            {data: 'email_tit', name: 'email_tit'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    //agregar titular
    /* When click New customer button */
        $('#new-titular').click(function () {
            // $('#btn-save').val('create-titular');
            $('#id').val('');
            $('#nom_titular').val('');
            $('#titularForm').trigger('reset');
            $('#userCrudModal').html('Agregar titular');
            $('#crud-modal').modal('show');
        });
    //fin
    //Save boton
         $('#btn-save').click(function (e) {
            e.preventDefault();
            $(this).html('Guardando....');
            $.ajax({
              data: $('#titularForm').serialize(),
              url: "{{ route('titulares.store') }}",
              type: "POST",
              dataType: 'json',
              success: function (data) {
                  $("#alert").show();
                    $("#alert").html('<h6 style="margin-top: 12px;" class="alert alert-success">titular  guardado  correctamente</h6>');
                    setTimeout(function() {
                    $('#alert').fadeOut('slow');
                    }, 2500);

                  $('#titularForm').trigger('reset');
                  $('#crud-modal').modal('hide');
                  $('#btn-save').html('Guardar');
                  table.draw();
            },
              error: function (data) {
                var titular = $('#nom_tit').val();
                $('#btn-save').html('Guardar');
                $('#titularForm').trigger('reset');
                $('#crud-modal').modal('hide');
                table.draw();
                alert('El titular ' + titular + ' se encuentra registrado' );
                //   $('#userCrudModal').html("titulars");
                  console.log('Error:', data);

              }
      });
    });
    //fin

    //editar titular
    /* Edit customer */
$('body').on('click','.edit-titular', function () {
    var titular_id = $(this).data('id');
    $.get('titulares/'+titular_id+'/edit', function (data) {
        $('#userCrudModal').html("Editar titular");
        $('#btn-update').val("Update");
        $('#btn-save').prop('disabled',false);
        $('#btn-save').html('Guardar');
        $('#crud-modal').modal('show');
        $('#id').val(data[0].id);
        $('#nom_tit').val(data[0].nom_tit);
        $('#id_doc_tit').val(data[0].id_doc_tit);
        // $('#id_doc_tit').html(data[0].documento);
        $('#doc_tit').val(data[0].doc_tit);
        $('#tel_tit').val(data[0].tel_tit);
        $('#email_tit').val(data[0].email_tit);

    })
});
    //fin editar titular
    //comienzo de view
    /* Show customer */
$('body').on('click', '.view-titular', function () {
    var titular_id = $(this).data('id');
   $.get('titulares/'+titular_id+'/edit', function (data) {
    $('#sntit').html(data[0].id);
    $('#stit').html(data[0].nom_tit);
    $('#sdoc_tit').html(data[0].doct);
    $('#stel_tit').html(data[0].tel_tit);
    $('#semail_tit').html(data[0].email_tit);
    })
    $('#userCrudModal-show').html("Detalle del Titular");
    $('#crud-modal-show').modal('show');
});
    //fin de view


    // fin boton cancelar
//Fin boton ok view

  });
</script>
</html>
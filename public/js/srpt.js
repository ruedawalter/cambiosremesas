        function modal(){
            var correo = /^[A-Z0-9._%+-]+@([A-Z0-9-]+.)+[A-Z]{2,4}$/i;
            var letras =/^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/g;
            var celular = /^[0]{1}[4]{1}[1-2]{1}[2,4,6]{1}[0-9]{7}$/i;
            var fijo = /^[0]{1}[1]{1}[0-9]{7}$/i;
            var telefono = document.getElementById("telefono").value;

              // if (telefono.trim() == '' ){
              //     $('#telefono').val('04XX-XXX-XXXX');
              //     // return false;
              if (!celular.test(telefono)){
                  alert('Número de telefono inválido, formato 04(1-2)(2-4-6)XXXXXXX 11 digitos');
                  $('#telefono').focus();
                  $('#btn-save').html('Guardar');
                  e.preventdefault();
              }
              if (telefono.length !=11 ){
                  alert('Número de teléfono celular incompleto');
                  $('#telefono').focus();
                  $('#btn-save').html('Guardar');
                  e.preventdefault();
              }
        }

         form = document.querySelector('#titularForm');
        form.telefono.addEventListener('keypress', function (e){
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
            if(document.titularForm.nom_tit.value !='' && document.titularForm.doc_tit.value !='' && document.titularForm.email_tit.value !='')
            document.titularForm.btnsave.disabled=false
            else
            document.titularForm.btnsave.disabled=true
        }


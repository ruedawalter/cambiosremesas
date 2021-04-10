 <script>
        error=false

        function validate()
        {
            if(document.bancoForm.nom_banco.value !='' )
            document.bancoForm.btnsave.disabled=false
            else
            document.bancoForm.btnsave.disabled=true


        }
    </script><?php /**PATH C:\laragon\www\cambios\resources\views/layouts/_validate.blade.php ENDPATH**/ ?>
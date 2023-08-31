
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2023</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<script src="<?php echo base_url()?>js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url()?>js/scripts.js"></script>
<script src="<?php echo base_url()?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>js/dataTables.bootstrap5.min.js"></script>
<script src="<?php echo base_url()?>js/simple-datatables.min.js"></script>
<script src="<?php echo base_url()?>js/datatables-simple-demo.js"></script>
<script src="<?php echo base_url()?>js/sweetalert2.min.js"></script>


<script>
    $('#modal-confirma').on('show.bs.modal', function(e) {
        var targetButton = $(e.relatedTarget);
        var href = targetButton.data('href');
        $(this).find('.btn-ok').attr('href', href);
    });
</script>

</body>

</html>


<script>
            /*const dynamicContent = document.getElementById("layoutSidenav_content");
            const etiquetaA = document.getElementById("cliente-a");

            etiquetaA.addEventListener("click", () => {
                 // Realizar solicitud Ajax
                fetch('<?php //echo base_url(); ?>cliente')
                    .then(response => response.text())
                    .then(data => {
                        console.log(data)
                        dynamicContent.innerHTML = data; // Cambiar el contenido dinámicamente
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });*/

           
        </script>
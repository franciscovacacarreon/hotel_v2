
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
<script src="<?php echo base_url()?>js/simple-datatables.min.js"></script>
<script src="<?php echo base_url()?>js/datatables-simple-demo.js"></script>
<script src="<?php echo base_url()?>js/jquery-3.5.1.min.js"></script>

<script>
    $('#modal-confirma').on('show.bs.modal', function(e) {
        var targetButton = $(e.relatedTarget);
        var href = targetButton.data('href');
        $(this).find('.btn-ok').attr('href', href);
    });
</script>

</body>

</html>
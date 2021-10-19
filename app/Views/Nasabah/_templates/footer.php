        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- Toastr -->
        <script src="assets/plugins/toastr/toastr.min.js"></script>
        <script src="assets/plugins/select2/js/select2.full.min.js"></script>
        <script src="assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <!-- AdminLTE -->
        <script src="assets/js/adminlte.js"></script>
        <?php foreach ($Page->scripts as $key => $value) : ?>
            <script src="<?php echo ($value) ?>"></script>
        <?php endforeach; ?>
        <script src="assets/js/main.js"></script>

        <?php if (session()->getFlashdata("swalOpen") <> '') : ?>
            <script>
                Swal.fire({
                    title: '<?php echo (session()->getFlashdata("swalTitle")) ?>',
                    html: '<?php echo (session()->getFlashdata("swalText")) ?>',
                    icon: '<?php echo (session()->getFlashdata("swalIcon")) ?>',
                    didOpen: () => {}
                });
            </script>
        <?php endif; ?>

    </body>

</html>
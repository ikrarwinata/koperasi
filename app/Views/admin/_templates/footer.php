<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="assets/js/jquery-3.6.0.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<?php foreach ($Page->scripts as $key => $script): ?>
<script src="<?php echo $script ?>"></script>
<?php endforeach ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Koperasi Simpan Pinjam</title>
	<base href="<?php echo (base_url()) ?>">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
	<link href="assets/plugins/animate.css/animate.min.css" rel="stylesheet">

	<link href="assets/plugins/pnotify/dist/pnotify.css" rel="stylesheet">
	<link href="assets/plugins/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
	<link href="assets/plugins/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="<?php echo (base_url('Home/index')) ?>" class="h1"><b>Koperasi</b></a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Silahkan login untuk memulai</p>

				<form action="<?php echo (base_url('Home/login_auth')) ?>" method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="remember" name="keepalive" value="1">
								<label for="remember">
									Ingat Saya
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Masuk</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="assets/dist/js/adminlte.min.js"></script>
	<script src="assets/plugins/pnotify/dist/pnotify.js"></script>
	<script src="assets/plugins/pnotify/dist/pnotify.buttons.js"></script>
	<script src="assets/plugins/pnotify/dist/pnotify.nonblock.js"></script>
	<?php if (session()->getFlashdata('ci_login_flash_message') != NULL) : ?>
		<script type="text/javascript">
			jQuery(function($) {
				new PNotify({
					title: ' Uppsss...',
					type: "<?php echo session()->getFlashdata('ci_login_flash_message_type') ?>",
					text: "<?php echo session()->getFlashdata('ci_login_flash_message') ?>",
					nonblock: {
						nonblock: true
					},
					styling: 'bootstrap3',
				});
			})
		</script>
	<?php endif ?>
</body>

</html>
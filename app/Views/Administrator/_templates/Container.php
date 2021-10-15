<?php echo view($Template->header); ?>

<div class="wrapper">
	<div class="preloader flex-column justify-content-center align-items-center">
		<div class="fa-4x">
			<i class="fas fa-spinner fa-pulse"></i>
		</div>
	</div>
	<!-- Navbar -->
	<?php echo view($Template->navbar); ?>
	<!-- /.navbar -->

	<!-- Main Sidebar Container -->
	<?php echo view($Template->sidebar); ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0"><?php echo ($Page->title) ?></h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="<?php echo (base_url('administrator/Dashboard')) ?>">Home</a></li>
							<?php foreach ($Page->subtitle as $key => $value) : ?>
								<li class="breadcrumb-item active"><a href="<?php echo (base_url($value)) ?>"><?php echo (strSentence($key)) ?></a></li>
							<?php endforeach; ?>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<?php $this->renderSection('content') ?>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	<footer class="main-footer">
		<div class="float-right d-none d-sm-inline-block">
			<strong>Copyright &copy; 2021.</strong>
			All rights reserved.
		</div>
	</footer>
</div>

<?php echo view($Template->footer); ?>
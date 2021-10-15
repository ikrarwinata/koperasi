<?php
$this->extend($Template->container);
$this->section('content');
?>
<div class="col-12 col-lg-3 col-xl-3">
	<!-- small box -->
	<div class="small-box bg-success">
		<div class="inner">
			<h3><?php echo (session("verivikasi")) ?></h3>

			<p>Pengajuan Pinjaman</p>
		</div>
		<div class="icon">
			<i class="ion ion-bag"></i>
		</div>
		<a href="<?php echo (base_url('Administrator/Master/verifikasi')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-12 col-lg-3 col-xl-3">
	<!-- small box -->
	<div class="small-box bg-warning">
		<div class="inner">
			<h3><?php echo (session("d_cancel")) ?></h3>

			<p>Pinjaman Belum Lunas</p>
		</div>
		<div class="icon">
			<i class="fa fa-times-circle"></i>
		</div>
		<a href="<?php echo (base_url('Administrator/Deliver/index')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-12 col-lg-3 col-xl-3">
	<!-- small box -->
	<div class="small-box bg-success">
		<div class="inner">
			<h3><?php echo (session("d_success")) ?></h3>

			<p>Pengajuan Tambah Simpanan</p>
		</div>
		<div class="icon">
			<i class="fa fa-shipping-fast"></i>
		</div>
		<a href="<?php echo (base_url('Administrator/Deliver/verifikasi')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-12 col-lg-3 col-xl-3">
	<!-- small box -->
	<div class="small-box bg-info">
		<div class="inner">
			<h3><?php echo (session("d_success")) ?></h3>

			<p>Pengajuan Ambil Simpanan</p>
		</div>
		<div class="icon">
			<i class="fa fa-shipping-fast"></i>
		</div>
		<a href="<?php echo (base_url('Administrator/Deliver/verifikasi')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<?php $this->endSection(); ?>;
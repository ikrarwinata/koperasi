<?php
$this->extend($Template->container);
$this->section('content');
?>
<div class="col-12 col-lg-6 col-xl-6">
	<!-- small box -->
	<div class="small-box bg-success">
		<div class="inner">
			<h3><?php echo (session("pengajuan_pinjaman")) ?></h3>

			<p>Pengajuan Pinjaman</p>
		</div>
		<div class="icon">
			<i class="fa fa-comment-dollar"></i>
		</div>
		<a href="<?php echo (base_url('Administrator/Tambah_pinjaman/index')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-12 col-lg-6 col-xl-6">
	<!-- small box -->
	<div class="small-box bg-warning">
		<div class="inner">
			<h3><?php echo (session("pinjaman_berjalan")) ?></h3>

			<p>Pinjaman Belum Lunas</p>
		</div>
		<div class="icon">
			<i class="fa fa-times-circle"></i>
		</div>
		<a href="<?php echo (base_url('Administrator/Deliver/index')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-12 col-lg-6 col-xl-6">
	<!-- small box -->
	<div class="small-box bg-success">
		<div class="inner">
			<h3><?php echo (session("pengajuan_simpan")) ?></h3>

			<p>Pengajuan Tambah Simpanan</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-invoice-dollar"></i>
		</div>
		<a href="<?php echo (base_url('Administrator/Tambah_simpanan/index')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-12 col-lg-6 col-xl-6">
	<!-- small box -->
	<div class="small-box bg-info">
		<div class="inner">
			<h3>Rp.<?php echo (formatNumber(session("incash"))) ?></h3>

			<p>Total Saldo Nasabah</p>
		</div>
		<div class="icon">
			<i class="fa fa-balance-scale"></i>
		</div>
		<a href="<?php echo (base_url('Administrator/Saldo_nasabah/index')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<?php $this->endSection(); ?>;
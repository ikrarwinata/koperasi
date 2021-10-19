<?php
$this->extend($Template->container);
$this->section('content');
?>
<div class="col-12 col-lg-6 col-xl-6">
	<!-- small box -->
	<div class="small-box bg-warning">
		<div class="inner">
			<h3><?php echo (session("verivikasi")) ?></h3>

			<p>Total Pinjaman Anda</p>
		</div>
		<div class="icon">
			<i class="fa fa-file-signature"></i>
		</div>
		<a href="<?php echo (base_url('Nasabah/Master/verifikasi')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<div class="col-12 col-lg-6 col-xl-6">
	<!-- small box -->
	<div class="small-box bg-info">
		<div class="inner">
			<h3>Rp. <?php echo (formatNumber(session("saldo"))) ?></h3>

			<p>Saldo Simpanan Anda</p>
		</div>
		<div class="icon">
			<i class="fa fa-balance-scale"></i>
		</div>
		<a href="<?php echo (base_url('Nasabah/Dashboard/buku_simpanan')) ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
	</div>
</div>
<?php $this->endSection(); ?>;
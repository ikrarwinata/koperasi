<aside class="main-sidebar main-sidebar-custom sidebar-light-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?php echo (base_url('Administrator/Dashboard/index')) ?>" class="brand-link">
		<img src="<?php echo ('assets/img/AdminLTELogo.png') ?>" alt="" class="brand-image img-circle elevation-3" style="opacity: .9">
		<span class="brand-text font-weight-light">Koperasi</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="assets/img/user.png" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="<?php echo (base_url('Administrator/Dashboard/index')) ?>" class="d-block"><?php echo (strCut(session("nama"), 23)) ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?php echo (base_url('Administrator/Dashboard')) ?>" class="nav-link">
						<i class="nav-icon fas fa-home"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-hand-holding-usd"></i>
						<p>
							Transaksi Simpanan
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo (base_url('Administrator/Tambah_simpanan/index')) ?>" class="nav-link">
								<i class="fas fa-user-check nav-icon text-xs"></i>
								<p class="text-xs">
									Verifikasi Pengajuan Simpanan
									<?php if (session()->has("pengajuan_simpanan") && session("pengajuan_simpanan") >= 1) : ?>
										<span class="right badge badge-danger"><?php echo (session("pengajuan_simpanan")) ?></span>
									<?php endif; ?>
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo (base_url('Administrator/Tambah_simpanan/create')) ?>" class="nav-link">
								<i class="fas fa-file-invoice-dollar nav-icon text-xs"></i>
								<p class="text-xs">
									Tambah Simpanan Nasabah
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo (base_url('Administrator/Ambil_simpanan/create')) ?>" class="nav-link">
								<i class="far fa-circle nav-icon text-xs"></i>
								<p class="text-xs">
									Ambil Simpanan
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo (base_url('Administrator/Saldo_nasabah/index')) ?>" class="nav-link">
								<i class="fa fa-book nav-icon text-xs"></i>
								<p class="text-xs">
									Buku Simpanan
								</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-comments-dollar"></i>
						<p>
							Transaksi Pinjaman
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo (base_url('Administrator/Tambah_pinjaman/index')) ?>" class="nav-link">
								<i class="fas fa-user-check nav-icon text-xs"></i>
								<p class="text-xs">
									Verifikasi Pengajuan Pinjaman
									<?php if (session()->has("pengajuan_simpanan") && session("pengajuan_simpanan") >= 1) : ?>
										<span class="right badge badge-danger"><?php echo (session("pengajuan_simpanan")) ?></span>
									<?php endif; ?>
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo (base_url('Administrator/Pickup/create')) ?>" class="nav-link">
								<i class="fas fa-comment-dollar nav-icon text-xs"></i>
								<p class="text-xs">
									Pinjaman Baru
									<?php if (session()->has("verivikasi") && session("verivikasi") >= 1) : ?>
										<span class="right badge badge-danger"><?php echo (session("verivikasi")) ?></span>
									<?php endif; ?>
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo (base_url('Administrator/Pickup/index')) ?>" class="nav-link">
								<i class="fa fa-file-invoice-dollar nav-icon text-xs"></i>
								<p class="text-xs">
									Pembayaran Cicilan
									<?php if (session()->has("verivikasi") && session("verivikasi") >= 1) : ?>
										<span class="right badge badge-danger"><?php echo (session("verivikasi")) ?></span>
									<?php endif; ?>
								</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?php echo (base_url('Administrator/Jenissimpan_pinjam/index/')) ?>" class="nav-link">
						<i class="nav-icon fa fa-file-invoice"></i>
						<p>
							Jenis Simpan Pinjam
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo (base_url('Administrator/Kelola_nasabah/index/')) ?>" class="nav-link">
						<i class="nav-icon fa fa-users"></i>
						<p>
							Nasabah
						</p>
					</a>
				</li>

				<li class="nav-header"><?php echo (strtoupper(session("level"))) ?></li>
				<li class="nav-item">
					<a href="<?php echo (base_url('Administrator/User/update/' . urlencode(base64_encode(session('id_user'))))) ?>" class="nav-link">
						<i class="nav-icon fa fa-user-edit"></i>
						<p>
							Profil Saya
						</p>
					</a>
				</li>

				<li class="nav-item">
					<a href="<?php echo (base_url('Administrator/User/index/')) ?>" class="nav-link">
						<i class="nav-icon fa fa-users-cog"></i>
						<p>
							Akun Pengguna
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo (base_url('Home/logout')) ?>" class="nav-link">
						<i class="nav-icon fa fa-sign-out-alt"></i>
						<p>
							Logout
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
<aside class="main-sidebar main-sidebar-custom sidebar-light-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?php echo (base_url('administrator/Dashboard/index')) ?>" class="brand-link">
		<img src="assets/img/AdminLTELogo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .9">
		<span class="brand-text font-weight-light">Ekspedisi</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="assets/img/user.png" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="<?php echo (base_url('administrator/Dashboard/index')) ?>" class="d-block"><?php echo (strCut(session("nama"), 23)) ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?php echo (base_url('administrator/Dashboard')) ?>" class="nav-link">
						<i class="nav-icon fas fa-home"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-calendar-check"></i>
						<p>
							Pickup
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo (base_url('administrator/Pickup/create')) ?>" class="nav-link">
								<i class="fas fa-plus nav-icon text-xs"></i>
								<p class="text-xs">Pickup Barang Baru</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo (base_url('administrator/Pickup/index')) ?>" class="nav-link">
								<i class="far fa-circle nav-icon text-xs"></i>
								<p class="text-xs">Riwayat Pickup</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo (base_url('administrator/Master/verifikasi')) ?>" class="nav-link">
								<i class="fas fa-question-circle nav-icon text-xs"></i>
								<p class="text-xs">
									Butuh Verifikasi
									<?php if (session()->has("verivikasi") && session("verivikasi") >= 1) : ?>
										<span class="right badge badge-danger"><?php echo (session("verivikasi")) ?></span>
									<?php endif; ?>
								</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo (base_url('administrator/Master/index')) ?>" class="nav-link">
								<i class="fas fa-spell-check nav-icon text-xs"></i>
								<p class="text-xs">Terverivikasi</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-shipping-fast"></i>
						<p>
							Delivery
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo (base_url('administrator/Deliver/verifikasi')) ?>" class="nav-link">
								<i class="fas fa-bell nav-icon text-xs"></i>
								<p class="text-xs">
									Verivikasi Delivery
									<?php if (session()->has("d_success") && session("d_success") >= 1) : ?>
										<span class="right badge badge-danger"><?php echo (session("d_success")) ?></span>
									<?php endif; ?>
								</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo (base_url('administrator/Deliver/index')) ?>" class="nav-link">
								<i class="far fa-circle nav-icon text-xs"></i>
								<p class="text-xs">Riwayat Delivery</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?php echo (base_url('administrator/Olshop/index/')) ?>" class="nav-link">
						<i class="nav-icon fa fa-store"></i>
						<p>
							Online Shop
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Akun Pengguna
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo (base_url('administrator/Admin/index')) ?>" class="nav-link">
								<i class="far fa-circle nav-icon text-xs"></i>
								<p class="text-xs">Akun Admin</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo (base_url('administrator/Kurir/index')) ?>" class="nav-link">
								<i class="far fa-circle nav-icon text-xs"></i>
								<p class="text-xs">Akun Kurir</p>
							</a>
						</li>
					</ul>
				</li>

				<li class="nav-header"><?php echo (strtoupper(session("level"))) ?></li>
				<li class="nav-item">
					<a href="<?php echo (base_url('administrator/Admin/update/' . urlencode(base64_encode(session('username'))))) ?>" class="nav-link">
						<i class="nav-icon fa fa-user"></i>
						<p>
							Profil Saya
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
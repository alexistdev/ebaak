<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('Member'); ?>" class="brand-link">
		<img src="<?= base_url('gambar/darmajaya.png'); ?>"
			 alt="AdminLTE Logo"
			 class="brand-image img-circle elevation-3"
			 style="opacity: .8">
		<span class="brand-text font-weight-light">EBaak</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url('gambar/default.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">Dashboard</a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
					 with font-awesome or any other icon font library -->
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-mail-bulk"></i>
						<p>
							Pengajuan Surat
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('mahasiswa/sidang'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Pendaftaran Sidang</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('mahasiswa/keterangan'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Surat Keterangan</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('mahasiswa/cuti'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Cuti Akademik</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('mahasiswa/aktif'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Aktif Kembali</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('mahasiswa/penelitian'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Surat Ijin Penelitian</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('mahasiswa/kerjapraktek'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Surat Ijin Kerja Praktek</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('mahasiswa/pindahkelas'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Pindah Kelas</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="<?= base_url('mahasiswa/pindahprodi'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Pindah Program Studi</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('mahasiswa/tandalulus'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Tanda Lulus Sementara</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('mahasiswa/riwayat'); ?>" class="nav-link">
						<i class="nav-icon fas fa-envelope"></i>
						<p>
							Riwayat Pengajuan
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('mahasiswa/setting'); ?>" class="nav-link">
						<i class="nav-icon fas fa-cog"></i>
						<p>
							Setting
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>

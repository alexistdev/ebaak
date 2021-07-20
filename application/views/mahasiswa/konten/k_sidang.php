<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Registrasi Sidang</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
						<li class="breadcrumb-item active">Registrasi Sidang</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php
					echo $this->session->flashdata('notif1');
					echo $this->session->flashdata('notif2'); ?>
				</div>
			</div>

			<form action="<?= base_url('mahasiswa/sidang'); ?>" method="post">
				<div class="row">
					<!--	Form Ruas Kiri		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- Judul Skripsi -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="judul">Judul <span class="text-danger">*</span></label>
											<input type="text" name="judul" id="judul" maxlength="128" class="form-control" value="<?= set_value('judul'); ?>" placeholder="Judul Skripsi" required="required">
										</div>
									</div>
								</div>
								<!-- Dosen Pembimbing -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="pembimbing">Pembimbing <span class="text-danger">*</span></label>
											<input type="text" name="pembimbing" id="pembimbing" maxlength="128" class="form-control" value="<?= set_value('pembimbing'); ?>" placeholder="Dosen Pembimbing" required="required">
										</div>
									</div>
								</div>
								<!-- Dosen Penguji1 -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="penguji1">Penguji 1 <span class="text-danger">*</span></label>
											<input type="text" name="penguji1" id="penguji1" maxlength="128" class="form-control" value="<?= set_value('penguji1'); ?>" placeholder="Dosen Penguji 1" required="required">
										</div>
									</div>
								</div>
								<!-- Dosen Penguji2 -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="penguji2">Penguji 2 <span class="text-danger">*</span></label>
											<input type="text" name="penguji2" id="penguji2" maxlength="128" class="form-control" value="<?= set_value('penguji2'); ?>" placeholder="Dosen Penguji 2" required="required">
										</div>
									</div>
								</div>
								<!-- NIDN Pembimbing -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="nidn">NIDN Pembimbing <span class="text-danger">*</span></label>
											<input type="text" name="nidn" id="nidn" maxlength="100" class="form-control" value="<?= set_value('nidn'); ?>" placeholder="NIDN Pembimbing" required="required">
										</div>
									</div>
								</div>


							</div>
						</div>
					</div>
					<!--	Form Ruas Kanan		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- Nomor SK Bimbingan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="skbimbingan">Nomor SK Bimbingan <span class="text-danger">*</span></label>
											<input type="text" name="skbimbingan" id="skbimbingan" maxlength="100" class="form-control" value="<?= set_value('skbimbingan'); ?>" placeholder="SK Bimbingan" required="required">
										</div>
									</div>
								</div>
								<!-- Tanggal SK Bimbingan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="tanggalsk">Tanggal SK Bimbingan <span class="text-danger">*</span></label>
											<input type="text" name="tanggalsk" id="tanggalsk" maxlength="16" class="form-control" value="<?= set_value('tanggalsk'); ?>" placeholder="01-01-2020" required="required">
										</div>
									</div>
								</div>
								<!-- Tanggal ACC Bimbingan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="tanggalacc">Tanggal ACC Bimbingan <span class="text-danger">*</span></label>
											<input type="text" name="tanggalacc" id="tanggalacc" maxlength="16" class="form-control" value="<?= set_value('tanggalacc'); ?>" placeholder="01-01-2020" required="required">
										</div>
									</div>
								</div>
								<!-- Jumlah Bimbingan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="jumlah">Bimbingan Bimbingan <span class="text-danger">*</span></label>
											<input type="number" name="jumlah" id="jumlah" min="1" max="20" class="form-control" value="<?= set_value('jumlah'); ?>" placeholder="20" required="required">
										</div>
									</div>
								</div>
								<!-- Submit -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary">Simpan</button>
											<a href="<?= base_url('User'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->

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
					<h1>Surat Cuti</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
						<li class="breadcrumb-item active">Surat Cuti</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<?php
					echo $this->session->flashdata('notif1');
					echo $this->session->flashdata('notif2'); ?>
				</div>
			</div>

			<form action="<?= base_url('mahasiswa/cuti'); ?>" method="post">
				<div class="row">
					<!--	Form Ruas Kiri		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- Tahun Akademik -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="tahunAkademik">Tahun Akademik <span class="text-danger">*</span></label>
											<input type="text" name="tahunAkademik" id="tahunAkademik" maxlength="30" class="form-control" value="<?= set_value('tahunAkademik'); ?>" placeholder="Genap 2021" required="required">
										</div>
									</div>
								</div>
								<!-- Alasan Cuti -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="alasanCuti">Alasan Cuti <span class="text-danger">*</span></label>
											<input type="text" name="alasanCuti" id="alasanCuti" maxlength="128" class="form-control" value="<?= set_value('alasanCuti'); ?>" placeholder="Alasan Cuti" required="required">
										</div>
									</div>
								</div>

								<!-- Submit -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary">Simpan</button>
											<a href="<?= base_url('Member'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card card-dark">
							<div class="card-header">Prasyarat</div>
							<div class="card-body">
								<ul>
									<li>Membayar Biaya Cuti AKademik</li>
									<li>Aktif Semester Sebelumnya</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->

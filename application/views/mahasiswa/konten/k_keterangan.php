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
					<h1>Surat Keterangan</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
						<li class="breadcrumb-item active">Surat Keterangan</li>
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
			<div class="row">
				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">Prasyarat</div>
						<div class="card-body">
							<ul>
								<li>Melampirkan Fotocopy KRS (Semester Berjalan)</li>
								<li>Melampirkan Fotocopy DNS (Semester Terakhir/Semester Aktif)</li>
								<li>Melampirkan Fotocopy Slip BPP (Semester Berjalan)</li>
								<li>File disimpan dalam folder dan dikompress dengan format RAR</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<form action="<?= base_url('mahasiswa/keterangan'); ?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<!--	Form Ruas Kiri		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- NIK/NIP Orang Tua -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="nik">NIK/NIP Orang Tua <span class="text-danger">*</span></label>
											<input type="text" name="nik" id="nik" maxlength="50" class="form-control" value="<?= set_value('nik'); ?>" placeholder="NIK/NIP Orang Tua" >
										</div>
									</div>
								</div>
								<!-- Nama Orang tua / wali -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="namaOrtu">Nama Orang Tua/Wali <span class="text-danger">*</span></label>
											<input type="text" name="namaOrtu" id="namaOrtu" maxlength="120" class="form-control" value="<?= set_value('namaOrtu'); ?>" placeholder="Nama Orang Tua / Wali" required="required">
										</div>
									</div>
								</div>
								<!-- Pekerjaan Orang tua / wali -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="pekerjaan">Pekerjaan Orang Tua/Wali <span class="text-danger">*</span></label>
											<input type="text" name="pekerjaan" id="pekerjaan" maxlength="120" class="form-control" value="<?= set_value('pekerjaan'); ?>" placeholder="Pekerjaan Orang Tua" required="required">
										</div>
									</div>
								</div>
								<!-- Alamat -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="alamat">Alamat <span class="text-danger">*</span></label>
											<input type="text" name="alamat" id="alamat" maxlength="300" class="form-control" value="<?= set_value('alamat'); ?>" placeholder="Alamat" required="required">
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

								<!-- Keperluan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="keperluan">Keperluan <span class="text-danger">*</span></label>
											<input type="text" name="keperluan" id="keperluan" maxlength="200" class="form-control" value="<?= set_value('keperluan'); ?>" placeholder="Keperluan Surat" required="required">
										</div>
									</div>
								</div>
								<!-- Upload -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<input type="file" id="lampiran" name="lampiran" required="required"/>
											<br>
											<span class="text-danger">** File format RAR</span>
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

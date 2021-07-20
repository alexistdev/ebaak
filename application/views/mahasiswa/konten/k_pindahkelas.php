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
					<h1>Surat Pindah Kelas</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
						<li class="breadcrumb-item active">Surat Pindah Kelas</li>
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
			<form action="<?= base_url('mahasiswa/pindahkelas'); ?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<!--	Form Ruas Kiri		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- Kelas Sebelumnya -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="kelasSebelumnya">Kelas Sebelumnya <span class="text-danger">*</span></label>
											<input type="text" name="kelasSebelumnya" id="kelasSebelumnya" maxlength="128" class="form-control" value="<?= set_value('kelasSebelumnya'); ?>" placeholder="Kelas Sebelumnya" required="required">
										</div>
									</div>
								</div>
								<!-- Alasan Pindah -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="alasan">Alasan Pindah <span class="text-danger">*</span></label>
											<input type="text" name="alasan" id="alasan" maxlength="300" class="form-control" value="<?= set_value('alasan'); ?>" placeholder="Alasan Pindah" required="required">
										</div>
									</div>
								</div>
								<!-- Tanggal Pengajuan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="tanggal">Tanggal Pengajuan <span class="text-danger">*</span></label>
											<input type="text" name="tanggal" id="tanggal" maxlength="16" class="form-control" value="<?= set_value('tanggal'); ?>" placeholder="Tanggal Pengajuan" required="required">
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
									<li>Surat bekerja bagi mahasiswa yang pindah malam</li>
									<li>File disimpan dalam folder dan dikompress dengan format RAR</li>
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

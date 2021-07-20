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
					<h1>Surat Kerja Praktek</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
						<li class="breadcrumb-item active">Surat Kerja Praktek</li>
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
			<div class="row">
				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">Prasyarat</div>
						<div class="card-body">
							<ul>
								<li>Fotocopy KRS</li>
								<li>Rangkuman Nilai Akademik</li>
								<li>Slip pembayaran BPP,SKS,dan Biaya Kerja Praktek</li>
								<li>File disimpan dalam folder dan dikompress dengan format RAR</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<form action="<?= base_url('mahasiswa/kerjapraktek'); ?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<!--	Form Ruas Kiri		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- Nama Instansi -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="namaInstansi">Nama Instansi / Perusahaan <span class="text-danger">*</span></label>
											<input type="text" name="namaInstansi" id="namaInstansi" maxlength="128" class="form-control" value="<?= set_value('namaInstansi'); ?>" placeholder="Nama Instansi / Perusahaan" required="required">
										</div>
									</div>
								</div>
								<!-- Ditujukan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="ditujukan">Ditujukan kepada<span class="text-danger">*</span></label>
											<input type="text" name="ditujukan" id="ditujukan" maxlength="128" class="form-control" value="<?= set_value('ditujukan'); ?>" placeholder="Kepala/Direktur/Pimpinan/Rektor" required="required">
										</div>
									</div>
								</div>

								<!-- Alamat Instansi -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="alamat">Alamat Instansi <span class="text-danger">*</span></label>
											<input type="text" name="alamat" id="alamat" maxlength="300" class="form-control" value="<?= set_value('alamat'); ?>" placeholder="Alamat Instansi" required="required">
										</div>
									</div>
								</div>
								<!-- Keterangan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="keterangan">Keterangan <span class="text-danger">*</span></label>
											<input type="text" name="keterangan" id="keterangan" maxlength="128" class="form-control" value="<?= set_value('keterangan'); ?>" placeholder="Keterangan" required="required">
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

								<!-- Tanggal Mulai Penelitian -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="tanggalPenelitian">Tanggal Mulai Penelitian <span class="text-danger">*</span></label>
											<input type="text" name="tanggalPenelitian" id="tanggalPenelitian" maxlength="16" class="form-control" value="<?= set_value('tanggalPenelitian'); ?>" placeholder="01-01-2021" required="required">
										</div>
									</div>
								</div>
								<!-- Tanggal Akhir Penelitian -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="tanggalAkhir">Tanggal Akhir Penelitian <span class="text-danger">*</span></label>
											<input type="text" name="tanggalAkhir" id="tanggalAkhir" maxlength="16" class="form-control" value="<?= set_value('tanggalAkhir'); ?>" placeholder="01-01-2021" required="required">
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
				</div>
			</form>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->

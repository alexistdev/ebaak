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
					<h1>Tambah Data Jurusan</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('Jurusan') ?>">Jurusan</a></li>
						<li class="breadcrumb-item active">Tambah Jurusan</li>
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
					echo $this->session->flashdata('pesan');
					echo $this->session->flashdata('pesan2'); ?>
				</div>
			</div>
			<form action="" method="post">
				<div class="row">
					<!--	Form Ruas Kiri		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- Kode Jurusan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="kodeJurusan">Kode Jurusan <span class="text-danger">*</span></label>
											<input type="text" name="kodeJurusan" id="kodeJurusan" maxlength="30" class="form-control" value="<?= set_value('kodeJurusan'); ?>" placeholder="Kode Jurusan" required="required">
										</div>
									</div>
								</div>
								<!-- Nama Jurusan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="namaJurusan">Nama Jurusan <span class="text-danger">*</span></label>
											<input type="text" name="namaJurusan" id="namaJurusan" maxlength="50" class="form-control" value="<?= set_value('namaJurusan'); ?>" placeholder="Nama Jurusan" required="required">
										</div>
									</div>
								</div>
								<!-- Submit -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary">Simpan</button>
											<a href="<?= base_url('Jurusan'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
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

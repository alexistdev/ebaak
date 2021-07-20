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
						<li class="breadcrumb-item"><a href="<?= base_url('Mahasiswa') ?>">Mahasiswa</a></li>
						<li class="breadcrumb-item active">Edit Mahasiswa</li>
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
			<form action="<?= base_url('Mahasiswa/edit/'.sanitasi($idUser)); ?>" method="post">
				<div class="row">
					<!--	Form Ruas Kiri		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- Jurusan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="namaJurusan">Jurusan <span class="text-danger">*</span></label>
											<select name="namaJurusan" id="namaJurusan" class="form-control" required="required">
												<option value="" <?= (sanitasi($jurusan) != '')? 'selected':''; ?>>=Pilih=</option>
												<?php foreach($pilihanJurusan as $rowJurusan) :?>
													<option value="<?= sanitasi($rowJurusan['id_jurusan']); ?>" <?= (sanitasi($jurusan) == sanitasi($rowJurusan['id_jurusan']))?'selected':''; ?> ><?= sanitasi(ucwords($rowJurusan['nama_jurusan'])); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<!-- Nama  Mahasiswa -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="namaMahasiswa">Nama Mahasiswa<span class="text-danger">*</span></label>
											<input type="text" name="namaMahasiswa" id="namaMahasiswa" maxlength="100" class="form-control" value="<?= sanitasi($namaMahasiswa); ?>" placeholder="Nama Mahasiswa" required="required">
										</div>
									</div>
								</div>
								<!-- NPM  Mahasiswa -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="npmMahasiswa">NPM<span class="text-danger">*</span></label>
											<input type="text" name="npmMahasiswa" id="npmMahasiswa" maxlength="50" class="form-control" value="<?= sanitasi($npmMahasiswa); ?>" placeholder="NPM" required="required">
										</div>
									</div>
								</div>
								<!-- Email  Mahasiswa -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="email">Email <span class="text-danger">*</span></label>
											<input type="email" name="email" id="email" maxlength="50" class="form-control" value="<?= sanitasi($emailMahasiswa); ?>" placeholder="Email" required="required">
										</div>
									</div>
								</div>
								<!-- Password -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="password">Password <span class="text-danger">*</span></label>
											<input type="password" name="password" id="password" maxlength="16" class="form-control" value="<?= set_value('password'); ?>" placeholder="******" ">
										</div>
									</div>
								</div>
								<!-- Submit -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary">Simpan</button>
											<a href="<?= base_url('Mahasiswa'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
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

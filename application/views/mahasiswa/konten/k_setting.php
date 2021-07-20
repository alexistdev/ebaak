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
					<h1>Setting</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
						<li class="breadcrumb-item active">Setting</li>
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
			<form action="<?= base_url('mahasiswa/setting'); ?>" method="post">
				<div class="row">
					<!--	Form Ruas Kiri		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- Nama Lengkap -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="namaLengkap">Nama Lengkap</label>
											<input type="text" name="namaLengkap" id="namaLengkap" maxlength="100" class="form-control" value="<?= sanitasi($namaAkun); ?>" placeholder="Nama Lengkap" required="required">
										</div>
									</div>
								</div>
								<!-- Email -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="email">Email</label>
											<input type="email" name="email" id="email" maxlength="50" class="form-control" value="<?= sanitasi($emailAkun); ?>" placeholder="Alamat Email" required="required">
										</div>
									</div>
								</div>
								<!-- Jurusan -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="jurusan">Jurusan</label>
											<select name="jurusan" id="jurusan" class="form-control" required="required">
												<option value="">Pilih</option>
												<?php foreach($jurusan->result_array() as $rowJurusan) :?>
													<option value="<?= sanitasi($rowJurusan['id_jurusan']); ?>"<?= (sanitasi($rowJurusan['id_jurusan']) == sanitasi($jurusanAkun))? "SELECTED": ""; ?>>

													<?= ucwords(sanitasi($rowJurusan['nama_jurusan'])); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<!-- Password Baru -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="password">Password Baru</label>
											<input type="password" name="password" id="password" maxlength="16" class="form-control" value="<?= set_value('password'); ?>" placeholder="******" >
										</div>
									</div>
								</div>

								<!-- Submit -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary">Ubah</button>
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

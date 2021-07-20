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
					<h1>Surat Tanda Lulus Sementara</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
						<li class="breadcrumb-item active">Surat Tanda Lulus</li>
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
			<form action="<?= base_url('mahasiswa/tandalulus'); ?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<!--	Form Ruas Kiri		-->
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<!-- Tempat Lahir -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="tempatlahir">Tempat Lahir <span class="text-danger">*</span></label>
											<input type="text" name="tempatlahir" id="tempatlahir" maxlength="50" class="form-control" value="<?= set_value('tempatlahir'); ?>" placeholder="Tempat Lahir" required="required">
										</div>
									</div>
								</div>
								<!-- Tanggal Lahir-->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="tglLahir">Tanggal Lahir <span class="text-danger">*</span></label>
											<input type="text" name="tglLahir" id="tglLahir" maxlength="16" class="form-control" value="<?= set_value('tglLahir'); ?>" placeholder="01-01-2021" required="required">
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
									<li>FORM SLS : <a href="http://baak.darmajaya.ac.id/wp-content/uploads/2020/11/4.FM-S-1.10.10-Form-Permohonan-Surat-Tanda-Lulus-Sementara-STLS.pdf">DOWNLOAD DISINI</a></li>
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

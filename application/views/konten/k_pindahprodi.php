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
					<h1>Data Surat Pindah Prodi</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member') ?>">Home</a></li>
						<li class="breadcrumb-item active">Surat Pindah Prodi</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Small boxes (Stat box) -->
			<div class="row">
				<div class="col-md-12">
					<!-- Start Pesan -->
					<?php
					echo $this->session->flashdata('notif');
					echo $this->session->flashdata('notif2');
					echo $this->session->flashdata('notif3');?>
					<!-- End Pesan -->
				</div>
			</div>
			<div class="row">
				<!-- Khusus Personal Hosting -->
				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title">Daftar Pindah Prodi</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="tabelSidang" class="table table-bordered table-hover" style="width: 100%">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Nama Mahasiswa</th>
									<th class="text-center">Alasan Pindah</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $no=1;foreach($dataPindahProdi as $rowProdi):
									$statusRiwayat = sanitasi($rowProdi['status_riwayat']);?>
								<tr>
									<td class="text-center"><?= $no++; ?></td>
									<td class="text-center"><?= sanitasi($rowProdi['nama']); ?></td>
									<td class="text-center"><?= sanitasi($rowProdi['alasan_pindah']); ?></td>
									<td class="text-center">
										<?php if($statusRiwayat == 3) {;?>
											<small class="badge badge-warning"> PENDING </small>
										<?php } else if($statusRiwayat == 2) {;?>
											<small class="badge badge-danger"> DITOLAK </small>
										<?php } else {;?>
											<small class="badge badge-success"> SELESAI </small>
										<?php };?>

									</td>
									<td class="text-center">
										<?php if($statusRiwayat == 3) {;?>
											<a href="<?= base_url('Pindahprodi/selesai/'.sanitasi($rowProdi['id_pindahprodi'])); ?>"><button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Selesai"><i class="fas fa-check-square"></i></button></a>
											<a href="<?= sanitasi($rowProdi['lampiran']); ?>" target="_blank"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Download File"><i class="fas fa-download"></i></button></a>
											<a href="<?= base_url('Pindahprodi/tolak/'.sanitasi($rowProdi['id_pindahprodi'])); ?>"><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Tolak"><i class="far fa-times-circle"></i></button></a>
										<?php } else if($statusRiwayat == 2) {;?>
											<a href="<?= base_url('Pindahprodi/selesai/'.sanitasi($rowProdi['id_pindahprodi'])); ?>"><button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Selesai"><i class="fas fa-check-square"></i></button></a>
											<a href="<?= sanitasi($rowProdi['lampiran']); ?>" target="_blank"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Download File"><i class="fas fa-download"></i></button></a>
										<?php } else {;?>
											<a href="<?= sanitasi($rowProdi['lampiran']); ?>" target="_blank"><button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Download File"><i class="fas fa-download"></i></button></a>
										<?php };?>
									</td>
								</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!--	Modal Kunci Pesan	-->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
			</div>
			<div class="modal-body">
				Apakah anda yakin ingin menghapus data ini ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<a href="" id="urlKunci"><button  type="button" class="btn btn-danger">Hapus</button></a>
			</div>
		</div>
	</div>
</div>
<!--	/Modal Kunci Pesan	-->

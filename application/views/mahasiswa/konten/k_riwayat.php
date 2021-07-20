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
					<h1>Riwayat Pengajuan Surat</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
						<li class="breadcrumb-item active">Riwayat Pengajuan Surat</li>
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
					echo $this->session->flashdata('notif1');
					echo $this->session->flashdata('notif2'); ?>
					<!-- End Pesan -->
				</div>
			</div>
			<div class="row">
				<!-- Khusus Personal Hosting -->
				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title">Riwayat Pengajuan Surat</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<table id="tabelRiwayat" class="table table-bordered table-hover" style="width: 100%">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Kode Surat</th>
									<th class="text-center">Nama Surat</th>
									<th class="text-center">Tanggal Lahir</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $no=1;
									foreach($dataRiwayat as $rowRiwayat):?>
									<tr>
										<td class="text-center"><?= sanitasi($no++);?></td>
										<td class="text-center"><?= sanitasi($rowRiwayat['kode_surat']);?></td>
										<td class="text-center"><?= sanitasi($rowRiwayat['nama_surat']);?></td>
										<td class="text-center"><?= date("d-m-Y",strtotime(sanitasi($rowRiwayat['tanggal_surat'])));?></td>
										<td class="text-center">
											<?php if(sanitasi($rowRiwayat['status_riwayat']) == 3) { ?>
												<small class="badge badge-warning"> PENDING </small>
											<?php } else if($rowRiwayat['status_riwayat'] == 2) { ?>
												<small class="badge badge-danger"> DITOLAK </small>
											<?php } else { ?>
												<small class="badge badge-success"> SELESAI </small>
											<?php } ?>
										<td class="text-center">
											<a href="<?= base_url('mahasiswa/riwayat/'.sanitasi($rowRiwayat['id_riwayat'])); ?>"><button class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button></a>
										</td>
									</tr>
								<?php endforeach;?>
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

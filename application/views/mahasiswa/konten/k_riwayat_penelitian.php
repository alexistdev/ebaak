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
					<h1>Riwayat Surat Penelitian</h1>
				</div>

				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('User') ?>">Home</a></li>
						<li class="breadcrumb-item"><a href="<?= base_url('mahasiswa/riwayat') ;?>">Riwayat Surat</a></li>
						<li class="breadcrumb-item active">Detail</li>
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
					<div class="card">
						<div class="card-body">
							<table class="table table-striped">
								<tbody>
								<?php foreach($pilihan5->result_array() as $rowSurat):;?>
									<tr>
										<th scope="row" width="20%">Judul Penelitian</th>
										<td width="5%">:</td>
										<td class="text-primary font-weight-bold"><?= strtoupper(sanitasi($rowSurat['judul_penelitian']));?></td>
									</tr>
									<tr>
										<th scope="row" width="20%">Ditujukan</th>
										<td width="5%">:</td>
										<td><?= ucwords(sanitasi($rowSurat['ditujukan']));?></td>

									</tr>
									<tr>
										<th scope="row" width="20%">Nama Instansi</th>
										<td width="5%">:</td>
										<td><?= ucwords(sanitasi($rowSurat['nama_instansi']));?></td>
									</tr>
									<tr>
										<th scope="row" width="20%">Alamat</th>
										<td width="5%">:</td>
										<td><?= ucwords(sanitasi($rowSurat['alamat_instansi']));?></td>
									</tr>
									<tr>
										<th scope="row" width="20%">Tanggal Mulai Penelitian</th>
										<td width="5%">:</td>
										<td><?= date("d-m-Y",strtotime(sanitasi($rowSurat['tanggal_mulai'])));?></td>
									</tr>
									<tr>
										<th scope="row" width="20%">Tanggal Akhir Penelitian</th>
										<td width="5%">:</td>
										<td><?= date("d-m-Y",strtotime(sanitasi($rowSurat['tanggal_akhir'])));?></td>
									</tr>
									<tr>
										<th scope="row" width="20%">Lampiran</th>
										<td width="5%">:</td>
										<td><a href="<?= sanitasi($rowSurat['lampiran']);?>">DOWNLOAD</a></td>
									</tr>
									<tr>
										<th scope="row" width="20%">Status</th>
										<td width="5%">:</td>
										<td>
											<?php if($statusRiwayat == 3) {;?>
												<small class="badge badge-warning"> PENDING </small>
											<?php } else if($statusRiwayat == 2) {;?>
												<small class="badge badge-danger"> DITOLAK </small>
											<?php } else {;?>
												<small class="badge badge-success"> SELESAI </small>
											<?php };?>
										</td>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
							<a href="<?= base_url('mahasiswa/riwayat') ;?>"><button class="btn btn-danger btn-sm float-right">Kembali</button></a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>
<!-- /.content-wrapper -->

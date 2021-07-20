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
					<h1>Riwayat Surat Pendaftaran Sidang</h1>
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
								<?php foreach($pilihan1->result_array() as $rowSidang):;?>
								<tr>
									<th scope="row" width="20%">Judul</th>
									<td width="5%">:</td>
									<td class="text-primary font-weight-bold"><?= strtoupper(sanitasi($rowSidang['judul']));?></td>
								</tr>
								<tr>
									<th scope="row" width="20%">Pembimbing</th>
									<td width="5%">:</td>
									<td><?= ucwords(sanitasi($rowSidang['pembimbing']));?></td>

								</tr>
								<tr>
									<th scope="row" width="20%">Penguji 1</th>
									<td width="5%">:</td>
									<td><?= ucwords(sanitasi($rowSidang['penguji1']));?></td>
								</tr>
								<tr>
									<th scope="row" width="20%">Penguji 2</th>
									<td width="5%">:</td>
									<td><?= ucwords(sanitasi($rowSidang['penguji2']));?></td>
								</tr>
								<tr>
									<th scope="row" width="20%">NIDN Pembimbing</th>
									<td width="5%">:</td>
									<td><?= ucwords(sanitasi($rowSidang['nidn_pembimbing']));?></td>
								</tr>
								<tr>
									<th scope="row" width="20%">SK Bimbingan</th>
									<td width="5%">:</td>
									<td><?= ucwords(sanitasi($rowSidang['nomor_sk']));?></td>
								</tr>
								<tr>
									<th scope="row" width="20%">Tanggal SK</th>
									<td width="5%">:</td>
									<td><?= date("d-m-Y",strtotime(sanitasi($rowSidang['tanggal_sk'])));?></td>
								</tr>
								<tr>
									<th scope="row" width="20%">Tanggal Bimbingan</th>
									<td width="5%">:</td>
									<td><?= date("d-m-Y",strtotime(sanitasi($rowSidang['tanggal_acc'])));?></td>
								</tr>
								<tr>
									<th scope="row" width="20%">Jumlah Bimbingan</th>
									<td width="5%">:</td>
									<td><?= sanitasi($rowSidang['jumlah_bimbingan']);?></td>
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

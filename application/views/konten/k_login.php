<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<div class="login-box">
	<div class="login-logo">
		<img src="<?= base_url('gambar/darmajaya.png'); ?>" alt="logo Ebaak" width="20%"><br>
		<a href="<?= base_url('Login'); ?>" class="text-white"><b>E</b>Baak</a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Dashoard Login</p>
			<p class="login-box-msg">
				<?php
				echo $this->session->flashdata('pesan');
				echo $this->session->flashdata('pesan2');
				echo $this->session->flashdata('pesan3');
				?>
			</p>

			<form action="<?= base_url('Login'); ?>" method="post">
				<div class="input-group mb-3">
					<input type="text" name="username" maxlength="30" class="form-control" placeholder="NPM" required="required">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" name="password" maxlength="16" class="form-control" placeholder="Password" required="required">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="icheck-primary">
							<?= $image; ?>
						</div>
					</div>
					<!-- /.col -->
					<div class="col-md-6">
						<input name="captcha" class="form-control" placeholder="Captcha"/>
					</div>
					<!-- /.col -->
				</div>
				<div class="row mt-4">
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary btn-block">Login</button>
					</div>
				</div>
			</form>

			<!-- /.social-auth-links -->

			<p class="mb-1 mt-4">
				Buat Akun ? <a href="<?= base_url('Daftar'); ?>">Daftar</a>
			</p>

		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->

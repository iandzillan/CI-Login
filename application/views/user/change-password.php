<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="col-md-6">
		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
		<?php if ($this->session->flashdata('message')) : ?>
			<?= $this->session->flashdata('message') ?>
			<?php $this->session->unset_userdata('message') ?>
		<?php endif; ?>
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Form Change Password</h6>
			</div>
			<div class="card-body">
				<form action="<?= base_url('user/updatepassword') ?>" method="POST">
					<div class="form-group row">
						<label for="password" class="col-sm-3 col-form-label">Current Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control <?= (form_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
							<?= form_error('password', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</div>
					<div class="form-group row">
						<label for="password1" class="col-sm-3 col-form-label">New Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control <?= (form_error('password1')) ? 'is-invalid' : ''; ?>" id="password1" name="password1">
							<?= form_error('password1', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</div>
					<div class="form-group row">
						<label for="password2" class="col-sm-3 col-form-label">Repeat Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control <?= (form_error('password2')) ? 'is-invalid' : ''; ?>" id="password2" name="password2">
							<?= form_error('password2', '<div class="invalid-feedback">', '</div>') ?>
						</div>
					</div>
					<div class="form-group row justify-content-end">
						<div class="col-sm-9">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

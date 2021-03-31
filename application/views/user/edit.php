<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="col-md-6 pl-0">
		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Form Edit Your Profile</h6>
			</div>
			<div class="card-body">
				<?php echo form_open_multipart('user/update'); ?>
				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="email" value="<?= $user['email']; ?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">Full Name</label>
					<div class="col-sm-10">
						<input type="text" class="form-control <?= (form_error('name')) ? 'is-invalid' : ''; ?>" id="name" value="<?= $user['name']; ?>" name="name">
						<?= form_error('name', '<div class="invalid-feedback">', '</div>') ?>
					</div>
				</div>
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">Image Profile</label>
					<div class="col-sm-4">
						<img src="<?= base_url('assets/img/profile/' . $user['image']) ?>" class="img-thumbnail img-preview">
					</div>
					<div class="col-sm">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="image" name="image" onchange="previewImg()">
							<label class="custom-file-label" for="image">Choose file</label>
						</div>
					</div>
				</div>
				<div class="form-group row justify-content-end">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Upload</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

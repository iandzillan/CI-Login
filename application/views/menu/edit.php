<!-- Begin Page Content -->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<!-- Page Heading -->
			<h1 class="h3 text-gray-800"><?= $title; ?></h1>

			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Edit Menu</h6>
				</div>
				<div class="card-body">
					<form action="<?= base_url('menu/update/' . $menu['id']) ?>" method="POST">
						<input type="hidden" name="id" id="id" value="<?= $menu['id']; ?>">
						<div class="form-group">
							<label for="menu">Change Menu Name</label>
							<input type="text" class="form-control <?= (form_error('menu')) ? 'is-invalid' : ''; ?>" id="menu" name="menu" value="<?= $menu['menu']; ?>">
							<?php if (form_error('menu')) : ?>
								<?= form_error('menu', '<div class="invalid-feedback">', '</div>') ?>
							<?php endif; ?>
						</div>
						<button type="button" class="btn btn-secondary" onclick="window.location.href ='<?= base_url('menu') ?>'">Back</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End of page content -->

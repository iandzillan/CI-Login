<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="col-md-6 pl-0">
		<!-- Page Heading -->
		<h1 class="h3 text-gray-800"><?= $title; ?></h1>
		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Add New Menu</a>
		<?= form_error('menu', '<div class="alert alert-danger col-md" role="alert">', '</div>') ?>
		<?php if ($this->session->flashdata('message')) : ?>
			<?= $this->session->flashdata('message'); ?>
			<?php $this->session->unset_userdata('message') ?>
		<?php endif; ?>
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Menu List</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Menu</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($menus as $menu) : ?>
								<tr>
									<td><?= $i++; ?></td>
									<td><?= $menu['menu']; ?></td>
									<td>
										<a href="#" class="badge badge-success">Edit</a>
										<a href="#" class="badge badge-danger">Delete</a>
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
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addModalLabel">Add New Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('menu/add') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="menu">Name of Menu</label>
						<input type="text" class="form-control" id="menu" name="menu">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

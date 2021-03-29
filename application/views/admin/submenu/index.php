<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="col-md-6 pl-0">
		<!-- Page Heading -->
		<h1 class="h3 text-gray-800"><?= $title; ?></h1>
		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Add New Sub Menu</a>
		<?= form_error('submenu', '<div class="alert alert-danger col-md" role="alert">', '</div>') ?>
		<?php if ($this->session->flashdata('message')) : ?>
			<?= $this->session->flashdata('message'); ?>
			<?php $this->session->unset_userdata('message') ?>
		<?php endif; ?>
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Sub Menu List</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Sub Menu</th>
								<th>Menu</th>
								<th>url</th>
								<th>icon</th>
								<th>Is Active</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($sub_menus as $sub_menu) : ?>
								<tr>
									<td><?= $i++; ?></td>
									<td><?= $sub_menu['title']; ?></td>
									<td><?= $sub_menu['menu']; ?></td>
									<td><?= $sub_menu['url']; ?></td>
									<td class="text-center"><i class="<?= $sub_menu['icon']; ?>"></i></td>
									<td>
										<?php if ($sub_menu['is_active'] == 1) : ?>
											Active
										<?php else : ?>
											Not Active
										<?php endif; ?>
									</td>
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
				<h5 class="modal-title" id="addModalLabel">Add New Sub Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('menu/add') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="title">Sub Menu</label>
						<input type="text" class="form-control" id="title" name="title">
					</div>
					<div class="form-group">
						<label for="url">URL</label>
						<input type="text" class="form-control" id="url" name="url">
					</div>
					<div class="form-group">
						<label for="icon">Icon</label>
						<input type="text" class="form-control" id="icon" name="icon">
					</div>
					<div class="form-group">
						<label for="menu_id">Menu</label>
						<select name="menu_id" id="menu_id" class="custom-select">
							<option value="">Choose</option>
							<?php foreach ($menu_id as $row) : ?>
								<option value="<?= $row['id']; ?>"><?= $row['menu']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
							<label class="form-check-label" for="is_active">
								Active?
							</label>
						</div </div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
			</form>
		</div>
	</div>
</div>

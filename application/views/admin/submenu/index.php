<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="col-md-8 pl-0">
		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Manage Sub Menu</h1>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-fade">
			Add New Sub Menu
		</button>
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
								<th>Icon</th>
								<th>Is Active?</th>
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
									<td><i class="<?= $sub_menu['icon']; ?>"></i></td>
									<td>
										<?php if ($sub_menu['is_active'] == 1) : ?>
											Active
										<?php else : ?>
											Not active
										<?php endif; ?>
									</td>
									<td>
										<a href="" class="badge badge-success">Edit</a>
										<a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteSubMenu<?= $sub_menu['id']; ?>">Delete</a>
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

<!-- Modal add sub menu -->
<div class="modal fade" id="modal-fade" tabindex="-1" role="dialog" aria-labelledby="modal-fadeLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-fadeLabel">Form Add New Sub Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('menu/addsubmenu') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="title">Sub Menu Name</label>
						<input type="text" class="form-control <?= (form_error('title')) ? 'is-invalid' : ''; ?>" id="title" name="title">
						<?= form_error('title', '<div class="invalid-feedback">', '</div>') ?>
					</div>
					<div class="form-group">
						<label for="url">URL</label>
						<input type="text" class="form-control <?= (form_error('url')) ? 'is-invalid' : ''; ?>" id="url" name="url">
						<?= form_error('url', '<div class="invalid-feedback">', '</div>') ?>
					</div>
					<div class="form-group">
						<label for="icon">Icon</label>
						<input type="text" class="form-control <?= (form_error('icon')) ? 'is-invalid' : ''; ?>" id="icon" name="icon">
						<?= form_error('icon', '<div class="invalid-feedback">', '</div>') ?>
					</div>
					<div class="form-group">
						<label for="menu_id">Menu</label>
						<select name="menu_id" id="menu_id" class="custom-select <?= (form_error('menu_id')) ? 'is-invalid' : ''; ?>">
							<option value="">Choose</option>
							<?php foreach ($menu_id as $row) : ?>
								<option value="<?= $row['id']; ?>"><?= $row['menu']; ?></option>
							<?php endforeach; ?>
						</select>
						<?= form_error('menu_id', '<div class="invalid-feedback">', '</div>') ?>
					</div>
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
							<label class="form-check-label" for="is_active">
								Active?
							</label>
						</div>
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
<!-- End of modal add sub menu -->

<?php foreach ($sub_menus as $sub_menu) : ?>
	<!-- Modal delete sub menu -->
	<div class="modal fade" id="deleteSubMenu<?= $sub_menu['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteSubMenu<?= $sub_menu['id']; ?>Label" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteSubMenu<?= $sub_menu['id']; ?>Label">Delete This Sub Menu?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('menu/deletesubmenu/' . $sub_menu['id']) ?>" method="POST">
					<div class="modal-body">
						<p>Sub Menu: <?= $sub_menu['title']; ?></p>
						<p>from</p>
						<p>Menu: <?= $sub_menu['menu']; ?></p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End of modal delete sub menu -->
<?php endforeach; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="col-md-6 pl-0">
		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
		<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-fade">
			Add New Role
		</button>
		<?php if ($this->session->flashdata('message')) : ?>
			<?= $this->session->flashdata('message'); ?>
			<?php $this->session->unset_userdata('message') ?>
		<?php endif; ?>

		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Role List</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Role</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($roles as $role) : ?>
								<tr>
									<td><?= $i++; ?></td>
									<td><?= $role['role']; ?></td>
									<td>
										<a href="<?= base_url('admin/roleaccess/' . $role['id']) ?>" class="badge badge-success">Access</a>
										<a href="" class="badge badge-info">Edit</a>
										<a href="" class="badge badge-danger" data-toggle="modal" data-target="#deleteRole<?= $role['id']; ?>">Delete</a>
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

<!-- Modal add role -->
<div class="modal fade" id="modal-fade" tabindex="-1" role="dialog" aria-labelledby="modal-fadeLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modal-fadeLabel">Form Add New Role</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/addrole') ?>" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label for="role">Role Name</label>
						<input type="text" class="form-control <?= (form_error('role')) ? 'is-invalid' : ''; ?>" id="role" name="role">
						<?= form_error('role', '<div class="invalid-feedback">', '</div>') ?>
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
<!-- End of modal add role -->

<?php foreach ($roles as $role) : ?>
	<!-- Modal delte role -->
	<div class="modal fade" id="deleteRole<?= $role['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteRole<?= $role['id']; ?>Label" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="deleteRole<?= $role['id']; ?>Label">Delete This Role?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?= base_url('admin/deleterole/' . $role['id']) ?>" method="POST">
					<div class="modal-body">
						Role : <b><?= $role['role']; ?></b>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-danger">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- End of modal delete role -->
<?php endforeach; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<div class="col-md-6 pl-0">
		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Role Access Menu Management</h1>
		<?php if ($this->session->flashdata('message')) : ?>
			<?= $this->session->flashdata("message"); ?>
			<?php $this->session->unset_userdata('message') ?>
		<?php endif; ?>
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Role: <b><?= $role['role']; ?></b></h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>Menu</th>
								<th>Access?</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($menus as $menu) : ?>
								<tr>
									<td><?= $i++; ?></td>
									<td><?= $menu['menu']; ?></td>
									<td>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" <?= check_access($role['id'], $menu['id']); ?> data-role="<?= $role['id']; ?>" data-menu="<?= $menu['id']; ?>">
										</div>
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

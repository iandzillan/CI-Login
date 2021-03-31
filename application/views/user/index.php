<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<?php if ($this->session->flashdata('message')) : ?>
		<?= $this->session->flashdata('meesage') ?>
		<?php $this->session->unset_userdata('message') ?>
	<?php endif; ?>
	<div class="card mb-3" style="max-width: 540px;">
		<div class="row no-gutters">
			<div class="col-md-6">
				<img src="<?= base_url('assets/img/profile/' . $user['image']) ?>" class="card-img p-1">
			</div>
			<div class="col-md-6">
				<div class="card-body">
					<h5 class="card-title"><?= $user['name']; ?></h5>
					<p class="card-text"><?= $user['email']; ?></p>
					<p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']) ?></small></p>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
										<?php if ($this->session->flashdata('message')) : ?>
											<?= $this->session->flashdata('message'); ?>
											<?php $this->session->unset_userdata('message') ?>
										<?php endif; ?>
									</div>
									<form class="user" method="POST" action="<?= base_url('auth/requestpass') ?>">
										<div class="form-group">
											<input type="text" class="form-control form-control-user <?= (form_error('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email') ?>">
											<?= form_error('email', '<div class="invalid-feedback pl-3">', '</div>') ?>
										</div>
										<button type="submit" class="btn btn-primary btn-user btn-block">
											Send Request
										</button>
									</form>
									<hr>
									<div class="text-center">
										<a class="small" href="<?= base_url('auth') ?>">Back to login</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

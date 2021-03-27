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
										<h1 class="h4 text-gray-900 mb-4">CI Login</h1>
										<?php if ($this->session->flashdata('message')) : ?>
											<?= $this->session->flashdata('message'); ?>
											<?php $this->session->unset_userdata('message') ?>
										<?php endif; ?>
									</div>
									<form class="user" method="POST" action="<?= base_url('auth/login') ?>">
										<div class="form-group">
											<input type="text" class="form-control form-control-user <?= (form_error('email')) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email') ?>">
											<?= form_error('email', '<div class="invalid-feedback pl-3">', '</div>') ?>
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user <?= (form_error('password')) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password">
											<?= form_error('password', '<div class="invalid-feedback pl-3">', '</div>') ?>
										</div>
										<button type="submit" class="btn btn-primary btn-user btn-block">
											Login
										</button>
									</form>
									<hr>
									<div class="text-center">
										<a class="small" href="#">Forgot Password?</a>
									</div>
									<div class="text-center">
										<a class="small" href="<?= base_url('auth/register') ?>">Create an Account!</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

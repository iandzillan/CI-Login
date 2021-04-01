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
										<h1 class="h4 text-gray-900">Reset Password for</h1>
										<h6 class="mb-4"><?= $this->session->userdata('reset_password'); ?></h6>
									</div>
									<form class="user" method="POST" action="">
										<div class="form-group">
											<input type="password" class="form-control form-control-user <?= (form_error('password')) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Enter new password...">
											<?= form_error('password', '<div class="invalid-feedback pl-3">', '</div>') ?>
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user <?= (form_error('password2')) ? 'is-invalid' : '' ?>" id="password2" name="password2" placeholder="Repeat password...">
											<?= form_error('password2', '<div class="invalid-feedback pl-3">', '</div>') ?>
										</div>
										<button type="submit" class="btn btn-primary btn-user btn-block">
											Reset Password
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

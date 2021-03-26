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
										<?php if ($this->session->flashdata('success')) : ?>
											<div class="alert alert-success" role="alert">
												Your account has been <?= $this->session->flashdata('success'); ?>, please login!
											</div>
											<?php $this->session->unset_userdata('success') ?>
										<?php endif; ?>
									</div>
									<form class="user">
										<div class="form-group">
											<input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address...">
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
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

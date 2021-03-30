</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; IDM CI_login <?= date('Y') ?></span>
		</div>
	</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets') ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets') ?>/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('assets') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('assets') ?>/js/demo/datatables-demo.js"></script>

<!-- Modal_show script -->
<script>
	<?php if ($modal_show) : ?>
		<?= $modal_show; ?>
	<?php endif; ?>
</script>
<!-- End of modal show script -->

<!-- Change access script -->
<script>
	// Get the tag input with class form-check-input, if it clicked, run the function
	$('.form-check-input').on('click', function() {
		// Get the data menu
		const menuId = $(this).data('menu');
		// Get the data role
		const roleId = $(this).data('role');
		// Run ajax
		$.ajax({
			// Set the url to send the data
			url: "<?= base_url('admin/changeaccess') ?>",
			// Set type of send method
			type: "post",
			// Set the data which will to be send to the url
			data: {
				menuId: menuId,
				roleId: roleId
			},
			// Set condition if send data success
			success: function() {
				// Redirect to role access page
				window.location.href = "<?= base_url('admin/roleaccess/') ?>" + roleId;
			}
		});
	});
</script>

</body>

</html>

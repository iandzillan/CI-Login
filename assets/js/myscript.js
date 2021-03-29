// Run the function when page is load
	$(function() {
		// Get class addMenu from tag a in admin/menu/index, and run this function when it clicked
		$(".addMenu").on("click", function() {
			// Get id formModalLabel from modal in admin/menu/index, and change the text
			$("#formModalLabel").html("Add New Menu");
		});

		// Get class editModal from edit button in admin/menu/index, and run this function when it clicked
		$(".editModal").on("click", function() {
			// Get id formModalLabel from modal in admin/menu/index, and change the text
			$("#formModalLabel").html("Edit Menu");
			// Get tag form in class modal-body from modal in admin/menu/index, and change the action attribute to edit menu controller
			$("#formModalLabel .modal-content form").attr("action", "<?php echo base_url('menu/update'); ?>");
			// Get id from data-id in edit button
			const id = $(this).data("id");
			let csrf_token = "";

			if (csrf_token == "") {
				csrf_token = "<?php echo $this->security->get_csrf_hash(); ?>"
			}

			// Run the ajax
			$.ajax({
				// Get data from controller getMenuId() in menu controller
				url: "<?php echo base_url('menu/getmenuid); ?>",
				// Send the id
				data: {
					csrf_token_name: csrf_token,
					id: id
				},
				// Use post method
				type: "POST",
				// Use JSON data type
				dataType: "json",
				// If success run this function
				success: function(data) {
					let k = JSON.parse(data);
					if (k.csrf_token) {
						csrf_token = k.csrf_token;
					}
					$("#menu").val(data.menu);
					$("#id").val(data.id);
				}
			});
		});
	});


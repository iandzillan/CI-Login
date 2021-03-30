		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
				<div class="sidebar-brand-icon">
					<i class="fab fa-fw fa-free-code-camp"></i>
				</div>
				<div class="sidebar-brand-text mx-3">IDM CI_Login</div>
			</a>
			<!-- Divider -->
			<hr class="sidebar-divider">

			<?php foreach ($sidebar_menus as $sidebar_menu) :  ?>

				<!-- Heading -->
				<div class="sidebar-heading">
					<?= $sidebar_menu['menu']; ?>
				</div>

				<!-- Query sub menu according menu id -->
				<?php
				$this->db->select('*');
				$this->db->from('user_sub_menu');
				$this->db->where('menu_id', $sidebar_menu['id']);
				$this->db->where('is_active', 1);
				$sub_menus = $this->db->get()->result_array();
				?>

				<?php foreach ($sub_menus as $sub_menu) : ?>
					<!-- Nav Item - Sub menu -->
					<li class="nav-item <?= ($sub_menu['title'] == $title) ? 'active' : '' ?>">
						<a class="nav-link pb-0" href="<?= base_url($sub_menu['url']) ?>">
							<i class="<?= $sub_menu['icon']; ?>"></i>
							<span><?= $sub_menu['title']; ?></span>
						</a>
					</li>
				<?php endforeach; ?>

				<!-- Divider -->
				<hr class="sidebar-divider mt-1">
			<?php endforeach; ?>

			<!-- Nav Item - Logout -->
			<li class="nav-item">
				<a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
					<i class="fas fa-sign-out-alt"></i>
					<span>Log out</span></a>
			</li>

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

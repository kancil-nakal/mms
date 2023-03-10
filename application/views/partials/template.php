<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>MMS - <?= $title; ?></title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= base_url('assets'); ?>/img/mms-logo.jpg" rel="icon">
	<link href="<?= base_url('assets'); ?>/img/mms-logo.jpg" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url('assets'); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url('assets'); ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url('assets'); ?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url('assets'); ?>/vendor/quill/quill.snow.css" rel="stylesheet">
	<link href="<?= base_url('assets'); ?>/vendor/quill/quill.bubble.css" rel="stylesheet">
	<link href="<?= base_url('assets'); ?>/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?= base_url('assets'); ?>/vendor/simple-datatables/style.css" rel="stylesheet">

	<!-- FontAwesom -->
	<script src="https://kit.fontawesome.com/56427c2ef3.js" crossorigin="anonymous"></script>
	<!-- Template Main CSS File -->
	<link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet">

	<!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

	<!-- ======= Header ======= -->
	<header id="header" class="header fixed-top d-flex align-items-center">

		<div class="d-flex align-items-center justify-content-between">
			<a href="<?= base_url('/'); ?>" class="logo d-flex align-items-center">
				<img src="<?= base_url('assets'); ?>/img/mms-logo.jpg" alt="">
				<span class="d-none d-lg-block">MMS</span>
			</a>
			<i class="bi bi-list toggle-sidebar-btn"></i>
		</div><!-- End Logo -->



		<nav class="header-nav ms-auto">
			<ul class="d-flex align-items-center">

				<li class="nav-item dropdown">

					<a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
						<i class="bi bi-bell"></i>
						<span class="badge bg-primary badge-number">4</span>
					</a><!-- End Notification Icon -->

					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
						<li class="dropdown-header">
							You have 4 new notifications
							<a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li class="notification-item">
							<i class="bi bi-exclamation-circle text-warning"></i>
							<div>
								<h4>Lorem Ipsum</h4>
								<p>Quae dolorem earum veritatis oditseno</p>
								<p>30 min. ago</p>
							</div>
						</li>

						<li>
							<hr class="dropdown-divider">
						</li>

						<li class="notification-item">
							<i class="bi bi-x-circle text-danger"></i>
							<div>
								<h4>Atque rerum nesciunt</h4>
								<p>Quae dolorem earum veritatis oditseno</p>
								<p>1 hr. ago</p>
							</div>
						</li>

						<li>
							<hr class="dropdown-divider">
						</li>

						<li class="notification-item">
							<i class="bi bi-check-circle text-success"></i>
							<div>
								<h4>Sit rerum fuga</h4>
								<p>Quae dolorem earum veritatis oditseno</p>
								<p>2 hrs. ago</p>
							</div>
						</li>

						<li>
							<hr class="dropdown-divider">
						</li>

						<li class="notification-item">
							<i class="bi bi-info-circle text-primary"></i>
							<div>
								<h4>Dicta reprehenderit</h4>
								<p>Quae dolorem earum veritatis oditseno</p>
								<p>4 hrs. ago</p>
							</div>
						</li>

						<li>
							<hr class="dropdown-divider">
						</li>
						<li class="dropdown-footer">
							<a href="#">Show all notifications</a>
						</li>

					</ul><!-- End Notification Dropdown Items -->

				</li><!-- End Notification Nav -->



				<li class="nav-item dropdown pe-3">

					<a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
						<img src="<?= base_url('assets'); ?>/img/profile-img.jpg" alt="Profile" class="rounded-circle">
						<span class="d-none d-md-block dropdown-toggle ps-2"><?= $this->fungsi->user_login()->name ?></span>
					</a><!-- End Profile Iamge Icon -->

					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
						<li class="dropdown-header">
							<h6><?= $this->fungsi->user_login()->name ?></h6>
							<span><?= ucwords($this->fungsi->user_login()->role) ?></span>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>

						<li>
							<a class="dropdown-item d-flex align-items-center" href="<?= base_url('auth/logout'); ?>">
								<i class="bi bi-box-arrow-right"></i>
								<span>Logout</span>
							</a>
						</li>

					</ul><!-- End Profile Dropdown Items -->
				</li><!-- End Profile Nav -->

			</ul>
		</nav><!-- End Icons Navigation -->

	</header><!-- End Header -->

	<!-- ======= Sidebar ======= -->
	<aside id="sidebar" class="sidebar">

		<ul class="sidebar-nav" id="sidebar-nav">

			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? '' : 'collapsed'; ?>" href="<?= base_url('dashboard'); ?>">
					<i class="bi bi-grid"></i>
					<span>Dashboard</span>
				</a>
			</li><!-- End Dashboard Nav -->
			<?php if ($this->fungsi->user_login()->id_role == 1 || $this->fungsi->user_login()->id_role == 2 || $this->fungsi->user_login()->id_role == 3) : ?>
				<li class="nav-item">
					<a class="nav-link <?= $this->uri->segment(1) == 'project'  ? '' : 'collapsed'; ?>" href="<?= base_url('project'); ?>">
						<i class="bi bi-calendar-week"></i>
						<span>Project</span>
					</a>
				</li>
			<?php endif; ?>

			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(1) == 'request'  ? '' : 'collapsed'; ?>" data-bs-target="#request-nav" data-bs-toggle="collapse" href="#">
					<i class=" bi bi-check-all"></i><span>Request</span><i class="bi bi-chevron-down ms-auto"></i>
				</a>
				<ul id="request-nav" class="nav-content collapse <?= $this->uri->segment(1) == 'request'  ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
					<li>
						<a href="<?= base_url('request/in'); ?>" class="<?= $this->uri->segment(1) == 'request' && $this->uri->segment(2) == 'in' || $this->uri->segment(4) == 'in' ? 'active' : ''; ?>">
							<i class="bi bi-circle"></i><span>In</span>
						</a>
					</li>
					<li>
						<a href="<?= base_url('request/out'); ?>" class="<?= $this->uri->segment(1) == 'request' && $this->uri->segment(2) == 'out' ? 'active' : ''; ?>">
							<i class="bi bi-circle"></i><span>Out</span>
						</a>
					</li>
				</ul>
			</li>

			<!-- <li class="nav-item">
        <a class="nav-link <?= $this->uri->segment(1) == 'request'  ? '' : 'collapsed'; ?>" href="<?= base_url('request'); ?>">
          <i class="bi bi-clipboard-check"></i>
          <span>Request</span>
        </a> -->
			</li>

			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(1) == 'stock' || $this->uri->segment(2) == 'material' ? '' : 'collapsed'; ?>" href="<?= base_url('stock/material'); ?>">
					<i class="bi bi-box"></i>
					<span> Stock</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link <?= $this->uri->segment(1) == 'report'  ? '' : 'collapsed'; ?>" href="<?= base_url('report'); ?>">
					<i class="bi bi-receipt"></i>
					<span>Report</span>
				</a>
			</li>



			<!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#reports-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-earmark-text"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="reports-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Project</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Material Request</span>
            </a>
          </li>
          <li>
            <a href="">
              <i class="bi bi-circle"></i><span>Material Stock</span>
            </a>
          </li>
        </ul>
      </li> -->
			<!-- End Components Nav -->
			<?php if ($this->fungsi->user_login()->id_role == 1) : ?>
				<li class="nav-heading">Settings</li>

				<li class="nav-item">
					<a href="<?= base_url('user'); ?>" class="nav-link <?= $this->uri->segment(1) == 'user' ? '' : 'collapsed'; ?>">
						<i class=" bi bi-person"></i>
						<span>User</span>
					</a>
				</li><!-- End User Nav -->

				<li class="nav-item">
					<a class="nav-link <?= $this->uri->segment(1) == 'material' ? '' : 'collapsed'; ?>" href="<?= base_url('material'); ?>">
						<i class="bi bi-box-seam"></i>
						<span>Meterial</span>
					</a>
				</li>
			<?php endif ?>
		</ul>

	</aside><!-- End Sidebar-->

	<main id="main" class="main">

		<script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>

		<?= $contents; ?>

	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<!-- <footer id="footer" class="footer">
		<div class="copyright">
			&copy; Copyright <strong><span>KancilNakal</span></strong>. All Rights Reserved
		</div>
		<div class="credits">

			Designed by <a href="https://kancilnakal.com/">KnCorp</a>
		</div>
	</footer> -->
	<!-- End Footer -->

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<!-- Vendor JS Files -->

	<script src="<?= base_url('assets'); ?>/vendor/apexcharts/apexcharts.min.js"></script>
	<script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('assets'); ?>/vendor/chart.js/chart.min.js"></script>
	<script src="<?= base_url('assets'); ?>/vendor/echarts/echarts.min.js"></script>
	<script src="<?= base_url('assets'); ?>/vendor/quill/quill.min.js"></script>
	<script src="<?= base_url('assets'); ?>/vendor/simple-datatables/simple-datatables.js"></script>
	<script src="<?= base_url('assets'); ?>/vendor/tinymce/tinymce.min.js"></script>
	<script src="<?= base_url('assets'); ?>/vendor/php-email-form/validate.js"></script>

	<!-- Template Main JS File -->
	<script src="<?= base_url('assets'); ?>/js/main.js"></script>

</body>

</html>

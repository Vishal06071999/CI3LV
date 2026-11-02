<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo title ?> - <?php echo(!empty($header)?  $header:'');  ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?php echo base_url() ?>/assets/Admin/css/style.css" rel="stylesheet">
</head>
<body>
  <!-- Sidebar -->
  <nav class="sidebar" id="sidebar">
    <div class="sidebar-brand d-flex align-items-center gap-2">
      <i class="bi bi-shield-check fs-4"></i>
      <span><?php echo(!empty($header)?  $header:'');  ?></span>
    </div>
    <ul class="nav flex-column mt-3">
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo base_url('admin-dashboard'); ?>"><i class="bi bi-speedometer2"></i> Dashboard</a>
      </li>
     
    </ul>
    <!-- Dropdown Menu -->
  <?php
 foreach(admin_header() as $headerKey => $headerValue){
  ?>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle"
       href="#"
       id="headerKey"
       role="button"
       data-bs-toggle="dropdown"
       aria-expanded="false">
        <i class="bi bi-grid"></i> <?=  $headerKey ?>
    </a>

    <ul class="dropdown-menu" aria-labelledby="adminDropdown">
      <?php foreach($headerValue as $link){ ?>
        <li>
            <a class="dropdown-item" href="<?= base_url($link['url']); ?>">
                <i class="bi bi-people me-2"></i> <?= $link['name']; ?>
            </a>
        </li>
<?php } ?>
    </ul>
</li>
<?php } ?>
 <li class="nav-item">
        <a class="nav-link text-danger" href="<?php echo base_url('admin-logout'); ?>"><i class="bi bi-box-arrow-left"></i> Logout</a>
      </li>
  </nav>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Top Navbar -->
    <nav class="top-navbar d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-light d-lg-none" id="sidebarToggle"><i class="bi bi-list fs-5"></i></button>
        <h5 class="mb-0 fw-semibold"><?php echo(!empty($header)?  $header:'');  ?></h5>
      </div>
      <div class="d-flex align-items-center gap-3">
        <div class="position-relative">
          <i class="bi bi-bell fs-5 text-secondary"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">3</span>
        </div>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
            <img src="https://ui-avatars.com/api/?name=Admin&background=3b82f6&color=fff" class="avatar avatar-sm me-2" alt="Admin">
            <span class="d-none d-md-inline text-dark fw-medium">Admin</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0">
            <li><a class="dropdown-item" href="settings.html"><i class="bi bi-person me-2"></i> Profile</a></li>
            <li><a class="dropdown-item" href="settings.html"><i class="bi bi-gear me-2"></i> Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="<?php echo base_url('admin-logout') ?>"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
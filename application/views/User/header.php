<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo title ?> - <?php echo(!empty($header)?  $header:'');  ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>/assets/User/css/style.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

 
</head>
<body>
  <nav class="sidebar" id="sidebar">
    <div class="sidebar-brand d-flex align-items-center gap-2">
      <img src="<?php echo logo; ?>" class="fs-4" width="100px">
      <!-- <i class="bi bi-person-circle fs-4"></i> -->
      <span></span>
    </div>
    <ul class="nav flex-column mt-3">
      <li class="nav-item"><a class="nav-link active" href="dashboard.html"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
      <li class="nav-item"><a class="nav-link" href="orders.html"><i class="bi bi-bag-check"></i> My Orders</a></li>
      <li class="nav-item"><a class="nav-link" href="wishlist.html"><i class="bi bi-heart"></i> Wishlist</a></li>
      <li class="nav-item"><a class="nav-link" href="profile.html"><i class="bi bi-person"></i> Profile</a></li>
      <li class="nav-item"><a class="nav-link" href="settings.html"><i class="bi bi-gear"></i> Settings</a></li>
      <li class="nav-item mt-4"><a class="nav-link text-danger" href="<?php echo base_url('logout'); ?>"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
    </ul>
  </nav>
    <div class="main-content">
    <nav class="top-navbar d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-3">
        <button class="btn btn-light d-lg-none" id="sidebarToggle"><i class="bi bi-list fs-5"></i></button>
        <h5 class="mb-0 fw-semibold"><?php echo(!empty($header)?  $header:'');  ?></h5>
      </div>
      <div class="d-flex align-items-center gap-3">
        <div class="position-relative">
          <i class="bi bi-bell fs-5 text-secondary"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">2</span>
        </div>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
            <img src="https://ui-avatars.com/api/?name=<?php echo $user['name']; ?>&background=10b981&color=fff" class="avatar avatar-sm me-2" alt="User">
            <span class="d-none d-md-inline text-dark fw-medium"><?php echo $user['name']; ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0">
            <li><a class="dropdown-item" href="profile.html"><i class="bi bi-person me-2"></i> Profile</a></li>
            <li><a class="dropdown-item" href="settings.html"><i class="bi bi-gear me-2"></i> Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="<?php echo base_url('logout'); ?>"><i class="bi bi-box-arrow-left me-2"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
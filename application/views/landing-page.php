<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AdminUser Panel – Modern Admin & User Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets/Site/css/style.css') ?>" rel="stylesheet">

</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top border-bottom">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
        <span class="logo-icon">
          <!-- Custom Logo SVG -->
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2L4 6v6c0 5.25 3.4 10.15 8 11.5 4.6-1.35 8-6.25 8-11.5V6l-8-4z" fill="white" fill-opacity="0.95"/>
            <path d="M12 7a3 3 0 100 6 3 3 0 000-6z" fill="#4f46e5"/>
            <path d="M8.5 16.5c0-1.5 1.5-2.5 3.5-2.5s3.5 1 3.5 2.5" stroke="#4f46e5" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </span>
        <span>AdminUser</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav mx-auto gap-lg-3">
          <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
          <li class="nav-item"><a class="nav-link" href="#panels">Panels</a></li>
          <li class="nav-item"><a class="nav-link" href="#pages">Pages</a></li>
          <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
        </ul>
        <div class="d-flex gap-2">
          <a href="index.html" class="btn btn-outline-primary btn-sm px-3 rounded-pill">Login</a>
          <a href="register.html" class="btn btn-primary btn-sm px-3 rounded-pill">Get Started</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Hero -->
  <section class="hero d-flex align-items-center text-white">
    <!-- Decorative blobs -->
    <div class="floating-shape" style="width:400px;height:400px;background:#6366f1;top:-100px;left:-100px;"></div>
    <div class="floating-shape" style="width:300px;height:300px;background:#06b6d4;bottom:10%;right:5%;"></div>

    <div class="container position-relative" style="z-index:1;">
      <div class="row align-items-center min-vh-100 py-5">
        <div class="col-lg-6 pt-5">
          <span class="badge badge-glow mb-3 px-3 py-2 rounded-pill">
            <i class="bi bi-stars me-1"></i> Bootstrap 5 Ready
          </span>
          <h1 class="display-4 fw-bold mb-3" style="letter-spacing:-0.03em; line-height:1.15;">
            Modern Admin & User<br>
            <span style="background: linear-gradient(90deg,#a5b4fc,#67e8f9); -webkit-background-clip:text; -webkit-text-fill-color:transparent;">Dashboard Template</span>
          </h1>
          <p class="lead text-white-50 mb-4" style="max-width:480px;">
            Clean, responsive multi-page panel for Admin and Users. Built with Bootstrap 5 – ready to connect with your backend.
          </p>
          <div class="d-flex flex-wrap gap-3 mb-5">
            <a href="index.html" class="btn btn-primary btn-lg px-4 btn-glow rounded-pill">
              <i class="bi bi-box-arrow-in-right me-2"></i>Live Demo
            </a>
            <a href="#features" class="btn btn-outline-light btn-lg px-4 rounded-pill">
              Explore Features
            </a>
          </div>
          <div class="d-flex flex-wrap gap-3">
            <div class="stat-box">
              <h4 class="fw-bold mb-0">15+</h4>
              <small class="text-white-50">Pages</small>
            </div>
            <div class="stat-box">
              <h4 class="fw-bold mb-0">100%</h4>
              <small class="text-white-50">Responsive</small>
            </div>
            <div class="stat-box">
              <h4 class="fw-bold mb-0">Bootstrap 5</h4>
              <small class="text-white-50">Latest</small>
            </div>
          </div>
        </div>

        <div class="col-lg-6 d-none d-lg-block pt-5">
          <div class="preview-card bg-dark">
            <div class="bg-secondary bg-opacity-25 p-2 d-flex gap-1 align-items-center">
              <span class="rounded-circle bg-danger" style="width:10px;height:10px;"></span>
              <span class="rounded-circle bg-warning" style="width:10px;height:10px;"></span>
              <span class="rounded-circle bg-success" style="width:10px;height:10px;"></span>
              <span class="ms-auto text-white-50 small pe-2">AdminUser • Dashboard</span>
            </div>
            <div class="p-4 text-center" style="min-height:340px; background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);">
              <div class="d-flex gap-3 justify-content-center mb-4">
                <div class="rounded-3 p-3 text-start" style="width:150px; background:rgba(79,70,229,0.18); border:1px solid rgba(99,102,241,0.3);">
                  <i class="bi bi-people text-primary fs-4"></i>
                  <p class="mb-0 small text-white-50 mt-2">Users</p>
                  <h5 class="text-white mb-0">2,847</h5>
                </div>
                <div class="rounded-3 p-3 text-start" style="width:150px; background:rgba(16,185,129,0.15); border:1px solid rgba(52,211,153,0.3);">
                  <i class="bi bi-cart-check text-success fs-4"></i>
                  <p class="mb-0 small text-white-50 mt-2">Orders</p>
                  <h5 class="text-white mb-0">1,245</h5>
                </div>
              </div>
              <div class="rounded-3 p-3 mx-auto" style="max-width:300px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08);">
                <div class="d-flex align-items-center gap-2 mb-3">
                  <div class="rounded-circle" style="width:32px;height:32px;background:var(--gradient-primary);"></div>
                  <div class="flex-grow-1">
                    <div class="bg-white bg-opacity-20 rounded" style="height:8px;width:70%;"></div>
                    <div class="bg-white bg-opacity-10 rounded mt-1" style="height:6px;width:40%;"></div>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-2 mb-3">
                  <div class="rounded-circle bg-success" style="width:32px;height:32px;"></div>
                  <div class="flex-grow-1">
                    <div class="bg-white bg-opacity-20 rounded" style="height:8px;width:55%;"></div>
                    <div class="bg-white bg-opacity-10 rounded mt-1" style="height:6px;width:30%;"></div>
                  </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                  <div class="rounded-circle bg-warning" style="width:32px;height:32px;"></div>
                  <div class="flex-grow-1">
                    <div class="bg-white bg-opacity-20 rounded" style="height:8px;width:85%;"></div>
                    <div class="bg-white bg-opacity-10 rounded mt-1" style="height:6px;width:50%;"></div>
                  </div>
                </div>
              </div>
              <p class="text-white-50 small mt-3 mb-0">Admin Dashboard Preview</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Features -->
  <section id="features" class="py-5 bg-light">
    <div class="container py-5">
      <div class="text-center mb-5">
        <h2 class="section-title display-6">Everything You Need</h2>
        <p class="text-muted col-md-6 mx-auto">A complete frontend kit for building Admin and User dashboards quickly and beautifully.</p>
      </div>
      <div class="row g-4">
        <div class="col-md-6 col-lg-4">
          <div class="card feature-card h-100 border-0 shadow-sm p-2">
            <div class="card-body">
              <div class="feature-icon bg-primary bg-opacity-10 text-primary mb-3">
                <i class="bi bi-layout-sidebar"></i>
              </div>
              <h5 class="fw-semibold">Responsive Sidebar</h5>
              <p class="text-muted mb-0">Collapsible sidebar that works perfectly on mobile, tablet and desktop.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card feature-card h-100 border-0 shadow-sm p-2">
            <div class="card-body">
              <div class="feature-icon bg-success bg-opacity-10 text-success mb-3">
                <i class="bi bi-people"></i>
              </div>
              <h5 class="fw-semibold">Dual Role Panels</h5>
              <p class="text-muted mb-0">Separate Admin and User panels with dedicated pages and navigation.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card feature-card h-100 border-0 shadow-sm p-2">
            <div class="card-body">
              <div class="feature-icon bg-warning bg-opacity-10 text-warning mb-3">
                <i class="bi bi-table"></i>
              </div>
              <h5 class="fw-semibold">Data Tables</h5>
              <p class="text-muted mb-0">Users, Orders, Products tables with search, filters and action buttons.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card feature-card h-100 border-0 shadow-sm p-2">
            <div class="card-body">
              <div class="feature-icon bg-info bg-opacity-10 text-info mb-3">
                <i class="bi bi-graph-up"></i>
              </div>
              <h5 class="fw-semibold">Stats & Reports</h5>
              <p class="text-muted mb-0">Dashboard cards, activity feed and report placeholders ready for charts.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card feature-card h-100 border-0 shadow-sm p-2">
            <div class="card-body">
              <div class="feature-icon bg-danger bg-opacity-10 text-danger mb-3">
                <i class="bi bi-shield-lock"></i>
              </div>
              <h5 class="fw-semibold">Auth Pages</h5>
              <p class="text-muted mb-0">Login (User/Admin tabs) and Registration pages with modern design.</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card feature-card h-100 border-0 shadow-sm p-2">
            <div class="card-body">
              <div class="feature-icon bg-secondary bg-opacity-10 text-secondary mb-3">
                <i class="bi bi-phone"></i>
              </div>
              <h5 class="fw-semibold">Mobile First</h5>
              <p class="text-muted mb-0">Fully responsive design that looks great on every screen size.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Panels -->
  <section id="panels" class="py-5">
    <div class="container py-5">
      <div class="text-center mb-5">
        <h2 class="section-title display-6">Two Powerful Panels</h2>
        <p class="text-muted">Choose your role and explore the dedicated experience.</p>
      </div>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="card panel-card border-0 shadow-lg h-100">
            <div class="card-body p-0">
              <div class="p-4 text-white" style="background: var(--gradient-admin);">
                <div class="d-flex align-items-center gap-3 mb-3">
                  <div class="bg-white bg-opacity-20 rounded-3 p-2">
                    <i class="bi bi-shield-check fs-3"></i>
                  </div>
                  <div>
                    <h4 class="fw-bold mb-0">Admin Panel</h4>
                    <small class="opacity-75">Full control & management</small>
                  </div>
                </div>
                <ul class="list-unstyled mb-0 small opacity-90">
                  <li class="mb-2"><i class="bi bi-check2-circle me-2"></i>Dashboard with stats & activity</li>
                  <li class="mb-2"><i class="bi bi-check2-circle me-2"></i>Users management + Add modal</li>
                  <li class="mb-2"><i class="bi bi-check2-circle me-2"></i>Products, Orders, Reports</li>
                  <li><i class="bi bi-check2-circle me-2"></i>Settings (Profile, Security, etc.)</li>
                </ul>
              </div>
              <div class="p-4 text-center bg-white">
                <a href="index.html" class="btn btn-dark w-100 rounded-pill py-2">Login as Admin</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card panel-card border-0 shadow-lg h-100">
            <div class="card-body p-0">
              <div class="p-4 text-white" style="background: var(--gradient-user);">
                <div class="d-flex align-items-center gap-3 mb-3">
                  <div class="bg-white bg-opacity-20 rounded-3 p-2">
                    <i class="bi bi-person-circle fs-3"></i>
                  </div>
                  <div>
                    <h4 class="fw-bold mb-0">User Panel</h4>
                    <small class="opacity-75">Customer experience</small>
                  </div>
                </div>
                <ul class="list-unstyled mb-0 small opacity-90">
                  <li class="mb-2"><i class="bi bi-check2-circle me-2"></i>Personal dashboard & stats</li>
                  <li class="mb-2"><i class="bi bi-check2-circle me-2"></i>My Orders with tracking</li>
                  <li class="mb-2"><i class="bi bi-check2-circle me-2"></i>Wishlist management</li>
                  <li><i class="bi bi-check2-circle me-2"></i>Profile & Account settings</li>
                </ul>
              </div>
              <div class="p-4 text-center bg-white">
                <a href="index.html" class="btn btn-success w-100 rounded-pill py-2">Login as User</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Pages List -->
  <section id="pages" class="py-5 bg-light">
    <div class="container py-5">
      <div class="text-center mb-5">
        <h2 class="section-title display-6">All Pages Included</h2>
        <p class="text-muted">15+ ready-to-use HTML pages</p>
      </div>
      <div class="row g-3 justify-content-center">
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-box-arrow-in-right text-primary fs-3 mb-2"></i>
            <small class="fw-medium">Login</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-person-plus text-success fs-3 mb-2"></i>
            <small class="fw-medium">Register</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-speedometer2 text-primary fs-3 mb-2"></i>
            <small class="fw-medium">Admin Dashboard</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-people text-info fs-3 mb-2"></i>
            <small class="fw-medium">Users</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-box-seam text-warning fs-3 mb-2"></i>
            <small class="fw-medium">Products</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-cart-check text-success fs-3 mb-2"></i>
            <small class="fw-medium">Orders</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-bar-chart text-danger fs-3 mb-2"></i>
            <small class="fw-medium">Reports</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-person-circle text-primary fs-3 mb-2"></i>
            <small class="fw-medium">User Dashboard</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-bag-check text-success fs-3 mb-2"></i>
            <small class="fw-medium">My Orders</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-heart text-danger fs-3 mb-2"></i>
            <small class="fw-medium">Wishlist</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-person text-info fs-3 mb-2"></i>
            <small class="fw-medium">Profile</small>
          </div>
        </div>
        <div class="col-6 col-md-4 col-lg-3">
          <div class="card page-pill border-0 shadow-sm text-center p-3 h-100">
            <i class="bi bi-gear text-secondary fs-3 mb-2"></i>
            <small class="fw-medium">Settings</small>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Pricing / CTA -->
  <section id="pricing" class="py-5">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-9">
          <div class="card cta-card border-0">
            <div class="row g-0">
              <div class="col-md-5 text-white p-5 d-flex flex-column justify-content-center" style="background: var(--gradient-cta);">
                <div class="logo-icon mb-3" style="width:48px;height:48px;">
                  <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="26" height="26">
                    <path d="M12 2L4 6v6c0 5.25 3.4 10.15 8 11.5 4.6-1.35 8-6.25 8-11.5V6l-8-4z" fill="white" fill-opacity="0.95"/>
                    <path d="M12 7a3 3 0 100 6 3 3 0 000-6z" fill="#4f46e5"/>
                    <path d="M8.5 16.5c0-1.5 1.5-2.5 3.5-2.5s3.5 1 3.5 2.5" stroke="#4f46e5" stroke-width="1.5" stroke-linecap="round"/>
                  </svg>
                </div>
                <h3 class="fw-bold mb-2">Free Template</h3>
                <p class="opacity-90 mb-0">Download and use it for personal or commercial projects. No strings attached.</p>
              </div>
              <div class="col-md-7 p-5 bg-white">
                <h4 class="fw-bold mb-3">Ready to start?</h4>
                <p class="text-muted mb-4">Open the login page and explore Admin or User panels instantly.</p>
                <div class="d-flex flex-wrap gap-2">
                  <a href="index.html" class="btn btn-primary px-4 rounded-pill">
                    <i class="bi bi-play-fill me-1"></i> Open Demo
                  </a>
                  <a href="register.html" class="btn btn-outline-primary px-4 rounded-pill">Register</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-white py-5">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4">
          <div class="d-flex align-items-center gap-2 mb-3">
            <span class="logo-icon">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L4 6v6c0 5.25 3.4 10.15 8 11.5 4.6-1.35 8-6.25 8-11.5V6l-8-4z" fill="white" fill-opacity="0.95"/>
                <path d="M12 7a3 3 0 100 6 3 3 0 000-6z" fill="#4f46e5"/>
                <path d="M8.5 16.5c0-1.5 1.5-2.5 3.5-2.5s3.5 1 3.5 2.5" stroke="#4f46e5" stroke-width="1.5" stroke-linecap="round"/>
              </svg>
            </span>
            <span class="fw-bold fs-5">AdminUser</span>
          </div>
          <p class="text-white-50 small mb-0">Modern Bootstrap 5 Admin & User dashboard template. Clean, responsive and ready for production.</p>
        </div>
        <div class="col-6 col-md-2">
          <h6 class="fw-semibold mb-3">Pages</h6>
          <ul class="list-unstyled small text-white-50">
            <li class="mb-2"><a href="index.html" class="text-white-50 text-decoration-none">Login</a></li>
            <li class="mb-2"><a href="register.html" class="text-white-50 text-decoration-none">Register</a></li>
            <li class="mb-2"><a href="admin/dashboard.html" class="text-white-50 text-decoration-none">Admin</a></li>
            <li><a href="user/dashboard.html" class="text-white-50 text-decoration-none">User</a></li>
          </ul>
        </div>
        <div class="col-6 col-md-3">
          <h6 class="fw-semibold mb-3">Features</h6>
          <ul class="list-unstyled small text-white-50">
            <li class="mb-2">Responsive Sidebar</li>
            <li class="mb-2">Dual Role Panels</li>
            <li class="mb-2">Data Tables</li>
            <li>Auth Pages</li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6 class="fw-semibold mb-3">Tech</h6>
          <ul class="list-unstyled small text-white-50">
            <li class="mb-2">Bootstrap 5.3</li>
            <li class="mb-2">Bootstrap Icons</li>
            <li class="mb-2">HTML5 / CSS3</li>
            <li>Vanilla JS</li>
          </ul>
        </div>
      </div>
      <hr class="border-secondary my-4">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <p class="text-white-50 small mb-0">© 2025 AdminUser Panel. All rights reserved.</p>
        <p class="text-white-50 small mb-0">Built with Bootstrap 5</p>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Navbar shadow on scroll
    window.addEventListener('scroll', () => {
      document.querySelector('.navbar').classList.toggle('scrolled', window.scrollY > 20);
    });
  </script>
</body>
</html>
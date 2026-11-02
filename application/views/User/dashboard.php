



    <div class="p-4">
      <!-- Welcome Banner -->
      <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-body p-4" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);">
          <div class="row align-items-center text-white">
            <div class="col-md-8">
              <h4 class="fw-bold mb-1">Welcome back, <?php echo $user['name']; ?>! 👋</h4>
              <p class="mb-0 opacity-75">Here's what's happening with your account today.</p>
            </div>
            
          </div>
        </div>
      </div>

      <!-- Stats -->
      <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
          <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-bag-check"></i></div>
              <div>
                <p class="text-muted small mb-0">Total Orders</p>
                <h4 class="fw-bold mb-0">12</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-check-circle"></i></div>
              <div>
                <p class="text-muted small mb-0">Completed</p>
                <h4 class="fw-bold mb-0">9</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-clock"></i></div>
              <div>
                <p class="text-muted small mb-0">Pending</p>
                <h4 class="fw-bold mb-0">2</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="bi bi-heart"></i></div>
              <div>
                <p class="text-muted small mb-0">Wishlist</p>
                <h4 class="fw-bold mb-0">5</h4>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row g-4">
        <!-- Recent Orders -->
        <div class="col-lg-8">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
              <h6 class="fw-semibold mb-0">Recent Orders</h6>
              <a href="orders.html" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-hover mb-0">
                  <thead>
                    <tr>
                      <th class="ps-4">Order</th>
                      <th>Date</th>
                      <th>Amount</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="ps-4 fw-medium">#ORD-4521</td>
                      <td>01 Oct 2025</td>
                      <td>$245.00</td>
                      <td><span class="badge bg-success-subtle text-success">Delivered</span></td>
                    </tr>
                    <tr>
                      <td class="ps-4 fw-medium">#ORD-4489</td>
                      <td>25 Sep 2025</td>
                      <td>$189.00</td>
                      <td><span class="badge bg-primary-subtle text-primary">Shipped</span></td>
                    </tr>
                    <tr>
                      <td class="ps-4 fw-medium">#ORD-4452</td>
                      <td>18 Sep 2025</td>
                      <td>$512.00</td>
                      <td><span class="badge bg-warning-subtle text-warning">Processing</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-0 pt-4 px-4">
              <h6 class="fw-semibold mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
              <a href="orders.html" class="d-flex align-items-center gap-3 p-3 rounded-3 bg-light text-decoration-none text-dark mb-2">
                <i class="bi bi-bag-check text-primary fs-5"></i>
                <span class="fw-medium">Track Order</span>
              </a>
              <a href="wishlist.html" class="d-flex align-items-center gap-3 p-3 rounded-3 bg-light text-decoration-none text-dark mb-2">
                <i class="bi bi-heart text-danger fs-5"></i>
                <span class="fw-medium">View Wishlist</span>
              </a>
              <a href="profile.html" class="d-flex align-items-center gap-3 p-3 rounded-3 bg-light text-decoration-none text-dark mb-2">
                <i class="bi bi-person text-success fs-5"></i>
                <span class="fw-medium">Edit Profile</span>
              </a>
              <a href="settings.html" class="d-flex align-items-center gap-3 p-3 rounded-3 bg-light text-decoration-none text-dark">
                <i class="bi bi-gear text-secondary fs-5"></i>
                <span class="fw-medium">Account Settings</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



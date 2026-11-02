

    <div class="p-4">
      <!-- Stats Cards -->
      <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
          <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-people"></i></div>
              <div>
                <p class="text-muted small mb-0">Total Users</p>
                <h4 class="fw-bold mb-0"><?= $total_users ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-cart-check"></i></div>
              <div>
                <p class="text-muted small mb-0">Paid Users</p>
                <h4 class="fw-bold mb-0"><?= $paid_users ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-currency-dollar"></i></div>
              <div>
                <p class="text-muted small mb-0">Fund</p>
                <h4 class="fw-bold mb-0"><?= format($e_wallet); ?></h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card stat-card shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
              <div class="stat-icon bg-info bg-opacity-10 text-info"><i class="bi bi-box-seam"></i></div>
              <div>
                <p class="text-muted small mb-0">Products</p>
                <h4 class="fw-bold mb-0">356</h4>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row g-4">
        <!-- Chart -->
        <div class="col-lg-8">
          <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 px-4">
              <h6 class="fw-semibold mb-0">Sales Overview</h6>
            </div>
            <div class="card-body">
              <div class="chart-placeholder">
                <div class="text-center">
                  <i class="bi bi-bar-chart-line fs-1 mb-2"></i>
                  <p class="mb-0">Chart Placeholder (Integrate Chart.js)</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-4">
          <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-0 pt-4 px-4">
              <h6 class="fw-semibold mb-0">Recent Activity</h6>
            </div>
            <div class="card-body">
              <div class="d-flex gap-3 mb-3">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary" style="width:36px;height:36px;font-size:0.9rem;"><i class="bi bi-person-plus"></i></div>
                <div>
                  <p class="mb-0 small fw-medium">New user registered</p>
                  <p class="text-muted small mb-0">2 minutes ago</p>
                </div>
              </div>
              <div class="d-flex gap-3 mb-3">
                <div class="stat-icon bg-success bg-opacity-10 text-success" style="width:36px;height:36px;font-size:0.9rem;"><i class="bi bi-cart"></i></div>
                <div>
                  <p class="mb-0 small fw-medium">Order #4521 completed</p>
                  <p class="text-muted small mb-0">15 minutes ago</p>
                </div>
              </div>
              <div class="d-flex gap-3 mb-3">
                <div class="stat-icon bg-warning bg-opacity-10 text-warning" style="width:36px;height:36px;font-size:0.9rem;"><i class="bi bi-exclamation-triangle"></i></div>
                <div>
                  <p class="mb-0 small fw-medium">Low stock alert</p>
                  <p class="text-muted small mb-0">1 hour ago</p>
                </div>
              </div>
              <div class="d-flex gap-3">
                <div class="stat-icon bg-info bg-opacity-10 text-info" style="width:36px;height:36px;font-size:0.9rem;"><i class="bi bi-chat"></i></div>
                <div>
                  <p class="mb-0 small fw-medium">New support ticket</p>
                  <p class="text-muted small mb-0">3 hours ago</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Orders Table -->
      <div class="card border-0 shadow-sm rounded-4 mt-4">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
          <h6 class="fw-semibold mb-0">Recent Orders</h6>
          <a href="orders.html" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr>
                  <th class="ps-4">Order ID</th>
                  <th>Customer</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th class="pe-4">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="ps-4 fw-medium">#ORD-4521</td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <img src="https://ui-avatars.com/api/?name=Sarah+J&background=8b5cf6&color=fff" class="avatar avatar-sm" alt="">
                      Sarah Johnson
                    </div>
                  </td>
                  <td>01 Oct 2025</td>
                  <td>$245.00</td>
                  <td><span class="badge bg-success-subtle text-success badge-status">Completed</span></td>
                  <td class="pe-4"><a href="#" class="btn btn-sm btn-light"><i class="bi bi-eye"></i></a></td>
                </tr>
                <tr>
                  <td class="ps-4 fw-medium">#ORD-4520</td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <img src="https://ui-avatars.com/api/?name=Mike+T&background=10b981&color=fff" class="avatar avatar-sm" alt="">
                      Mike Thompson
                    </div>
                  </td>
                  <td>30 Sep 2025</td>
                  <td>$189.50</td>
                  <td><span class="badge bg-warning-subtle text-warning badge-status">Pending</span></td>
                  <td class="pe-4"><a href="#" class="btn btn-sm btn-light"><i class="bi bi-eye"></i></a></td>
                </tr>
                <tr>
                  <td class="ps-4 fw-medium">#ORD-4519</td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <img src="https://ui-avatars.com/api/?name=Emma+W&background=ef4444&color=fff" class="avatar avatar-sm" alt="">
                      Emma Wilson
                    </div>
                  </td>
                  <td>29 Sep 2025</td>
                  <td>$512.00</td>
                  <td><span class="badge bg-primary-subtle text-primary badge-status">Processing</span></td>
                  <td class="pe-4"><a href="#" class="btn btn-sm btn-light"><i class="bi bi-eye"></i></a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


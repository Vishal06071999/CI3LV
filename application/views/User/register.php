<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo title; ?> - <?php echo $header; ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <link href="<?php echo base_url('assets/User/css/style.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('AppAjax/notify.css'); ?>" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">

      <div class="col-md-6 col-lg-5">

        <div class="card shadow-lg border-0 rounded-4">

          <div class="card-body p-4 p-md-5">

            <!-- Header -->
            <div class="text-center mb-4">

              <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                style="width:70px;height:70px;">

                <i class="bi bi-person-plus text-white fs-2"></i>

              </div>

              <h3 class="fw-bold mb-1">
                Create Account
              </h3>

              <p class="text-muted small mb-0">
                Register as a new User
              </p>

            </div>


            <!-- Registration Form -->


            <form id="registerForm" action="<?= base_url('registerAjax') ?>" method="POST" data-ajax="true">
              <!-- CSRF -->
              <input
                type="hidden"
                name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
              <div class="row g-3">
                <div class="col-12">
                  <label for="sponsor" class="form-label"> Sponsor</label>

                  <div class="input-group">

                    <span class="input-group-text">
                      <i class="bi bi-person-fill"></i>
                    </span>

                    <input type="text"
                      id="user_id"
                      name="sponsor"
                      class="form-control"
                      placeholder="Enter Sponsor"
                      value="<?php echo (!empty($_GET['sponsor']) ? $_GET['sponsor'] : ''); ?>"
                      <?php echo (!empty($_GET['sponsor']) ? 'readonly' : ''); ?>
                      autocomplete="off">

                  </div>
                  <span id="user_message"></span>
                </div>


                <!-- Name -->
                <div class="col-12">

                  <label for="name" class="form-label">
                    Name
                  </label>

                  <div class="input-group">

                    <span class="input-group-text">
                      <i class="bi bi-person"></i>
                    </span>

                    <input type="text"
                      id="name"
                      name="name"
                      class="form-control"
                      placeholder="Enter Name"
                      autocomplete="name"
                      required>

                  </div>

                </div>


                <!-- Email -->
                <div class="col-12">

                  <label for="email" class="form-label">
                    Email
                  </label>

                  <div class="input-group">

                    <span class="input-group-text">
                      <i class="bi bi-envelope"></i>
                    </span>

                    <input type="email"
                      id="email"
                      name="email"
                      class="form-control"
                      placeholder="john@example.com"
                      autocomplete="email"
                      required>

                  </div>

                </div>

                <?php if (register == 1) { ?>

                  <div class="col-12">
                    <label for="name" class="form-label">
                      Position
                    </label>
                    <?php if(empty($_GET['position'])){ ?>
                    <div class="input-group">
                      <span class="input-group-text">
                        <input type="radio"
                          name="position"
                          value="L"
                          class="form-check-input mt-0"
                          required>
                        <span class="ms-1">LEFT</span>
                      </span>

                      <span class="input-group-text">
                        <input type="radio"
                          name="position"
                          value="R"
                          class="form-check-input mt-0">
                        <span class="ms-1">RIGHT</span>
                      </span>
                    </div>
                    <?php }else{ 
                      if($_GET['position'] == 'L'){
                        $name = 'LEFT';
                        $value = "L";
                      }else{
                        $name = 'RIGHT';
                        $value = "R"; 
                      }
                      ?>
                      <span class="input-group-text">
                        <input type="radio"
                          name="position"
                          value="<?=  $value ?>"
                          checked
                          class="form-check-input mt-0">
                        <span class="ms-1"><?=  $name ?> </span>
                      </span>
                    <?php } ?>

                  </div>
                <?php } ?>


                <!-- Terms -->
                <div class="col-12">

                  <div class="form-check">

                    <input class="form-check-input"
                      type="checkbox"
                      name="terms"
                      value="1"
                      id="terms"
                      required>

                    <label class="form-check-label small"
                      for="terms">

                      I agree to the Terms & Conditions

                    </label>

                  </div>

                </div>


                <!-- Submit -->
                <div class="col-12">

                  <button type="submit"
                    id="registerBtn"
                    class="btn btn-success w-100 py-2 fw-semibold">

                    <span class="btn-text">
                      Create Account
                    </span>
                  </button>

                </div>

              </div>

            </form>


            <!-- Login -->
            <div class="text-center mt-4">

              <p class="small text-muted mb-0">

                Already have an account?

                <a href="<?php echo base_url('login'); ?>"
                  class="text-decoration-none fw-semibold">

                  Login

                </a>

              </p>

            </div>

          </div>

        </div>

      </div>

    </div>
  </div>




  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


  <!-- ===================== POPUP JS ===================== -->
  <script src="<?php echo base_url('AppAjax/notify.js') ?>"> </script>
  <script src="<?php echo base_url('AppAjax/ajax.js') ?>"></script>

</body>

</html>
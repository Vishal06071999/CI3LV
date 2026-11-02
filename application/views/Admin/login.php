<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title><?php echo title; ?> - Admin Login</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
      <link href="<?php echo base_url('AppAjax/notify.css'); ?>" rel="stylesheet">

</head>

<body>

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body">

                    <h3 class="text-center mb-4">
                        Admin Login
                    </h3>

                    <form
                        id="loginForm"
                        data-ajax="true"
                        method="POST"
                        action="<?= base_url('admin-login-post'); ?>"
                    >

                        <!-- CSRF -->
                        <input
                            type="hidden"
                            name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>"
                        >

                        <div class="mb-3">

                            <label class="form-label">
                                User ID
                            </label>

                            <input
                                type="text"
                                name="user_id"
                                class="form-control",
                                palace_holder="Enter User ID"
                                autocomplete="username"
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                autocomplete="current-password"
                            >

                        </div>

                        <button
                            type="submit"
                            id="loginBtn"
                            class="btn btn-primary w-100"
                        >
                            <span class="btn-text">
                                Login
                            </span>

                          

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <script src="<?php echo base_url('AppAjax/notify.js') ?>"> </script>
  <script src="<?php echo base_url('AppAjax/ajax.js') ?>"></script>
</body>

</html>
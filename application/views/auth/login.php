<!doctype html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
  data-assets-path="<?php echo base_url('assets/'); ?>" data-template="vertical-menu-template" data-style="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Login Cover - Pages | Vuexy - Bootstrap Admin Template</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/puskesmas/puskesmas-seeklogo.png'); ?>" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
    rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/fontawesome.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/tabler-icons.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/fonts/flag-icons.css'); ?>" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/css/rtl/core.css'); ?>"
    class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/css/rtl/theme-default.css'); ?>"
    class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css'); ?>" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/libs/node-waves/node-waves.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/libs/typeahead-js/typeahead.css'); ?>" />
  <!-- Vendor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/libs/@form-validation/form-validation.css'); ?>" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/vendor/css/pages/page-auth.css'); ?>" />

  <!-- Helpers -->
  <script src="<?php echo base_url('assets/vendor/js/helpers.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/js/template-customizer.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/config.js'); ?>"></script>
</head>

<body>
  <!-- Content -->
  <div class="authentication-wrapper authentication-cover">
    <!-- Logo -->
    <a href="<?php echo site_url(); ?>" class="app-brand auth-cover-brand">
      <span class="app-brand-logo demo">
        <img src="<?= base_url('assets/img/puskesmas/puskesmas-seeklogo.png') ?>" alt="Logo Puskesmas" width="32"
          height="32">
      </span>
      <span class="app-brand-text demo text-heading fw-bold">Puskesmas</span>
    </a>
    <!-- /Logo -->
    <div class="authentication-inner row m-0">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-8 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img src="<?php echo base_url('assets/img/illustrations/auth-login-illustration-light.png'); ?>"
            alt="auth-login-cover" class="my-5 auth-illustration"
            data-app-light-img="illustrations/auth-login-illustration-light.png"
            data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

          <img src="<?php echo base_url('assets/img/illustrations/bg-shape-image-light.png'); ?>" alt="auth-login-cover"
            class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.png" />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Login -->
      <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
        <div class="w-px-400 mx-auto mt-12 pt-5">
          <h4 class="mb-1">Welcome to Puskesmas! 👋</h4>
          <p class="mb-6">Please sign-in to your account and start the adventure</p>

          <?php if ($this->session->flashdata('error')): ?>
            <div style="color: red;">
              <?= $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <form id="formAuthentication" class="mb-6" action="<?= site_url('auth/process_login'); ?>" method="POST">
            <div class="mb-6">
              <label for="email" class="form-label">Username</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or username"
                autofocus />
            </div>
            <div class="mb-6 form-password-toggle">
              <label class="form-label" for="password">Password</label>
              <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password"
                  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                  aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
              </div>
            </div>
            <div class="my-8">
              <div class="d-flex justify-content-between">
                <div class="form-check mb-0 ms-2">
                  <input class="form-check-input" type="checkbox" id="remember-me" />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
                <a href="<?php echo site_url('forgot_password'); ?>">
                  <p class="mb-0">Forgot Password?</p>
                </a>
              </div>
            </div>
            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
          </form>

          <p class="text-center">
            <span>New on our platform?</span>
            <a href="<?php echo site_url('auth/register'); ?>">
              <span>Create an account</span>
            </a>
          </p>

          <div class="divider my-6">
            <div class="divider-text">or</div>
          </div>

          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-facebook me-1_5">
              <i class="tf-icons ti ti-brand-facebook-filled"></i>
            </a>

            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-twitter me-1_5">
              <i class="tf-icons ti ti-brand-twitter-filled"></i>
            </a>

            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-github me-1_5">
              <i class="tf-icons ti ti-brand-github-filled"></i>
            </a>

            <a href="javascript:;" class="btn btn-sm btn-icon rounded-pill btn-text-google-plus">
              <i class="tf-icons ti ti-brand-google-filled"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- /Login -->
    </div>
  </div>

  <!-- Core JS -->
  <script src="<?php echo base_url('assets/vendor/libs/jquery/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/libs/popper/popper.js'); ?>"></script>
  <script src="<?
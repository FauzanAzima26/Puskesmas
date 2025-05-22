<!doctype html>
<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
  data-assets-path="<?php echo base_url('assets/'); ?>" data-template="vertical-menu-template" data-style="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Register Cover - Pages | Vuexy - Bootstrap Admin Template</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicon/favicon.ico'); ?>" />

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
    <a href="<?php echo base_url(); ?>" class="app-brand auth-cover-brand">
      <span class="app-brand-logo demo">
        <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
            fill="#7367F0" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
          <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
          <path fill-rule="evenodd" clip-rule="evenodd"
            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
            fill="#7367F0" />
        </svg>
      </span>
      <span class="app-brand-text demo text-heading fw-bold">Vuexy</span>
    </a>
    <!-- /Logo -->
    <div class="authentication-inner row m-0">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-8 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img src="<?php echo base_url('assets/img/illustrations/auth-register-illustration-light.png'); ?>"
            alt="auth-register-cover" class="my-5 auth-illustration"
            data-app-light-img="illustrations/auth-register-illustration-light.png"
            data-app-dark-img="illustrations/auth-register-illustration-dark.png" />

          <img src="<?php echo base_url('assets/img/illustrations/bg-shape-image-light.png'); ?>"
            alt="auth-register-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
            data-app-dark-img="illustrations/bg-shape-image-dark.png" />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Register -->
      <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
        <div class="w-px-400 mx-auto mt-12 pt-5">
          <h4 class="mb-1">Adventure starts here 🚀</h4>
          <p class="mb-6">Make your app management easy and fun!</p>

          <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
              <?= $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <form id="formAuthentication" class="mb-6" action="<?= site_url('auth/process_register'); ?>" method="POST"
            enctype="multipart/form-data">

            <!-- Nama -->
            <div class="mb-3">
              <label for="nama" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter your full name"
                maxlength="100" required />
              <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
            </div>

            <!-- NIK -->
            <div class="mb-3">
              <label for="nik" class="form-label">NIK</label>
              <input type="number" class="form-control" id="nik" name="nik" placeholder="Enter your NIK" maxlength="20" />
            </div>

            <!-- No BPJS -->
            <div class="mb-3">
              <label for="no_bpjs" class="form-label">No BPJS</label>
              <input type="number" class="form-control" id="no_bpjs" name="no_bpjs" placeholder="Enter your No BPJS"
                maxlength="20" />
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-3">
              <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
              <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="2"
                placeholder="Enter your full address"></textarea>
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-3">
              <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" />
            </div>

            <!-- No HP -->
            <div class="mb-3">
              <label for="no_hp" class="form-label">No. Hp</label>
              <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Enter your phone number"
                maxlength="15" />
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                maxlength="100" required />
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password"
                placeholder="Enter your password" required />
            </div>

            <!-- Avatar -->
            <div class="mb-3">
              <label for="avatar" class="form-label">Profile Photo</label>
              <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*" />
            </div>

            <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>

          </form>

          <p class="text-center">
            <span>Already have an account?</span>
            <a href="<?= site_url('auth/login') ?>">
              <span>Sign in instead</span>
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
      <!-- /Register -->
    </div>
  </div>

  <!-- Core JS -->
  <script src="<?php echo base_url('assets/vendor/libs/jquery/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/libs/popper/popper.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/js/bootstrap.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/libs/node-waves/node-waves.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/libs/hammer/hammer.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/libs/i18n/i18n.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/libs/typeahead-js/typeahead.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/js/menu.js'); ?>"></script>

  <!-- Vendors JS -->
  <script src="<?php echo base_url('assets/vendor/libs/@form-validation/popular.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/libs/@form-validation/bootstrap5.js'); ?>"></script>
  <script src="<?php echo base_url('assets/vendor/libs/@form-validation/auto-focus.js'); ?>"></script>

  <!-- Main JS -->
  <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

  <!-- Page JS -->
  <script src="<?php echo base_url('assets/js/pages-auth.js'); ?>"></script>
</body>

</html>
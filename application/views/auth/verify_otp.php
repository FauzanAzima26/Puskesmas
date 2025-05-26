<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="<?= base_url('assets/') ?>" data-template="vertical-menu-template" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Two Steps Verifications Basic - Pages | Puskesmas - Bootstrap Admin Template</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/puskesmas/puskesmas-seeklogo.png') ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />

    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="<?= base_url('assets/') ?>vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?= base_url('assets/') ?>vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url('assets/') ?>js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-basic px-6">
        <div class="authentication-inner py-6">
            <!--  Two Steps Verification -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-6">
                        <a href="index.html" class="app-brand-link">
                            <span class="app-brand-logo demo">
                                <img src="<?= base_url('assets/img/puskesmas/puskesmas-seeklogo.png') ?>"
                                    alt="Logo Puskesmas" width="32" height="32">
                            </span>
                            <span class="app-brand-text demo text-heading fw-bold">Puskesmas</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-1">Two Step Verification 💬</h4>
                    <p class="text-start mb-6">
                        We sent a verification code to your mobile. Enter the code from the mobile in the field below.
                        <span class="fw-medium d-block mt-1 text-heading">******1234</span>
                    </p>
                    <p class="mb-0">Type your 6 digit security code</p>
                    <!-- resources/views/backend/auth/otp.php -->
                    <form id="twoStepsForm" method="POST" action="<?= site_url('auth/verify_otp') ?>">
                        <!-- Tampilkan flash error jika ada -->
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $this->session->flashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Input OTP Split -->
                        <div class="mb-3 otp-input-wrapper d-flex align-items-center justify-content-center gap-2">
                            <input type="text" class="form-control auth-input text-center" maxlength="1" autofocus />
                            <input type="text" class="form-control auth-input text-center" maxlength="1" />
                            <input type="text" class="form-control auth-input text-center" maxlength="1" />
                            <input type="text" class="form-control auth-input text-center" maxlength="1" />
                            <input type="text" class="form-control auth-input text-center" maxlength="1" />
                            <input type="text" class="form-control auth-input text-center" maxlength="1" />
                        </div>

                        <!-- Hidden input untuk dikirim ke backend -->
                        <input type="hidden" name="otp" />

                        <button type="submit" class="btn btn-primary d-grid w-100">Verify</button>

                        <div class="text-center mt-3">
                            <p>Didn’t get the code? <a href="<?= site_url('auth/resend_otp') ?>">Resend</a></p>
                        </div>
                    </form>

                </div>
            </div>
            <!-- / Two Steps Verification -->
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="<?= base_url('assets/') ?>vendor/libs/jquery/jquery.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/libs/popper/popper.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/js/bootstrap.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/libs/node-waves/node-waves.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/libs/hammer/hammer.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/libs/i18n/i18n.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url('assets/') ?>vendor/libs/cleavejs/cleave.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/libs/@form-validation/popular.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url('assets/') ?>js/main.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url('assets/') ?>js/pages-auth.js"></script>
    <script src="<?= base_url('assets/') ?>js/pages-auth-two-steps.js"></script>

    <script>
        const otpInputs = document.querySelectorAll('.auth-input');
        const hiddenInput = document.querySelector('input[name="otp"]');

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                // Pindah ke input selanjutnya jika karakter sudah diisi
                if (input.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }

                // Gabungkan nilai dari semua input
                hiddenInput.value = Array.from(otpInputs).map(i => i.value).join('');
            });
        });
    </script>

</body>

</html>
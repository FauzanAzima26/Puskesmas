<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP</title>
</head>
<body>
    <h2>Masukkan Kode OTP</h2>
    <?php if ($this->session->flashdata('error')): ?>
        <p style="color:red;"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>
    <form method="POST" action="<?php echo site_url('auth/verify_otp'); ?>">
        <label>Kode OTP:</label>
        <input type="text" name="otp" required>
        <button type="submit">Verifikasi</button>
    </form>
</body>
</html>

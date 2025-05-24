<!DOCTYPE html>
<html>
<head>
    <title>Password Reset OTP</title>
</head>
<body>
    <h2>Password Reset Request</h2>
    <p>You have requested to reset your password. Here is your OTP code:</p>
    <h3><?= $otp_code ?></h3>
    <p>This code will expire in <?= $expiry_minutes ?> minutes.</p>
    <p>If you didn't request this, please ignore this email.</p>
</body>
</html>
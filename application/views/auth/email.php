<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .otp-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .otp-token {
            font-size: 2.5rem;
            letter-spacing: 0.5rem;
            margin: 1.5rem 0;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 4px;
            font-family: monospace;
        }
        .error-message {
            color: #dc3545;
            margin-bottom: 1rem;
        }
        .note {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="otp-container">
        <h2>Kode Verifikasi Anda</h2>
        
        <?php if ($this->session->flashdata('error')): ?>
            <div class="error-message">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        
        <div class="otp-token">
            <?php echo $otp_code; ?>
        </div>
        
        <div class="note">
            Kode ini berlaku untuk verifikasi akun Anda. Jangan berikan kode ini kepada siapapun.
        </div>
    </div>
</body>
</html>
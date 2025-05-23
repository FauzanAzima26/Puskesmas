<!DOCTYPE html>
<html>
<head>
    <title>Antrian Anda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">

    <h2 class="mb-4 text-center">Nomor Antrian Anda Hari Ini</h2>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h1 class="display-1 mb-3"><?= $antrian->nomor_antrian ?></h1>
                    <p class="card-text mb-1">Tanggal: <?= date('d-m-Y', strtotime($antrian->tanggal)) ?></p>
                    <a href="<?= site_url('dashboard') ?>" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

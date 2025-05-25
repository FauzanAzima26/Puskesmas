<body>

  <div class="container my-4">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Kartu Riwayat Berobat</h4>
      </div>
      <div class="card-body">
        <!-- Info Pasien -->
        <h5>Informasi Pasien</h5>
        <div class="row mb-3">
          <div class="col-md-4"><strong>Nama:</strong> <span id="nama-pasien"><?= $pasien->nama ?></span></div>
          <div class="col-md-4"><strong>NIK:</strong> <span id="nik-pasien"><?= $pasien->nik ?></span></div>
          <div class="col-md-4"><strong>Jenis Kelamin:</strong> <span
              id="jk-pasien"><?= $pasien->jenis_kelamin ?></span></div>
        </div>
        <div class="row mb-4">
          <div class="col-md-4"><strong>Tanggal Lahir:</strong> <span
              id="tgl-lahir-pasien"><?= $pasien->tgl_lahir ?></span></div>
          <div class="col-md-8"><strong>Alamat:</strong> <span id="alamat-pasien"><?= $pasien->alamat ?></span>
          </div>
        </div>

        <!-- Riwayat Berobat -->
        <h5>Riwayat Berobat</h5>
        <table class="table table-bordered table-striped">
          <thead class="table-secondary">
            <tr>
              <th>Tanggal Periksa</th>
              <th>Dokter</th>
              <th>Keluhan</th>
              <th>Diagnosa</th>
              <th>Tindakan</th>
              <th>Resep</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($riwayat as $r): ?>
              <tr>
                <td><?= $r->tgl_periksa ?></td>
                <td><?= $r->nama_dokter ?></td>
                <td><?= $r->keluhan ?></td>
                <td><?= $r->diagnosa ?></td>
                <td><?= $r->tindakan ?></td>
                <td><?= $r->resep ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>

        </table>

        <!-- Informasi Lainnya -->
        <h5 class="mt-8">Informasi Tambahan</h5>
        <p><strong>Nomor BPJS:</strong> <?= $pasien->no_bpjs ?></p>
        <p><strong>Kontak Darurat:</strong> 081234567890 (Ibu Ani)</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
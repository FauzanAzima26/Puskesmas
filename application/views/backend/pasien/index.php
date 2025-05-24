<div id="pasien-form" data-store-url="<?= site_url('riwayat/store') ?>"
    data-get-data-url="<?= site_url('pasien/get_data') ?>">
</div>

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="pasien table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>No BPJS</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Tgl Lahir</th>
                        <th>No HP</th>
                        <th>Profile</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="add-riwayat-berobat">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Tambah Riwayat Berobat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="form-riwayat-berobat">
            <input type="hidden" name="id_riwayat" id="id_riwayat">
            <input type="hidden" name="id_pasien" id="id_pasien">
            <?php if (isset($dokter) && isset($dokter['id_dokter'])): ?>
                <input type="hidden" name="id_dokter" id="id_dokter" value="<?= $dokter['id_dokter']; ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
                <input type="date" class="form-control" name="tgl_periksa" id="tgl_periksa" required>
            </div>

            <div class="mb-3">
                <label for="keluhan" class="form-label">Keluhan</label>
                <textarea class="form-control" name="keluhan" id="keluhan" required></textarea>
            </div>

            <div class="mb-3">
                <label for="diagnosa" class="form-label">Diagnosa</label>
                <textarea class="form-control" name="diagnosa" id="diagnosa" required></textarea>
            </div>

            <div class="mb-3">
                <label for="tindakan" class="form-label">Tindakan</label>
                <textarea class="form-control" name="tindakan" id="tindakan" required></textarea>
            </div>

            <div class="mb-3">
                <label for="resep" class="form-label">Resep</label>
                <textarea class="form-control" name="resep" id="resep" required></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="offcanvas">Batal</button>
            </div>
        </form>
    </div>
</div>

<!--/ DataTable with Buttons -->
<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
<script src="<?= base_url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') ?>"></script>
<script src="<?= base_url('assets/js/backend/pasien.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
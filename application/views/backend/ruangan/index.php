<div id="ruangan-form" data-store-url="<?= site_url('ruangan/store') ?>"
    data-get-data-url="<?= site_url('ruangan/get_data') ?>">
</div>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
            <i class="ti ti-plus"></i> Add New
        </button>
    </div>
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="ruangan table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruangan</th>
                        <th>Jenis</th>
                        <th>Kapasitas</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Tambah/Update Ruangan</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="add-new-record pt-0 row g-2" id="form-add-new-record" onsubmit="return false">
            <input type="hidden" name="id_ruangan" id="id_ruangan">

            <!-- Nama Ruangan -->
            <div class="col-sm-12">
                <label class="form-label" for="nama_ruangan">Nama Ruangan</label>
                <input type="text" id="nama_ruangan" name="nama_ruangan" class="form-control"
                    placeholder="Contoh: Ruang Operasi 1" required />
            </div>

            <!-- Jenis -->
            <div class="col-sm-12">
                <label class="form-label" for="jenis">Jenis Ruangan</label>
                <select id="jenis" name="jenis" class="form-select" required>
                    <option value="">Pilih Jenis</option>
                    <option value="Rawat Inap">Rawat Inap</option>
                    <option value="Rawat Jalan">Rawat Jalan</option>
                    <option value="Operasi">Operasi</option>
                    <option value="UGD">UGD</option>
                    <option value="Laboratorium">Laboratorium</option>
                </select>
            </div>

            <!-- Kapasitas -->
            <div class="col-sm-12">
                <label class="form-label" for="kapasitas">Kapasitas</label>
                <input type="number" id="kapasitas" name="kapasitas" class="form-control"
                    placeholder="Contoh: 10" required />
            </div>

            <!-- Tombol Submit -->
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary data-submit me-sm-4 me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!--/ DataTable with Buttons -->
<script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
<script src="<?= base_url('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') ?>"></script>
<script src="<?= base_url('assets/js/backend/ruangan.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
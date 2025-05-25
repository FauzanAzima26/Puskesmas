<div id="doctor-form" data-store-url="<?= site_url('obat/store') ?>"
    data-get-data-url="<?= site_url('obat/get_data') ?>">
</div>


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
            <i class="ti ti-plus"></i> Add New
        </button>
    </div>
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="obat table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Keterangan</th>
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
        <h5 class="offcanvas-title" id="exampleModalLabel">Tambah/Update Obat</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        <form class="add-new-record pt-0 row g-2" id="form-add-new-record" onsubmit="return false">
            <input type="hidden" name="id_obat" id="id_obat">

            <!-- Nama Obat -->
            <div class="col-sm-12">
                <label class="form-label" for="nama_obat">Nama Obat</label>
                <input type="text" id="nama_obat" name="nama_obat" class="form-control"
                    placeholder="Contoh: Paracetamol" required />
            </div>

            <!-- Kategori -->
            <div class="col-sm-12">
                <label class="form-label" for="kategori">Kategori</label>
                <input type="text" id="kategori" name="kategori" class="form-control"
                    placeholder="Contoh: Analgesik, Antibiotik" required />
            </div>

            <!-- Stok -->
            <div class="col-sm-12">
                <label class="form-label" for="stok">Stok</label>
                <input type="number" id="stok" name="stok" class="form-control" placeholder="Jumlah stok" required />
            </div>

            <!-- Keterangan -->
            <div class="col-sm-12">
                <label class="form-label" for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" class="form-control"
                    placeholder="Keterangan tambahan"></textarea>
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
<script src="<?= base_url('assets/js/backend/obat.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
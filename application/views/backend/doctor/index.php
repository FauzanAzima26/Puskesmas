<div id="doctor-form" data-store-url="<?= site_url('doctor/store') ?>"
  data-get-data-url="<?= site_url('doctor/get_data') ?>">
</div>


<div class="container-xxl flex-grow-1 container-p-y">
  <div class="mb-3">
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#add-new-record">
      <i class="ti ti-plus"></i> Add New
    </button>
  </div>

  <!-- DataTable with Buttons -->
  <div class="card">
    <div class="card-datatable table-responsive pt-0">
      <table class="doctor table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Spesialisasi</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
            <th width="20%">Aksi</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Offcanvas Add New Record sudah ada -->
</div>

<!-- Modal to add new record -->
<div class="offcanvas offcanvas-end" id="add-new-record">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
    <form class="add-new-record pt-0 row g-2" id="form-add-new-record" onsubmit="return false">
      <!-- Nama -->
      <div class="col-sm-12">
        <label class="form-label" for="nama">Nama Dokter</label>
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap" required />
      </div>
      <!-- Spesialisasi -->
      <div class="col-sm-12">
        <label class="form-label" for="spesialisasi">Spesialisasi</label>
        <input type="text" id="spesialisasi" name="spesialisasi" class="form-control" placeholder="Contoh: Anak, Umum"
          required />
      </div>
      <!-- Jenis Kelamin -->
      <div class="col-sm-12">
        <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
          <option value="">-- Pilih --</option>
          <option value="Laki-Laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>
      <!-- No HP -->
      <div class="col-sm-12">
        <label class="form-label" for="no_hp">No HP</label>
        <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required />
      </div>
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
<script src="<?= base_url('assets/js/backend/doctor.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
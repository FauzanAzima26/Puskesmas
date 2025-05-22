$(document).ready(function () {
  const storeUrl = document.getElementById("doctor-form").dataset.storeUrl;
  const getDataUrl = document.getElementById("doctor-form").dataset.getDataUrl;

  let editingId = null;

  // Inisialisasi DataTable
  const table = $(".doctor").DataTable({
    ajax: {
      url: getDataUrl,
      dataSrc: "data",
    },
    columns: [
      { data: null, render: (data, type, row, meta) => meta.row + 1 },
      { data: "nama" },
      { data: "spesialisasi" },
      { data: "jenis_kelamin" },
      { data: "no_hp" },
      {
        data: null,
        orderable: false,
        render: (data, type, row) => `
          <button class="btn btn-sm btn-primary edit-btn" data-id="${row.id_dokter}">Edit</button>
          <button class="btn btn-sm btn-danger delete-btn" data-id="${row.id_dokter}">Delete</button>
        `,
      },
    ],
  });

  // Form submit: ADD or UPDATE
  $("#form-add-new-record").on("submit", function (e) {
    e.preventDefault();

    const $btn = $(".data-submit");
    $btn.prop("disabled", true);

    const formData = $(this).serialize() + (editingId ? `&id_dokter=${editingId}` : "");
    const url = storeUrl;

    $.ajax({
      url: url,
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status) {
          $("#add-new-record").offcanvas("hide");
          $("#form-add-new-record")[0].reset();
          table.ajax.reload();
          $(".data-submit").text("Submit");

          Swal.fire({
            icon: "success",
            title: editingId ? "Data berhasil diperbarui!" : "Dokter berhasil ditambahkan!",
            html: editingId
              ? response.message
              : `<b>Email login:</b> ${response.email}<br><b>Password default:</b> 123456`,
          });
          editingId = null;
        } else {
          Swal.fire("Gagal!", response.message, "error");
        }
      },
      error: function () {
        Swal.fire("Oops!", "Terjadi kesalahan saat mengirim data", "error");
      },
      complete: function () {
        $btn.prop("disabled", false);
      },
    });
  });

  // Saat klik Edit
  $(document).on("click", ".edit-btn", function () {
    const id = $(this).data("id");

    $.get(`${getDataUrl.replace("get_data", "edit/")}${id}`, function (res) {
      if (res.status) {
        const d = res.data;
        editingId = d.id_dokter;

        $("#nama").val(d.nama);
        $("#spesialisasi").val(d.spesialisasi);
        $("#jenis_kelamin").val(d.jenis_kelamin);
        $("#no_hp").val(d.no_hp);

        $("#add-new-record").offcanvas("show");
        $(".data-submit").text("Update");
      } else {
        Swal.fire("Gagal", res.message, "error");
      }
    }, "json");
  });
});

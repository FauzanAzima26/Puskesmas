$(document).ready(function () {
    const table = $(".ruangan").DataTable({
        ajax: {
            url: $("#ruangan-form").data("get-data-url"),
            type: "GET",
            dataSrc: "data",
        },
        columns: [
            {
                data: null,
                render: (data, type, row, meta) => meta.row + 1,
                className: "text-center",
            },
            { 
                data: "nama_ruangan",
                className: "text-left" 
            },
            { 
                data: "jenis",
                className: "text-left" 
            },
            { 
                data: "kapasitas",
                className: "text-center" 
            },
            {
                data: null,
                render: (data, type, row) => `
                    <button class="btn btn-sm btn-warning edit" data-id="${row.id_ruangan}">Edit</button>
                    <button class="btn btn-sm btn-danger delete" data-id="${row.id_ruangan}">Delete</button>
                `,
                className: "text-center",
                orderable: false,
            },
        ],
        language: {
            emptyTable: "Tidak ada data ruangan yang tersedia",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data ruangan",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
        },
    });

    // Submit form
    $("#form-add-new-record").on("submit", function (e) {
        e.preventDefault();
        const formData = $(this).serialize();
        const url = $("#ruangan-form").data("store-url");
        const submitBtn = $(this).find('[type="submit"]');

        submitBtn.prop("disabled", true).html(`
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Memproses...
        `);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire("Berhasil", response.message, "success");
                    $("#form-add-new-record")[0].reset();
                    bootstrap.Offcanvas.getInstance("#add-new-record").hide();
                    table.ajax.reload(null, false);
                } else {
                    Swal.fire("Gagal", response.message, "error");
                }
            },
            error: function (xhr) {
                Swal.fire("Error", "Terjadi kesalahan saat menyimpan data", "error");
            },
            complete: function () {
                submitBtn.prop("disabled", false).html("Submit");
            },
        });
    });

    // Edit
    $(document).on("click", ".edit", function () {
        const id = $(this).data("id");
        const getUrl = $("#ruangan-form").data("get-data-url");

        $.ajax({
            url: getUrl,
            type: "GET",
            data: { id: id },
            dataType: "json",
            success: function (response) {
                if (response && response.id_ruangan) {
                    $("#id_ruangan").val(response.id_ruangan);
                    $("#nama_ruangan").val(response.nama_ruangan);
                    $("#jenis").val(response.jenis);
                    $("#kapasitas").val(response.kapasitas);

                    $("#exampleModalLabel").text("Edit Ruangan");
                    const offcanvas = new bootstrap.Offcanvas("#add-new-record");
                    offcanvas.show();
                } else {
                    Swal.fire({
                        title: "Error",
                        text: response.error || "Data ruangan tidak ditemukan",
                        icon: "error",
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    title: "Error",
                    text: "Gagal mengambil data ruangan dari server",
                    icon: "error",
                });
            },
        });
    });

    // Delete
    $(document).on("click", ".delete", function () {
        const id = $(this).data("id");

        Swal.fire({
            title: "Yakin hapus data?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $("#ruangan-form").data("store-url"),
                    type: "POST",
                    data: {
                        id_ruangan: id,
                        _method: "DELETE",
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            Swal.fire("Berhasil", response.message, "success");
                            table.ajax.reload(null, false);
                        } else {
                            Swal.fire("Gagal", response.message, "error");
                        }
                    },
                    error: function (xhr) {
                        Swal.fire("Error", "Terjadi kesalahan saat menghapus data", "error");
                    },
                });
            }
        });
    });

    // Reset form when offcanvas is hidden
    document.getElementById("add-new-record").addEventListener("hidden.bs.offcanvas", function () {
        $("#form-add-new-record")[0].reset();
        $("#exampleModalLabel").text("Tambah Ruangan Baru");
        $("#id_ruangan").val("");
    });
});
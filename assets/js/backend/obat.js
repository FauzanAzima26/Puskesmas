const table = $(".obat").DataTable({
	ajax: {
		url: $("#doctor-form").data("get-data-url"),
		type: "GET",
		dataSrc: "data",
	},
	columns: [
		{
			data: null,
			render: (data, type, row, meta) => meta.row + 1,
		},
		{ data: "nama_obat" },
		{ data: "kategori" },
		{ data: "stok" },
		{ data: "keterangan" },
		{
			data: null,
			render: (data, type, row) => `
                <button class="btn btn-sm btn-warning edit" data-id="${row.id_obat}">Edit</button>
                <button class="btn btn-sm btn-danger delete" data-id="${row.id_obat}">Delete</button>
            `,
		},
	],
});

// Submit form
$("#form-add-new-record").on("submit", function (e) {
	e.preventDefault();
	const formData = $(this).serialize();
	const url = $("#doctor-form").data("store-url");

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
	});
});

// Edit
$(document).on("click", ".edit", function () {
	const id = $(this).data("id");
	const getUrl = $("#doctor-form").data("get-data-url");

	console.log("Mengambil data obat dengan ID:", id);

	$.ajax({
		url: getUrl,
		type: "GET",
		data: { id: id },
		dataType: "json",
		success: function (response) {
			console.log("Response dari server:", response);

			// Periksa apakah response memiliki id_obat
			if (response && response.id_obat) {
				$("#id_obat").val(response.id_obat);
				$("#nama_obat").val(response.nama_obat);
				$("#kategori").val(response.kategori);
				$("#stok").val(response.stok);
				$("#keterangan").val(response.keterangan);

				const offcanvas = new bootstrap.Offcanvas("#add-new-record");
				offcanvas.show();
			} else {
				console.error("Data tidak valid:", response);
				Swal.fire({
					title: "Error",
					text: response.error || "Data obat tidak ditemukan",
					icon: "error",
				});
			}
		},
		error: function (xhr, status, error) {
			console.error("Error:", error);
			Swal.fire({
				title: "Error",
				text: "Gagal mengambil data obat dari server",
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
				url: $("#doctor-form").data("store-url"),
				type: "POST",
				data: {
					id_obat: id,
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

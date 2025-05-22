$(document).ready(function () {
	const storeUrl = document.getElementById("doctor-form").dataset.storeUrl;
	const getDataUrl = document.getElementById("doctor-form").dataset.getDataUrl;

	// Inisialisasi DataTable dengan ajax load
	const table = $(".doctor").DataTable({
		ajax: {
			url: getDataUrl,
			dataSrc: "data", // pastikan JSON response ada key 'data' yang berisi array data
		},
		columns: [
			{
				// nomor urut
				data: null,
				render: function (data, type, row, meta) {
					return meta.row + 1;
				},
			},
			{ data: "nama" },
			{ data: "spesialisasi" },
			{ data: "jenis_kelamin" },
			{ data: "no_hp" },
			{
				data: null,
				orderable: false,
				render: function (data, type, row) {
					return `
        <button class="btn btn-sm btn-primary edit-btn" data-id="#">Edit</button>
        <button class="btn btn-sm btn-danger delete-btn" data-id="#">Delete</button>
      `;
				},
			},
		],
	});

	// Submit form add new record via AJAX
	$("#form-add-new-record").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: storeUrl,
			method: "POST",
			data: $(this).serialize(),
			dataType: "json",
			success: function (response) {
				if (response.status) {
					$("#add-new-record").offcanvas("hide");
					$("#form-add-new-record")[0].reset();
					table.ajax.reload();

					Swal.fire({
						icon: "success",
						title: "Dokter berhasil ditambahkan!",
						html: `
            <b>Email login:</b> ${response.email}<br>
            <b>Password default:</b> 123456
          `,
					});
				} else {
					Swal.fire("Gagal!", response.message, "error");
				}
			},
			error: function () {
				Swal.fire("Oops!", "Terjadi kesalahan saat mengirim data", "error");
			},
		});
	});
});

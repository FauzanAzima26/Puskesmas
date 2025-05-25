const getDataUrl = document.getElementById("pasien-form").dataset.getDataUrl;
const storeUrl = document.getElementById("pasien-form").dataset.storeUrl;

console.log("Endpoint URL:", getDataUrl);

const table = $(".pasien").DataTable({
	ajax: {
		url: getDataUrl,
		dataSrc: "data",
		error: function (xhr, error, thrown) {
			dd({
				status: "API Error",
				xhr: xhr,
				error: error,
				thrown: thrown,
			});
		},
	},
	columns: [
		{
			data: null,
			render: (data, type, row, meta) => meta.row + 1,
		},
		{ data: "nama" },
		{ data: "nik" },
		{ data: "no_bpjs" },
		{ data: "jenis_kelamin" },
		{ data: "alamat" },
		{ data: "tgl_lahir" },
		{ data: "no_hp" },
		{
			data: "avatar",
			render: function (data, type, row) {
				const imageUrl = `http://localhost/CI/www.puskesmas-digital.com/uploads/avatar/${
					data || "default.png"
				}`;
				return `
			<img src="${imageUrl}" alt="Avatar" style="
				width: 60px;
				height: 60px;
				object-fit: cover;
				border-radius: 50%;
				border: 2px solid #e0e0e0;
				box-shadow: 0 2px 6px rgba(0,0,0,0.1);
			">`;
			},
		},
		{
			data: null,
			render: function (data, type, row) {
				return `
		<div class="d-flex gap-1">
			<button class="btn btn-sm btn-icon btn-primary edit-btn p-1" data-id="${row.id_pasien}">
				<i class="menu-icon tf-icons ti ti-edit mx-auto"></i>
			</button>
			<button class="btn btn-sm btn-icon btn-warning detail-btn p-1" data-id="${row.id_pasien}">
				<i class="menu-icon tf-icons ti ti-eye mx-auto"></i>
			</button>
			<button class="btn btn-sm btn-icon btn-danger delete-btn p-1" data-id="${row.id_pasien}">
				<i class="menu-icon tf-icons ti ti-trash mx-auto"></i>
			</button>
		</div>
	`;
			},
		},
	],
});

$(document).on("click", ".edit-btn", function () {
	const idPasien = $(this).data("id");

	$("#id_pasien").val(idPasien);
	// jangan hilangkan atau ubah nilai id_dokter,
	// biarkan tetap sesuai user dokter yang login

	$("#tgl_periksa").val("");
	$("#keluhan").val("");
	$("#diagnosa").val("");
	$("#tindakan").val("");
	$("#resep").val("");

	const offcanvas = new bootstrap.Offcanvas("#add-riwayat-berobat");
	offcanvas.show();
});

$("#form-riwayat-berobat").submit(function (e) {
	e.preventDefault();

	const formData = $(this).serialize();
	$.ajax({
		url: storeUrl,
		method: "POST",
		data: formData,
		success: function (res) {
			Swal.fire("Berhasil!", "Data riwayat berhasil disimpan.", "success");
			$(".pasien").DataTable().ajax.reload(null, false);
			bootstrap.Offcanvas.getInstance(
				document.getElementById("add-riwayat-berobat")
			).hide();
		},
		error: function () {
			Swal.fire("Gagal!", "Terjadi kesalahan saat menyimpan data.", "error");
		},
	});
});

$(document).on("click", ".detail-btn", function () {
	const idPasien = $(this).data("id");
	window.location.href = `http://localhost/CI/www.puskesmas-digital.com/index.php/riwayat_berobat/index/${idPasien}`;
});

$(document).on("click", ".delete-btn", function () {
	const idPasien = $(this).data("id");

	Swal.fire({
		title: "Apakah kamu yakin?",
		text: "Data pasien akan dihapus secara permanen!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonText: "Ya, hapus!",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: `http://localhost/CI/www.puskesmas-digital.com/index.php/pasien/delete/${idPasien}`,
				method: "POST",
				success: function (res) {
					Swal.fire("Terhapus!", "Data pasien berhasil dihapus.", "success");
					$(".pasien").DataTable().ajax.reload(null, false);
				},
				error: function () {
					Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus data.", "error");
				},
			});
		}
	});
});

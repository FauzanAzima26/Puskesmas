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
		{
			data: "nama",
		},
		{
			data: "nik",
		},
		{
			data: "no_bpjs",
		},
		{
			data: "jenis_kelamin",
		},
		{
			data: "alamat",
		},
		{
			data: "tgl_lahir",
		},
		{
			data: "no_hp",
		},
		{
			data: "avatar",
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

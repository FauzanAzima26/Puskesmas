const getDataUrl = document.getElementById("pasien-form").dataset.getDataUrl;

console.log("Endpoint URL:", getDataUrl);

const table = $(".pasien").DataTable({
  ajax: {
    url: getDataUrl,
    dataSrc: "data",
    error: function(xhr, error, thrown) {
      dd({
        status: "API Error",
        xhr: xhr,
        error: error,
        thrown: thrown,
      });
    }
  },
  columns: [
    { 
      data: null, 
      render: (data, type, row, meta) => meta.row + 1 
    },
    {
      data: "nama",
      render: function(data, type, row) {
        return `<p>${data}</p>`;
      }
    },
    {
      data: "nama",
      render: function(data, type, row) {
        // Show empty if not updated, otherwise show doctor name
        return row.is_updated ? `${data}` : '<span class="text-muted">-</span>';
      }
    },
    {
      data: "tgl_periksa",
      render: function(data, type, row) {
        // Show empty if not updated, otherwise show formatted date
        return row.is_updated ? new Date(data).toLocaleDateString() : '<span class="text-muted">-</span>';
      }
    },
    { 
      data: "keluhan",
      render: function(data, type, row) {
        return row.is_updated ? data : '<span class="text-muted">-</span>';
      }
    },
    { 
      data: "diagnosa",
      render: function(data, type, row) {
        return row.is_updated ? data : '<span class="text-muted">-</span>';
      }
    },
    { 
      data: "tindakan",
      render: function(data, type, row) {
        return row.is_updated ? data : '<span class="text-muted">-</span>';
      }
    },
    { 
      data: "resep",
      render: function(data, type, row) {
        return row.is_updated ? data : '<span class="text-muted">-</span>';
      }
    },
    {
      data: null,
      render: function(data, type, row) {
        return `
          <div class="d-flex gap-1">
			<button class="btn btn-sm btn-icon btn-primary edit-btn p-1" data-id="${row.id_riwayat}">
            <i class="menu-icon tf-icons ti ti-edit" style="margin-right: 0px"></i>
          </button>
          <button class="btn btn-sm btn-icon btn-danger delete-btn p-1" data-id="${row.id_riwayat}">
            <i class="menu-icon tf-icons ti ti-trash" style="margin-right: 0px"></i>
          </button>
		  </div>
        `;
      }
    }
  ],
});
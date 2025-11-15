<!DOCTYPE html>
<html>
<head>
    <title>Euscaa Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        th { cursor: pointer; }
        img.thumb { width: 50px; border-radius: 6px; }
    </style>
</head>

<body class="p-4">

<div class="d-flex justify-content-between">
    <h2>Euscaa Dashboard</h2>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-danger">Logout</button>
    </form>
</div>

<div class="mt-3">
    <input type="text" id="search" class="form-control" placeholder="Search name, email, phone...">
</div>

<button class="btn btn-success mt-2" onclick="downloadExcel()">Excel</button>
<button class="btn btn-danger mt-2" onclick="downloadPDF()">PDF</button>

<table class="table table-bordered mt-3" id="dataTable">
    <thead>
        <tr id="tableHead"></tr>
    </thead>
    <tbody id="tableBody"></tbody>
</table>

<div id="pagination"></div>

<script>
let page = 1;
let sortColumn = 'id';
let sortDirection = 'asc';
let search = '';

function loadTable() {
    fetch(`/dashboard/data?page=${page}&sort_column=${sortColumn}&sort_direction=${sortDirection}&search=${search}`)
        .then(res => res.json())
        .then(res => {

            // Auto Header
            if (res.data.length > 0) {
                let header = '';
                Object.keys(res.data[0]).forEach(key => {
                    header += `<th onclick="sortBy('${key}')">${key}</th>`;
                });
                document.getElementById('tableHead').innerHTML = header;
            }

            // Auto Body
            let body = '';
            res.data.forEach(row => {
                body += '<tr>';

                Object.keys(row).forEach(key => {

                    if (key === 'photo_url') {
                        body += `<td>${row[key] ? `<img src="${row[key]}" class="thumb">` : 'No Image'}</td>`;
                    } else {
                        body += `<td>${row[key] ?? ''}</td>`;
                    }

                });

                body += '</tr>';
            });

            document.getElementById('tableBody').innerHTML = body;

            // Pagination
            let links = '';
            for (let i = 1; i <= res.last_page; i++) {
                links += `<button class="btn btn-sm ${page == i ? 'btn-primary' : 'btn-light'}" onclick="goTo(${i})">${i}</button> `;
            }
            document.getElementById('pagination').innerHTML = links;

        });
}

function sortBy(col) {
    sortColumn = col;
    sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
    loadTable();
}

function goTo(p) {
    page = p;
    loadTable();
}

document.getElementById('search').addEventListener('keyup', e => {
    search = e.target.value;
    page = 1;
    loadTable();
});

function downloadExcel() {
    let wb = XLSX.utils.table_to_book(document.getElementById('dataTable'));
    XLSX.writeFile(wb, 'euscaa.xlsx');
}

function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.text('EUSCAA Export', 10, 10);
    doc.save('euscaa.pdf');
}

loadTable();
</script>

</body>
</html>

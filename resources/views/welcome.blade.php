<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Reunion Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">

  <style>
    :root{--card-bg:#fff;--muted:#6b7280;--ring:#6366f1}
    *{box-sizing:border-box}
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;background:#f6f8fb;margin:0;padding:24px}
    .wrap{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:2fr 1fr;gap:24px}
    .card{background:var(--card-bg);border-radius:14px;box-shadow:0 8px 24px rgba(0,0,0,.06);padding:22px}
    h1{font-weight:800;font-size:26px;margin:0 0 8px}
    p.sub{color:var(--muted);margin:0 0 12px}
    /* form layout */
    .row{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .row.full{grid-template-columns:1fr}
    label{display:block;font-weight:600;margin:10px 0 6px}
    input,select{width:100%;padding:11px 12px;border:1px solid #d1d5db;border-radius:10px;font-size:15px;outline:none;background:#fff;text-align:left}
    input[type="tel"],input[type="number"],input[type="email"],input[type="text"]{direction:ltr}
    input:focus,select:focus{border-color:var(--ring);box-shadow:0 0 0 3px rgba(99,102,241,.15)}
    button{margin-top:14px;display:inline-block;background:var(--ring);border:none;color:#fff;padding:12px 16px;border-radius:10px;font-weight:700;cursor:pointer}
    button:disabled{opacity:.6;cursor:not-allowed}
    small.hint{color:#9ca3af}
    .muted{color:var(--muted);font-size:13px}
    /* table */
    .dataTables_wrapper .dataTables_filter input{border:1px solid #d1d5db;border-radius:8px;padding:6px 8px}
    .dataTables_wrapper .dataTables_length select{border:1px solid #d1d5db;border-radius:8px;padding:6px 8px}
    table.dataTable thead th{background:#f9fafb}
    /* responsive */
    @media (max-width:1000px){.wrap{grid-template-columns:1fr}}
    @media (max-width:600px){.row{grid-template-columns:1fr}}
  </style>
</head>
<body>

  <div class="wrap">
    <!-- LEFT: DataTable -->
    <div class="card">
      <h1>Registration List</h1>
      <p class="sub">All submissions (auto-refresh on new entry)</p>

      <table id="regTable" class="display" style="width:100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>SSC</th>
            <th>HSC</th>
            <th>Guests</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>

    <!-- RIGHT: Form -->
    <div class="card">
      <h1>Test Registration Form</h1>
      <form id="regForm" autocomplete="off">
        <div class="row full">
          <div>
            <label for="name">Name <span class="muted">(required)</span></label>
            <input type="text" id="name" name="name" required />
          </div>
        </div>

        <div class="row">
          <div>
            <label for="email">Email <span class="muted">(required)</span></label>
            <input type="email" id="email" name="email" required inputmode="email" />
          </div>
          <div>
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" placeholder="+8801XXXXXXXXX" inputmode="tel" />
          </div>
        </div>

        <div class="row">
          <div>
            <label for="ssc_batch">SSC Batch <small class="hint">(Year)</small></label>
            <select id="ssc_batch" name="ssc_batch">
              <option value="">-- Select Year --</option>
            </select>
          </div>
          <div>
            <label for="hsc_batch">HSC Batch <small class="hint">(Year)</small></label>
            <select id="hsc_batch" name="hsc_batch">
              <option value="">-- Select Year --</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div>
            <label for="guest_above_12">Guest (above 12) <span class="muted">(required)</span></label>
            <input type="number" id="guest_above_12" name="guest_above_12" min="0" value="0" required inputmode="numeric" />
          </div>
        </div>

        <button type="submit" id="submitBtn">Submit</button>
        <span id="saving" class="muted" style="display:none;margin-left:8px;">Saving…</span>
      </form>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

  <script>
    // Toastr config
    toastr.options = {
      closeButton: true,
      progressBar: true,
      newestOnTop: true,
      positionClass: "toast-top-right",
      timeOut: 3000
    };

    // Populate year dropdowns
    (function fillYearDropdowns(){
      const start = 1980, end = new Date().getFullYear();
      for(let y=end; y>=start; y--){
        $('#ssc_batch,#hsc_batch').append(`<option value="${y}">${y}</option>`);
      }
    })();

    // CSRF for AJAX
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
    });

    // Init DataTable
    const table = $('#regTable').DataTable({
      paging: true,
      searching: true,
      info: true,
      responsive: true,
      autoWidth: false,
      columns: [
        { data: null, render: (d,t,r,meta)=> meta.row + 1 }, // index
        { data: 'name' },
        { data: 'email' },
        { data: 'phone', defaultContent: '' },
        { data: 'ssc_batch', defaultContent: '' },
        { data: 'hsc_batch', defaultContent: '' },
        { data: 'guest_above_12' }
      ]
    });

    // Load data into DataTable
    function loadRegistrations(){
      $.get("{{ route('registrations.index') }}", function(resp){
        if(resp && resp.data){
          table.clear().rows.add(resp.data).draw();
        }
      });
    }
    loadRegistrations(); // initial

    // Submit handler
    const form = $('#regForm');
    const submitBtn = $('#submitBtn');
    const saving = $('#saving');

    form.on('submit', function(e){
      e.preventDefault();
      submitBtn.prop('disabled', true);
      saving.show();

      const payload = {
        name: $('#name').val().trim(),
        email: $('#email').val().trim(),
        phone: $('#phone').val().trim(),
        ssc_batch: $('#ssc_batch').val() || null,
        hsc_batch: $('#hsc_batch').val() || null,
        guest_above_12: $('#guest_above_12').val()
      };

      $.post("{{ route('registrations.store') }}", payload)
        .done(function(resp){
          if(resp && resp.success){
            toastr.success(resp.message || 'Saved!');
            form.trigger('reset');
            loadRegistrations(); // refresh table
          } else {
            toastr.info('Request completed.');
          }
        })
        .fail(function(xhr){
          if(xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors){
            const errors = xhr.responseJSON.errors;
            Object.keys(errors).forEach(function(key){
              toastr.error(errors[key][0]);
            });
          } else {
            toastr.error('Something went wrong. Please try again.');
          }
        })
        .always(function(){
          submitBtn.prop('disabled', false);
          saving.hide();
        });
    });
  </script>
</body>
</html>

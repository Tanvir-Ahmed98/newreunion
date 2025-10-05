<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>🎓 EUSCIANS Reunion 2026 – Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- Styles -->
  <style>
    :root{
      /* Cool Minimalist palette */
      --bg1:#E8F0F2;            /* page background */
      --bg2:#E8F0F2;
      --text:#2F3640;           /* main text */
      --muted:#5B6B75;          /* helper/subtle text */
      --ring:#1ABC9C;           /* accents & focus */
      --success:#10b981;
      --danger:#ef4444;

      --shadow: 0 12px 40px rgba(44,62,80,.12);

      /* surfaces / fields */
      --card-bg:#FFFFFF;        /* form container */
      --section-surface:#F6FAFB;
      --field-bg:#FFFFFF;
      --field-border:#D5E0E6;
      --field-border-focus:#1ABC9C;
      --link:#1ABC9C;
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
      color:var(--text);
      background: var(--bg1);
    }

    .container{ min-height:100%; display:grid; place-items:center; padding:40px 20px; }

    .card{
      width:min(920px, 100%);
      background: var(--card-bg);
      border:1px solid #E1EAEE;
      border-radius:20px;
      box-shadow:var(--shadow);
      overflow:hidden;
    }

    .card-header{
      padding:28px 28px 18px;
      background:#2C3E50;                  /* header bar */
      color:#FFFFFF;
      border-bottom:1px solid rgba(0,0,0,.05);
    }
    .title{ margin:0 0 6px; font-weight:900; font-size:28px; letter-spacing:.3px; color:#FFFFFF; }
    .subtitle{ margin:0; color:rgba(255,255,255,.85); font-size:14px; }

    .card-body{ padding:24px; }

    .grid{ display:grid; gap:16px; grid-template-columns:1fr 1fr; }
    .grid.full{ grid-template-columns:1fr; }

    label{ display:block; font-weight:700; margin:0 0 6px; color:var(--text); }
    .muted{ color:var(--muted); font-weight:600; }
    .help{ color:var(--muted); font-size:12px; margin-top:6px; }

    /* Clean, light inputs */
    input,select,textarea{
      width:100%;
      background: var(--field-bg);
      color:var(--text);
      border:1px solid var(--field-border);
      border-radius:12px;
      padding:12px 14px;
      font-size:15px;
      outline:none;
      transition:.2s border-color,.2s box-shadow,.2s transform,.2s background-color;
    }
    input::placeholder, textarea::placeholder{ color:#8FA3AE; }
    input:focus,select:focus,textarea:focus{
      border-color: var(--field-border-focus);
      box-shadow: 0 0 0 3px rgba(26,188,156,.18);
      transform: translateY(-1px);
    }

    /* Better spacing between side-by-side fields */
    .flex{
      display:flex;
      gap:20px;           /* spacing between SSC & HSC etc */
      flex-wrap:wrap;
      margin-top:12px;
    }
    .flex > div{
      flex:1 1 260px;
      min-width:260px;
    }

    /* optional: more space inside dropdown items */
    select option{ padding:8px 12px; }

    .row{ display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
    .thumb{ width:40px;height:40px;border-radius:10px;object-fit:cover; border:1px solid var(--field-border); }

    /* Info/Note blocks on a light surface */
    .note{
      font-size:13px;
      color:#2F3640;
      background:var(--section-surface);
      border:1px solid #E1EAEE;
      padding:10px 12px;
      border-radius:12px;
      margin-top:8px;
    }

    .actions{ display:flex; gap:12px; margin-top:18px; flex-wrap:wrap; }

    button{
      appearance:none;
      border:none;
      cursor:pointer;
      padding:12px 18px;
      border-radius:12px;
      font-weight:800;
      font-size:15px;
      transition:.2s transform,.2s box-shadow,.2s background-color;
    }
    .btn-primary{
      background:#1ABC9C;                 /* teal button */
      color:#FFFFFF;
      box-shadow:0 8px 24px rgba(26,188,156,.28);
    }
    .btn-primary:hover{ transform: translateY(-2px); filter:brightness(.95); }
    .btn-secondary{
      background:#FFFFFF;
      color:#2C3E50;
      border:1px solid #CBD8DF;
      box-shadow:none;
    }
    .btn-secondary:hover{ background:#F3F7F9; transform: translateY(-2px); }

    /* Sections get a subtle light surface */
    .section{
      margin:8px 0 0;
      padding:18px 18px 2px;
      border:1px dashed #E1EAEE;
      border-radius:14px;
      background: var(--section-surface);
    }

    /* Fee paragraph box */
    .info-box{
      background:#FFFFFF;
      border:1px solid #E1EAEE;
      border-radius:12px;
      padding:14px 16px;
      color:var(--text);
      line-height:1.55;
    }
    .info-box p{ margin:0 0 8px; }
    .info-box p:last-child{ margin:0; }

    /* Radio group spacing (if used) */
    [role="radiogroup"]{ display:flex; gap:16px; flex-wrap:wrap; margin-top:6px; }
    [role="radiogroup"] label{ display:inline-flex; align-items:center; gap:6px; }

    /* Table */
    table{ width:100%; border-collapse:collapse; font-size:14px; color:var(--text); }
    th, td{ border:1px solid #E1EAEE; padding:8px; text-align:center; }
    th{ background:#F3F7F9; }

    dialog{ border:none; border-radius:16px; padding:0; overflow:hidden; box-shadow:var(--shadow); }
    dialog::backdrop{ background:rgba(0,0,0,.35); }
    .modal{ background:#FFFFFF; color:var(--text); }
    .modal header{ padding:16px 18px; border-bottom:1px solid #EAEFF2; font-weight:800; }
    .modal .content{ padding:18px; }
    .modal .footer{ display:flex; justify-content:flex-end; gap:10px; padding:12px 18px; border-top:1px solid #EAEFF2; }
    .link{ color:var(--link); text-decoration:underline; cursor:pointer; }

    @media (max-width:900px){
      .grid{ grid-template-columns:1fr; }
      .card-body{ padding:18px; }
      .card-header{ padding:22px 18px 14px; }
      .title{ font-size:24px; }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h1 class="title">🎓 EUSCIANS Reunion 2026 – Registration</h1>
        <p class="subtitle">Fill in your details to confirm attendance. Fields marked required must be completed.</p>
      </div>

      <div class="card-body">
        <form id="regForm" autocomplete="off" enctype="multipart/form-data">

          <!-- Fee & Payment info -->
          <div class="section">
            <div class="grid full">
              <div>
                <label>Fee Structure & Payment Instructions</label>
                <div class="info-box">
                  <p><strong>Registration Fee (SSC is primary; HSC used if SSC empty)</strong></p>
                  <p>• <strong>1985–2000:</strong> 2000 BDT</p>
                  <p>• <strong>2001–2015:</strong> 1500 BDT</p>
                  <p>• <strong>2016–2025:</strong> 1000 BDT</p>
                  <p style="margin-top:10px;"><strong>Per additional guest aged 12+ :</strong> 1000 BDT</p>

                  <p style="margin-top:12px;"><strong>Payment:</strong></p>
                  <p>• bKash/Nagad: ____________ (Merchant/Personal)</p>
                  <p>• Reference: Your Name + Phone</p>
                  <p>• After payment, include Txn ID in the notes (optional).</p>
                </div>
                <div class="help">SSC/HSC whichever is available is used to determine the base fee (SSC preferred).</div>
              </div>
            </div>
          </div>

          <!-- Basic info -->
          <div class="section">
            <div class="grid full">
              <div>
                <label for="name">Full Name (as per SSC/HSC certificate) <span class="muted">(required)</span></label>
                <input type="text" id="name" name="name" required />
              </div>
            </div>

            <!-- Side-by-side SSC + HSC dropdowns -->
              <div class="help">Pick your SSC and/or HSC year. At least one is required (SSC used as primary).</div>
            <div class="flex">
              <div>
                <label for="ssc_year">SSC Year <span class="muted">(1985–2025)</span></label>
                <select id="ssc_year" name="ssc_year">
                  <option value="">-- Select --</option>
                </select>
              </div>
              <div>
                <label for="hsc_year">HSC Year <span class="muted">(1998–2025)</span></label>
                <select id="hsc_year" name="hsc_year">
                  <option value="">-- Select --</option>
                </select>
              </div>
            </div>

            <div class="grid">
              <div>
                <label for="phone">Phone Number <span class="muted">(required)</span></label>
                <input type="tel" id="phone" name="phone" required placeholder="+8801XXXXXXXXX" inputmode="tel" />
                <div class="help">Include country code if outside Bangladesh.</div>
              </div>
              <div>
                <label for="email">Email Address <span class="muted">(required)</span></label>
                <input type="email" id="email" name="email" required inputmode="email" />
              </div>
            </div>

            <div class="grid full">
              <div>
                <label for="location">Current / Permanent Location <span class="muted">(required)</span></label>
                <input type="text" id="location" name="location" required placeholder="e.g., Dhaka – Bangladesh, New York – USA" />
              </div>
            </div>

            <div class="grid full">
              <div>
                <label for="profession">Profession & Institutional Affiliation</label>
                <input type="text" id="profession" name="profession" placeholder="e.g., Doctor – Square Hospital, Engineer – Google" />
              </div>
            </div>

            <!-- Currency helper (appears if location is outside Bangladesh) -->
            <div class="grid full" id="currencyHelper" style="display:none;">
              <div>
                <label class="row" style="justify-content:space-between; gap:10px; align-items:baseline;">
                  <span>USD ⇄ BDT Helper</span>
                  <span class="muted" style="font-weight:500; font-size:12px;">Edit the rate to match today's market</span>
                </label>
                <div class="row" style="gap:12px; flex-wrap:wrap;">
                  <div style="flex:1 1 160px; min-width:160px;">
                    <label for="fx_rate" class="muted" style="margin:0 0 4px;">Rate (1 USD ≈ BDT)</label>
                    <input type="number" id="fx_rate" name="fx_rate" min="1" step="0.01" value="120" inputmode="decimal" />
                  </div>
                  <div style="flex:1 1 160px; min-width:160px;">
                    <label for="usd_amount" class="muted" style="margin:0 0 4px;">USD</label>
                    <input type="number" id="usd_amount" name="usd_amount" min="0" step="0.01" placeholder="e.g., 50" inputmode="decimal" />
                  </div>
                  <div style="flex:1 1 160px; min-width:160px;">
                    <label for="bdt_amount" class="muted" style="margin:0 0 4px;">BDT (calculated)</label>
                    <input type="number" id="bdt_amount" name="bdt_amount" step="0.01" placeholder="—" inputmode="decimal" readonly />
                  </div>
                </div>
                <div class="help">This is an on-page helper only (no data is submitted). It shows up when the location seems outside Bangladesh.</div>
              </div>
            </div>

            <!-- Attendance & preferences -->
           
              <div class="flex">
                <div>
                  <label for="guests_total">Number of Guests / Family Members Attending</label>
                  <input type="number" id="guests_total" name="guests_total" min="0" value="0" inputmode="numeric" />
                </div>
                <div>
                  <label for="guest_above_12">Guests aged 12+ <span class="muted">(required)</span></label>
                  <input type="number" id="guest_above_12" name="guest_above_12" min="0" value="0" required inputmode="numeric" />
                  <div class="note">An additional <strong>1000 BDT</strong> will be charged for each guest aged 12 or over.</div>
                </div>
              </div>

              <div class="grid">
                <div>
                  <label for="tshirt_size">Preferred T-Shirt Size</label>
                  <select id="tshirt_size" name="tshirt_size">
                    <option value="">-- Select --</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                  </select>
                  <div class="help">Please check the <span id="openSizeChart" class="link">size chart</span> before selecting.</div>
                </div>
              </div>

              <div class="grid full">
                <div>
                  <label for="photo">Upload Your Photo (JPG/PNG, Max 20MB)</label>
                  <div class="row">
                    <input type="file" id="photo" name="photo" accept="image/jpeg,image/png" />
                    <img id="photoPreview" class="thumb" alt="" style="display:none;" />
                  </div>
                  <div class="help">Used for the reunion directory, ID card, and event displays.</div>
                </div>
              </div>
          
          </div>

          <!-- Actions -->
          <div class="actions">
            <button type="submit" id="submitBtn" class="btn-primary">Submit Registration</button>
            <button type="reset" class="btn-secondary" id="resetBtn">Reset</button>
            <span id="saving" class="muted" style="align-self:center; display:none;">Saving…</span>
          </div>

          <!-- Hidden composed field to preserve existing backend 'batch' expectation -->
          <input type="hidden" id="batch" name="batch" />
          <!-- Hidden client registration id (added on confirm) -->
          <input type="hidden" id="client_reg_id" name="client_reg_id" />
          <!-- Hidden computed amount (added on confirm) -->
          <input type="hidden" id="payable_bdt" name="payable_bdt" />
        </form>
      </div>
    </div>
  </div>

  <!-- Size Chart Modal -->
  <dialog id="sizeChart">
    <div class="modal">
      <header>Unisex T-Shirt Size Chart (inches)</header>
      <div class="content">
        <table>
          <thead>
            <tr><th>Size</th><th>Chest</th><th>Length</th></tr>
          </thead>
          <tbody>
            <tr><td>S</td><td>34–36</td><td>27</td></tr>
            <tr><td>M</td><td>38–40</td><td>28</td></tr>
            <tr><td>L</td><td>42–44</td><td>29</td></tr>
            <tr><td>XL</td><td>46–48</td><td>30</td></tr>
            <tr><td>XXL</td><td>50–52</td><td>31</td></tr>
          </tbody>
        </table>
        <div class="help" style="margin-top:8px">Tip: Measure around the fullest part of the chest. If in between sizes, choose the larger size.</div>
      </div>
      <div class="footer">
        <button id="closeSizeChart" class="btn-secondary" style="box-shadow:none">Close</button>
      </div>
    </div>
  </dialog>

  <!-- Summary / Confirmation Modal (appears before submit) -->
  <dialog id="paymentSummary">
    <div class="modal">
      <header>Confirm Registration & Payment Summary</header>
      <div class="content">
        <p><strong>Registration ID:</strong> <span id="sumRegId">—</span></p>
        <p><strong>Primary Year Used:</strong> <span id="sumYear">—</span></p>
        <p style="margin-top:10px"><strong>Breakdown</strong></p>
        <ul style="margin:8px 0 0 18px; line-height:1.6">
          <li>Base Fee: <span id="sumBase">—</span> BDT</li>
          <li>Guests 12+ Fee: <span id="sumGuests">—</span> BDT</li>
        </ul>
        <p style="margin-top:10px; font-size:18px"><strong>Total Payable:</strong> <span id="sumTotal">—</span> BDT</p>
        <div class="help" style="margin-top:6px">Click “Confirm & Submit” to save your registration.</div>
      </div>
      <div class="footer">
        <button id="cancelSummary" class="btn-secondary">Back</button>
        <button id="confirmSummary" class="btn-primary">Confirm & Submit</button>
      </div>
    </div>
  </dialog>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    // Toastr config
    toastr.options = { closeButton: true, progressBar: true, newestOnTop: true, positionClass: "toast-top-right", timeOut: 3000 };

    // CSRF for AJAX
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') } });

    // Elements
    const form = $('#regForm');
    const submitBtn = $('#submitBtn');
    const saving = $('#saving');
    const photoEl = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');

    // Year dropdowns
    function fillYearRange(selectId, start, end){
      const sel = document.getElementById(selectId);
      for(let y=end; y>=start; y--){
        const opt = document.createElement('option');
        opt.value = String(y);
        opt.textContent = String(y);
        sel.appendChild(opt);
      }
    }
    fillYearRange('ssc_year', 1985, 2025);
    fillYearRange('hsc_year', 1998, 2025);

    // Size chart modal
    const dlgSize = document.getElementById('sizeChart');
    document.getElementById('openSizeChart').addEventListener('click', ()=> dlgSize.showModal());
    document.getElementById('closeSizeChart').addEventListener('click', ()=> dlgSize.close());

    // Currency helper logic
    const currencyHelper = document.getElementById('currencyHelper');
    const locationInput = document.getElementById('location');
    const fxRate = document.getElementById('fx_rate');
    const usdAmount = document.getElementById('usd_amount');
    const bdtAmount = document.getElementById('bdt_amount');

    function seemsInBangladesh(text){
      if(!text) return true;
      const t = text.toLowerCase();
      return t.includes('bangladesh') || t.includes('bd') || t.includes('dhaka');
    }
    function toggleCurrencyHelper(){
      const show = !seemsInBangladesh(locationInput.value.trim());
      if(currencyHelper){ currencyHelper.style.display = show ? 'block' : 'none'; }
    }
    function recomputeBDT(){
      const rate = parseFloat(fxRate?.value || '0');
      const usd = parseFloat(usdAmount?.value || '0');
      if(!isFinite(rate) || !isFinite(usd)) { if(bdtAmount) bdtAmount.value = ''; return; }
      if(bdtAmount) bdtAmount.value = (rate * usd).toFixed(2);
    }
    locationInput?.addEventListener('input', toggleCurrencyHelper);
    fxRate?.addEventListener('input', recomputeBDT);
    usdAmount?.addEventListener('input', recomputeBDT);
    toggleCurrencyHelper();

    // Photo preview + validation
    photoEl?.addEventListener('change', function(){
      const file = this.files && this.files[0];
      if(!file){ photoPreview.style.display = 'none'; photoPreview.src = ''; return; }
      const okTypes = ['image/jpeg','image/png'];
      const maxBytes = 20 * 1024 * 1024; // 20MB
      if(!okTypes.includes(file.type)){
        toastr.error('Photo must be a JPG or PNG.');
        this.value = '';
        photoPreview.style.display = 'none';
        return;
      }
      if(file.size > maxBytes){
        toastr.error('Photo must be 20MB or less.');
        this.value = '';
        photoPreview.style.display = 'none';
        return;
      }
      const url = URL.createObjectURL(file);
      photoPreview.src = url;
      photoPreview.style.display = 'inline-block';
    });

    // Guests cross-check
    function validateGuests(){
      const total = parseInt($('#guests_total').val() || '0', 10);
      const guests12 = parseInt($('#guest_above_12').val() || '0', 10);
      if(guests12 > total){
        toastr.error('Guests aged 12+ cannot exceed total guests.');
        return false;
      }
      if(total < 0 || guests12 < 0){
        toastr.error('Guest numbers cannot be negative.');
        return false;
      }
      return true;
    }

    // Compose legacy 'batch' string from SSC/HSC for backend compatibility
    function composeBatch(){
      const ssc = $('#ssc_year').val();
      const hsc = $('#hsc_year').val();
      let parts = [];
      if(ssc) parts.push(`SSC – ${ssc}`);
      if(hsc) parts.push(`HSC – ${hsc}`);
      return parts.join(', ');
    }

    // === Fee Logic ===
    // Determine primary year (SSC preferred, otherwise HSC). Require at least one.
    function getPrimaryYear(){
      const ssc = $('#ssc_year').val();
      const hsc = $('#hsc_year').val();
      if(ssc) return parseInt(ssc,10);
      if(hsc) return parseInt(hsc,10);
      return null;
    }
    function getBaseFee(year){
      if(year === null || !isFinite(year)) return 0;
      if(year >= 1985 && year <= 2000) return 2000;
      if(year >= 2001 && year <= 2015) return 1500;
      if(year >= 2016 && year <= 2025) return 1000;
      // fallback if out of expected range
      return 0;
    }
    function computePayable(){
      const primaryYear = getPrimaryYear();
      const base = getBaseFee(primaryYear);
      const guests12 = parseInt($('#guest_above_12').val() || '0', 10);
      const guestsFee = (isFinite(guests12) ? guests12 : 0) * 1000;
      const total = base + guestsFee;
      return { primaryYear, base, guestsFee, total };
    }

    // Summary dialog
    const sumDlg = document.getElementById('paymentSummary');
    const sumRegIdEl = document.getElementById('sumRegId');
    const sumYearEl = document.getElementById('sumYear');
    const sumBaseEl = document.getElementById('sumBase');
    const sumGuestsEl = document.getElementById('sumGuests');
    const sumTotalEl = document.getElementById('sumTotal');
    const confirmBtn = document.getElementById('confirmSummary');
    const cancelBtn = document.getElementById('cancelSummary');

    function genRegistrationId(){
      const ts = new Date();
      const pad = n => String(n).padStart(2,'0');
      const stamp = ts.getFullYear().toString() + pad(ts.getMonth()+1) + pad(ts.getDate()) + '-' + pad(ts.getHours()) + pad(ts.getMinutes()) + pad(ts.getSeconds());
      const rand = Math.floor(1000 + Math.random()*9000);
      return `EUSC-${stamp}-${rand}`;
    }

    let pendingFormData = null;   // holds FormData between dialog and final submit

    // Submit handler — show summary first
    form.on('submit', function(e){
      e.preventDefault();
      if(!validateGuests()) return;

      // require at least one of SSC/HSC
      const primaryYear = getPrimaryYear();
      if(primaryYear === null){
        toastr.error('Please select at least one: SSC Year or HSC Year.');
        return;
      }

      // prepare display values
      const { base, guestsFee, total } = computePayable();
      if(base === 0){
        toastr.error('Selected year is out of the allowed range.');
        return;
      }

      const regId = genRegistrationId();
      $('#client_reg_id').val(regId); // set hidden field for backend

      // fill dialog
      sumRegIdEl.textContent = regId;
      sumYearEl.textContent = String(primaryYear);
      sumBaseEl.textContent = String(base);
      sumGuestsEl.textContent = String(guestsFee);
      sumTotalEl.textContent = String(total);

      // Keep computed total to submit after confirmation
      $('#payable_bdt').val(String(total));

      // Build FormData now, but do not send yet
      $('#batch').val(composeBatch());
      const fd = new FormData();
      fd.append('name', $('#name').val().trim());
      fd.append('email', $('#email').val().trim());
      fd.append('phone', $('#phone').val().trim());
      fd.append('batch', $('#batch').val());
      fd.append('ssc_year', $('#ssc_year').val());
      fd.append('hsc_year', $('#hsc_year').val());
      fd.append('location', $('#location').val().trim());
      fd.append('profession', $('#profession').val().trim());
      fd.append('guests_total', $('#guests_total').val());
      fd.append('guest_above_12', $('#guest_above_12').val());
      fd.append('tshirt_size', $('#tshirt_size').val());
      fd.append('client_reg_id', $('#client_reg_id').val());
      fd.append('payable_bdt', $('#payable_bdt').val());
      if(photoEl && photoEl.files && photoEl.files[0]){ fd.append('photo', photoEl.files[0]); }
      pendingFormData = fd;

      // open dialog
      sumDlg.showModal();
    });

    cancelBtn.addEventListener('click', () => sumDlg.close());

    confirmBtn.addEventListener('click', () => {
      if(!pendingFormData){ sumDlg.close(); return; }

      const originalBtnText = submitBtn.text();
      submitBtn.prop('disabled', true).text('Submitting…');
      saving.show();

      $.ajax({
        url: "{{ route('registrations.store') }}",
        method: "POST",
        data: pendingFormData,
        contentType: false,
        processData: false
      })
      .done(function(resp){
        if(resp && resp.success){
          toastr.success(resp.message || 'Registration saved!');
          form.trigger('reset');
          photoPreview.style.display = 'none';
          photoPreview.src = '';
        } else if(resp && resp.message){
          toastr.info(resp.message);
        } else {
          toastr.info('Request completed.');
        }
      })
      .fail(function(xhr){
        if(xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors){
          const errors = xhr.responseJSON.errors;
          Object.keys(errors).forEach(function(key){ toastr.error(errors[key][0]); });
        } else if (xhr.status === 419) {
          toastr.error('Session expired (419). Please refresh the page and try again.');
        } else {
          toastr.error('Something went wrong. Please try again.');
        }
      })
      .always(function(){
        submitBtn.prop('disabled', false).text(originalBtnText);
        saving.hide();
        sumDlg.close();
        pendingFormData = null;
      });
    });

    // Reset Preview
    document.getElementById('resetBtn')?.addEventListener('click', () => {
      photoPreview.style.display = 'none';
      photoPreview.src = '';
    });
  </script>
</body>
</html>

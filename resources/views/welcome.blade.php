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

  <style>
    :root{
      --bg1:#0ea5e9;   /* sky */
      --bg2:#6366f1;   /* indigo */
      --card:#0b1220cc;/* glass */
      --ring:#22d3ee;  /* cyan accent */
      --text:#e5e7eb;  /* light text */
      --muted:#94a3b8; /* slate-400 */
      --success:#10b981;
      --danger:#ef4444;
      --shadow: 0 20px 60px rgba(0,0,0,.35);
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: ui-sans-serif,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
      color:var(--text);
      background:
        radial-gradient(1200px 800px at 10% -10%, rgba(255,255,255,.15), transparent 60%),
        radial-gradient(900px 600px at 110% 0%, rgba(255,255,255,.10), transparent 60%),
        linear-gradient(140deg, var(--bg1), var(--bg2));
    }

    .container{
      min-height:100%;
      display:grid;
      place-items:center;
      padding:40px 20px;
    }

    .card{
      width:min(920px, 100%);
      background:var(--card);
      backdrop-filter: blur(12px);
      border:1px solid rgba(255,255,255,.15);
      border-radius:20px;
      box-shadow:var(--shadow);
      overflow:hidden;
    }

    .card-header{
      padding:28px 28px 18px;
      background:
        radial-gradient(400px 120px at 20% 0%, rgba(34,211,238,.25), transparent 60%),
        radial-gradient(400px 120px at 80% 0%, rgba(99,102,241,.25), transparent 60%);
      border-bottom:1px solid rgba(255,255,255,.1);
    }
    .title{
      margin:0 0 6px;
      font-weight:900;
      font-size:28px;
      letter-spacing:.3px;
    }
    .subtitle{
      margin:0;
      color:var(--muted);
      font-size:14px;
    }

    .card-body{ padding:24px; }

    .grid{
      display:grid;
      gap:16px;
      grid-template-columns:1fr 1fr;
    }
    .grid.full{ grid-template-columns:1fr; }

    label{
      display:block;
      font-weight:700;
      margin:0 0 6px;
      color:#f3f4f6;
    }
    .muted{ color:var(--muted); font-weight:600; }
    .help{ color:var(--muted); font-size:12px; margin-top:6px; }

    input,select,textarea{
      width:100%;
      background:#0b1220;
      color:#e5e7eb;
      border:1px solid rgba(148,163,184,.35);
      border-radius:12px;
      padding:12px 14px;
      font-size:15px;
      outline:none;
      transition:.2s border-color,.2s box-shadow,.2s transform;
    }
    input::placeholder, textarea::placeholder{ color:#7c8aa3; }
    input:focus,select:focus,textarea:focus{
      border-color:var(--ring);
      box-shadow:0 0 0 4px rgba(34,211,238,.15);
      transform: translateY(-1px);
    }

    .row{ display:flex; gap:10px; align-items:center; }
    .thumb{
      width:40px;height:40px;border-radius:10px;object-fit:cover;
      border:1px solid rgba(148,163,184,.35);
    }

    .note{
      font-size:13px;
      color:#dbeafe;
      background:linear-gradient(180deg, rgba(99,102,241,.25), rgba(99,102,241,.15));
      border:1px solid rgba(99,102,241,.35);
      padding:10px 12px;
      border-radius:12px;
      margin-top:8px;
    }

    .actions{
      display:flex;
      gap:12px;
      margin-top:18px;
    }
    button{
      appearance:none;border:none;cursor:pointer;
      padding:12px 18px;border-radius:12px;font-weight:800;font-size:15px;
      transition:.2s transform,.2s box-shadow,.2s background-color;
      box-shadow:0 10px 30px rgba(34,211,238,.25);
    }
    .btn-primary{
      background:linear-gradient(135deg, #22d3ee, #60a5fa);
      color:#0b1220;
    }
    .btn-primary:hover{ transform: translateY(-2px); }
    .btn-secondary{
      background:transparent;color:#e5e7eb;border:1px solid rgba(255,255,255,.25);
      box-shadow:none;
    }
    .btn-secondary:hover{ background:rgba(255,255,255,.06); transform: translateY(-2px); }

    .section{
      margin:8px 0 0;
      padding:18px 18px 2px;
      border:1px dashed rgba(255,255,255,.13);
      border-radius:14px;
      background:linear-gradient(180deg, rgba(255,255,255,.03), transparent);
    }

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
          <!-- Basic info -->
          <div class="section">
            <div class="grid full">
              <div>
                <label for="name">Full Name (as per SSC/HSC certificate) <span class="muted">(required)</span></label>
                <input type="text" id="name" name="name" required />
              </div>
            </div>

            <div class="grid full">
              <div>
                <label for="batch">SSC or HSC Batch <span class="muted">(required)</span></label>
                <input type="text" id="batch" name="batch" required placeholder="e.g., SSC – 1985, HSC – 1990" />
                <div class="help">If you completed both at EUSC, please mention both.</div>
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
          </div>

          <!-- Attendance & preferences -->
          <div class="section">
            <div class="grid">
              <div>
                <label for="guests_total">Number of Guests / Family Members Attending</label>
                <select id="guests_total" name="guests_total">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5+</option>
                </select>
                <div class="note">An additional 1000 BDT will be charged for each guest aged 12 or over.</div>
              </div>
              <div>
                <label for="guest_above_12">Guests aged 12+ <span class="muted">(required)</span></label>
                <input type="number" id="guest_above_12" name="guest_above_12" min="0" value="0" required inputmode="numeric" />
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
                <div class="help">Please refer to the size chart before selecting.</div>
              </div>

              <div>
                <label for="donation_bdt">💙 Contribution to EUSCAA (BDT)</label>
                <input type="number" id="donation_bdt" name="donation_bdt" min="0" step="100" placeholder="e.g., 1000" />
                <div class="help">Any amount—small or large—helps support alumni & student welfare.</div>
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
        </form>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
    // Toastr config
    toastr.options = {
      closeButton: true,
      progressBar: true,
      newestOnTop: true,
      positionClass: "toast-top-right",
      timeOut: 3000
    };

    // CSRF for AJAX
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
    });

    // Elements
    const form = $('#regForm');
    const submitBtn = $('#submitBtn');      // jQuery
    const saving = $('#saving');            // jQuery
    const photoEl = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');

    // Photo validation + preview
    photoEl?.addEventListener('change', function(){
      const file = this.files && this.files[0];
      if(!file){
        photoPreview.style.display = 'none';
        photoPreview.src = '';
        return;
      }
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
      const totalVal = $('#guests_total').val();        // '0'..'5'
      const guests12 = parseInt($('#guest_above_12').val() || '0', 10);
      if(totalVal !== '5'){
        const total = parseInt(totalVal || '0', 10);
        if(guests12 > total){
          toastr.error('Guests aged 12+ cannot exceed total guests.');
          return false;
        }
      }
      return true;
    }

    // Submit handler (uses FormData for file upload)
    form.on('submit', function(e){
      e.preventDefault();
      if(!validateGuests()) return;

      const originalBtnText = submitBtn.text();
      submitBtn.prop('disabled', true).text('Submitting…');
      saving.show(); // show "Saving…"

      const fd = new FormData();
      fd.append('name', $('#name').val().trim());
      fd.append('email', $('#email').val().trim());
      fd.append('phone', $('#phone').val().trim());
      fd.append('batch', $('#batch').val().trim());
      fd.append('location', $('#location').val().trim());
      fd.append('profession', $('#profession').val().trim());
      fd.append('guests_total', $('#guests_total').val()); // '0'..'5'
      fd.append('guest_above_12', $('#guest_above_12').val());
      fd.append('tshirt_size', $('#tshirt_size').val());
      fd.append('donation_bdt', $('#donation_bdt').val());
      if(photoEl && photoEl.files && photoEl.files[0]){
        fd.append('photo', photoEl.files[0]);
      }

      $.ajax({
        url: "{{ route('registrations.store') }}",
        method: "POST",
        data: fd,
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
          Object.keys(errors).forEach(function(key){
            toastr.error(errors[key][0]);
          });
        } else if (xhr.status === 419) {
          toastr.error('Session expired (419). Please refresh the page and try again.');
        } else {
          toastr.error('Something went wrong. Please try again.');
        }
      })
      .always(function(){
        submitBtn.prop('disabled', false).text(originalBtnText);
        saving.hide(); // hide "Saving…"
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

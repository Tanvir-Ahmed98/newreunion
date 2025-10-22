<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>🎓 EUSCIANS Reunion 2026 – Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Tailwind (CDN) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- Minimal styles just for <dialog> backdrop -->
  <style>
    dialog::backdrop{ background:rgba(0,0,0,.35); }
  </style>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">
  <div class="min-h-screen grid place-items-center p-10">
    <div class="w-full max-w-[920px] bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">
      <!-- Header -->
      <div class="bg-slate-800 text-white border-b border-black/5 px-7 pt-7 pb-5 text-center">
        <h1 class="font-black text-2xl md:text-3xl tracking-tight mb-3">🎓 EUSCIANS Reunion 2026 – Registration</h1>
        <p class="text-white/90 text-sm md:text-base font-semibold">
          Fill in your details to confirm attendance.
          <span class="block md:inline text-base md:text-lg font-semibold">Fields marked required must be completed.</span>
        </p>
      </div>

      <!-- Body -->
      <div class="p-6 md:p-7">
        <form id="regForm" autocomplete="off" enctype="multipart/form-data" class="space-y-6">

          <!-- Fee & Payment info -->
          <section class="border border-slate-200 rounded-xl bg-slate-50 p-5">
            <div class="grid grid-cols-1 gap-4">
              <div>
                <label class="block font-bold mb-1">Fee Structure & Payment Instructions</label>
                <div class="bg-white border border-slate-200 rounded-xl p-4 leading-6 text-slate-800">
                  <p class="font-semibold">Registration Fee:</p>
                  <p>• <strong>1985-2015:</strong> 2000 BDT</p>
                  <p>• <strong>2016-2025:</strong> 1500 BDT</p>
                  <p>• <strong>Foreign Alumni:</strong> 5000 BDT (Souvenir will be shipped to you)</p>
                  <p class="mt-2"><strong>Additional Guest age 12 and above:</strong> 1000 BDT</p>

                  <p class="mt-3 font-semibold">Payment Method: <strong> Bkash</strong></p>
                  <p>• Marchant Acc: +8801879996066 (EUSCAA)</p>
                </div>
                <div class="text-red-600 text-sm mt-2">A unique reference number will be generated after submitting this form. Use this number to pay your registration fee. Registration will not be completed without it.</div>
              </div>
            </div>
          </section>

          <!-- Basic info -->
          <section class="border border-slate-200 rounded-xl bg-slate-50 p-5 space-y-5">
            <div class="grid grid-cols-1 gap-4">
              <div>
                <label for="name" class="block font-bold mb-1">Full Name (According to SSC/HSC certificate) <span class="text-slate-500 font-semibold">(required)</span></label>
                <input id="name" name="name" required
                       class="w-full bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400" />
              </div>
            </div>

            <p class="text-slate-500 text-sm">Pick your SSC and/or HSC year. At least one is required (SSC used as primary).</p>

            <div class="flex flex-wrap gap-5 mt-1">
              <div class="min-w-[260px] flex-1">
                <label for="ssc_year" class="block font-bold mb-1">SSC Year <span class="text-slate-500 font-semibold">(1985–2025)</span></label>
                <select id="ssc_year" name="ssc_year"
                        class="w-full bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400">
                  <option value="">-- Select --</option>
                </select>
              </div>
              <div class="min-w-[260px] flex-1">
                <label for="hsc_year" class="block font-bold mb-1">HSC Year <span class="text-slate-500 font-semibold">(1998–2025)</span></label>
                <select id="hsc_year" name="hsc_year"
                        class="w-full bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400">
                  <option value="">-- Select --</option>
                </select>
              </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <label for="phone" class="block font-bold mb-1">Phone Number <span class="text-slate-500 font-semibold">(required)</span></label>
                <input type="tel" id="phone" name="phone" required placeholder="+8801XXXXXXXXX" inputmode="tel"
                       class="w-full bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400" />
                <div class="text-slate-500 text-sm mt-1">Include country code if outside Bangladesh.</div>
              </div>
              <div>
                <label for="email" class="block font-bold mb-1">Email Address <span class="text-slate-500 font-semibold">(required)</span></label>
                <input type="email" id="email" name="email" required inputmode="email"
                       class="w-full bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400" />
              </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
              <div>
                <label for="location" class="block font-bold mb-1">Current / Permanent Location <span class="text-slate-500 font-semibold">(required)</span></label>
                <input type="text" id="location" name="location" required placeholder="e.g., Dhaka – Bangladesh, New York – USA"
                       class="w-full bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400" />
              </div>
            </div>

            <!-- Do you live abroad? (Yes/No only) -->
            <div class="grid grid-cols-1 gap-4">
              <div>
                <label class="block font-bold mb-1">Do you live abroad? <span class="text-slate-500 font-semibold">(required)</span></label>
                <div role="radiogroup" aria-label="Do you live abroad?" class="flex flex-wrap gap-4 mt-1">
                  <label class="inline-flex items-center gap-2">
                    <input type="radio" name="live_abroad" id="live_abroad_yes" value="yes" required class="accent-teal-500">
                    <span>Yes</span>
                  </label>
                  <label class="inline-flex items-center gap-2">
                    <input type="radio" name="live_abroad" id="live_abroad_no" value="no" class="accent-teal-500">
                    <span>No</span>
                  </label>
                </div>
              </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
              <div>
                <label for="profession" class="block font-bold mb-1">Profession & Institutional Affiliation</label>
                <input type="text" id="profession" name="profession" placeholder="e.g., Doctor – Square Hospital, Engineer – Google"
                       class="w-full bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400" />
              </div>
            </div>

            <!-- Attendance & preferences -->
            <div class="flex flex-wrap gap-5">
              <div class="min-w-[260px] flex-1">
                <label for="guests_total" class="block font-bold mb-1">Number of Guests / Family Members Attending</label>
                <input type="number" id="guests_total" name="guests_total" min="0" value="0" inputmode="numeric"
                       class="w-full bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400" />
              </div>
              <div class="min-w-[260px] flex-1">
                <label for="guest_above_12" class="block font-bold mb-1">Guests aged 12+ <span class="text-slate-500 font-semibold">(required)</span></label>
                <input type="number" id="guest_above_12" name="guest_above_12" min="0" value="0" required inputmode="numeric"
                       class="w-full bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400" />
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label for="tshirt_size" class="block font-bold mb-1">Preferred T-Shirt Size</label>
                <select id="tshirt_size" name="tshirt_size"
                        class="w-full bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400">
                  <option value="">-- Select --</option>
                  <option value="S">S</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
                  <option value="XXL">XXL</option>
                </select>
                <div class="text-slate-500 text-sm mt-1">Please check the <span id="openSizeChart" class="underline text-teal-600 cursor-pointer">size chart</span> before selecting.</div>
              </div>
            </div>

            <div class="grid grid-cols-1 gap-4">
              <div>
                <label for="photo" class="block font-bold mb-1">Upload Your Photo (JPG/PNG, Max 20MB)</label>
                <div class="flex items-center gap-3 flex-wrap">
                  <input type="file" id="photo" name="photo" accept="image/jpeg,image/png"
                         class="block w-full md:w-auto bg-white text-slate-800 border border-slate-300 rounded-xl px-4 py-3 text-base outline-none focus:ring-2 focus:ring-teal-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 file:text-sm file:font-semibold hover:file:bg-slate-200" />
                  <img id="photoPreview" alt="" class="w-10 h-10 rounded-lg object-cover border border-slate-300 hidden" />
                </div>
                <div class="text-slate-500 text-sm mt-1">Used for the reunion directory, ID card, and event displays.</div>
              </div>
            </div>
          </section>

          <!-- Actions -->
          <div class="flex items-center gap-3 flex-wrap">
            <button type="submit" id="submitBtn"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl font-extrabold text-white bg-teal-500 shadow-lg shadow-teal-500/30 hover:brightness-95 transition">
              Submit Registration
            </button>
            <button type="reset" id="resetBtn"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl font-bold border border-slate-300 bg-white text-slate-800 hover:bg-slate-100 transition">
              Reset
            </button>
            <span id="saving" class="text-slate-500 hidden">Saving…</span>
          </div>

          <!-- Hidden fields -->
          <input type="hidden" id="batch" name="batch" />
          <input type="hidden" id="client_reg_id" name="client_reg_id" />
          <input type="hidden" id="payable_amount" name="payable_amount" />
        </form>
      </div>
    </div>
  </div>

  <!-- Size Chart Modal -->
  <dialog id="sizeChart" class="rounded-2xl overflow-hidden shadow-2xl">
    <div class="bg-white text-slate-800">
      <header class="px-5 py-4 border-b border-slate-200 font-extrabold">Unisex T-Shirt Size Chart (inches)</header>
      <div class="p-5">
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-slate-800 border-collapse">
            <thead>
              <tr>
                <th class="border border-slate-200 bg-slate-100 px-3 py-2">Size</th>
                <th class="border border-slate-200 bg-slate-100 px-3 py-2">Chest</th>
                <th class="border border-slate-200 bg-slate-100 px-3 py-2">Length</th>
              </tr>
            </thead>
            <tbody>
              <tr><td class="border px-3 py-2">S</td><td class="border px-3 py-2">34–36</td><td class="border px-3 py-2">27</td></tr>
              <tr><td class="border px-3 py-2">M</td><td class="border px-3 py-2">38–40</td><td class="border px-3 py-2">28</td></tr>
              <tr><td class="border px-3 py-2">L</td><td class="border px-3 py-2">42–44</td><td class="border px-3 py-2">29</td></tr>
              <tr><td class="border px-3 py-2">XL</td><td class="border px-3 py-2">46–48</td><td class="border px-3 py-2">30</td></tr>
              <tr><td class="border px-3 py-2">XXL</td><td class="border px-3 py-2">50–52</td><td class="border px-3 py-2">31</td></tr>
            </tbody>
          </table>
        </div>
        <div class="text-slate-500 text-sm mt-2">Tip: Measure around the fullest part of the chest. If in between sizes, choose the larger size.</div>
      </div>
      <div class="px-5 py-3 border-t border-slate-200 flex justify-end">
        <button id="closeSizeChart" class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-100">Close</button>
      </div>
    </div>
  </dialog>

  <!-- Summary / Confirmation Modal -->
  <dialog id="paymentSummary" class="rounded-2xl overflow-hidden shadow-2xl">
    <div class="bg-white text-slate-800">
      <header class="px-5 py-4 border-b border-slate-200 font-extrabold">Confirm Registration & Payment Summary</header>
      <div class="p-5 space-y-2">
        <p><strong>Registration ID:</strong> <span id="sumUid">—</span></p>
        <p class="mt-2 font-semibold">Breakdown</p>
        <ul class="list-disc pl-6 leading-7">
          <li>Base Fee: <span id="sumBase">—</span> BDT</li>
          <li>Guests 12+ Fee: <span id="sumGuests">—</span> BDT</li>
        </ul>
        <p class="mt-2 text-lg"><strong>Total Payable:</strong> <span id="sumTotal">—</span> BDT</p>
        <div class="text-slate-500 text-sm mt-1">Click “Confirm & Submit” to save your registration.</div>
      </div>
      <div class="px-5 py-3 border-t border-slate-200 flex justify-end gap-2">
        <button id="cancelSummary" class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-100">Back</button>
        <button id="confirmSummary" class="px-4 py-2 rounded-lg font-bold text-white bg-teal-500 hover:brightness-95 shadow">Confirm & Submit</button>
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

    const form = $('#regForm');
    const submitBtn = $('#submitBtn');
    const saving = $('#saving');
    const photoEl = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');

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

    // Photo preview
    photoEl?.addEventListener('change', function(){
      const file = this.files && this.files[0];
      if(!file){ photoPreview.classList.add('hidden'); photoPreview.src=''; return; }
      const okTypes = ['image/jpeg','image/png'];
      const maxBytes = 20 * 1024 * 1024;
      if(!okTypes.includes(file.type)){
        toastr.error('Photo must be a JPG or PNG.');
        this.value = '';
        photoPreview.classList.add('hidden');
        return;
      }
      if(file.size > maxBytes){
        toastr.error('Photo must be 20MB or less.');
        this.value = '';
        photoPreview.classList.add('hidden');
        return;
      }
      const url = URL.createObjectURL(file);
      photoPreview.src = url;
      photoPreview.classList.remove('hidden');
    });

    // Guest validation
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

    function composeBatch(){
      const ssc = $('#ssc_year').val();
      const hsc = $('#hsc_year').val();
      let parts = [];
      if(ssc) parts.push(`SSC – ${ssc}`);
      if(hsc) parts.push(`HSC – ${hsc}`);
      return parts.join(', ');
    }

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
      return 0;
    }

    function computePayable(){
      const primaryYear = getPrimaryYear();
      const baseLocal = getBaseFee(primaryYear);
      const liveAbroad = document.getElementById('live_abroad_yes')?.checked;
      const base = liveAbroad ? 5000 : baseLocal;
      const guests12 = parseInt($('#guest_above_12').val() || '0', 10);
      const guestsFee = (isFinite(guests12) ? guests12 : 0) * 1000;
      const total = base + guestsFee;
      return { primaryYear, base, guestsFee, total };
    }

    function computeBaseUid(name, ssc, hsc, phone){
      const year = (ssc && String(ssc).trim()) ? String(ssc).trim() : String(hsc || '').trim();
      if(!year) return null;
      const first3 = String(name || '').toLowerCase().replace(/[^a-z]/g,'').slice(0,3);
      const digits = String(phone || '').replace(/\D/g,'');
      const last4  = digits.slice(-4);
      if(!first3 || last4.length < 4) return null;
      return `${year}-${first3}-${last4}`;
    }

    const sumDlg = document.getElementById('paymentSummary');
    const sumUidEl = document.getElementById('sumUid');
    const sumBaseEl = document.getElementById('sumBase');
    const sumGuestsEl = document.getElementById('sumGuests');
    const sumTotalEl = document.getElementById('sumTotal');

    function genRegistrationId(){
      const ts = new Date();
      const pad = n => String(n).padStart(2,'0');
      const stamp = ts.getFullYear().toString() + pad(ts.getMonth()+1) + pad(ts.getDate()) + '-' + pad(ts.getHours()) + pad(ts.getMinutes()) + pad(ts.getSeconds());
      const rand = Math.floor(1000 + Math.random()*9000);
      return `EUSC-${stamp}-${rand}`;
    }

    let pendingFormData = null;

    form.on('submit', function(e){
      e.preventDefault();
      if(!validateGuests()) return;

      const primaryYear = getPrimaryYear();
      if(primaryYear === null){
        toastr.error('Please select at least one: SSC Year or HSC Year.');
        return;
      }

      const { base, guestsFee, total } = computePayable();
      if(base === 0){
        toastr.error('Selected year is out of the allowed range.');
        return;
      }

      const regId = genRegistrationId();
      $('#client_reg_id').val(regId);

      const baseUid = computeBaseUid($('#name').val(), $('#ssc_year').val(), $('#hsc_year').val(), $('#phone').val());
      sumUidEl.textContent = baseUid || '—';
      sumBaseEl.textContent = String(base);
      sumGuestsEl.textContent = String(guestsFee);
      sumTotalEl.textContent = String(total);

      $('#payable_amount').val(String(total));
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
      fd.append('payable_amount', $('#payable_amount').val());
      fd.append('live_abroad', (document.getElementById('live_abroad_yes')?.checked) ? 'yes' : 'no');
      if (baseUid) fd.append('client_reg_id', baseUid);
      if(photoEl && photoEl.files && photoEl.files[0]){ fd.append('photo', photoEl.files[0]); }
      pendingFormData = fd;

      sumDlg.showModal();
    });

    document.getElementById('cancelSummary').addEventListener('click', () => sumDlg.close());
    document.getElementById('confirmSummary').addEventListener('click', () => {
      if(!pendingFormData){ sumDlg.close(); return; }
      const originalBtnText = submitBtn.text();
      submitBtn.prop('disabled', true).text('Submitting…');
      saving.removeClass('hidden');

      $.ajax({
        url: "{{ route('registrations.store') }}",
        method: "POST",
        data: pendingFormData,
        contentType: false,
        processData: false
      })
      .done(function(resp){
        if(resp && resp.success){
          if(resp.unique_id){
            toastr.success(`Registration saved. Your Unique ID: ${resp.unique_id}`);
            document.getElementById('sumUid').textContent = resp.unique_id;
          } else {
            toastr.success(resp.message || 'Registration saved!');
          }
          form.trigger('reset');
          photoPreview.classList.add('hidden');
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
        saving.addClass('hidden');
        sumDlg.close();
        pendingFormData = null;
      });
    });

    document.getElementById('resetBtn')?.addEventListener('click', () => {
      photoPreview.classList.add('hidden');
      photoPreview.src = '';
      document.getElementById('sumUid').textContent = '—';
    });
  </script>
</body>
</html>

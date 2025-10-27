<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>🎓 EUSCIANS Reunion 2026 – Registration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Tailwind & Toastr -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <style>
    dialog::backdrop { background: rgba(0,0,0,.35); }
  </style>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">

  <div class="min-h-screen grid place-items-center p-10">
    <div class="w-full max-w-[920px] bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden">

      <!-- Header -->
      <div class="bg-slate-800 text-white px-7 pt-7 pb-5 text-center">
        <h1 class="font-black text-2xl md:text-3xl mb-3">🎓 EUSCIANS Reunion 2026 – Registration</h1>
        <p class="text-white/90 text-sm md:text-base font-semibold">
          Fill in your details to confirm attendance.
          <span class="block md:inline text-base md:text-lg font-semibold">
            Fields marked required must be completed.
          </span>
        </p>
      </div>

      <!-- Body -->
      <div class="p-6 md:p-7">
        <form id="regForm" autocomplete="off" enctype="multipart/form-data" class="space-y-6">

          <!-- Fee Info -->
          <section class="border border-slate-200 rounded-xl bg-slate-50 p-5">
            <label class="block font-bold mb-1">Fee Structure & Payment Instructions</label>
            <div class="bg-white border border-slate-200 rounded-xl p-4 leading-6 text-slate-800">
              <p class="font-semibold">Registration Fee:</p>
              <p>• <strong>1985–2015:</strong> 2000 BDT</p>
              <p>• <strong>2016–2026:</strong> 1500 BDT</p>
              <p>• <strong>Foreign Alumni:</strong> 5000 BDT (Souvenir shipped)</p>
              <p class="mt-2"><strong>Guest 12+:</strong> 1000 BDT each</p>
              <p class="mt-3 font-semibold">Payment via <strong>Bkash</strong></p>
              <p>• Merchant Acc: +8801879996066 (EUSCAA)</p>
            </div>
            <p class="text-red-600 text-sm mt-2">
              A unique reference number will be generated after submitting this form. Use it when paying.
            </p>
          </section>

          <!-- Personal Info -->
          <section class="border border-slate-200 rounded-xl bg-slate-50 p-5 space-y-5">
            <div>
              <label for="name" class="block font-bold mb-1">Full Name <span class="text-slate-500">(required)</span></label>
              <input id="name" name="name" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400" />
            </div>

            <p class="text-slate-500 text-sm">Pick your SSC and/or HSC year. At least one is required.</p>

            <div class="flex flex-wrap gap-5">
              <div class="flex-1 min-w-[260px]">
                <label for="ssc_year" class="block font-bold mb-1">SSC Year (1985–2026)</label>
                <select id="ssc_year" name="ssc_year" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400"><option value="">-- Select --</option></select>
              </div>
              <div class="flex-1 min-w-[260px]">
                <label for="hsc_year" class="block font-bold mb-1">HSC Year (1998–2026)</label>
                <select id="hsc_year" name="hsc_year" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400"><option value="">-- Select --</option></select>
              </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
              <div>
                <label for="phone" class="block font-bold mb-1">Phone Number <span class="text-slate-500">(required)</span></label>
                <input id="phone" name="phone" required placeholder="+8801XXXXXXXXX" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400" />
              </div>
              <div>
                <label for="email" class="block font-bold mb-1">Email <span class="text-slate-500">(required)</span></label>
                <input id="email" name="email" required type="email" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400" />
              </div>
            </div>

            <div>
              <label for="location" class="block font-bold mb-1">Location <span class="text-slate-500">(required)</span></label>
              <input id="location" name="location" required placeholder="e.g., Dhaka – Bangladesh" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400" />
            </div>

            <div>
              <label class="block font-bold mb-1">Do you live abroad? <span class="text-slate-500">(required)</span></label>
              <div class="flex gap-4">
                <label class="inline-flex items-center gap-2"><input type="radio" name="live_abroad" id="live_abroad_yes" value="yes" required class="accent-teal-500"><span>Yes</span></label>
                <label class="inline-flex items-center gap-2"><input type="radio" name="live_abroad" id="live_abroad_no" value="no" class="accent-teal-500"><span>No</span></label>
              </div>
            </div>

            <div>
              <label for="profession" class="block font-bold mb-1">Profession & Affiliation</label>
              <input id="profession" name="profession" placeholder="e.g., Doctor – Square Hospital" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400" />
            </div>

            <div class="flex flex-wrap gap-5">
              <div class="flex-1 min-w-[260px]">
                <label for="guests_total" class="block font-bold mb-1">Total Guests</label>
                <input id="guests_total" name="guests_total" type="number" min="0" value="0" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400" />
              </div>
              <div class="flex-1 min-w-[260px]">
                <label for="guest_above_12" class="block font-bold mb-1">Guests 12+ <span class="text-slate-500">(required)</span></label>
                <input id="guest_above_12" name="guest_above_12" type="number" min="0" value="0" required class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400" />
              </div>
            </div>

            <div>
              <label for="tshirt_size" class="block font-bold mb-1">T-Shirt Size</label>
              <select id="tshirt_size" name="tshirt_size" class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-teal-400">
                <option value="">-- Select --</option><option>S</option><option>M</option><option>L</option><option>XL</option><option>XXL</option>
              </select>
              <p class="text-slate-500 text-sm mt-1">
                Check the <span id="openSizeChart" class="underline text-teal-600 cursor-pointer">size chart</span> before selecting.
              </p>
            </div>

            <div>
              <label for="photo" class="block font-bold mb-1">Upload Photo (JPG/PNG ≤ 20 MB)</label>
              <div class="flex items-center gap-3 flex-wrap">
                <input type="file" id="photo" name="photo" accept="image/jpeg,image/png"
                       class="border border-slate-300 rounded-xl px-4 py-3 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200" />
                <img id="photoPreview" class="w-10 h-10 rounded-lg border border-slate-300 hidden" />
              </div>
            </div>
          </section>

          <!-- Buttons -->
          <div class="flex items-center gap-3">
            <button id="submitBtn" class="px-5 py-3 rounded-xl font-extrabold text-white bg-teal-500 shadow-lg hover:brightness-95">Submit Registration</button>
            <button type="reset" id="resetBtn" class="px-5 py-3 rounded-xl font-bold border border-slate-300 bg-white hover:bg-slate-100">Reset</button>
            <span id="saving" class="text-slate-500 hidden">Saving…</span>
          </div>

          <input type="hidden" id="batch" name="batch">
          <input type="hidden" id="client_reg_id" name="client_reg_id">
          <input type="hidden" id="payable_amount" name="payable_amount">
        </form>
      </div>
    </div>
  </div>

  <!-- 🧢 Size Chart Modal -->
  <dialog id="sizeChart" class="rounded-2xl overflow-hidden shadow-2xl">
    <div class="bg-white text-slate-800">
      <header class="px-5 py-4 border-b border-slate-200 font-extrabold">Unisex T-Shirt Size Chart (inches)</header>
      <div class="p-5 overflow-x-auto">
        <table class="w-full text-sm border-collapse">
          <thead><tr class="bg-slate-100">
            <th class="border px-3 py-2">Size</th><th class="border px-3 py-2">Chest</th><th class="border px-3 py-2">Length</th>
          </tr></thead>
          <tbody>
            <tr><td class="border px-3 py-2">S</td><td class="border px-3 py-2">34–36</td><td class="border px-3 py-2">27</td></tr>
            <tr><td class="border px-3 py-2">M</td><td class="border px-3 py-2">38–40</td><td class="border px-3 py-2">28</td></tr>
            <tr><td class="border px-3 py-2">L</td><td class="border px-3 py-2">42–44</td><td class="border px-3 py-2">29</td></tr>
            <tr><td class="border px-3 py-2">XL</td><td class="border px-3 py-2">46–48</td><td class="border px-3 py-2">30</td></tr>
            <tr><td class="border px-3 py-2">XXL</td><td class="border px-3 py-2">50–52</td><td class="border px-3 py-2">31</td></tr>
          </tbody>
        </table>
      </div>
      <div class="px-5 py-3 border-t border-slate-200 text-right">
        <button id="closeSizeChart" class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-100">Close</button>
      </div>
    </div>
  </dialog>

  <!-- 💰 Payment Summary Modal -->
  <dialog id="paymentSummary" class="rounded-2xl overflow-hidden shadow-2xl">
    <div class="bg-white text-slate-800">
      <header class="px-5 py-4 border-b border-slate-200 font-extrabold">Confirm Registration & Payment Summary</header>
      <div class="p-5 space-y-2">
        <p><strong>Registration ID:</strong> <span id="sumUid">—</span></p>
        <ul class="list-disc pl-6 leading-7">
          <li>Base Fee: <span id="sumBase">—</span> BDT</li>
          <li>Guests 12+ Fee: <span id="sumGuests">—</span> BDT</li>
        </ul>
        <p class="mt-2 text-lg"><strong>Total Payable:</strong> <span id="sumTotal">—</span> BDT</p>
      </div>
      <div class="px-5 py-3 border-t border-slate-200 flex justify-end gap-2">
        <button id="cancelSummary" class="px-4 py-2 rounded-lg border border-slate-300 bg-white hover:bg-slate-100">Back</button>
        <button id="confirmSummary" class="px-4 py-2 rounded-lg font-bold text-white bg-teal-500 hover:brightness-95 flex items-center gap-2">
          <span class="btn-text">Confirm & Submit</span>
          <svg id="btnSpinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
          </svg>
        </button>
      </div>
    </div>
  </dialog>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    toastr.options={closeButton:true,progressBar:true,positionClass:"toast-top-right",timeOut:3000};
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content}});

    const form=$('#regForm'),submitBtn=$('#submitBtn'),saving=$('#saving');
    const photoEl=document.getElementById('photo'),photoPreview=document.getElementById('photoPreview');
    const sizeDlg=document.getElementById('sizeChart');
    document.getElementById('openSizeChart').onclick=()=>sizeDlg.showModal();
    document.getElementById('closeSizeChart').onclick=()=>sizeDlg.close();

    const confirmBtn=document.getElementById('confirmSummary'),btnSpinner=document.getElementById('btnSpinner'),btnText=confirmBtn.querySelector('.btn-text');
    const sumDlg=document.getElementById('paymentSummary'),sumUid=document.getElementById('sumUid'),sumBase=document.getElementById('sumBase'),sumGuests=document.getElementById('sumGuests'),sumTotal=document.getElementById('sumTotal');
    let pending=null;

    function fillYears(id,start,end){const el=document.getElementById(id);for(let y=end;y>=start;y--){el.innerHTML+=`<option>${y}</option>`;}}
    fillYears('ssc_year',1985,2026);fillYears('hsc_year',1998,2026);

    function genRegistrationId(){const t=new Date(),p=n=>String(n).padStart(2,'0');const s=`${t.getFullYear()}${p(t.getMonth()+1)}${p(t.getDate())}-${p(t.getHours())}${p(t.getMinutes())}${p(t.getSeconds())}`;return`EUSC-${s}-${Math.floor(1000+Math.random()*9000)}`;}
    function computeBaseUid(n,s,h,p){const y=s||h;if(!y)return null;const f=(n||'').toLowerCase().replace(/[^a-z]/g,'').slice(0,3);const d=(p||'').replace(/\D/g,'').slice(-4);return(f&&d.length===4)?`${y}-${f}-${d}`:null;}
    const getYear=()=>parseInt($('#ssc_year').val()||$('#hsc_year').val()||0), getFee=y=>y>=1985&&y<=2000?2000:y<=2015?1500:y<=2025?1000:0;
    const payable=()=>{const y=getYear(),base=getFee(y),ab=document.getElementById('live_abroad_yes').checked,b=ab?5000:base,g12=parseInt($('#guest_above_12').val()||0),gf=g12*1000;return{base:b,guestsFee:gf,total:b+gf};};

    form.on('submit',e=>{
      e.preventDefault();const y=getYear();if(!y){toastr.error('Select SSC or HSC year.');return;}
      const {base,guestsFee,total}=payable();if(base===0){toastr.error('Invalid year.');return;}
      const rid=genRegistrationId();$('#client_reg_id').val(rid);$('#payable_amount').val(total);$('#batch').val(`${$('#ssc_year').val()?`SSC – ${$('#ssc_year').val()}`:''}${$('#hsc_year').val()?`, HSC – ${$('#hsc_year').val()}`:''}`);
      const uid=computeBaseUid($('#name').val(),$('#ssc_year').val(),$('#hsc_year').val(),$('#phone').val());
      sumUid.textContent=uid||'—';sumBase.textContent=base;sumGuests.textContent=guestsFee;sumTotal.textContent=total;
      const fd=new FormData(form[0]);if(uid)fd.append('client_reg_id',uid);pending=fd;sumDlg.showModal();
    });

    document.getElementById('cancelSummary').onclick=()=>sumDlg.close();

    confirmBtn.onclick=()=>{
      if(!pending){sumDlg.close();return;}
      confirmBtn.disabled=true;btnSpinner.classList.remove('hidden');btnText.textContent='Submitting...';
      submitBtn.prop('disabled',true).text('Submitting…');saving.removeClass('hidden');
      $.ajax({url:"{{ route('registrations.store') }}",method:"POST",data:pending,contentType:false,processData:false})
      .done(r=>{if(r?.success){toastr.success(r.message||'Registration saved!');form.trigger('reset');photoPreview.classList.add('hidden');}
        else if(r?.message)toastr.info(r.message);else toastr.info('Done.');})
      .fail(x=>{if(x.status===422&&x.responseJSON?.errors)Object.values(x.responseJSON.errors).forEach(e=>toastr.error(e[0]));
        else if(x.status===419)toastr.error('Session expired.');else toastr.error('Something went wrong.');})
      .always(()=>{submitBtn.prop('disabled',false).text('Submit Registration');saving.addClass('hidden');confirmBtn.disabled=false;btnSpinner.classList.add('hidden');btnText.textContent='Confirm & Submit';sumDlg.close();pending=null;});
    };

    photoEl.onchange=()=>{const f=photoEl.files[0];if(!f){photoPreview.classList.add('hidden');return;}if(!['image/jpeg','image/png'].includes(f.type)||f.size>20*1024*1024){toastr.error('Invalid image.');photoEl.value='';return;}photoPreview.src=URL.createObjectURL(f);photoPreview.classList.remove('hidden');};
    document.getElementById('resetBtn').onclick=()=>{photoPreview.classList.add('hidden');photoPreview.src='';};
  </script>
</body>
</html>

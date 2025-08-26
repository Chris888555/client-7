<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GutGuard SynBIOTIC+</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
</head>
<body class="bg-white font-sans">

<!-- Hero / Caption -->
<section class="w-full relative">
    <!-- Image for PC only -->
    <img src="{{ asset('assets/images/pc-hero-image.png') }}" 
         alt="Hero PC" 
         class="hidden md:block w-full h-auto object-cover">

    <!-- Button for PC (absolute on image) -->
   <a href="javascript:void(0)" 
   class="hidden md:flex items-center md:absolute md:top-[65%] md:left-[7%] z-20 bg-blue-600 text-white px-8 py-3 font-semibold hover:bg-blue-700 transition rounded-lg openFormBtn">
    Learn More 
    <i class="fas fa-arrow-right ml-2"></i>
</a>

    <!-- Image for Mobile only -->
    <img src="{{ asset('assets/images/mobile-hero-image.png') }}"
         alt="Hero Mobile" 
         class="block md:hidden w-full h-auto object-cover mt-0">

    <!-- Button for Mobile (below image) -->
    <a href="javascript:void(0)" 
   class="block md:hidden flex items-center justify-center mt-4 bg-blue-600 text-white mt-8 px-8 py-3 font-semibold text-center hover:bg-blue-700 transition mx-auto w-max rounded-lg openFormBtn">
    Learn More 
    <i class="fas fa-arrow-right ml-2"></i>
</a>
</section>



<!-- Video Section -->
<section class="max-w-6xl mx-auto px-6 py-12 mt-5">
  <!-- Heading -->
  <h2 class="text-3xl md:text-4xl font-extrabold text-center mb-8 bg-clip-text text-blue-600">
    Watch How It Works
  </h2>

  <!-- Video Wrapper -->
  <div class="relative w-full max-w-4xl mx-auto rounded-2xl overflow-hidden shadow-2xl">
    <video class="w-full h-auto rounded-2xl " controls>
      <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
      Your browser does not support HTML5 video.
    </video>
  </div>

  <!-- Caption -->
  <p class="text-center mt-6 text-lg text-gray-700 max-w-2xl mx-auto">
    Experience the <span class="font-semibold text-blue-600">Gutguard SYNBIOTIC+</span> difference in action.
  </p>
</section>





<!-- SynBIOTIC+ Process Section with Number Icons in Circles -->
<section class="max-w-6xl mx-auto p-6 mt-5">
  <div class="flex flex-col md:flex-row items-center bg-white  p-6 md:gap-8 gap-4">

    <!-- Left: Product Illustration -->
    <div class="w-full md:w-1/2 flex justify-center">
      <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/68adc43b47df8_Untitleddesign25.png" 
           alt="SynBIOTIC+ Bottle" 
           class="w-full  object-contain">
    </div>

    <!-- Right: Text Content -->
    <div class="w-full md:w-1/2">
      <h3 class="text-3xl font-bold text-blue-700 mb-4">THE FUTURE OF HEALTH IS HERE</h3>
      <p class="text-gray-700 mb-6">Backed by 15 years of scientific and medical research. Produced in a ₱1 Billion ISO-certified facility. Developed with 7 leading organizations.</p>
      
      <ul class="space-y-6 text-gray-800 text-base w-full">
        <li class="flex items-start gap-4 flex-nowrap">
          <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex-shrink-0 flex items-center justify-center text-lg font-bold">
            1
          </div>
          <div><strong>Discover</strong> the power of 80 Billion CFU & 17 Strains</div>
        </li>
        <li class="flex items-start gap-4 flex-nowrap">
          <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex-shrink-0 flex items-center justify-center text-lg font-bold">
            2
          </div>
          <div><strong>Activate</strong> your cells with Urolithin A + XOS + Tributyrin</div>
        </li>
        <li class="flex items-start gap-4 flex-nowrap">
          <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex-shrink-0 flex items-center justify-center text-lg font-bold">
            3
          </div>
          <div><strong>Support</strong> full-body health with STEM CELL ACTIVATOR</div>
        </li>
        <li class="flex items-start gap-4 flex-nowrap">
          <div class="bg-blue-600 text-white rounded-full w-10 h-10 flex-shrink-0 flex items-center justify-center text-lg font-bold">
            4
          </div>
          <div><strong>Choose</strong> GutGuard SynBIOTIC+ — your health deserves the best</div>
        </li>
      </ul>
      
      <div class="mt-6 flex flex-wrap gap-4">
    <!-- Sa process section -->
<a href="javascript:void(0)" 
   class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition openFormBtn">
    Learn More
    <i class="fas fa-arrow-right ml-2"></i>
</a>
</div>
    </div>

  </div>
</section>

<!-- Benefits Section: How SynBIOTIC+ Helps You -->
<section class="max-w-6xl mx-auto p-6 mt-12">
  <div class="text-center mb-8">
    <h3 class="text-3xl font-bold text-blue-600 mb-3">Paano Makakatulong ang SynBIOTIC+ sa Iyo</h3>
    <p class="text-gray-600 text-base max-w-2xl mx-auto">Tingnan kung paano makakatulong ang SynBIOTIC+ sa kalusugan ng iyong tiyan at pangkalahatang lakas.</p>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-gray-100">
    <div class="bg-gray-800 p-4 rounded-lg shadow hover:shadow-xl transition flex flex-col items-start gap-2">
      <div class="text-blue-400 text-2xl mb-2"><i class="fas fa-shield-alt"></i></div>
      <h4 class="font-semibold text-lg">Malusog na Tiyan</h4>
      <p class="text-gray-300 text-sm">Mas maayos na digestion at nutrient absorption sa tulong ng probiotics.</p>
    </div>

    <div class="bg-gray-800 p-4 rounded-lg shadow hover:shadow-xl transition flex flex-col items-start gap-2">
      <div class="text-blue-400 text-2xl mb-2"><i class="fas fa-shield-alt"></i></div>
      <h4 class="font-semibold text-lg">Lakas ng Depensa</h4>
      <p class="text-gray-300 text-sm">Pinapalakas ang immune system para laban sa sakit at impeksyon.</p>
    </div>

    <div class="bg-gray-800 p-4 rounded-lg shadow hover:shadow-xl transition flex flex-col items-start gap-2">
      <div class="text-blue-400 text-2xl mb-2"><i class="fas fa-bolt"></i></div>
      <h4 class="font-semibold text-lg">Mas Enerhiya</h4>
      <p class="text-gray-300 text-sm">Masigla at alerto sa araw-araw dahil sa improved metabolism at cellular energy.</p>
    </div>

    <div class="bg-gray-800 p-4 rounded-lg shadow hover:shadow-xl transition flex flex-col items-start gap-2">
      <div class="text-blue-400 text-2xl mb-2"><i class="fas fa-heart"></i></div>
      <h4 class="font-semibold text-lg">Buong Katawan Suporta</h4>
      <p class="text-gray-300 text-sm">Tinutulungan ang katawan sa pangmatagalang wellness at overall vitality.</p>
    </div>
  </div>

  <div class="mt-8 text-center">
   <!-- Sa benefits section -->
<a href="javascript:void(0)" 
   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg transition openFormBtn">
    <i class="fas fa-cart-plus"></i> Learn more
</a>
  </div>
</section>





<!-- Feature -->
<section class="w-full relative">
    <!-- Image for PC only -->
    <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/68adc16dd73ca_BlueModernBuildingConstructionPresentation1080x400px3.png" 
         alt="Hero" 
         class="hidden md:block w-full h-auto object-cover">

    <!-- Image for Mobile only -->
    <img src="https://d1yei2z3i6k35z.cloudfront.net/4624298/68adc2da1f0e7_ModernProfessionalCVResume21x40.7cm2.png"
         alt="Hero Mobile" 
         class="block md:hidden w-full h-auto object-cover mt-0">
</section>




<!-- Scientific & Medical Advisory Board -->
<section class="max-w-6xl mx-auto p-6 mt-12">
  <h3 class="text-3xl font-bold mb-2 text-center text-blue-700">Our Scientific & Medical Advisory Board</h3>
  <p class="text-center text-sm italic text-gray-500 mb-10">"We take care of your HEALTH"</p>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">

    <!-- Dr. Roly Michael L. Racsa -->
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 text-center text-gray-100">
      <img src="https://img.freepik.com/premium-photo/indian-doctor_714173-1916.jpg" alt="Dr. Roly Racsa" class="h-32 w-32 object-cover mx-auto rounded-full ring-4 ring-blue-500 shadow-md mb-4">
      <h4 class="font-semibold text-xl mb-2">Dr. Roly Michael L. Racsa, CBE</h4>
      <div class="h-0.5 w-16 bg-blue-500 mx-auto mb-2 rounded"></div>
      <p class="text-sm text-gray-300">UN Technical Advisor, Ex-Professor in Mechanical & Civil Engineering</p>
      <p class="italic text-xs text-gray-400 mt-2">"We take care of your HEALTH"</p>
    </div>

    <!-- Dr. Roberto Malaluan -->
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 text-center text-gray-100">
      <img src="https://img.freepik.com/premium-photo/indian-doctor_714173-1916.jpg" alt="Dr. Roberto Malaluan" class="h-32 w-32 object-cover mx-auto rounded-full ring-4 ring-blue-500 shadow-md mb-4">
      <h4 class="font-semibold text-xl mb-2">Dr. Roberto Malaluan</h4>
      <div class="h-0.5 w-16 bg-blue-500 mx-auto mb-2 rounded"></div>
      <p class="text-sm text-gray-300">PhD in Chemical Engineering, NAST & PICHE Awardee</p>
      <p class="italic text-xs text-gray-400 mt-2">"We take care of your HEALTH"</p>
    </div>

    <!-- Dr. Jocelyn Arboleda -->
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 text-center text-gray-100">
      <img src="https://img.freepik.com/premium-photo/indian-doctor_714173-1916.jpg" alt="Dr. Jocelyn Arboleda" class="h-32 w-32 object-cover mx-auto rounded-full ring-4 ring-blue-500 shadow-md mb-4">
      <h4 class="font-semibold text-xl mb-2">Dr. Jocelyn Arboleda</h4>
      <div class="h-0.5 w-16 bg-blue-500 mx-auto mb-2 rounded"></div>
      <p class="text-sm text-gray-300">Board-Certified Internist, 30+ Years in Clinical Practice</p>
      <p class="italic text-xs text-gray-400 mt-2">"We take care of your HEALTH"</p>
    </div>

    <!-- Dr. Joey M. Sinchicco -->
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 text-center text-gray-100">
      <img src="https://img.freepik.com/premium-photo/indian-doctor_714173-1916.jpg" alt="Dr. Joey Sinchicco" class="h-32 w-32 object-cover mx-auto rounded-full ring-4 ring-blue-500 shadow-md mb-4">
      <h4 class="font-semibold text-xl mb-2">Dr. Joey M. Sinchicco</h4>
      <div class="h-0.5 w-16 bg-blue-500 mx-auto mb-2 rounded"></div>
      <p class="text-sm text-gray-300">Aesthetic & Functional Medicine, OB-GYN Perinatology</p>
      <p class="italic text-xs text-gray-400 mt-2">"We take care of your HEALTH"</p>
    </div>

    <!-- Dr. John C. Batacan -->
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 text-center text-gray-100">
      <img src="https://img.freepik.com/premium-photo/indian-doctor_714173-1916.jpg" alt="Dr. John Batacan" class="h-32 w-32 object-cover mx-auto rounded-full ring-4 ring-blue-500 shadow-md mb-4">
      <h4 class="font-semibold text-xl mb-2">Dr. John C. Batacan</h4>
      <div class="h-0.5 w-16 bg-blue-500 mx-auto mb-2 rounded"></div>
      <p class="text-sm text-gray-300">Family Medicine Specialist, Medical Director at JCB Wellness</p>
      <p class="italic text-xs text-gray-400 mt-2">"We take care of your HEALTH"</p>
    </div>

    <!-- Dr. Jimymiah Coching -->
    <div class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 text-center text-gray-100">
      <img src="https://img.freepik.com/premium-photo/indian-doctor_714173-1916.jpg" alt="Dr. Jimymiah Coching" class="h-32 w-32 object-cover mx-auto rounded-full ring-4 ring-blue-500 shadow-md mb-4">
      <h4 class="font-semibold text-xl mb-2">Dr. Jimymiah Coching</h4>
      <div class="h-0.5 w-16 bg-blue-500 mx-auto mb-2 rounded"></div>
      <p class="text-sm text-gray-300">Colon Care Specialist, Certified Hydrotherapist & Wellness Coach</p>
      <p class="italic text-xs text-gray-400 mt-2">"We take care of your HEALTH"</p>
    </div>

  </div>

  <div class="mt-8 text-center">
   <a href="javascript:void(0)" 
   class="inline-flex items-center justify-center bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold shadow-lg transition w-full md:w-auto md:max-w-[220px] mx-auto openFormBtn">
    Learn More
    <i class="fas fa-arrow-right ml-2"></i>
</a>
</div>
</section>


    <!-- Footer -->
    <footer class="bg-gray-100 text-center py-6 mt-24">
        <p class="text-gray-600">&copy; 2025 GutGuard SynBIOTIC+. All rights reserved.</p>
    </footer>

    <!-- Modal (Order Form) -->
<div id="formModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg mx-4 rounded-2xl shadow-lg p-8 relative">
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        <h2 class="text-2xl font-bold mb-6">Ready to Take the Next Step?</h2>
        <p class="text-lg text-gray-600 mb-8">
                 Sign up now and get instant FREE access to exclusive insights.
            </p>
       <form id="leadForm" class="space-y-4">
    @csrf
    <input type="hidden" name="page_link" value="{{ $funnel->page_link }}">

    <div>
        <input type="text" name="name" placeholder="Full Name"
            class="w-full px-4 py-2 border rounded-lg">
        <p class="error-message text-red-500 text-sm mt-1 hidden" data-error="name"></p>
    </div>

    <div>
        <input type="email" name="email" placeholder="Email"
            class="w-full px-4 py-2 border rounded-lg">
        <p class="error-message text-red-500 text-sm mt-1 hidden" data-error="email"></p>
    </div>

    <div>
        <input type="text" name="phone" placeholder="Phone"
            class="w-full px-4 py-2 border rounded-lg">
        <p class="error-message text-red-500 text-sm mt-1 hidden" data-error="phone"></p>
    </div>

    <button type="submit"
        class="w-full py-3 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600">
        Get Instant Access
    </button>
</form>

    </div>
</div>

<script>
document.getElementById("leadForm").addEventListener("submit", function(e){
    e.preventDefault();

    // clear old errors
    document.querySelectorAll(".error-message").forEach(el => {
        el.classList.add("hidden");
        el.textContent = "";
    });

    let formData = new FormData(this);

    fetch("{{ route('funnel.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === "error"){
            Object.keys(data.errors).forEach(key => {
                let errorEl = document.querySelector(`[data-error="${key}"]`);
                if(errorEl){
                    errorEl.textContent = data.errors[key][0];
                    errorEl.classList.remove("hidden");
                }
            });
        }else if(data.status === "success"){
            window.location.href = data.redirect;
        }
    })
    .catch(err => console.error(err));
});
</script>


<script>
    function openModal(){
        document.getElementById('formModal').classList.remove('hidden');
        document.getElementById('formModal').classList.add('flex');
    }
    function closeModal(){
        document.getElementById('formModal').classList.add('hidden');
        document.getElementById('formModal').classList.remove('flex');
    }
</script>
<script>
document.querySelectorAll(".openFormBtn").forEach(btn => {
    btn.addEventListener("click", function(e){
        e.preventDefault();
        openModal();
    });
});
</script>

</body>
</html>

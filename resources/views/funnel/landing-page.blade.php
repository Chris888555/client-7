@extends('layouts.funnel')

@section('title', 'Ace Brew Coffee Landing Page')

@section('content')

<!-- Hero -->
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-10 px-6 lg:px-12">
        <div class="flex-1 text-center lg:text-left">
            <h1 class="text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                Experience the Rich Flavor of <br> <span class="text-orange-600">Ace Brew Coffee</span>
            </h1>
            <p class="text-lg text-gray-600 mb-8">
                Start your day with the bold, aromatic, and energizing taste of Ace Brew — crafted to awaken your senses and keep you going all day.
            </p>
            <div class="flex gap-4 justify-center lg:justify-start">
                <button onclick="openModal()" class="bg-orange-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-orange-600">Learn More</button>
            </div>
        </div>
        <div class="flex-1">
            <img src="https://dynamicacelanka.com/wp-content/uploads/2024/04/Ace-Brew-Main-Image-1536x1382.png" class="mt-0" alt="Ace Brew Coffee">
        </div>
    </div>
</section>

<!-- Main Video Sales Presentation Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl sm:text-3xl font-bold text-center mb-8">
           Discover the Secret Behind the Perfect Cup of Ace Brew Coffee
        </h2>

        <div class="max-w-6xl mx-auto rounded-2xl overflow-hidden shadow-lg">
            <video class="w-full h-auto rounded-2xl" controls>
                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>


<!-- Features -->
<section id="features" class="bg-white py-16">
    <div class="max-w-6xl mx-auto text-center px-6">
        <h2 class="text-3xl font-bold mb-12">Why Choose <span class="text-orange-600">Ace Brew Coffee</span>?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-orange-500 text-4xl mb-4"><i class="fas fa-mug-hot"></i></div>
                <h3 class="text-xl font-semibold mb-2">Premium Taste</h3>
                <p class="text-gray-600">Enjoy smooth, rich, and bold flavors in every sip.</p>
            </div>
            <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-orange-500 text-4xl mb-4"><i class="fas fa-seedling"></i></div>
                <h3 class="text-xl font-semibold mb-2">100% Natural</h3>
                <p class="text-gray-600">Made with carefully selected beans, no artificial additives.</p>
            </div>
            <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-lg transition">
                <div class="text-orange-500 text-4xl mb-4"><i class="fas fa-bolt"></i></div>
                <h3 class="text-xl font-semibold mb-2">Boost Your Energy</h3>
                <p class="text-gray-600">Stay focused and energized throughout the day.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section id="reviews" class="bg-gray-50 py-16">
    <div class="max-w-6xl mx-auto text-center px-6">
        <h2 class="text-3xl font-bold mb-12">What Coffee Lovers Say About <span class="text-orange-600">Ace Brew</span></h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-white rounded-xl shadow">
                <p class="text-gray-600 mb-4">"The aroma is amazing! Perfect way to start my morning."</p>
                <h4 class="font-bold">Maria G.</h4>
                <div class="text-yellow-400"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            </div>
            <div class="p-6 bg-white rounded-xl shadow">
                <p class="text-gray-600 mb-4">"Super smooth and rich flavor. My new favorite coffee!"</p>
                <h4 class="font-bold">James P.</h4>
                <div class="text-yellow-400"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            </div>
            <div class="p-6 bg-white rounded-xl shadow">
                <p class="text-gray-600 mb-4">"Delivered fast and tastes premium. Highly recommended!"</p>
                <h4 class="font-bold">Liza R.</h4>
                <div class="text-yellow-400"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 py-10 mt-10">
    <div class="max-w-6xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
        <p>© 2025 Ace Brew Coffee. All rights reserved.</p>
        <div class="flex gap-4 text-xl mt-4 md:mt-0">
            <a href="#"><i class="fas fa-globe"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
        </div>
    </div>
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
        class="w-full py-3 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">
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
@endsection

@extends('layouts.app')

@section('content')

<section class="relative bg-gradient-to-br from-green-900 via-green-700 to-green-600 text-white py-32 px-6 overflow-hidden font-[Cairo]">
  <!-- Curved Background with SVG -->
  <div class="absolute top-0 left-0 w-full overflow-hidden leading-[0] rotate-180 z-0">
    <svg class="w-full h-24" viewBox="0 0 500 150" preserveAspectRatio="none">
      <path d="M0,0 C150,100 350,0 500,100 L500,0 L0,0 Z" fill="#064e3b"></path>
    </svg>
  </div>

  <!-- Hero Content -->
  <div class="relative z-10 text-center max-w-3xl mx-auto">
    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-xl text-white font-[Playfair+Display]">
      <span class="text-lime-300">Find</span> Your <span class="text-yellow-300">Qur'an Revision Partner</span> Online
    </h1>
    <p class="text-xl md:text-2xl mb-8 text-white/90 font-light">
      Connect with <span class="text-lime-100 font-medium">dedicated memorizers</span> for structured and spiritual revision — <span class="italic text-lime-200">anytime, anywhere.</span>
    </p>
    <a href="{{ route('register') }}"
       class="inline-block bg-white text-green-900 font-semibold px-8 py-4 rounded-full shadow-lg hover:bg-gray-100 transition-transform transform hover:scale-105">
      Get Started Now
    </a>
  </div>

  <!-- Bottom Curve -->
  <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] z-0">
    <svg class="w-full h-24" viewBox="0 0 500 150" preserveAspectRatio="none">
      <path d="M0,100 C150,0 350,200 500,100 L500,150 L0,150 Z" fill="#064e3b"></path>
    </svg>
  </div>
</section>



<!-- Benefits Section -->
<section class="py-24 px-6 bg-white text-center font-[Cairo]">
  <h2 class="text-4xl md:text-5xl font-extrabold mb-6 text-gray-800">Why Join <span class="text-green-600">QuranConnect</span>?</h2>
  <p class="text-lg md:text-xl max-w-3xl mx-auto mb-16 text-gray-600 leading-relaxed">
    Whether you're revising alone or with a partner, our platform empowers you to stay consistent, spiritually connected, and globally linked — every step of your memorization journey.
  </p>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
    <!-- Card 1 -->
    <div class="p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-transform transform hover:scale-105 bg-green-50 border border-green-100">
      <img src="https://cdn-icons-png.flaticon.com/512/4859/4859892.png" class="w-20 h-20 mx-auto mb-6" alt="Global Access Icon">
      <h3 class="text-2xl font-semibold text-green-800 mb-3">Global Access</h3>
      <p class="text-gray-700">Connect with like-minded memorizers across continents — unite in purpose, grow together in faith.</p>
    </div>

    <!-- Card 2 -->
    <div class="p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-transform transform hover:scale-105 bg-yellow-50 border border-yellow-100">
      <img src="https://cdn-icons-png.flaticon.com/512/1040/1040987.png" class="w-20 h-20 mx-auto mb-6" alt="Flexible Schedule Icon">
      <h3 class="text-2xl font-semibold text-yellow-700 mb-3">Flexible Scheduling</h3>
      <p class="text-gray-700">Choose times that fit your life rhythm. Morning, night, or weekend — your revision, your way.</p>
    </div>

    <!-- Card 3 -->
    <div class="p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-transform transform hover:scale-105 bg-blue-50 border border-blue-100">
      <img src="https://cdn-icons-png.flaticon.com/512/2942/2942922.png" class="w-20 h-20 mx-auto mb-6" alt="Progress Tracking Icon">
      <h3 class="text-2xl font-semibold text-blue-800 mb-3">Structured Progress</h3>
      <p class="text-gray-700">Use built-in tools to monitor your surahs, set goals, and reflect on your memorization milestones.</p>
    </div>
  </div>
</section>


<!-- How It Works Section -->
<section class="bg-gradient-to-br from-green-50 via-white to-emerald-100 py-24 px-6">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-4xl md:text-5xl font-extrabold text-center text-green-800 mb-16">
      How It Works
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">
      
      <!-- Step 1: Register -->
      <div class="bg-white p-10 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
        <img src="https://cdn-icons-png.flaticon.com/512/7476/7476277.png" alt="Register Icon" class="w-20 h-20 mx-auto mb-6">
        <h3 class="text-2xl font-semibold text-green-700 mb-3">1. Register</h3>
        <p class="text-gray-600">Create a free account and become part of our worldwide community of Quran memorizers.</p>
      </div>

      <!-- Step 2: Set Your Profile -->
      <div class="bg-white p-10 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
        <img src="https://cdn-icons-png.flaticon.com/512/1011/1011863.png" alt="Profile Setup Icon" class="w-20 h-20 mx-auto mb-6">
        <h3 class="text-2xl font-semibold text-green-700 mb-3">2. Set Your Profile</h3>
        <p class="text-gray-600">Add your memorization details, time preferences, and goals to match with ideal partners.</p>
      </div>

      <!-- Step 3: Find a Partner -->
      <div class="bg-white p-10 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
        <img src="https://cdn-icons-png.flaticon.com/512/566/566960.png" alt="Find Partner Icon" class="w-20 h-20 mx-auto mb-6">
        <h3 class="text-2xl font-semibold text-green-700 mb-3">3. Find a Partner</h3>
        <p class="text-gray-600">Get matched with compatible revision partners based on your needs and start revising together.</p>
      </div>

    </div>
  </div>
</section>



<!-- Visual Highlight: Zoom Revision Image -->
<section class="bg-white py-20 px-6">
  <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
    <img src="{{ asset('images/quran-zoom-revision.png') }}" class="w-full rounded-xl shadow-xl" alt="Quran Revision on Zoom">
    <div>
      <h2 class="text-3xl font-bold mb-4 text-green-800">Online Revision in Real Time</h2>
      <p class="text-gray-700 text-lg mb-6">
        Watch as fellow memorizers connect over video to revise the Holy Qur’an together. Experience the beauty of structured peer-to-peer recitation — no matter where you are in the world.
      </p>
      <a href="{{ route('register') }}" class="inline-block bg-green-700 text-white font-semibold px-6 py-3 rounded-full hover:bg-green-800 transition">Start Revising Today</a>
    </div>
  </div>
</section>


<!-- Testimonials Section -->
<section class="bg-white py-24 px-6 font-[Poppins]">
  <div class="text-center mb-16" data-aos="fade-up">
    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800">What Our Users Say</h2>
    <p class="text-gray-500 mt-3 text-lg">Trusted by Quran memorizers across the globe 🌍</p>
  </div>

  <div class="swiper max-w-6xl mx-auto px-4">
    <div class="swiper-wrapper">
      
      <!-- Testimonial Slide 1 -->
      <div class="swiper-slide bg-green-50 p-8 rounded-2xl border border-green-100 shadow-sm">
        <div class="flex items-center gap-4 mb-5">
          <img src="https://randomuser.me/api/portraits/men/32.jpg" class="w-14 h-14 rounded-full border" alt="Ahmad">
          <div>
            <p class="font-semibold text-green-900">Ahmad</p>
            <p class="text-sm text-green-700">United Kingdom</p>
          </div>
        </div>
        <p class="italic text-gray-700 leading-relaxed">“Since joining this platform, I’ve stayed consistent like never before. Truly life-changing.”</p>
      </div>

      <!-- Testimonial Slide 2 -->
      <div class="swiper-slide bg-yellow-50 p-8 rounded-2xl border border-yellow-100 shadow-sm">
        <div class="flex items-center gap-4 mb-5">
          <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-14 h-14 rounded-full border" alt="Fatima">
          <div>
            <p class="font-semibold text-yellow-800">Fatima</p>
            <p class="text-sm text-yellow-700">Nigeria</p>
          </div>
        </div>
        <p class="italic text-gray-700 leading-relaxed">“During Ramadan, I found partners to revise with every single night. Alhamdulillah!”</p>
      </div>

      <!-- Testimonial Slide 3 -->
      <div class="swiper-slide bg-blue-50 p-8 rounded-2xl border border-blue-100 shadow-sm">
        <div class="flex items-center gap-4 mb-5">
          <img src="https://randomuser.me/api/portraits/men/76.jpg" class="w-14 h-14 rounded-full border" alt="Yusuf">
          <div>
            <p class="font-semibold text-blue-900">Yusuf</p>
            <p class="text-sm text-blue-700">Malaysia</p>
          </div>
        </div>
        <p class="italic text-gray-700 leading-relaxed">“What helped me most was the accountability. Having a partner kept me focused.”</p>
      </div>

      <!-- Testimonial Slide 4 -->
      <div class="swiper-slide bg-purple-50 p-8 rounded-2xl border border-purple-100 shadow-sm">
        <div class="flex items-center gap-4 mb-5">
          <img src="https://randomuser.me/api/portraits/women/65.jpg" class="w-14 h-14 rounded-full border" alt="Aisha">
          <div>
            <p class="font-semibold text-purple-900">Aisha</p>
            <p class="text-sm text-purple-700">United States</p>
          </div>
        </div>
        <p class="italic text-gray-700 leading-relaxed">“I loved the structure and reminders — it helped me complete Juz Amma with consistency.”</p>
      </div>
    </div>

    <!-- Pagination Dots -->
    <div class="swiper-pagination mt-10"></div>
  </div>
</section>




<!-- CTA Section -->
<section class="relative py-24 px-6 bg-gradient-to-br from-green-900 via-emerald-700 to-green-500 text-white text-center overflow-hidden" style="font-family: 'Nunito', sans-serif;">
  <!-- Background Decoration (light effects) -->
  <div class="absolute inset-0 pointer-events-none z-0">
    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-80 h-80 bg-emerald-300 opacity-10 rounded-full blur-[100px]"></div>
    <div class="absolute bottom-0 right-0 w-[300px] h-[300px] bg-lime-300 opacity-10 rounded-full blur-[120px]"></div>
    <div class="absolute top-16 left-10 w-32 h-32 bg-white/5 border border-white/10 rounded-full backdrop-blur-md"></div>
  </div>

  <!-- Content -->
  <div class="relative z-10 max-w-3xl mx-auto">
     <h4 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight drop-shadow-lg bg-gradient-to-r from-lime-200 via-emerald-300 to-green-600 text-transparent bg-clip-text">
       Ready to Strengthen Your Memorization?
    </h4>

    <p class="text-lg md:text-xl text-white/90 mb-8 max-w-xl mx-auto leading-relaxed">
      Join a vibrant community of dedicated Quran memorizers and find your perfect revision partner today.
    </p>
    <a href="{{ route('register') }}"
       class="inline-block bg-white text-green-800 font-bold px-10 py-4 rounded-full shadow-lg hover:bg-gray-100 transition-transform transform hover:scale-105">
      Get Started Now
    </a>
  </div>
</section>



<!-- Footer -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: {
      delay: 4000,
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    grabCursor: true,
    breakpoints: {
      640: { slidesPerView: 1 },
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
    },
    spaceBetween: 30,
  });
</script>

@endsection

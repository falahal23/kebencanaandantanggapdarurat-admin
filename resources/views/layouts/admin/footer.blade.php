<footer class="w-full bg-white-900 text-gray-300 pt-4 pb-4">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 justify-items-end">

        <!-- KIRI -->
        <div class="w-full md:full text-left ">
            <p class="text-black text-xl font-bold mb-3">
                ❖ GuardianNet
            </p>

            <p class="text-black text-semibold mb-3">
                Platform informasi kebencanaan yang akurat dan terintegrasi untuk aksi tanggap yang cepat.
            </p>

            <div class="mt-4">
                <h5 class="text-lg font-bold text-red-400">Darurat: 112</h5>
                <p class="text-black">Layanan Panggilan Bantuan Nasional</p>
            </div>
        </div>

        <!-- KANAN -->
        <div class="w-full md:w-3/4 text-left">
            <ul class="space-y-2 text-sm mb-3">
                <li>
                    <a href="/profile"
                        class="{{ request()->is('profile') ? 'text-red-600' : 'text-black hover:text-red-600' }} transition">
                        Tentang Pengembang
                    </a>

                </li>
            </ul>

            <p class="text-black text-sm mb-3">Ikuti Kami:</p>

            <!-- ICON KE KIRI -->
            <div class="flex justify-start space-x-8 text-2xl" style="space-x-8">
                <a href="https://www.instagram.com/faaalhl_nbiil" target="_blank"
                    class="text-black-700 hover:text-pink-500 transition mr-4 text-2xl">
                    <i class="fab fa-instagram"></i>
                </a>

                <a href="https://www.facebook.com/share/1Bj9pkLBcE/" target="_blank"
                    class="text-black-700 hover:text-blue-600 transition mr-4 text-2xl">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <a href="https://github.com/falahal23" target="_blank"
                    class="text-black-700 hover:text-black transition mr-4 text-2xl">
                    <i class="fab fa-github"></i>
                </a>

                <a href="https://www.linkedin.com/in/falahal-nabil-haqiqi" target="_blank"
                    class="text-black-700 hover:text-blue-500 transition mr-4 text-2xl">
                    <i class="fab fa-linkedin-in"></i>
                </a>

                <a href="mailto:falahalnabil81@gmail.com"
                    class="text-black-700 hover:text-blue-400 transition mr-4 text-2xl">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
        </div>


        <!-- COPYRIGHT -->
        <div class="text-center pt-8 text-black text-sm">
            &copy;
            <script>
                document.write(new Date().getFullYear());
            </script>
            Sistem GuardianNet. Seluruh Hak Cipta Dilindungi.
        </div>

        <!-- Floating WhatsApp Button -->
<a href="https://wa.me/6281266007367"
   target="_blank"
   aria-label="Chat via WhatsApp"
   class="fixed bottom-16 right-6 z-50
          w-14 h-14 rounded-full
          bg-green-500 hover:bg-green-600
          flex items-center justify-center
          text-white text-2xl
          shadow-lg transition duration-300">

    <i class="fab fa-whatsapp"></i>
</a>


</footer>

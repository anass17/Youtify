<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="p-4 absolute top-0 left-0 w-full z-10">
        <div class="container mx-auto px-3 max-w-[1250px]">
            <div class="container mx-auto flex items-center justify-between">
                <!-- Logo -->
                <div class="text-white text-2xl font-semibold">
                    <a href="#">Youtify</a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-6">
                    <a href="<?php echo URLROOT; ?>" class="text-white hover:text-orange-300">Home</a>
                    <a href="#" class="text-white hover:text-orange-300">Songs</a>
                    <a href="<?php echo URLROOT . '/playlist/index'; ?>" class="text-white hover:text-orange-300">Playlists</a>
                    <a href="<?php echo URLROOT . '/user/login'; ?>" class="text-white hover:text-orange-300">Login</a>
                </div>

                <!-- Hamburger Button (Mobile) -->
                <div class="md:hidden">
                    <button id="hamburger-btn" class="text-white focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden text-white p-4">
                <a href="<?php echo URLROOT; ?>" class="block py-2 px-4 text-white hover:text-orange-300">Home</a>
                <a href="#" class="block py-2 px-4 text-white hover:text-orange-300">Songs</a>
                <a href="#" class="block py-2 px-4 text-white hover:text-orange-300">Playlists</a>
                <a href="#" class="block py-2 px-4 text-white hover:text-orange-300">Login</a>
            </div>
        </div>
    </nav>

    <section class="bg-cover bg-center h-screen relative">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white">
            <h1 class="text-5xl font-semibold mb-4">Music for Everyone</h1>
            <p class="text-lg mb-6">Millions of songs, all at your fingertips</p>
            <a href="<?php echo URLROOT; ?>/pages/login" class="px-8 py-3 bg-orange-500 text-white rounded-full text-lg hover:bg-orange-600 transition">Get Started</a>
        </div>
    </section>

    <script>
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        hamburgerBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>

</body>
</html>

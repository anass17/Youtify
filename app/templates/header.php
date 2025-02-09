<?php
    $user = Security::isAccessTokenValid();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans pt-16">

<?php if(!$user): ?>

<nav class="bg-gradient-to-tr from-gray-500 to-gray-700 p-4 absolute top-0 left-0 w-full z-10">
    <div class="container mx-auto px-3 max-w-[1250px]">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo -->
            <div class="text-white text-2xl font-semibold">
                <a href="<?php echo URLROOT; ?>">Youtify</a>
            </div>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-6">
                <a href="<?php echo URLROOT; ?>" class="text-white hover:text-orange-300">Home</a>
                <a href="#" class="text-white hover:text-orange-300">Songs</a>
                <a href="#" class="text-white hover:text-orange-300">Playlists</a>
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
            <a href="<?php echo URLROOT . 'user/login'; ?>" class="block py-2 px-4 text-white hover:text-orange-300">Login</a>
        </div>
    </div>
</nav>

<?php else: ?>
    
<nav class="bg-gradient-to-tr from-gray-500 to-gray-700 p-4 absolute top-0 left-0 w-full z-10">
    <div class="container mx-auto px-3 max-w-[1250px]">
        <div class="container mx-auto flex items-center justify-between">
            <!-- Logo -->
            <div class="text-white text-2xl font-semibold">
                <a href="<?php echo URLROOT . '/playlist/index'; ?>">Youtify</a>
            </div>

            <span class="text-white mr-10"><?php echo $user['username']; ?></span>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-6">
                <a href="<?php echo URLROOT . '/album/index'; ?>" class="text-white hover:text-orange-300">Albums</a>
                <a href="<?php echo URLROOT . '/playlist/index'; ?>" class="text-white hover:text-orange-300">Playlists</a>
                <a href="<?php echo URLROOT . '/user/logout'; ?>" class="text-white hover:text-orange-300">Logout</a>
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

<?php endif; ?>
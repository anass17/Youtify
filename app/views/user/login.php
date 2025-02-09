<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Youtify</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-500 to-gray-700 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        
        <h1 class="mb-7 text-center font-semibold text-2xl">Login</h1>

        <?php if(isset($_SESSION['error'])): ?>

            <small class="block mb-3 text-red-500 font-semibold text-center"><?php echo $_SESSION['error']; ?></small>

            <?php unset($_SESSION['error']); ?>

        <?php endif; ?>

        <form action="<?php echo URLROOT . '/user/logUserIn'; ?>" method="POST">
            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email or Username</label>
                <input type="text" id="email" name="email" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter your email or username" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="w-full py-3 bg-orange-400 text-white font-semibold rounded-lg hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-green-400">Log In</button>
        </form>

        <div class="text-center mt-4">
            <span class="text-sm text-gray-600">Don't have an account? </span>
            <a href="<?php echo URLROOT; ?>/user/register" class="text-sm text-orange-500 hover:text-orange-600 font-semibold">Sign Up</a>
        </div>
    </div>

</body>
</html>

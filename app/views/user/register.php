<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?> - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-500 to-gray-700 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        
        <h1 class="mb-7 text-center font-semibold text-2xl">Register</h1>

        <?php if(isset($_SESSION['error'])): ?>

            <small class="block mb-3 text-red-500 font-semibold text-center"><?php echo $_SESSION['error']; ?></small>

            <?php unset($_SESSION['error']); ?>

        <?php endif; ?>

        <form action="<?php echo URLROOT . '/user/registerUser'; ?>" method="POST">
            <div class="mb-4">
                <label for="username" class="block text-sm font-semibold text-gray-700">Username</label>
                <input type="text" id="username" name="username" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter a username" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Create a password" required>
            </div>

            <div class="mb-4">
                <label for="account_type" class="block text-sm font-semibold text-gray-700">Account Type</label>
                <select id="account_type" name="account_type" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="member">Member</option>
                    <option value="artist">Artist</option>
                </select>
            </div>

            <button type="submit" class="w-full py-3 bg-orange-400 text-white font-semibold rounded-lg hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-400">Register</button>
        </form>

        <div class="text-center mt-6">
            <span class="text-sm text-gray-600">Already have an account? </span>
            <a href="<?php echo URLROOT; ?>/user/login" class="text-sm text-orange-500 hover:text-orange-600 font-semibold">Log In</a>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SmartOne E-Library</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@500;700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-slate-100 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-6">Login to SmartOne Lib</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-4 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                    class="mt-1 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-indigo-300">
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <label for="remember" class="ml-2 text-sm text-gray-700">Remember Me</label>
                </div>
                <a href="#" class="text-sm text-indigo-600 hover:underline">Forgot Password?</a>
            </div>

            <button type="submit"
                class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-500 focus:outline-none focus:ring focus:ring-indigo-300">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Register</a>
        </p>
    </div>

</body>

</html>

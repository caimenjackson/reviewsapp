<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Review Filter</title>
    <link rel="icon" type="image/x-icon" href="/images/logo.ico">
    <!-- Include Tailwind CSS -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <title>ProGarage PORTAL</title>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v3.x.x/dist/alpine.min.js" defer></script>


</head>

<body class="bg-grey-500 text-white">
    <header class="bg-grey-800 p-4 flex justify-between items-center">
        <div class="flex items-center">
            <!-- Logo -->
            <div class="mr-4">
                <a href="/">
                <img src="{{asset('images/logo.png')}}" alt="Logo" class="h-12" >
                </a>
            </div>
        </div>
    
        <!-- Navigation -->
        <nav class="flex justify-between items-center">
            <ul class="flex space-x-6 text-lg items-center">
                @auth

                <li>
                    <span class="ml-1 text-black font-bold">Welcome {{auth()->user()->name}}</span>
    
                </li>
                <li>
                    <a href="/account" class="hover:bg-yellow-500 hover:text-black relative inline-flex items-center bg-white-900 text-black rounded px-2 py-1">
                        <i class="fa-solid fa-archive"></i>
                        <span class="ml-1">My Account</span>
                        {{-- <span class="rounded-full bg-red-500 text-black px-2 py-1 ml-2 text-xs">ALPHA</span> --}}
                    </a>
                </li>
                <li>
                    <a href="/reviews" class="hover:bg-yellow-500 hover:text-black relative inline-flex items-center bg-white-900 text-black rounded px-2 py-1">
                        <i class="fa-solid fa-globe"></i>
                        <span class="ml-1">Reviews Database</span>
                        {{-- <span class="rounded-full bg-red-500 text-black px-2 py-1 ml-2 text-xs">ALPHA</span> --}}
                    </a>
                </li>
                <li>
                    <form class="inline" method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="hover:bg-yellow-500 hover:text-black relative inline-flex items-center bg-white-900 text-black rounded px-2 py-1">
                            <i class="fa-solid fa-door-closed"></i> Logout
                        </button>
                    </form>
                </li>
                @else
                <li>
                    <a href="/login" class="hover:bg-yellow-500 hover:text-black relative inline-flex items-center bg-white-900 text-black rounded px-2 py-1">
                        <i class="fa-solid fa-door-open"></i>
                        <span class="ml-1">Login </span>
                        {{-- <span class="rounded-full bg-red-500 text-white px-2 py-1 ml-2 text-xs">ALPHA</span> --}}
                    </a>
                </li>
                <li>
                    <a href="/register" class="hover:bg-yellow-500 hover:text-black relative inline-flex items-center bg-white-900 text-black rounded px-2 py-1">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span class="ml-1">Sign up</span>
                        {{-- <span class="rounded-full bg-red-500 text-white px-2 py-1 ml-2 text-xs">ALPHA</span> --}}
                    </a>
                </li>
                <li>
                    <a href="/predictive" class="hover:bg-yellow-500 hover:text-black relative inline-flex items-center bg-white-900 text-black rounded px-2 py-1">
                        <i class="fa-solid fa-globe"></i>
                        <span class="ml-2">Database</span>
                        {{-- <span class="rounded-full bg-red-500 text-white px-2 py-1 ml-2 text-xs">BETA</span> --}}
                    </a>
                    
                    
                </li>
                @endauth
            </ul>
        </nav>
    </header>


<main> 

    {{$slot}}

</main>
<x-cookie-popup/>

<footer class="w-full bg-yellow-500 text-white py-4 text-center">
    <div class="container mx-auto">
        <ul class="flex justify-center space-x-4">
            <li><a href="#" class="hover:text-gray-300">Contact Us</a></li>
            <li><a href="#" class="hover:text-gray-300">Support</a></li>
            <li><a href="/termsandconditions" class="hover:text-gray-300">Terms & Conditions</a></li>
            <li><a href="#" class="hover:text-gray-300">Documentation</a></li>
            <li><a href="#" class="hover:text-gray-300">Service Status</a></li>
            <!-- Add more links as necessary -->
        </ul>
        <p class="text-sm text-white font-bold mt-2">Copyright &copy; 2024 Caimen Jackson</p>

    </div>
</footer>
<x-flash-message />
</body>

</html>
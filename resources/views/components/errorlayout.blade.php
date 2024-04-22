<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RF Error </title>
    <link rel="icon" type="image/x-icon" href="/images/logo.ico">
    <!-- Include Tailwind CSS and other styles -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v3.x.x/dist/alpine.min.js" defer></script>
</head>
<body class="bg-fixed bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/review_filter.jpg') }}');">
    <div class="w-full h-screen flex flex-col items-center justify-center bg-black bg-opacity-80">
        <!-- Logo at the top (centered) -->
        <div class="w-full flex justify-center">
            <img src="{{ asset('images/logo.png') }}" class="mb-12" alt="Logo" style="margin-top: -100px;">
        </div>


        {{$slot}}



        <!-- Button -->
        <div class="w-1/2">
            <a href="/" class="text-center bg-green-500 text-white font-bold py-3 px-10 rounded hover:bg-green-900 flex items-center justify-center space-x-2">
                <i class="fa-solid fa-arrow-circle-left"></i>
                <span>Return to homepage</span>
            </a>
        </div>
        
    </div>
</body>
</html>

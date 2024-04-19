<x-layout>
    <!-- Thin hero section with title -->
    <section class="bg-red-500 py-10 text-white">
        <div class="container mx-auto">
            <i class="fa-solid fa-globe"></i>
            <span class="ml-2">Predictive Maintenance</span>
            <span class="rounded-full bg-grey-500 text-white px-2 py-1 ml-2 text-xl">BETA</span>
        </div>
    </section>

    <!-- Thin yellow hero section with disclaimer -->
    <section class="bg-yellow-300 py-4">
        <div class="container mx-auto flex items-center justify-center">
            <div class="text-2xl pr-2">⚠️</div>
            <p class="text-lg text-black">Disclaimer: The information provided here may not be accurate and is for demonstration purposes only. Always consult a professional for accurate maintenance advice.</p>
        </div>
    </section>

    <!-- Your partial will be included here -->
    <x-ai-warning />

    <x-form>

        <form method="POST" action="/predictive">
            @csrf


        @if(auth()->check())
            @include('partials.ai._authenticated', ['userCars' => auth()->check() ? auth()->user()->cars()->get() : null])

            @include('partials.ai._unauthenticated')
        @else
            @include('partials.ai._unauthenticated')
        @endif


        <div class="mb-6">
            <button class="bg-red-500 w-100 text-white rounded py-2 px-4 hover:bg-black">Analyse</button>
        </div>

    </form>


    </x-form>

</x-layout>
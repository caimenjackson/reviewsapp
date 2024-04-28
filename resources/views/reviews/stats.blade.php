<x-layout>
    @include('partials._databaseheader') 

    <div class="flex w-full mx-auto mt-5" style="padding-left: 2%; padding-right: 2%;">
        <div class="w-1/5 flex flex-col space-y-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('reviews.index') }}" class="text-center bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    <i class="fa-solid fa-chevron-circle-left"></i>
                    Return to reviews
                </a>
            </div>
        </div>

        <div style="width: 2%;"></div>
        <div class="w-4/5">
            <h1 class="text-center mb-4 text-black">Location Status Summary</h1>
            <div class="flex justify-around items-center">
                <div class="p-10 bg-green-300 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-white">Open Locations</h2>
                    <p class="text-2xl font-semibold">{{ $totalOpen }}</p>
                </div>
                
                <div class="p-10 bg-red-300 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold text-white">Closed Locations</h2>
                    <p class="text-2xl font-semibold">{{ $totalClosed }}</p>
                </div>
            </div>
            <div class="m-10"></div>
        </div>
    </div>
</x-layout>

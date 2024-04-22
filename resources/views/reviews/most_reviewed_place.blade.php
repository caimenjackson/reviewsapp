<x-layout>
    @include('partials._databaseheader')

    <div class="flex w-full mx-auto mt-5" style="padding-left: 2%; padding-right: 2%;">
        <div class="w-1/5 flex flex-col space-y-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('reviews.index') }}" class="text-center bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    Return to reviews
                </a>
            </div>
        </div>

        <div style="width: 2%;"></div>

        <div class="w-4/5">
            <h1 class="text-center mb-4 text-black">Place with the Most Reviews</h1>
            @if ($mostReviewedPlace)
                <div class="text-center p-4 shadow-lg rounded bg-white text-black">
                    <h2 class="text-lg font-bold">{{ $mostReviewedPlace->name }}</h2>
                    <p>Total Reviews: {{ $mostReviewedPlace->review_count }}</p>
                    <p>Place ID: {{ $mostReviewedPlace->gPlusPlaceId }}</p>
                </div>
            @else
                <p class="text-center">No reviews found.</p>
            @endif
        </div>
    </div>
</x-layout>

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
            <h1 class="text-center mb-4 text-black">Reviews by Job Title</h1>
            <form method="GET" action="{{ route('reviews.by_job') }}" class="mb-4">
                <div class="flex items-center space-x-2">
                    <select name="job" class="py-2 px-4 w-full rounded leading-tight focus:outline-none focus:shadow-outline bg-white border border-gray-300 text-gray-700">
                        <option value="">Select a Job</option>
                        @foreach ($jobs as $job)
                            <option value="{{ $job }}" {{ $selectedJob === $job ? 'selected' : '' }}>{{ $job }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-yellow-500 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">
                        Filter
                    </button>
                </div>
            </form>

            @if ($reviews->isNotEmpty())
                <table class="w-full text-left table-auto shadow-lg bg-white">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Reviewer Name</th>
                            <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Place Name</th>
                            <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Review Text</th>
                            <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Rating</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                        @foreach ($reviews as $review)
                            <tr class="@if ($loop->even) bg-gray-100 @else bg-white @endif">
                                <td class="border px-4 py-2">{{ $review->reviewer->userName }}</td> 
                                <td class="border px-4 py-2">{{ $review->place->name }}</td>
                                <td class="border px-4 py-2">{{ $review->reviewText }}</td>
                                <td class="border px-4 py-2">{{ $review->rating }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-sm text-gray-600 mb-4">
                    Showing {{ $reviews->firstItem() }} to {{ $reviews->lastItem() }} of {{ $reviews->total() }} entries
                </div>
                <div class="mt-4 mb-8 flex justify-center">
                    {{ $reviews->appends(['job' => $selectedJob])->onEachSide(1)->links('vendor.pagination.custom-tailwind') }}
                </div>
            @else
                <p>No reviews found for the selected job title.</p>
            @endif
        </div>
    </div>
</x-layout>

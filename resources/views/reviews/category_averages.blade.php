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
            <h1 class="text-center mb-4 text-black">Average Rating by Category</h1>
            <table class="w-full text-left table-auto shadow-lg bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Category</th>
                        <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Average Rating</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categoryAverages as $categoryAverage)
                        <tr class="text-black">
                            <td class="border px-4 py-2">{{ $categoryAverage->categories }}</td>
                            <td class="border px-4 py-2">{{ number_format($categoryAverage->average_rating, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 mb-8 flex justify-center">
                {{ $categoryAverages->links('vendor.pagination.custom-tailwind') }}
            </div>
        </div>
    </div>
</x-layout>

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
            <h1 class="text-center mb-4 text-black">Places with 4 or More Reviews</h1>
            <div class="text-black">
                <table class="w-full text-left table-auto shadow-lg bg-white">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Place Name</th>
                            <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Number of Reviews</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($places as $place)
                            <tr class="text-black">
                                <td class="border px-4 py-2">{{ $place->name }}</td>
                                <td class="border px-4 py-2">{{ $place->reviews_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($places->total() > 0)
            <div class="mt-4">
                Showing {{ $places->firstItem() }} to {{ $places->lastItem() }} of {{ $places->total() }} entries
            </div>
        @else
            <div class="mt-4">No places found.</div>
        @endif
        <div class="mt-4 mb-8 flex justify-center">
            {{ $places->links() }}
        </div>
            </div>
        </div>
    </div>
</x-layout>

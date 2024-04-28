

<x-layout>
    @include('partials._databaseheader')
    <div class="flex mx-auto mt-5" style="width: 96%;"> 
        <div style="width: 2%;"></div>
    
        <div class="w-4/5">
            <h1 class="text-center mb-4 text-black"></h1>
            <table class="w-full text-left table-auto shadow-lg bg-white">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Location</th>
                        <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Price</th>
                        <th class="px-2 py-2 bg-yellow-500 text-white font-bold">Rating</th>
                        <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Reviewer Name</th>
                        <th class="px-2 py-2 bg-yellow-500 text-white font-bold">Review Text</th>
                        <th class="px-2 py-2 bg-yellow-500 text-white font-bold">Categories</th>
                        <th class="px-2 py-2 bg-yellow-500 text-white font-bold">Published</th>
                    </tr>
                </thead>
                <tbody class="text-black">
                    @foreach ($reviews as $review)
                    <tr class="@if ($loop->even) bg-gray-100 @else bg-white @endif">
                        <td class="border px-4 py-2">{{ $review->place_name }}</td>
                        <td class="border px-4 py-2">{{ $review->price }}</td>
                        <td class="border px-4 py-2">{{ $review->rating }}</td>
                        <td class="border px-4 py-2">{{ $review->reviewerName }}</td>
                        <td class="border px-4 py-2">{{ $review->reviewText }}</td>
                        <td class="border px-4 py-2">{{ $review->categories }}</td>
                        <td class="border px-4 py-2">{{ $review->reviewTime->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="flex justify-center mt-4 mb-8">
                {{ $reviews->appends(['rating' => request('rating'), 'price' => request('price')])->onEachSide(1)->links('vendor.pagination.custom-tailwind') }}
            </div>
            
        </div>
    
        <div style="width: 2%;"></div>
    
        <div class="w-3/20 flex flex-col space-y-4 padding-top-10">
            <p class="text-sm text-gray-700 font-bold">
                Showing {{ $reviews->firstItem() }} to {{ $reviews->lastItem() }} of {{ $reviews->total() }} records
            </p>
            <h1></h1>
            <select class="bg-white border border-gray-300 text-gray-700 py-2 px-4 rounded leading-tight focus:outline-none focus:border-blue-500">
                <option>Sort by Rating Ascending</option>
                <option>Sort by Rating Descending</option>
                <option>Sort by Price Range Ascending</option>
                <option>Sort by Price Range Descending</option>
                <option>Sort by Newest First</option>
                <option>Sort by Oldest First</option>
            </select>
            <div class="flex flex-col space-y-2">
                <div class="space-y-0">
                <div class="bg-slate-900 text-white font-bold py-1 px-6 w-full hover:bg-yellow-500 my-0 text-center">
                    Select Rating
                </div>



                <form action="{{ route('reviews.index') }}" method="GET" class="flex flex-row">
                    @if(request()->has('price'))
                        <input type="hidden" name="price" value="{{ request('price') }}">
                    @endif
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="submit" name="rating" value="{{ $i }}" class="bg-slate-900 text-white font-bold py-3 px-6 w-full hover:bg-yellow-500">
                            {{ $i }}
                        </button>
                    @endfor
                </form>




                </div>

                <div class="space-y-0">
                    <div class="bg-slate-900 text-white font-bold py-1 px-6 w-full hover:bg-yellow-500 my-0 text-center">
                        Select by Price
                    </div>




                    <form action="{{ route('reviews.index') }}" method="GET" class="flex flex-row">
                        @if(request()->has('rating'))
                            <input type="hidden" name="rating" value="{{ request('rating') }}">
                        @endif
                        @foreach (['$', '$$', '$$$'] as $price)
                            <button type="submit" name="price" value="{{ $price }}" class="bg-slate-900 text-white font-bold py-3 px-6 w-full hover:bg-yellow-500">
                                {{ $price }}
                            </button>
                        @endforeach
                    </form>



                    
                    </div>





                <a href={{ route('reviews.profiles')}} class="text-center bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    Select Reviewer by Job
                </a>
                <a href={{ route('reviews.frequent')}} class="text-center bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    Find Frequent Phrases
                </a>
                <a href="/reviews/places" class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    Find locations with 4+ reviews
                </a>
                <a href="/reviews/by-job" class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    Select Reviews by job
                </a>
                <a href="/reviews/stats" class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    Calculate open/closed locations
                </a>
                <a href="/reviews/category-averages" class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    Calculate average category rating
                </a>
                <a href="reviews/top-categories" class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    Find top 5 categories
                </a>
                <a href="reviews/most-reviewed-place" class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    Highest Reviewed location
                </a>
                <a href="/reviews" class="text-center bg-red-500 text-white font-bold py-6 px-6 rounded w-full hover:bg-yellow-500">
                    <i class="fa-solid fa-times-circle"></i>
                    Clear Filters
                </a>
            </div>
        </div>
        <div style="width: 2%;"></div>
    </div>
    
</x-layout>
{{-- <x-layout>
    @include('partials._databaseheader')
<!-- Spacer for 2% gap on the left -->
<div style="width: 2%;"></div>
    
<!-- Table Section - 80% Width -->
<div class="w-4/5">
    <h1 class="text-center mb-4 text-black"></h1>
    <div class="w-4/5">
        <div class="text-black">
            <form method="POST" action="{{ route('frequent_words') }}">
                @csrf
                <input type="text" name="rating" placeholder="Enter rating">
                <button type="submit">Submit</button>
            </form>
            @if (!empty($frequentPhrases))
                <ul>
                    @foreach ($frequentPhrases as $phrase => $count)
                        <li>{{ $phrase }}: {{ $count }}</li>
                    @endforeach
            </ul>
            @endif
        </div>
        </div>

</div>

<!-- Spacer for 2% gap between table and dropdown/buttons -->
<div style="width: 2%;"></div>

<!-- Dropdown and Buttons Section - 15% Width -->
<div class="w-3/20 flex flex-col space-y-4 padding-top-10">
   

    <div class="flex flex-col space-y-2">
        <!-- List buttons here -->

    

        <button class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
            Select Reviewer by Job
        </button>
        <button class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
            Find Frequent Phrases
        </button>
        <button class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
            Find locations with 4+ reviews
        </button>
        <button class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
            Select Reviews by job
        </button>
        <button class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
            Calculate open/closed locations
        </button>
        <button class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
            Calculate average category rating
        </button>
        <button class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
            Find top 5 categories
        </button>
        <button class="bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
            Highest Reviewed location
        </button>
        <!-- More buttons -->
    </div>
</div>

<!-- Spacer for 2% gap on the right -->
<div style="width: 2%;"></div>
</div> 

























</x-layout> --}}


<x-layout>
    @include('partials._databaseheader')

    <div class="flex w-full mx-auto mt-5" style="padding-left: 2%; padding-right: 2%;">
        <!-- Button Section - Smaller width than initially to balance the layout -->
        <div class="w-1/5 flex flex-col space-y-4">
            <div class="flex flex-col space-y-2">
                <!-- Button here -->
                <a href="{{ route('reviews.index') }}" class="text-center bg-slate-900 text-white font-bold py-3 px-6 rounded w-full hover:bg-yellow-500">
                    <i class="fa-solid fa-chevron-circle-left"></i>
                    Return to reviews
                </a>
            </div>
        </div>

        <!-- Spacer for 2% gap between button and table -->
        <div style="width: 2%;"></div>

        <!-- Table Section - Taking up the majority of the space -->
        <div class="w-4/5">
            <h1 class="text-center mb-4 text-black">Find frequent review phrases according to a specific rating.</h1>
            <div class="text-black">
                <form method="POST" action="{{ route('frequent_words') }}" class="mb-4">
                    @csrf
                    <div class="flex items-center space-x-2">
                        <select name="rating" class="py-2 px-4 w-full rounded leading-tight focus:outline-none focus:shadow-outline bg-white border border-gray-300 text-gray-700">
                            <option value="">Select a Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button type="submit" class="bg-slate-900 text-white font-bold py-2 px-6 rounded hover:bg-yellow-500 transition-colors duration-150 ease-in-out">
                            Submit
                        </button>
                    </div>
                </form>
                
                @if (!empty($frequentPhrases))
                <table class="w-full text-left table-auto shadow-lg bg-white">
                    <thead>
                        <tr>
                            <th class="w-3/4 px-4 py-2 bg-yellow-500 text-white font-bold">Phrase</th>
                            <th class="w-1/4 px-4 py-2 bg-yellow-500 text-white font-bold">Count</th>
                        </tr>
                    </thead>
                    <tbody class="text-black">
                        @foreach ($frequentPhrases as $phrase => $count)
                        <tr class="@if ($loop->even) bg-gray-100 @else bg-white @endif">
                            <td class="border px-4 py-2">{{ $phrase }}</td>
                            <td class="border px-4 py-2 text-center">{{ $count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div> 

</x-layout>

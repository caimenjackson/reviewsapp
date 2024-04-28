<x-layout>
    @include('partials._databasereviewerheader')

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
            <h1 class="text-center mb-4 text-black">Reviewer Profiles by Job</h1>
            <div class="text-black">
                <div class="mt-4 flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    Showing {{ $reviewers->firstItem() }} to {{ $reviewers->lastItem() }} of {{ $reviewers->total() }} entries
                </div>
            </div>

                <form method="GET" action="{{ route('reviews.profiles') }}" class="mb-4">
                    <div class="flex items-center space-x-2">
                        <select name="jobs" class="py-2 px-4 w-full rounded leading-tight focus:outline-none focus:shadow-outline bg-white border border-gray-300 text-gray-700">
                            <option value="">Select a Job</option>
                            @foreach ($jobs as $job)
                                <option value="{{ $job }}"{{ $selectedJob == $job ? ' selected' : '' }}>{{ $job }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-yellow-500 hover:bg-slate-900 text-white font-bold py-2 px-4 rounded">
                            Filter
                        </button>
                    </div>
                </form>
                
                @if ($reviewers->isNotEmpty())
    <table class="w-full text-left table-auto shadow-lg bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Name</th>
                <th class="px-4 py-2 bg-yellow-500 text-white font-bold">Job</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviewers as $reviewer)
                <tr class="text-black">
                    <td class="border px-4 py-2">{{ $reviewer->userName }}</td>
                    <td class="border px-4 py-2">{{ $reviewer->jobs }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Custom pagination links -->
    <div class="mt-4 mb-8 flex justify-center">
        {{ $reviewers->appends(['jobs' => $selectedJob])->links('vendor.pagination.custom-tailwind') }}
    </div>
@endif
            </div>
        </div>
    </div> 
    <div class="padding-4">
    </div>
</x-layout>

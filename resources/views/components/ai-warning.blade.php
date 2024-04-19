<!-- ai-warning.blade.php -->
@php
    $warningAccepted = session('warning_accepted', false);
@endphp

@if (!$warningAccepted)
<div class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-black bg-opacity-50 z-50">
    <div class="bg-yellow-300 p-8 rounded-lg shadow-lg max-w-screen-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-red-600 mb-4 mx-auto" viewBox="0 0 20 20" fill="none">
            <path d="M10 3L17 17H3z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <text x="10" y="16" fill="currentColor" font-size="16" text-anchor="middle">!</text>
        </svg>
        <h2 class="text-black text-2xl font-semibold mb-4">Attention
    
        </h2>
        <p class="text-black mb-4">This website was created in partial fufillment of CIS3157 at Edge Hill University. This website is not intended for professional use. Please acknowledge this.</p>
        <div class="flex justify-end">
            <form action="/accept-warning" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded mr-2">Accept</button>
            </form>
            <a href="/decline-warning" class="px-4 py-2 bg-red-500 text-white rounded">Decline</a>
        </div>
    </div>
</div>

</div>
@endif

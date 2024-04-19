@if(session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="flex items-center justify-center fixed top-16 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
        <i class="fas fa-bell mr-2"></i>
        <p>{{ session('message') }}</p>
    </div>
@endif

<!-- _car-form-fields.blade.php -->

<div class="mb-6 text-center">
    <label for="make" class="block text-lg mb-2">Make</label>
    <input type="text" id="make" name="make" class="border border-gray-200 rounded p-2 w-full text-black">
    @error('make')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-6 text-center">
    <label for="model" class="block text-lg mb-2">Model</label>
    <input type="text" id="model" name="model" class="border border-gray-200 rounded p-2 w-full text-black">
    @error('model')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-6 text-center">
    <label for="year" class="block text-lg mb-2">Year</label>
    <input type="text" id="year" name="year" class="border border-gray-200 rounded p-2 w-full text-black">
    @error('year')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-6 text-center">
    <label for="car" class="block text-lg mb-2">Select Car</label>
    <select name="car" id="car" class="border border-gray-200 rounded p-2 w-full text-black">
        <!-- Placeholder option -->
        <option value="" selected disabled>Select a car</option>
        <!-- Iterate over user cars -->
        @foreach ($userCars as $car)
        <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }} - {{ $car->registration }}</option>
        @endforeach
    </select>
    @error('car')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<x-layout>

    @include('partials._editcardetails')

    <x-form>
        <form method="POST" action="/cars/{{$car->id}}" enctype="multipart/form-data">
            @csrf <!-- stops cross site scripting -->
            @method('PUT')



            <div class="mb-6">
                <label
                    for="registration"
                    class="inline-block text-lg mb-2"
                    >Vehicle Registration</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black text-center"
                    name="registration"
                    value="{{$car->registration}}"
                />
                @error('registration')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>


            <div class="mb-6">
                <label for="make" class="inline-block text-lg mb-2"
                    >Vehicle Manufacturer</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black text-center"
                    name="make"
                    placeholder="Example: Senior Laravel Developer"
                    value="{{$car->make}}"
                />
            </div>
            @error('make')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror


            <div class="mb-6">
                <label for="model" class="inline-block text-lg mb-2"
                    >Vehicle Model</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black text-center"
                    name="model"
                    placeholder="Example: Corsa"
                    value="{{$car->model}}"
                />
            </div>
            @error('model')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            
            <div class="mb-6">
                <label for="engine_size" class="inline-block text-lg mb-2"
                    >Vehicle Engine Size (L)</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black text-center"
                    name="engine_size"
                    placeholder="Example: 1.2 means 1200cc"
                    value="{{$car->engine_size}}"
                />
            </div>
            @error('engine_size')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-6">
                <label for="mileage" class="inline-block text-lg mb-2"
                    >Vehicle Current Mileage</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black text-center"
                    name="mileage"
                    placeholder="Example: 1200 means 1200miles"
                    value="{{$car->mileage}}"
                />
            </div>
            @error('mileage')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            

            <div class="mb-6 text-center">
                <button
                    class="bg-gray-500 text-white rounded py-2 px-4 hover:bg-red-500 p-2">
                    Update Vehicle Details
                </button>

            </div>


            <div class="mb-6 text-lg text-center bg-green-300 border-green rounded hover:bg-red-500 p-2">
            <a href="/" class="text-black ml-4 p-5"> Exit without saving </a>
            </div>



        </form>
    </x-form>

</x-layout>
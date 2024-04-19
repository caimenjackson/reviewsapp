<x-layout>

    <x-form>

        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Add new car
            </h2>
            <p class="mb-4">Add a new car to your account</p>
        </header>

        <form method="POST" action="/cars">
            @csrf
            <div class="mb-6">
                <label
                    for="registration"
                    class="inline-block text-lg mb-2"
                    >Vehicle Registration</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="registration"
                />
                @error('registration')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="make" class="inline-block text-lg mb-2"
                    >Vheicle Manufacturer</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="make"
                    placeholder="Example: Senior Laravel Developer"
                />
                @error('make')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="model"
                    class="inline-block text-lg mb-2"
                    >Vehicle Model Name</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="model"
                    placeholder="Example: Remote, Boston MA, etc"
                />
                @error('model')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="engine_size" class="inline-block text-lg mb-2"
                    >Vehicle Engine Size (L)</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="engine_size"
                />
                @error('engine_size')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="mileage"
                    class="inline-block text-lg mb-2"
                >
                    Current Vehicle Mileage
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="mileage"
                />
                @error('mileage')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>


            {{-- <div class="mb-6">
                <label for="vehicle_pic" class="inline-block text-lg mb-2">
                    Picture of your car
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="vehicle_pic"
                />
            </div> --}}


            <div class="mb-6">
                <button
                    class="bg-red-500 w-100 text-white rounded py-2 px-4 hover:bg-black"
                >
                    Add Car!
                </button>

                <a href="/" class="bg-green-300 rounded py-2 px-4 ml-4 text-white"> Back </a>
            </div>
        </form>



    </x-form>

</x-layout>
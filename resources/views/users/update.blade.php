<x-layout>

    @include('partials._edituserdetails')

    <x-form>
        <form method="POST" action="/users/{{$user->id}}" enctype="multipart/form-data">
            @csrf <!-- stops cross site scripting -->
            @method('PUT')



            <div class="mb-6 text-center">
                <label
                    for="name"
                    class="inline-block text-lg mb-2"
                    >Full Name</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black text-center"
                    name="name"
                    value="{{$user->name}}"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>


            <div class="mb-6 text-center">
                <label for="email" class="inline-block text-lg mb-2"
                    >eMail Address</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black text-center"
                    name="email"
                    placeholder="Example: Senior Laravel Developer"
                    value="{{$user->email}}"
                />
            </div>
            @error('email')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror


            <div class="mb-6 text-center">
                <label for="address" class="inline-block text-lg mb-2"
                    >Address</label
                >
                <textarea
                    class="border border-gray-200 rounded p-2 w-full text-black text-center"
                    name="address"
                    rows="3"
                >{{$user->address}}</textarea>
            </div>
            @error('address')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror

            <div class="mb-6 text-center">
                <label for="date_of_birth" class="inline-block text-lg mb-2">Date of Birth</label>
                <input 
                    type="date" 
                    class="border border-gray-200 rounded p-2 w-full bg-grey-500 text-black text-center" 
                    name="date_of_birth" 
                    value="{{$user->date_of_birth}}">
                @error('date_of_birth')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-center" x-data="{ selectedOption: '{{ $user->license_type ?? old('license_type') }}' }">
                <label for="license_type" class="block text-lg mb-2">License Type</label>
                <div class="flex justify-between items-center border border-gray-200 rounded-lg p-2">
                    <label class="flex-1 text-center cursor-pointer" for="provisional" @click="selectedOption = 'provisional'">
                        <input type="radio" id="provisional" name="license_type" value="provisional" class="hidden" x-bind:checked="selectedOption === 'provisional'">
                        <span class="block rounded-full border border-transparent p-2 hover:border-gray-300" :class="{ 'bg-red-500 text-white': selectedOption === 'provisional' }">Provisional</span>
                    </label>
                    <label class="flex-1 text-center cursor-pointer" for="full_manual" @click="selectedOption = 'full_manual'">
                        <input type="radio" id="full_manual" name="license_type" value="full_manual" class="hidden" x-bind:checked="selectedOption === 'full_manual'">
                        <span class="block rounded-full border border-transparent p-2 hover:border-gray-300" :class="{ 'bg-red-500 text-white': selectedOption === 'full_manual' }">Full Manual</span>
                    </label>
                    <label class="flex-1 text-center cursor-pointer" for="automatic" @click="selectedOption = 'full_automatic'">
                        <input type="radio" id="automatic" name="license_type" value="full_automatic" class="hidden" x-bind:checked="selectedOption === 'full_automatic'">
                        <span class="block rounded-full border border-transparent p-2 hover:border-gray-300" :class="{ 'bg-red-500 text-white': selectedOption === 'full_automatic' }">Automatic</span>
                    </label>
                </div>
                @error('license_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            
            <div class="mb-6 text-center">
                <label for="license_updated" class="block text-lg mb-2">License Updated</label>
                <input
                    type="date"
                    id="license_updated"
                    name="license_updated"
                    class="border border-gray-200 rounded p-2 w-full text-black text-center"
                    value="{{$user->license_updated}}"
                />
                @error('license_updated')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 text-center" x-data="{ userType: '{{ $user->user_type ?? old('user_type') }}', businessName: '{{ $user->business_name ?? old('business_name') }}' }">
                <label for="user_type" class="block text-lg mb-2">User Type</label>
                <div class="flex justify-between items-center border border-gray-200 rounded-lg p-2">
                    <label class="flex-1 text-center cursor-pointer" @click="userType = 'consumer'; businessName = '';">
                        <input type="radio" id="consumer" name="user_type" value="consumer" class="hidden" x-bind:checked="userType === 'consumer'">
                        <span class="block rounded-full border border-transparent p-2 hover:border-gray-300" :class="{ 'bg-red-500 text-white': userType === 'consumer' }">Consumer</span>
                    </label>
                    <label class="flex-1 text-center cursor-pointer" @click="userType = 'garage'; businessName = '{{ $user->business_name ?? old('business_name') }}';">
                        <input type="radio" id="garage" name="user_type" value="garage" class="hidden" x-bind:checked="userType === 'garage'">
                        <span class="block rounded-full border border-transparent p-2 hover:border-gray-300" :class="{ 'bg-red-500 text-white': userType === 'garage' }">Garage</span>
                    </label>
                </div>
                @error('user_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            
                <div x-show="userType === 'garage'" class="mt-4">
                    <label for="business_name" class="block text-lg mb-2">Business Name</label>
                    <input
                        type="text"
                        id="business_name"
                        name="business_name"
                        class="border border-gray-200 rounded p-2 w-full text-black"
                        x-bind:value="businessName"
                    />
                    @error('business_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            
           





            

            <div class="mb-6 text-center">
                <button
                    class="bg-gray-500 text-white rounded py-2 px-4 hover:bg-red-500 p-2">
                    Update User Account
                </button>

            </div>


            <div class="mb-6 text-lg text-center bg-green-300 border-green rounded hover:bg-red-500 p-2">
            <a href="/" class="text-black ml-4 p-5"> Exit without saving </a>
            </div>



        </form>
    </x-form>

</x-layout>
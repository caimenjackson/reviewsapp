<x-layout>
    <x-form>
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Review Filter
            </h2>
            <p class="mb-4">Register for a Review Filter Account</p>
        </header>

        <form method="POST" action="/users">
            @csrf 
            <div class="mb-6 text-center">
                <label for="name" class="inline-block text-lg mb-2">
                    Full Name
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="name"
                    value="{{old('name')}}"
                />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6 text-center">
                <label for="email" class="inline-block text-lg mb-2"
                    >Email</label
                >
                <input
                    type="email"
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="email"
                    value="{{old('email')}}"
                />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6 text-center">
                <label for="address" class="inline-block text-lg mb-2">Address</label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="address"
                    rows="3" 
                >{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            

            <div class="mb-6 text-center">
                <label for="date_of_birth" class="inline-block text-lg mb-2">Date of Birth</label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full bg-grey-500 text-black text-center" name="date_of_birth" value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            
            
            <div class="mb-6 text-center" x-data="{ userType: '{{ old('user_type') }}' }">
                <label for="user_type" class="block text-lg mb-2">User Type</label>
                <div class="flex justify-between items-center border border-gray-200 rounded-lg p-2">
                    <label class="flex-1 text-center cursor-pointer" @click="userType = 'consumer'">
                        <input type="radio" id="consumer" name="user_type" value="consumer" class="hidden" x-bind:checked="userType === 'consumer'">
                        <span class="block rounded-full border border-transparent p-2 hover:border-gray-300" :class="{ 'bg-red-500 text-white': userType === 'consumer' }">Consumer</span>
                    </label>
                    <label class="flex-1 text-center cursor-pointer" @click="userType = 'business'">
                        <input type="radio" id="business" name="user_type" value="garage" class="hidden" x-bind:checked="userType === 'garage'">
                        <span class="block rounded-full border border-transparent p-2 hover:border-gray-300" :class="{ 'bg-red-500 text-white': userType === 'business' }">Business</span>
                    </label>
                </div>
                @error('user_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            
                <div x-show="userType === 'business'" class="mt-4">
                    <label for="business_name" class="block text-lg mb-2">Business Name</label>
                    <input
                        type="text"
                        id="business_name"
                        name="business_name"
                        class="border border-gray-200 rounded p-2 w-full text-black"
                        value="{{ old('business_name') }}"
                    />
                    @error('business_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            
            
            


            <div class="mb-6 text-center">
                <label
                    for="password"
                    class="inline-block text-lg mb-2"
                >
                    Password
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="password"
                    value="{{old('password')}}"
                />

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6 text-center">
                <label
                    for="password2"
                    class="inline-block text-lg mb-2"
                >
                    Confirm Password
                </label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full text-black"
                    name="password_confirmation"
                    value="{{old('password_confirmation')}}"
                />

                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <input id="terms" type="checkbox" value="" class="w-4 h-4 border border-red-300 rounded bg-red-50 focus:ring-3 focus:ring-red-300 dark:bg-red-700 dark:border-red-600 dark:focus:ring-red-600 dark:ring-offset-red-800 dark:focus:ring-offset-red-800" required />
                </div>
                <label for="terms" class="ms-2 text-sm font-medium text-red-900 dark:text-gray-300">
                    I agree with the <a href="/tcs" class="text-red-600 hover:underline dark:text-red-500">Terms and conditions</a>
                </label>
            </div>
            

            <div class="mb-6">
                <button
                    type="submit"
                    class="bg-laravel text-red rounded py-2 px-4 hover:bg-red-400 w-full bg-red-500"
                >
                    Sign Up
                </button>
            </div>


            <div class="mt-8">
                <p>
                    Already have an account?
                    <a href="/login" class="text-laravel"
                        >Login</a
                    >
                </p>
            </div>
        </form>
    </div>

    <div class="pb-20"></div> <!-- Add padding to bottom of page -->
    </x-form>
</x-layout>
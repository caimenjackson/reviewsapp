<x-layout>
    <x-form>
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Review Filter
            </h2>
        <p>Log in to your Review Filter Account</p>
        </header>

        <form method="POST" action="/users/authenticate">
            @csrf
            
            <div class="mb-6 text-center pt-10">
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


            <div class="mb-6">
                <button
                    type="submit"
                    class="bg-laravel text-red rounded py-2 px-4 hover:bg-red-400 w-full bg-red-500"
                >
                    Sign In
                </button>
            </div>

            <div class="mt-8 flex justify-between">
                <p>Don't have an account? <a href="/register" class="hover:text-laravel relative inline-flex items-center bg-white text-black rounded px-2 py-1">Register</a></p>
                <a href="/reset-password" class="hover:text-laravel relative inline-flex items-center bg-white text-black rounded px-2 py-1">Reset Password</a>
            </div>
            
            
            
        </form>
    </div>


    </x-form>
</x-layout>
<x-layout>

    @include('partials._uac')

    <x-card>
        <table class="w-full table-auto rounded-sm text-black">
            <tbody>
                @foreach($user->getAttributes() as $key => $value)
                    @if (!in_array($key, ['created_at', 'updated_at', 'email_verified_at', 'password', 'remember_token']) && !($key === 'business_name' && $user->user_type === 'consumer'))
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg font-bold">
                                {{$key}}
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                {{$value}}
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </x-card>
    
    
    

    <div class="flex justify-center items-center mt-8">
        <form method="POST" action="/users/{{ auth()->id() }}">
            @csrf
            @method('DELETE')
            <button class="p-4 rounded text-white bg-red-500"><i class="fa-solid fa-trash"></i> Delete my account</button>
        </form>
        <div class="pl-2 pr-2"></div>
        <form method="GET" action="/users/{{ auth()->id() }}/update">
            <button class="p-4 rounded text-white bg-yellow-500 hover:bg-blue-800"><i class="fa-solid fa-pencil"></i> Update account information</button>
        </form>
    </div>
    
    <div class="p-10"></div>
</x-layout>
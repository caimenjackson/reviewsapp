<x-layout>

    @include('partials._cardetails')

    

    <x-card>
        <table class="w-full table-auto rounded-sm">
            <tbody>
                @foreach($car->getAttributes() as $key => $value)
                    @if (!in_array($key, ['user_id', 'created_at', 'updated_at']))
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
    
    @include('partials._carlink')

    <div class="p-10"></div>

</x-layout>
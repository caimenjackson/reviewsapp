<x-layout>
    @include('partials._accountheader')
    <x-card>
        

            <table class="w-full table-auto rounded-sm">
                <tbody>
                    @unless($cars->isEmpty())
                    @foreach($cars as $car)
                    <tr class="border-gray-300">
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <a href="/cars/{{$car->id}}">
                                {{$car->registration}}
                            </a>
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <a
                                href="/cars/{{$car->id}}/edit"
                                class="text-white px-6 py-2 rounded-xl"
                                ><i
                                    class="fa-solid fa-pen-to-square"
                                ></i>
                                Update Vehicle Information</a
                            >
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <a
                                href="/cars/{{$car->id}}/predictive"
                                class="text-white px-6 py-2 rounded-xl"
                                ><i
                                    class="fa-solid fa-pen-to-square"
                                ></i>
                                Predictive Maintenance</a
                            >
                            <span class="rounded-full bg-red-500 text-white px-2 py-1 ml-2 text-xs">ALPHA</span>
                        </td>
                        <td
                            class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                        >
                            <form method="POST" action="/cars/{{ $car->id }}/delete">
                                @csrf
                                @method('DELETE')
                                <button class="text-white">
                                    <i
                                        class="fa-solid fa-trash-can"
                                    ></i>
                                    Remove this vehicle
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <p class="text-center">No Cars Found</p>
                        </td>
                    </tr>

                    @endunless

                    
                </tbody>
            </table>
        
    </x-card>

    @include('partials._addcar')
 
</x-layout>
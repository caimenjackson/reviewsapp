<div class="flex justify-center items-center">
    <a href="/cars/{{$car->id}}/link" class="bg-red-500 hover:bg-red-600 text-white font-bold py-4 px-8 rounded-lg text-lg mt-10">
        Link government vehicle ID
    </a>
    <a href="/cars/{{$car->id}}/edit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-4 px-8 rounded-lg text-lg mt-10 ml-10">
        Update Vehicle Details
    </a>
    <a href="/cars/{{$car->id}}/link" class="bg-green-500 hover:bg-red-600 text-white font-bold py-4 px-8 rounded-lg text-lg mt-10 ml-10">
        Make vehicle record public
    </a>
    <a href="/cars/add" class="bg-red-500 hover:bg-red-600 text-white font-bold py-4 px-8 rounded-lg text-lg mt-10 ml-10">
        Upload service information
    </a>
    <div class="bg-red-500 hover:bg-red-600 text-white font-bold py-4 px-8 rounded-lg text-lg mt-10 ml-10">
        <form method="POST" action="/cars/{{ $car->id }}/delete">
            @csrf
            @method('DELETE')
            <button class=""><i class="fa-solid fa-trash"></i> Delete this vehicle</button>
        </form>
    </div>
    <div class="px-10"></div>
</div>
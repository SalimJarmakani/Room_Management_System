<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($rooms as $room)
            <div class="border border-gray-200 rounded-lg shadow-md overflow-hidden">
                <div class="bg-white p-6">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $room['name'] }}</h2>
                    <p class="text-gray-500 text-sm mt-1">{{ $room['description'] }}</p>
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Availability:</span>
                            <span class="{{ $room['availability'] === 'Available' ? 'text-green-500' : 'text-red-500' }} font-medium">
                                {{ $room['availability'] }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Capacity:</span>
                            <span class="text-gray-800 font-medium">{{ $room['capacity'] }} People</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Amenities:</span>
                            <span class="text-gray-800 font-medium">{{ $room['amenities'] }}</span>
                        </div>
                    </div>
                    <a href="{{ route('book-room.form'); }}" class="bg-blue-700 hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mt-2 block text-center">
                        Book Now
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
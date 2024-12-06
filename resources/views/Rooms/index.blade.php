<x-app-layout>
    <div class="container mx-auto p-6">
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative mb-4">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($rooms as $room)
            <div class="border border-gray-200 rounded-lg shadow-md overflow-hidden">
                <div class="bg-white p-6">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $room->room_name }}</h2>
                    <p class="text-gray-500 text-sm mt-1">{{ $room->description }}</p>
                    <div class="mt-4 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="{{ $room->latestBooking && $room->latestBooking->end_time > now() ? 'text-red-500' : 'text-green-500' }} font-medium">
                                {{ $room->latestBooking && $room->latestBooking->end_time > now() ? 'Booked' : 'Available' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Capacity:</span>
                            <span class="text-gray-800 font-medium">{{ $room->capacity }} People</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Amenities:</span>
                            <span class="text-gray-800 font-medium">
                                @foreach ($room->amenities as $amenity)
                                {{ $amenity->name }}@if (!$loop->last), @endif
                                @endforeach
                            </span>
                        </div>
                        @if ($room->latestBooking)
                        <div class="mt-4">
                            <span class="text-gray-600">Latest Booking:</span>
                            <span class="text-gray-800 font-medium">
                                {{ $room->latestBooking->start_time->format('M d, Y H:i') }} -
                                {{ $room->latestBooking->end_time->format('M d, Y H:i') }}
                            </span>
                        </div>
                        @endif
                    </div>
                    <a href="{{ route('book-room.form', ['room_id' => $room->room_id]) }}"
                        class="bg-blue-700 hover:bg-white hover:text-blue-700  text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow mt-2 block text-center">
                        Book Now
                    </a>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
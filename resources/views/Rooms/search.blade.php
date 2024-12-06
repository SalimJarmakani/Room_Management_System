<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl text-blue-500 font-semibold mb-4">Search Rooms by Amenities</h2>

        <!-- Search Form -->
        <form action="{{ route('rooms.search') }}" method="GET" class="mb-6">
            <div class="mb-4">
                <label for="amenities" class="block text-blue-700 font-semibold">Select Amenities</label>
                <select id="amenities" name="amenities[]" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" multiple>
                    @foreach ($amenities as $amenity)
                    <option value="{{ $amenity->id }}"
                        @if(in_array($amenity->id, request('amenities', []))) selected @endif>
                        {{ $amenity->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                    Search
                </button>
            </div>
        </form>

        <!-- Search Results -->
        @if($rooms->isEmpty())
        <p class="text-gray-700">No rooms found with the selected amenities.</p>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($rooms as $room)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold mb-4">{{ $room->room_name }}</h3>
                <p class="text-gray-700">Capacity: {{ $room->capacity }}</p>
                <p class="text-gray-700 mt-2">Description: {{ $room->description }}</p>
                <div class="mt-4">
                    <strong>Amenities:</strong>
                    <ul class="list-disc pl-5">
                        @foreach ($room->amenities as $amenity)
                        <li>{{ $amenity->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <!-- Book Now Button -->
                <a href="{{ route('book-room.form', ['room_id' => $room->room_id]) }}"
                    class="bg-blue-700 hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mt-2 block text-center">
                    Book Now
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <!-- Add Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Add jQuery and Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('#amenities').select2({
                placeholder: 'Select amenities',
                allowClear: true,
                width: '100%',
            });
        });
    </script>
</x-app-layout>
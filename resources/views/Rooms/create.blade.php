<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-bold mb-6">Create a New Room</h2>
            <form action="{{ route('rooms.store') }}" method="POST">
                @csrf

                <!-- Room Name Input -->
                <div class="mb-4">
                    <label for="room_name" class="block text-gray-700">Room Name</label>
                    <input
                        type="text"
                        id="room_name"
                        name="room_name"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <!-- Capacity Input -->
                <div class="mb-4">
                    <label for="capacity" class="block text-gray-700">Capacity</label>
                    <input
                        type="number"
                        id="capacity"
                        name="capacity"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required />
                </div>

                <!-- Description Input -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <!-- Amenities Select -->
                <div class="mb-4">
                    <label for="amenities" class="block text-gray-700">Amenities</label>
                    <select
                        id="amenities"
                        name="amenities[]"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        multiple>
                        @foreach ($amenities as $amenity)
                        <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                        Create Room
                    </button>
                </div>
            </form>
        </div>
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
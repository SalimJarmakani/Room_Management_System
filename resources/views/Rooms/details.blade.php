<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl text-blue-400 font-bold mb-6">Room Details</h1>

        @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white shadow rounded-lg p-6">
            <!-- Update Form -->
            <form method="POST" action="{{ route('rooms.update', $room->room_id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="room_name" class="block text-sm font-medium text-gray-700">Room Name</label>
                    <input type="text" name="room_name" id="room_name" value="{{ old('room_name', $room->room_name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('room_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
                    <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $room->capacity) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('capacity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $room->description) }}</textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-500">
                        Save Changes
                    </button>
                </div>
            </form>

            <!-- Delete Form -->
            <form method="POST" action="{{ route('rooms.destroy', $room->room_id) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="ms-auto inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring focus:ring-red-500"
                    onclick="return confirm('Are you sure you want to delete this room?')">
                    Delete Room
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
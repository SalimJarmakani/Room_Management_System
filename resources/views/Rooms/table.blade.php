<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl text-blue-500 font-bold mb-6">All Rooms</h1>

        <div class="bg-white shadow rounded-lg p-6">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Room ID</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Room Name</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Capacity</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Description</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rooms as $room)
                    <tr class="border-b">
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $room->room_id }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $room->room_name }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $room->capacity }}</td>
                        <td class="px-4 py-2 text-sm text-gray-700">{{ $room->description }}</td>
                        <td class="px-4 py-2 text-sm">
                            <a href="{{ route('rooms.details', $room->room_id) }}"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-xs font-medium rounded shadow hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-500">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center text-sm text-gray-500">No rooms available.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold text-blue-400 mb-6">Bookings</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Booking ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Room ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Start Time</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">End Time</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Employee Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Employee Email</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($bookings as $booking)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->booking_id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->room_id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->start_time }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->end_time }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">
                            <span class="inline-flex px-2 py-1 text-xs font-medium text-white rounded 
                                {{ $booking->bookingStatus === 'confirmed' ? 'bg-green-500' : ($booking->bookingStatus === 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                {{ $booking->bookingStatus }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->employee->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $booking->employee->user->email ?? 'N/A' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">No bookings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
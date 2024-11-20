<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Book a Room</h2>

            <!-- Display success message if booking is successful -->
            @if (session('success'))
            <div class="mb-4 text-green-500">{{ session('success') }}</div>
            @endif

            <!-- Booking Form -->
            <form method="POST">
                @csrf

                <!-- Start Time -->
                <div class="mb-4">
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                    <input type="datetime-local" id="start_time" name="start_time" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    @error('start_time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- End Time -->
                <div class="mb-4">
                    <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                    <input type="datetime-local" id="end_time" name="end_time" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    @error('end_time')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Reason -->
                <div class="mb-4">
                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                    <textarea id="reason" name="reason" rows="4" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter the reason for booking the room" required></textarea>
                    @error('reason')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-700 text-white text-lg font-semibold rounded-lg hover:bg-blue-800 focus:outline-none">
                        Book Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
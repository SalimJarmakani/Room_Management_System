<x-app-layout>
    <div class="container mx-auto p-6 bg-white mt-5 w-5/12 rounded">

        @if ($errors->has('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            {{ $errors->first('error') }}
        </div>
        @endif
        <h1 class="text-2xl font-bold mb-4">Book <span class="text-blue-600">{{$room_name}}</span></h1>
        <form method="POST" action="{{ route('book-room.store') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="room_id" value="{{ $room_id }}">

            <div>
                <label for="start_time" class="block text-gray-700">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="end_time" class="block text-gray-700">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" required
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <button type="submit" class="bg-blue-700 text-white py-2 px-4 rounded">
                Confirm Booking
            </button>
        </form>
    </div>
</x-app-layout>
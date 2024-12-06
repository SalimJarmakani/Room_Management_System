<x-app-layout>
    <div class="max-w-5xl w-5xl mt-5 p-6 mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-4xl">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Calendar Section -->
            <div class="w-2/5 md:w-2/3 h-3/6">
                <div id="calendar"></div>
            </div>

            <!-- Bookings Table Section -->
            <div class="w-full md:w-1/3">
                <h2 class="text-lg font-semibold text-blue-500 mb-4">Bookings Overview</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-blue-500 text-white">
                                <th class="px-4 py-2 text-left text-sm font-medium">Room</th>
                                <th class="px-4 py-2 text-left text-sm font-medium">Start Time</th>
                                <th class="px-4 py-2 text-left text-sm font-medium">End Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $booking->room->room_name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $booking->start_time->format('Y-m-d H:i') }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $booking->end_time->format('Y-m-d H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            const Calendar = window.Calendar;
            const calendarEl = document.getElementById('calendar');

            // Pass the PHP events to JavaScript
            const events = @json($events); // Blade directive to safely pass PHP data to JS

            console.log(events);
            const calendar = new Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                events: events, // Set events dynamically
            });

            calendar.render();
        });
    </script>
</x-app-layout>
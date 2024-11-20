<x-app-layout>




    <div class="max-w-5xl w-5xl mt-5 p-6 mx-auto h-3/6 bg-white rounded-xl shadow-md overflow-hidden md:max-w-4xl">

        <div id="calendar">


        </div>
    </div>


    <script type="module">
        document.addEventListener('DOMContentLoaded', function() {
            const Calendar = window.Calendar;
            const calendarEl = document.getElementById('calendar')
            const calendar = new Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                events: [{
                        id: 'a',
                        title: 'Meeting Room A',
                        start: '2024-11-15T09:00:00', // Start time: 9:00 AM
                        end: '2024-11-15T10:00:00', // End time: 10:00 AM
                        allDay: false,
                    },
                    {
                        id: 'a',
                        title: 'Meeting Room A',
                        start: '2024-11-15T08:00:00', // Start time: 9:00 AM
                        end: '2024-11-15T8:30:00', // End time: 10:00 AM
                        allDay: false,
                    }
                ]
            });
            calendar.render()
        })
    </script>
</x-app-layout>
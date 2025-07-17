<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
    body {
        background: linear-gradient(135deg, #0c1c3b, #050a1f);
        color: #fff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-wrapper {
        max-width: 700px;
        margin: 3rem auto;
        background: rgba(10, 20, 50, 0.85);
        padding: 2rem;
        border-radius: 1rem;
        border: 3px solid #ffd700;
        box-shadow:
            0 0 20px #00bfff,
            inset 0 0 10px #003366;
    }

    .form-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #ffd700;
        text-shadow: 1px 1px #003366;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        color: #ffd700;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    input[type="text"],
    input[type="datetime-local"],
    textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        background: #0a1b3b;
        border: 2px solid #335577;
        border-radius: 0.5rem;
        color: #fff;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    input:focus,
    textarea:focus {
        outline: none;
        border-color: #00bfff;
        box-shadow: 0 0 8px #00bfff;
    }

    .submit-btn {
        background: linear-gradient(45deg, #00bfff, #003366);
        color: #fff;
        padding: 0.75rem 1.5rem;
        font-weight: bold;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        float: right;
        box-shadow:
            inset 0 0 10px #003366,
            0 0 10px #00bfff;
        transition: background 0.3s, box-shadow 0.3s;
    }

    .submit-btn:hover {
        background: linear-gradient(45deg, #66ccff, #003366);
        box-shadow:
            inset 0 0 15px #ffd700,
            0 0 15px #ffd700;
    }

    .error-box {
        background: rgba(239, 68, 68, 0.2);
        border: 2px solid #ef4444;
        color: #f87171;
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
    }

    /* Mobile Legends Flatpickr Theme */
    .flatpickr-calendar {
        background: linear-gradient(135deg, #0a1b3b, #142850) !important;
        color: #fff !important;
        border-radius: 1rem;
        border: 3px solid #ffd700;
        box-shadow: 0 0 20px #00bfff;
        overflow: hidden;
    }

    .flatpickr-months {
        background: linear-gradient(135deg, #142850, #0c1c3b);
        color: #ffd700 !important;
        border-bottom: 2px solid #ffd700;
    }

    .flatpickr-months .flatpickr-prev-month,
    .flatpickr-months .flatpickr-next-month {
        color: #00bfff !important;
        transition: color 0.3s;
    }

    .flatpickr-months .flatpickr-prev-month:hover,
    .flatpickr-months .flatpickr-next-month:hover {
        color: #ffd700 !important;
    }

    .flatpickr-current-month {
        color: #ffd700 !important;
        font-weight: bold;
    }

    .flatpickr-weekdays {
        background: #0c1c3b;
        color: #ffd700 !important;
        font-weight: 600;
        border-bottom: 1px solid #00bfff;
    }

    .flatpickr-days {
        background: transparent;
    }

    .flatpickr-day {
        color: #fff !important;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .flatpickr-day:hover {
        background: rgba(0, 191, 255, 0.3) !important;
        color: #fff !important;
    }

    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
        background: linear-gradient(135deg, #00bfff, #ffd700) !important;
        color: white !important;
        font-weight: bold;
        box-shadow: 0 0 10px #ffd700;
    }

    .flatpickr-day.today {
        border: 2px solid #00bfff !important;
    }

    .flatpickr-time {
        background: #0c1c3b;
        color: #ffd700 !important;
        border-top: 2px solid #ffd700;
        padding: 0.5rem;
    }

    .flatpickr-time input {
        background: #142850;
        color: #fff !important;
        border: 1px solid #00bfff;
        border-radius: 6px;
        padding: 4px 8px;
    }

    .flatpickr-confirm {
        background: linear-gradient(45deg, #00bfff, #003366);
        color: #fff !important;
        border-radius: 0.5rem;
        border: none;
        padding: 6px 12px;
        font-weight: bold;
        box-shadow: 0 0 10px #00bfff;
        transition: background 0.3s;
    }

    .flatpickr-confirm:hover {
        background: linear-gradient(45deg, #66ccff, #003366);
    }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-400 leading-tight">
            🏰 Create Booking
        </h2>
    </x-slot>

    <div class="min-h-screen py-12 px-4">
        <div class="form-wrapper">
            <h1 class="form-title">🏰 Create Booking</h1>

            @if ($errors->any())
                <div class="error-box">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <label for="title">Booking Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        required
                        placeholder="e.g. Land of Dawn Tournament"
                    >
                </div>

                <!-- Booking Date & Time -->
                <div class="mb-6">
                    <label for="booking_date">🗓️ Booking Date & Time</label>
                    <input type="hidden" name="booking_date" id="booking_date">
                    <div id="calendarBox" class="rounded-2xl mt-4"></div>
                </div>

                <!-- Notes -->
                <div class="mb-6">
                    <label for="notes">Notes (Optional)</label>
                    <textarea
                        name="notes"
                        id="notes"
                        rows="4"
                        placeholder="Add any extra notes, e.g. Special hero appearances!"
                    >{{ old('notes') }}</textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="submit-btn">⚔️ Submit Booking</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Popup Custom Datetime -->
    <div id="customDatetimeBox" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center hidden">
        <div class="bg-[#0a1b3b] text-white p-6 rounded-xl w-96 text-center relative glow-box">
            <button onclick="toggleCustomDatetime()" class="absolute top-2 right-3 text-white hover:text-red-400 text-xl font-bold">×</button>
            <h2 class="text-lg font-bold mb-4">Select Booking Date & Time</h2>
            <input
                type="datetime-local"
                id="customPicker"
                class="w-full p-2 rounded bg-[#142850] text-white border border-[#ffd700] focus:ring-2 focus:ring-[#ffd700]"
            >
            <button onclick="applyCustomDatetime()" class="submit-btn mt-4 w-full">✅ Use This Date</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    flatpickr("#calendarBox", {
        inline: true,
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        defaultDate: new Date(),
        time_24hr: false,
        minuteIncrement: 1,
        onChange: function(selectedDates, dateStr, instance) {
            document.getElementById("booking_date").value = dateStr;
        }
    });

    function toggleCustomDatetime() {
        document.getElementById("customDatetimeBox").classList.toggle("hidden");
    }

    function applyCustomDatetime() {
        let value = document.getElementById("customPicker").value;
        document.getElementById("booking_date").value = value;
        toggleCustomDatetime();
    }
    </script>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">⚔️ My Bookings in the Land of Dawn</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto mt-8 px-4">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($bookings->isEmpty())
            <div class="no-bookings">
                <p>You have no bookings yet. Summon your heroes and create one!</p>
            </div>
        @else
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y g:i A') }}</td>
                                <td>{{ $booking->notes ?? '-' }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('bookings.edit', $booking) }}" class="edit-btn">⚙️ Edit</a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">🗡️ Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="new-booking">
            <a href="{{ route('bookings.create') }}">+ Create New Booking</a>
        </div>
    </div>

    {{-- Styles for Mobile Legends Theme --}}
    <style>
        body {
            background: linear-gradient(135deg, #0a1b3b, #142850);
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-header {
            font-size: 2.2rem;
            font-weight: 700;
            color: #ffd700;
            text-shadow: 0 0 10px #00bfff;
            margin-bottom: 2rem;
            text-align: center;
        }

        .alert-success {
            background: linear-gradient(to right, #00bfff, #003366);
            color: white;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 0 15px #00bfff;
            font-weight: bold;
            text-align: center;
        }

        .no-bookings {
            background: rgba(10, 27, 59, 0.8);
            border: 2px solid #00bfff;
            padding: 2rem;
            border-radius: 1rem;
            text-align: center;
            color: #cce4ff;
            font-size: 1.1rem;
            box-shadow: 0 0 15px #00bfff;
        }

        .table-container {
            overflow-x: auto;
            background-color: rgba(10, 27, 59, 0.7);
            border-radius: 1rem;
            box-shadow: 0 0 20px #003366;
            border: 2px solid #ffd700;
            padding: 1rem;
            margin-top: 2rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #e0e0e0;
            font-size: 0.95rem;
        }

        thead {
            background: linear-gradient(to right, #003366, #00bfff);
            color: #ffd700;
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        th, td {
            padding: 1rem;
            border-top: 1px solid #335577;
            text-align: left;
        }

        tr:hover {
            background: rgba(0, 191, 255, 0.2);
            box-shadow: 0 0 10px #00bfff;
        }

        .action-buttons a,
        .action-buttons button {
            display: inline-block;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.8rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
            margin-right: 0.5rem;
            box-shadow: 0 0 10px rgba(0,191,255,0.4);
        }

        .edit-btn {
            background: linear-gradient(to right, #ffd700, #00bfff);
            color: #003366;
            box-shadow: 0 0 10px #ffd700;
        }

        .edit-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #ffd700;
        }

        .delete-btn {
            background: linear-gradient(to right, #dc2626, #ef4444);
            box-shadow: 0 0 10px #ef4444;
        }

        .delete-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #ef4444;
        }

        .new-booking {
            margin-top: 2.5rem;
            text-align: center;
        }

        .new-booking a {
            background: linear-gradient(to right, #00bfff, #003366);
            color: #ffd700;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 0.75rem;
            text-decoration: none;
            box-shadow: 0 0 20px #00bfff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .new-booking a:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px #ffd700;
        }
    </style>
</x-app-layout>

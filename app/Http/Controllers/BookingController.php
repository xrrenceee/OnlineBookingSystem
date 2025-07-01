<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BookingCreatedNotification;

class BookingController extends Controller
{
    /**
     * List all bookings for the authenticated user.
     */
    public function index(Request $request)
    {
        return response()->json(
            $request->user()->bookings()->latest()->get()
        );
    }

    /**
     * Store a new booking and notify the user.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $booking = $request->user()->bookings()->create($data);

        // Notify the user
        $request->user()->notify(new BookingCreatedNotification($booking));

        return response()->json([
            'message' => 'Booking created successfully!',
            'booking' => $booking,
        ], 201);
    }

    /**
     * Show a specific booking owned by the user.
     */
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);

        return response()->json($booking);
    }

    /**
     * Update a specific booking.
     */
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $booking->update($data);

        return response()->json([
            'message' => 'Booking updated successfully!',
            'booking' => $booking,
        ]);
    }

    /**
     * Delete a specific booking.
     */
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);

        $booking->delete();

        return response()->json([
            'message' => 'Booking deleted successfully.',
        ]);
    }
}

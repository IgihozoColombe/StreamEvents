<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::all(); //

        return response()->json($donations);
    }

    public function markAsRead(Donation $donation)
    {
        // Mark the donation as read (update the 'is_read' field)
        $donation->update(['is_read' => true]);

        // Optionally, you can return a response if needed
        return response()->json(['message' => 'Donation marked as read']);
    }

    // Show the form to create a new donation
    public function create()
    {
        return view('donations.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|max:255',
            'donation_message' => 'nullable|string|max:255',
            'user_id' => 'required|exists:users,id', // Make sure user_id exists in the users table
        ]);

        // Create a new donation record
        $donation = Donation::create($validatedData);

        return response()->json(['message' => 'Donation created successfully', 'donation' => $donation], 201);
    }
}

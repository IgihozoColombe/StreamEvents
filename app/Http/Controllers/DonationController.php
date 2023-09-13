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

    // Store a new donation
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'currency' => 'required|string|max:255',
            'donation_message' => 'nullable|string|max:255',
        ]);

        $donation = new Donation([
            'amount' => $request->input('amount'),
            'currency' => $request->input('currency'),
            'donation_message' => $request->input('donation_message'),
        ]);

        auth()->user()->donations()->save($donation);
        auth()->user()->notify(new DonationCreatedNotification($donation));

        return redirect()->route('donations.index')->with('success', 'Donation created successfully!');
    }
}

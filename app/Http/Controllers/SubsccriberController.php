<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubsccriberController extends Controller
{
    // List all subscribers for the currently logged-in user
    public function index()
    {
        $subscribers = Subscriber::all(); 

        return response()->json($subscribers);
    }

    public function markAsRead(Subscriber $subscriber)
    {
        // Mark the donation as read (update the 'is_read' field)
        $subscriber->update(['is_read' => true]);

        // Optionally, you can return a response if needed
        return response()->json(['message' => 'Subscriber marked as read']);
    }

    // Show the form to create a new subscriber
    public function create()
    {
        return view('subscribers.create');
    }

    // Store a new subscriber

    
  public function store(Request $request)
  {
      // Validate the incoming request data
      $validatedData = $request->validate([
        'subscriber_name' => 'required|string|max:255',
        'subscription_tier' => 'required|integer|between:1,3',
        'user_id' => 'required|exists:users,id', // Make sure user_id exists in the users table
      ]);

      // Create a new donation record
      $subscriber = Subscriber::create($validatedData);

      return response()->json(['message' => 'subscriber created successfully', 'subscriber' => $subscriber], 201);
  }
   
}
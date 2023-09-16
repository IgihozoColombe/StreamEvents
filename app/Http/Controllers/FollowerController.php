<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follower;
use App\Models\User; // Make sure to import the User model
use App\Events\FollowerCreated; // Import the FollowerCreated event if not already imported
use Illuminate\Notifications\Messages\MailMessage;

class FollowerController extends Controller
{
    // Remove the constructor and $follower property
    
    public function toDatabase($notifiable)
    {
        // You can retrieve the follower data here if needed
        $follower = auth()->user(); // Example: Get the authenticated user as the follower

        return [
            'follower_name' => $follower->name,
            // Other relevant data
        ];
    }

    public function create()
{
    return view('followers.create'); // Assuming 'followers.create' is your view name
}
    public function index()
    {
        // Retrieve a list of followers from the database
        $followers = Follower::all(); // You can customize this query as needed

        // Return the followers as a JSON response
        return response()->json($followers);
    }
    public function markAsRead(Follower $follower)
    {
        // Mark the donation as read (update the 'is_read' field)
        $follower->update(['is_read' => true]);

        // Optionally, you can return a response if needed
        return response()->json(['message' => 'Notification marked as read']);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id', // Make sure user_id exists in the users table
        ]);

        // Create a new follower record
        $follower = Follower::create($validatedData);

        return response()->json(['message' => 'Follower created successfully', 'follower' => $follower], 201);
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You have a new follower!')
            ->action('View Follower', url('/followers'))
            ->line('Thank you for using our application!');
    }

    public function follow(User $user)
    {
        // Check if the authenticated user is not already following the given user
        if (auth()->user()->isNotFollowing($user)) {
            auth()->user()->follow($user);
            event(new FollowerCreated(auth()->user())); // Trigger the event with the authenticated user
        }
        
        // Redirect back or return a response
        // Example: return redirect()->back()->with('success', 'You are now following ' . $user->name);
    }

    // Remove a user as a follower
    public function unfollow(User $user)
    {
        // Check if the authenticated user is following the given user
        if (auth()->user()->isFollowing($user)) {
            auth()->user()->unfollow($user);
        }
        
        // Redirect back or return a response
        // Example: return redirect()->back()->with('success', 'You have unfollowed ' . $user->name);
    }
}

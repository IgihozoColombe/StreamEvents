<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follower;
use App\Models\Donation;
use App\Models\Subscriber;
use App\Models\MerchandiseSale;
use Carbon\Carbon;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function dashboardData(Request $request)
    {
        // Calculate the date 30 days ago
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        $totalDonations = Donation::where('created_at', '>=', $thirtyDaysAgo)->sum('amount');
        $totalSubscriptions = Subscriber::where('created_at', '>=', $thirtyDaysAgo)->count();
        $totalMerchSales = Merch_sale::where('created_at', '>=', $thirtyDaysAgo)->sum('amount');
        $totalFollowersGained = Follower::where('created_at', '>=', $thirtyDaysAgo)->count();
        $notification = new Notification();
$notification->user_id = $userBeingFollowed->id; // The user being followed
$notification->message = auth()->user()->name . " followed you!";
$notification->is_read = false; // Set as unread initially
$notification->save();

        $topSellingItems = Merch_sale::select('item_name', DB::raw('SUM(amount) as totalSales'))
            ->groupBy('item_name')
            ->orderByDesc('totalSales')
            ->limit(3)
            ->get();

        return response()->json([
            'totalDonations' => $totalDonations,
            'totalSubscriptions' => $totalSubscriptions,
            'totalMerchSales' => $totalMerchSales,
            'totalFollowersGained' => $totalFollowersGained,
            'topSellingItems' => $topSellingItems,
        ]);
    }
    public function getNotifications(Request $request)
{
    // Fetch notifications for the authenticated user
    $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

    return response()->json(['notifications' => $notifications]);
}
}
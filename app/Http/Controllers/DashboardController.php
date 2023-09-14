<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follower;
use App\Models\Donation;
use App\Models\Subscriber;
use App\Models\MerchSale;
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
        $totalMerchSales = MerchSale::where('created_at', '>=', $thirtyDaysAgo)->sum('amount');
        $totalFollowersGained = Follower::where('created_at', '>=', $thirtyDaysAgo)->count();
        $notification = new Notification();


        $topSellingItems =MerchSale::select('item_name', MerchSale::raw('SUM(amount) as totalSales'))
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

    public function getTotalMerchandiseSales()
{
    $totalMerchandiseSales = MerchSale::sum('amount');
    return response()->json(['totalMerchandiseSales' => $totalMerchandiseSales]);
}


public function getTotalFollowersLast30Days()
{
    // Calculate the date 30 days ago from today
    $thirtyDaysAgo = now()->subDays(30);

    // Use Eloquent to count followers in the last 30 days
    $totalFollowers = Follower::where('created_at', '>=', $thirtyDaysAgo)->count();

    // Return the total followers as a JSON response
    return response()->json(['totalFollowers' => $totalFollowers]);
}


    public function getNotifications(Request $request)
{
    // Fetch notifications for the authenticated user
    $notifications = Notification::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

    return response()->json(['notifications' => $notifications]);
}
}
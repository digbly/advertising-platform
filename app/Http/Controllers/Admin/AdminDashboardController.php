<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function stats(): JsonResponse
    {
        $stats = Cache::remember('dashboard:admin:stats', 60, function () {
            $totalUsers = DB::table('users')->count();
            $totalSubscribers = DB::table('subscriptions')
                ->where('status', 'active')
                ->distinct('user_id')
                ->count();

            $videoStats = DB::table('videos')
                ->selectRaw('COUNT(*) as total_videos')
                ->selectRaw('COALESCE(SUM(views), 0) as total_views')
                ->selectRaw('COALESCE(SUM(file_size), 0) as total_storage')
                ->first();

            $revenue = DB::table('payments')
                ->where('status', 'completed')
                ->selectRaw('COALESCE(SUM(amount), 0) as total_revenue')
                ->first();

            return [
                'total_users' => (int) $totalUsers,
                'total_videos' => (int) $videoStats->total_videos,
                'total_views' => (int) $videoStats->total_views,
                'total_storage' => (int) $videoStats->total_storage,
                'active_subscribers' => (int) $totalSubscribers,
                'total_revenue' => (float) $revenue->total_revenue,
            ];
        });

        return response()->json(['data' => $stats]);
    }
}

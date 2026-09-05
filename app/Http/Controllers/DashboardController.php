<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function stats(Request $request): JsonResponse
    {
        $userId = $request->user('api')->id;

        $stats = Cache::remember("dashboard:user:{$userId}", 60, function () use ($userId) {
            $videoStats = DB::table('videos')
                ->where('user_id', $userId)
                ->selectRaw('COUNT(*) as total_videos')
                ->selectRaw('COALESCE(SUM(views), 0) as total_views')
                ->selectRaw('COALESCE(SUM(file_size), 0) as total_storage')
                ->selectRaw('SUM(CASE WHEN qualities IS NOT NULL THEN 1 ELSE 0 END) as published')
                ->selectRaw('SUM(CASE WHEN qualities IS NULL THEN 1 ELSE 0 END) as processing')
                ->first();

            return [
                'total_videos' => (int) $videoStats->total_videos,
                'published' => (int) $videoStats->published,
                'total_views' => (int) $videoStats->total_views,
                'processing' => (int) $videoStats->processing,
                'total_storage' => (int) $videoStats->total_storage,
            ];
        });

        return response()->json(['data' => $stats]);
    }
}

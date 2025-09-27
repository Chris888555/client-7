<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class UtilityController extends Controller
{
    public function clearCache(Request $request)
    {
        // Optional: further authorize, e.g. admin check
        // if (!auth()->user()->is_admin) { return response()->json(['success'=>false,'message'=>'Forbidden'],403); }

        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');

            return response()->json(['success' => true, 'message' => 'Cache cleared successfully!']);
        } catch (\Throwable $e) {
            Log::error('Cache clear failed: '.$e->getMessage());
            // Return message for debugging; in production you may want a generic message
            return response()->json(['success' => false, 'message' => 'Server error: '.$e->getMessage()], 500);
        }
    }

    public function refreshStorage()
{
    try {
        // First unlink (safe, ignore if doesn't exist)
        Artisan::call('storage:unlink');
        // Then link again
        Artisan::call('storage:link');

        return response()->json([
            'success' => true,
            'message' => 'Storage symlink refreshed successfully!'
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: '.$e->getMessage()
        ], 500);
    }
}

}

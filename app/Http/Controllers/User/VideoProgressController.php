<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\VideoProgress;
use Illuminate\Support\Facades\Log;
use Exception;

class VideoProgressController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'user_cookie' => 'required|string',
                'video_url' => 'required|string', // updated field
                'page_link' => 'nullable|string',
                'username' => 'nullable|string',
                'progress' => 'required|numeric',
                'max_watch_percentage' => 'required|numeric',
            ]);

            Log::info('Incoming video progress data', $data);

            $existing = VideoProgress::where('user_cookie', $data['user_cookie'])
                ->where('video_url', $data['video_url']) // updated field
                ->first();

            if ($existing) {
                $existing->update([
                    'progress' => $data['progress'],
                    'max_watch_percentage' => max($data['max_watch_percentage'], $existing->max_watch_percentage),
                ]);
                Log::info('Updated existing progress', ['id' => $existing->id]);
            } else {
                $created = VideoProgress::create($data);
                Log::info('Created new progress', ['id' => $created->id]);
            }

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            Log::error('Error saving video progress', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}

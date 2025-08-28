<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    public function create()
    {
        $announcements = Announcement::latest()->get();
        return view('admin.announcement.create', compact('announcements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->id) {
            // --- UPDATE ---
            $announcement = Announcement::findOrFail($request->id);

            // Delete old poster
            if ($announcement->poster && Storage::disk('public')->exists($announcement->poster)) {
                Storage::disk('public')->delete($announcement->poster);
            }

            $path = $request->file('poster')->store('announcements', 'public');
            $announcement->update(['poster' => $path]);

            return response()->json([
                'success' => true,
                'message' => 'Poster updated successfully!',
            ]);
        } else {
            // --- CREATE ---
            $path = $request->file('poster')->store('announcements', 'public');
            Announcement::create(['poster' => $path]);

            return response()->json([
                'success' => true,
                'message' => 'Poster uploaded successfully!',
            ]);
        }
    }

    // --- DELETE FUNCTION ---
    public function destroy(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);

        // Delete poster from storage
        if ($announcement->poster && Storage::disk('public')->exists($announcement->poster)) {
            Storage::disk('public')->delete($announcement->poster);
        }

        // Delete DB record
        $announcement->delete();

        return response()->json([
            'success' => true,
            'message' => 'Poster deleted successfully!',
        ]);
    }
}

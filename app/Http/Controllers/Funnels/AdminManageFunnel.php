<?php

namespace App\Http\Controllers\Funnels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funnels\Funnel;
use App\Models\Funnels\FunnelBlock;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AdminManageFunnel extends Controller
{

    public function __construct()
{
    $this->middleware('usersession');
}

public function showlist(Request $request)
{
    // Only admin can access
    if (auth()->user()->role !== 'admin') {
        return redirect()->back()->with('error', 'Admin access only.');
    }

    $search = $request->input('search');

    $funnels = Funnel::with(['blocks', 'user'])
        ->when($search, function ($query, $search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        })
        ->latest()
        ->paginate(10); 

    return view('admin.funnels.list', compact('funnels', 'search'));
}



public function updateEditable(Request $request)
{
    if (auth()->user()->role !== 'admin') {
        return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
    }

    $request->validate([
        'ids' => 'required|array',
        'is_editable' => 'required|boolean'
    ]);

    Funnel::whereIn('id', $request->ids)->update([
        'is_editable' => $request->is_editable
    ]);

    return response()->json(['success' => true, 'message' => 'Editable status updated.']);
}



public function showtable(Request $request)
{
    // Access allowed only to admin
    if (auth()->user()->role !== 'admin') {
        return redirect()->back()->with('error', 'Admin access only.');
    }

    // Get latest funnel (any user's funnel)
    $funnel = Funnel::latest()->first();

    if (!$funnel) {
        return redirect()->back()->with('error', 'No funnel found.');
    }

    $user = $funnel->user;

    $blocks = $funnel->blocks()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get()
        ->keyBy('block_name');

    return view('admin.funnels.manage', compact('user', 'funnel', 'blocks'));
}


public function toggleActive($id)
{
    $block = FunnelBlock::findOrFail($id);
    $newStatus = !$block->is_active;

    // Update all blocks with the same block_name globally (all users)
    FunnelBlock::where('block_name', $block->block_name)
        ->update(['is_active' => $newStatus]);

    return response()->json(['message' => 'All blocks with same block name updated for all users.']);
}



public function updateSortOrder(Request $request, $id)
{
    $block = FunnelBlock::findOrFail($id);
    $newSortOrder = $request->input('sort_order');

    // Update all blocks with the same block_name across all users
    FunnelBlock::where('block_name', $block->block_name)
        ->update(['sort_order' => $newSortOrder]);

    return response()->json(['message' => 'Sort order updated for all matching blocks.']);
}




public function update(Request $request)
{
    try {
        $block_name = $request->block_name;

        // Always update ALL blocks with matching block_name
        $blocks = FunnelBlock::where('block_name', $block_name)->get();

         // Process single upload (if any)
        $originalFile = $request->hasFile('video_thumbnail') ? $request->file('video_thumbnail') : null;

        foreach ($blocks as $block) {
    $content = [];

    switch ($block_name) {
        case 'hero':
            $videoUrl = $request->video_url;
            $videoType = 'mp4';

            if (preg_match('/youtu\.be\/([^\?&]+)/', $videoUrl, $matches) || preg_match('/youtube\.com.*v=([^&]+)/', $videoUrl, $matches)) {
                $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                $videoType = 'youtube';
            }

            // Get funnel and username
            $funnel = $block->funnel;
            $username = $funnel->username ?? 'unknown';

            // Decode old content
            $oldContent = json_decode($block->content, true);
            $thumbnailUrl = $oldContent['video_thumbnail'] ?? null;

            if ($originalFile) {
                if (!empty($thumbnailUrl)) {
                    Storage::disk('public')->delete($thumbnailUrl);
                }

                // Store with user-specific path
                $folder = "f_video_thumbnail/{$username}";
                $filename = 'thumb_' . Str::random(10) . '.' . $originalFile->getClientOriginalExtension();

                $originalFile->storeAs($folder, $filename, 'public');
                $thumbnailUrl = "{$folder}/{$filename}";
            }

            $content = [
                'headline'        => $request->headline,
                'subheadline'     => $request->subheadline,
                'video_url'       => $videoUrl,
                'video_type'      => $videoType,
                'video_thumbnail' => $thumbnailUrl,
                'cta_text'        => $request->cta_text,
                'cta_link'        => $request->cta_link,
            ];
            break;



                case 'countdown':
                    $content = [
                        'title'    => $request->title,
                        'subtitle' => $request->subtitle,
                        'days'     => (int) $request->days,
                        'hours'    => (int) $request->hours,
                        'minutes'  => (int) $request->minutes,
                        'seconds'  => (int) $request->seconds,
                    ];
                    break;

                case 'features':
                    $items = [];
                    if ($request->has('item_titles') && $request->has('item_descriptions')) {
                        foreach ($request->item_titles as $index => $title) {
                            $items[] = [
                                'title'       => $title,
                                'description' => $request->item_descriptions[$index] ?? '',
                            ];
                        }
                    }
                    $content = [
                        'title' => $request->title,
                        'items' => $items,
                    ];
                    break;

                case 'testimonials':
                    $testimonials = [];
                    if ($request->has('names') && $request->has('feedbacks')) {
                        foreach ($request->names as $index => $name) {
                            $testimonials[] = [
                                'name'     => $name,
                                'feedback' => $request->feedbacks[$index] ?? '',
                            ];
                        }
                    }
                    $content = [
                        'title'        => $request->title,
                        'testimonials' => $testimonials,
                    ];
                    break;

                case 'faq':
                    $questions = [];
                    if ($request->has('questions') && $request->has('answers')) {
                        foreach ($request->questions as $index => $question) {
                            $questions[] = [
                                'q' => $question,
                                'a' => $request->answers[$index] ?? '',
                            ];
                        }
                    }
                    $content = [
                        'title'     => $request->title,
                        'questions' => $questions,
                    ];
                    break;

                case 'messengerbtn':
                    $content = [
                        'btn_text' => $request->btn_text,
                        'btn_link' => $request->btn_link,
                    ];
                    break;

                case 'footer':
                    $content = [
                        'text' => $request->text,
                        'disclaimer' => $request->disclaimer,
                    ];
                    break;

                default:
                    continue 2; // skip this block, invalid block_name
            }

            $block->content = json_encode($content);
            $block->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'All blocks updated successfully.',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


}

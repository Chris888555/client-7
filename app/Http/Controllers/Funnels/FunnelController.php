<?php

namespace App\Http\Controllers\Funnels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funnels\FunnelBlock;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Funnels\Funnel;
use App\Models\User\FunnelView;

class FunnelController extends Controller
{

public function viewFunnel($page_link, Request $request)
{
    $cookieName = 'funnel_user_cookie';
    $userCookie = $request->cookie($cookieName) ?? Str::uuid()->toString();

    // Get funnel by page_link
    $funnel = Funnel::where('page_link', $page_link)->firstOrFail();
    $username = $funnel->username;

    // ✅ Check if already viewed by this cookie
    $alreadyViewed = FunnelView::where('user_cookie', $userCookie)
        ->where('page_link', $page_link)
        ->exists();

    if (!$alreadyViewed) {
        FunnelView::create([
            'user_cookie' => $userCookie,
            'page_link' => $page_link,
            'username' => $username,
            'ip_address' => $request->ip(),
        ]);
    }

    // Load funnel blocks and hero thumbnail
    $blocks = $funnel->blocks()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get()
        ->keyBy('block_name');

    $heroBlock = $blocks->get('hero');
    $thumbnailUrl = asset('assets/images/funnel_video_thumbnail.png');
    $content = [];

    if ($heroBlock) {
        $content = json_decode($heroBlock->content, true);
        $userThumbnail = $content['video_thumbnail'] ?? null;

        if ($userThumbnail && file_exists(storage_path('app/public/' . $userThumbnail))) {
            $thumbnailUrl = asset('storage/' . $userThumbnail);
        }
    }

    return response()
        ->view('user.funnels.funnel', compact('funnel', 'blocks', 'thumbnailUrl', 'content'))
        ->cookie($cookieName, $userCookie, 60 * 24 * 30);
}



 public function showActivateForm()
{
    $user = Auth::user();
    $funnel = Funnel::where('username', $user->username)->first();

    return view('user.funnels.funnel-activate', [
        'user' => $user,
        'funnel' => $funnel
    ]);
}

public function updateLink(Request $request, $id)
{
    $request->validate([
        'page_link' => 'required|string|max:255|unique:funnels,page_link,' . $id,
    ]);

    $funnel = Funnel::findOrFail($id);
    $funnel->page_link = $request->page_link;
    $funnel->save();

    return response()->json([
        'success' => true,
        'new_link' => route('funnel.view', $funnel->page_link),
    ]);
}



 
public function activate(Request $request)
{
    $user = auth()->user();
    $username = $user->username;

    if (Funnel::where('username', $username)->exists()) {
        return back()->with('info', 'You already have a funnel');
    }

    $funnel = Funnel::create([
        'username'  => $username,
        'page_link' => 'funnel-' . Str::random(6),
        'status'    => 'active',
    ]);

    // Handle video thumbnail upload or use default
    if ($request->hasFile('video_thumbnail')) {
        $thumbnailPath = $request->file('video_thumbnail')->store('f_video_thumbnail', 'public');
    } else {
        $defaultImagePath = public_path('assets/images/funnel_video_thumbnail.png');
        $thumbnailFileName = uniqid('thumb_') . '.png';

        Storage::disk('public')->put(
            'f_video_thumbnail/' . $thumbnailFileName,
            file_get_contents($defaultImagePath)
        );

        $thumbnailPath = 'f_video_thumbnail/' . $thumbnailFileName;
    }

    $videoUrl = 'https://d1yei2z3i6k35z.cloudfront.net/5367986/669cd8b91f2c5_SeacrestInc.2024ProgramPlanPresentation.mp4';
    $isYouTube = false;

    $defaultBlocks = [
        [
            'block_name' => 'hero',
            'sort_order' => 1,
            'content' => json_encode([
                'headline'        => 'SIMULAN ANG ONLINE NEGOSYO NA KUMIKITA',
                'subheadline'     => 'Tested System + Viral Products + Full Support = Success',
                'video_url'       => $videoUrl,
                'video_type'      => $isYouTube ? 'youtube' : 'mp4',
                'video_thumbnail' => $thumbnailPath, // save relative path here
                'cta_text'        => 'START NOW — IT’S FREE!',
                'cta_link'        => 'https://sample.com',
            ]),
        ],
        [
            'block_name' => 'countdown',
            'sort_order' => 2,
            'content' => json_encode([
                'title'    => 'LIMITED-TIME OFFER!',
                'subtitle' => 'Grab this opportunity before the timer hits zero.',
                'days'     => 0,
                'hours'    => 0,
                'minutes'  => 30,
                'seconds'  => 0,
            ]),
        ],
        [
            'block_name' => 'features',
            'sort_order' => 3,
            'content' => json_encode([
                'title' => 'Why Join Us?',
                'items' => [
                    ['title' => 'SEC Registered', 'description' => 'Legit at trusted sa buong bansa, with proper legal docs.'],
                    ['title' => 'Viral Products', 'description' => 'Mabilis ibenta, mataas ang demand sa market.'],
                    ['title' => 'Free Training & Support', 'description' => 'Step-by-step guidance para sa mga beginners.'],
                ],
            ]),
        ],
        [
            'block_name' => 'testimonials',
            'sort_order' => 4,
            'content' => json_encode([
                'title' => 'What Our Members Say',
                'testimonials' => [
                    ['name' => 'Juan Dela Cruz', 'feedback' => 'In just 7 days, may kita na ako! Super dali lang sundan yung system!'],
                    ['name' => 'Maria Santos', 'feedback' => 'Napaka solid ng community at system. Hindi ka pababayaan.'],
                ],
            ]),
        ],
        [
            'block_name' => 'faq',
            'sort_order' => 5,
            'content' => json_encode([
                'title' => 'Frequently Asked Questions',
                'questions' => [
                    ['q' => 'Paano magsimula?', 'a' => 'Pindutin ang “Start Now” at sundan ang instructions.'],
                    ['q' => 'May puhunan ba?', 'a' => 'Libre ang pagsali. Optional lang ang upgrades.'],
                ],
            ]),
        ],
        [
            'block_name' => 'messengerbtn',
            'sort_order' => 6,
            'content' => json_encode([
                'btn_text' => 'Message Us Here',
                'btn_link' => 'https://sample.com',
            ]),
        ],
        [
            'block_name' => 'footer',
            'sort_order' => 7,
            'content' => json_encode([
                'text' => '© 2025 Elete Dynasty. All rights reserved.',
                'disclaimer' => 'Disclaimer: This website is for educational and informational purposes only. It does not offer financial, investment, or professional advice. We do not promote investments or trading. This site is not affiliated with or endorsed by Facebook. “Facebook” is a trademark of Meta Platforms, Inc.',
            ]),
        ],
    ];

    // Insert blocks
    foreach ($defaultBlocks as $block) {
        FunnelBlock::create([
            'funnel_id'  => $funnel->id,
            'block_name' => $block['block_name'],
            'content'    => $block['content'],
            'is_active'  => true,
            'sort_order' => $block['sort_order'],
        ]);
    }

    return back()->with('success', 'Funnel activated successfully!');
}


private function extractYouTubeId($url)
{
    $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
    preg_match($pattern, $url, $matches);
    return $matches[1] ?? null;
}


public function showtable(Request $request)
{
    $user = Auth::user();

    $funnel = Funnel::where('username', $user->username)->first();

    if (!$funnel) {
        return redirect()->back()->with('error', 'Funnel not found.');
    }

      // Redirect agad pag disabled
    if (!$funnel || $funnel->is_editable === 0) {
        return redirect()->route('funnels.activate.form');
    }

    $blocks = $funnel->blocks()
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get()
        ->keyBy('block_name');

    return view('user.funnels.update', compact('user', 'funnel', 'blocks'));
}


public function toggleActive($id)
{
    $user = Auth::user();
    $funnel = Funnel::where('username', $user->username)->first();

    $block = FunnelBlock::where('id', $id)
        ->where('funnel_id', $funnel->id)
        ->firstOrFail();

    $block->is_active = !$block->is_active;
    $block->save();

    return response()->json(['message' => 'Block status updated']);
}

public function updateSortOrder(Request $request, $id)
{
    $user = Auth::user();
    $funnel = Funnel::where('username', $user->username)->first();

    $block = FunnelBlock::where('id', $id)
        ->where('funnel_id', $funnel->id)
        ->firstOrFail();

    $block->sort_order = $request->input('sort_order');
    $block->save();

    return response()->json(['message' => 'Sort order updated.']);
}




public function update(Request $request)
{
    try {
        $user = Auth::user();
        $funnel = Funnel::where('username', $user->username)->first();

        $block = FunnelBlock::where('id', $request->block_id)
            ->where('funnel_id', $funnel->id)
            ->firstOrFail();
        
        $block_name = $request->block_name;
        $content = [];

                    switch ($block_name) {
                        case 'hero':
                $videoUrl = $request->video_url;
                $videoType = 'mp4'; // default

                // Convert YouTube URL to embed format
                if (preg_match('/youtu\.be\/([^\?&]+)/', $videoUrl, $matches) || preg_match('/youtube\.com.*v=([^&]+)/', $videoUrl, $matches)) {
                    $videoUrl = 'https://www.youtube.com/embed/' . $matches[1];
                    $videoType = 'youtube';
                }

                // Start with old content
                $oldContent = json_decode($block->content, true);
                $thumbnailUrl = $oldContent['video_thumbnail'] ?? null;

                // Replace thumbnail only if new one is uploaded
              if ($request->hasFile('video_thumbnail')) {
                if (!empty($thumbnailUrl)) {
                    // $thumbnailUrl is a full URL, convert to relative storage path
                    $oldPath = str_replace(asset('storage/') , '', $thumbnailUrl);
                    Storage::disk('public')->delete($oldPath);
                }

                $thumbnailPath = $request->file('video_thumbnail')->store('f_video_thumbnail', 'public');
                // Save relative path lang sa DB, asset() gawin sa view
                $thumbnailUrl = $thumbnailPath;
            }


                // Final content
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
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid block type.',
                ], 400);
        }

        $block->content = json_encode($content);
        $block->save();

        return response()->json([
            'success' => true,
            'message' => 'Block updated successfully.',
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

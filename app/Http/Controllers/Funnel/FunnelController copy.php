<?php

namespace App\Http\Controllers\Funnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funnel\UserFunnel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FunnelController extends Controller
{
    // Show funnel dashboard for logged-in user
    public function index()
    {
        $funnel = UserFunnel::where('user_id', Auth::id())->first();
        return view('funnel.index', compact('funnel'));
    }

    // Activate funnel
  public function activate(Request $request)
{
    $funnel = UserFunnel::where('user_id', Auth::id())->first();

    if (!$funnel) {
        $funnel = UserFunnel::create([
            'user_id'       => Auth::id(),
            'page_link'     => Str::random(10),
            'messenger_btn' => 'https://m.me/yourlink', 
            'referral_btn'  => 'https://referral/yourlink',                 
            'shop_btn'      => 'https://shop/yourlink',    
        ]);
    }

    // Return JSON if AJAX
    if ($request->expectsJson()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('funnel.index')->with('success', 'Funnel activated!');
}

    // Show funnel embed page
    public function view($page_link)
    {
        $funnel = UserFunnel::where('page_link', $page_link)->firstOrFail();

        return view('funnel.view', compact('funnel'));
    }

    // Update funnel page_link via AJAX
    public function updateLink(Request $request)
    {
        $request->validate([
            'page_link' => 'required|string|unique:user_funnels,page_link,' . Auth::id() . ',user_id'
        ]);

        $funnel = UserFunnel::where('user_id', Auth::id())->firstOrFail();
        $funnel->page_link = $request->page_link;
        $funnel->save();

        return response()->json(['success' => true]);
    }

    


    // Show update buttons form
public function editButtons()
{
    $funnel = UserFunnel::where('user_id', Auth::id())->firstOrFail();
    return view('funnel.edit-buttons', compact('funnel'));
}

// Update buttons via AJAX
public function updateButtons(Request $request)
{
    $request->validate([
        'messenger_btn' => 'required|url',
        'referral_btn'  => 'required|url',
        'shop_btn'      => 'required|url',
        'messenger_btn_state' => 'nullable|boolean',
        'referral_btn_state'  => 'nullable|boolean',
        'shop_btn_state'      => 'nullable|boolean',
    ]);

    $funnel = UserFunnel::where('user_id', Auth::id())->firstOrFail();

    $funnel->messenger_btn = $request->messenger_btn;
    $funnel->referral_btn  = $request->referral_btn;
    $funnel->shop_btn      = $request->shop_btn;

    // Checkbox states: 1 = show, 0 = hide
    $funnel->messenger_btn_state = $request->messenger_btn_state ?? 0;
    $funnel->referral_btn_state  = $request->referral_btn_state ?? 0;
    $funnel->shop_btn_state      = $request->shop_btn_state ?? 0;

    $funnel->save();

    return response()->json(['success' => true, 'message' => 'Buttons updated successfully!']);
}





// Update only the Meta Pixel Code via AJAX
public function updateMetaPixel(Request $request)
{
    $request->validate([
        'meta_pixel_code' => 'nullable|string'
    ]);

    $funnel = UserFunnel::where('user_id', Auth::id())->firstOrFail();
    $funnel->meta_pixel_code = $request->meta_pixel_code;
    $funnel->save();

    return response()->json([
        'success' => true,
        'message' => 'Meta Pixel Code updated successfully!'
    ]);
}


}

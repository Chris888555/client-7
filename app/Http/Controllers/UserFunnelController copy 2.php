<?php

namespace App\Http\Controllers;

use App\Models\UserFunnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class UserFunnelController extends Controller
{
    // Show the funnel page for logged-in users
 public function showFunnelPage()
{
    // Get the logged-in user ID
    $user_id = Auth::id();

    // Fetch the user's funnel data
    $funnel = UserFunnel::where('user_id', $user_id)->first();

    // Fetch the latest setting_value from the funnel_plans table (you can replace 'setting_value' with your actual column name)
    $setting_value = DB::table('funnel_plans')->orderByDesc('id')->value('setting_value'); // Assuming 'setting_value' column exists

    // Fetch all the funnel plans from the funnel_plans table
    $plans = DB::table('funnel_plans')->get();

    // Fetch the price associated with the selected plan duration (plan_price)
    if ($funnel && $funnel->plan_duration) {
        // Assuming plan_duration corresponds to 'months' in the funnel_plans table
        $selectedPlan = $plans->where('months', $funnel->plan_duration)->first();
        $funnel->plan_price = $selectedPlan ? $selectedPlan->price : 0;
    }

    // Pass the funnel data, setting value, and plans to the view
    return view('user.funnel', compact('funnel', 'setting_value', 'plans'));
}

     // ################ Save Payment Function ##################################
   public function submitFunnel(Request $request)
{
    $user_id = Auth::id();

    // Check if the user has already submitted a funnel
    if (UserFunnel::where('user_id', $user_id)->exists()) {
        return redirect()->back()->with('error', 'You have already submitted a funnel.');
    }

    $funnel = new UserFunnel();
    $funnel->user_id = $user_id;
    $funnel->status = 'pending';

    // Check if the user uploaded a proof image and save it
    if ($request->hasFile('proof_image')) {
        $path = $request->file('proof_image')->store('proofs', 'public');
        $funnel->proof_image = $path;
    }

    // Set the plan_duration from the request
    if ($request->plan_duration) {
        $funnel->plan_duration = $request->plan_duration;

        // Fetch the plan price based on the selected plan duration
        $plan = DB::table('funnel_plans')->where('months', $request->plan_duration)->first();
        if ($plan) {
            $funnel->plan_price = $plan->price; // Save the corresponding price
        }
    }

    // Save the funnel data
    $funnel->save();

    // Redirect to the funnel page with a success message
    return redirect()->route('funnel.page')->with('success', 'Funnel submitted for review.');
}


######################################################################################################
######################################################################################################


 // ################ Activate Directly No Payment Required Function ##################################
public function activateDirect(Request $request)
{
    
    $user_id = Auth::id();
    $funnel = UserFunnel::where('user_id', $user_id)->first();

    
    if (!$funnel) {
        $funnel = new UserFunnel();
        $funnel->user_id = $user_id;
        $funnel->status = 'approved';
        $funnel->is_active = true;
        $funnel->approval_date = now();
        $funnel->plan_duration = 'lifetime'; 
        $funnel->expiration_date = null;

     
        $funnel->funnel_content = json_encode([
    'headline' => 'NEGOSYONG PATOK AT WALANG LUGI',
    'subheadline' => 'PROVEN AND TESTED INCOME GENERATING SYSTEM',
    'video_link' => 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4',
    'testimonial_headline' => 'What Our Clients Say',
    'testimonial_subheadline' => 'Real results from real people',
    'testimonial_images' => [
        'http://127.0.0.1:8000/storage/marketing_image/4AIltHa0PBsWrTythfBKfvMULHFqKUQVXhJlZWlP.jpg',
        'ihttp://127.0.0.1:8000/storage/marketing_image/4AIltHa0PBsWrTythfBKfvMULHFqKUQVXhJlZWlP.jpg',
        'ihttp://127.0.0.1:8000/storage/marketing_image/4AIltHa0PBsWrTythfBKfvMULHFqKUQVXhJlZWlP.jpg',
    ],
    'testimonial_video_link' => [
        'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4',
        'hhttps://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4',
    ],
    'fomo_countdown' => [
        'days' => 2,
        'hours' => 6,
        'minutes' => 45
    ],
    'Messenger_link' => 'https://m.me/yourpage',
    'Referral_link' => 'https://yourdomain.com/referral-code',
    'Group_chat_link' => 'https://chat.whatsapp.com/yourgroup',
    
    // All toggles set to false by default
    'Messenger_link_toggle' => false,
    'Referral_link_toggle' => false,
    'Group_chat_link_toggle' => false
]);


        $funnel->save(); 

        return redirect()->route('funnel.page')->with('success', 'Your funnel has been activated successfully.');
    }

    if ($funnel->is_active) {
        return redirect()->back()->with('success', 'Your funnel is already active.');
    }

    $funnel->is_active = true;
    $funnel->status = 'approved';
    $funnel->approval_date = now();
    $funnel->save(); 

    return redirect()->route('funnel.page')->with('success', 'Your funnel has been activated successfully.');
}




######################################################################################################
######################################################################################################


  // ################ Show Page Approval Function ##################################
  public function showManualApprovalPage()
{
    
    $funnels = UserFunnel::paginate(2); 

    return view('manual-approval', compact('funnels'));
}

 // ################ Filter By Status Function ##################################
public function filterByStatus($status = 'all')
{
    
    $query = UserFunnel::with('user');

    
    if ($status === 'expired') {
        $query->where('status', 'expired');
    } elseif ($status !== 'all' && in_array($status, ['pending', 'approved', 'rejected'])) {
        $query->where('status', $status);
    } elseif ($status === 'all') {
      
        $query->where('status', '!=', 'expired');
    }
    $funnels = $query->paginate(10);

    return view('manual-approval', compact('funnels', 'status'));
}




######################################################################################################
######################################################################################################



// ################ Re Subscribe Payment function ##################################
public function resubmit(Request $request)
{
    // Validate the incoming request for proof image
    $request->validate([
        'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validate image format
    ]);

    // Get the authenticated user
    $user_id = Auth::id();

    // Check if there's an existing funnel with the user's ID that is expired and inactive
    $funnel = UserFunnel::where('user_id', $user_id)
        ->where('status', 'expired')  // Ensure it's expired
        ->where('is_active', 0)       // Ensure it's inactive
        ->first();

    // If no such funnel exists, return an error message
    if (!$funnel) {
        return back()->with('error', 'You are not allowed to resubmit at this time.');
    }

    // Handle file upload for proof image
    if ($request->hasFile('proof_image')) {
        // Store the new proof image and update the path in the database
        $imagePath = $request->file('proof_image')->store('proofs', 'public');
        $funnel->proof_image = $imagePath;
    }

    // Handle plan duration update (optional, based on your logic)
    if ($request->has('plan_duration')) {
        $funnel->plan_duration = $request->plan_duration; // Save the updated plan duration

        // Fetch the plan price based on the selected plan duration
        $plan = DB::table('funnel_plans')->where('months', $request->plan_duration)->first();
        if ($plan) {
            $funnel->plan_price = $plan->price; // Save the corresponding price
        }
    }

    // Reset status to pending and set it to inactive (awaiting approval)
    $funnel->status = 'pending';
    $funnel->is_active = 0;  // Make it inactive for review
    $funnel->save(); // Save the updated funnel

    // Redirect to the funnel page with a success message
    return redirect()->route('funnel.page')->with('success', 'Funnel resubmitted successfully.');
}






// ################ Update Subdomain Function ##################################
  public function updateSubdomain(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'subdomain' => 'required|string|unique:users,subdomain',
    ]);

    // Find the logged-in user and update their subdomain
    $user = User::findOrFail($request->user_id);
    $user->subdomain = $request->subdomain;
    $user->save();

    return back()->with('success', 'Subdomain updated successfully!');
}


// ################ Fetch Funnel Function ##################################

public function showFunnel($subdomain)
{
    // Fetch the user based on the subdomain
    $user = User::where('subdomain', $subdomain)->first();

    // If no user is found with this subdomain, show an error
    if (!$user) {
        return abort(404, 'Funnel not found for this subdomain.');
    }

    // Fetch the user's funnel based on user_id
    $funnel = UserFunnel::where('user_id', $user->id)->first();

    // If no funnel is found for the user, show an error
    if (!$funnel) {
        return abort(404, 'Funnel content not found.');
    }

    // Check if the content is already an array (if it's already decoded)
    $funnel_content = $funnel->funnel_content;

    // If it's a string, decode it
    if (is_string($funnel_content)) {
        $funnel_content = json_decode($funnel_content, true);
    }

    // Pass the funnel content to the view
    return view('sales_funnel', compact('funnel_content', 'subdomain', 'user'));
}



// ################ Manual Approve and delete Function ##################################
public function bulkUpdateStatus(Request $request)
{
    // Validate the request
    $request->validate([
        'action' => 'required|string|in:approved,rejected,pending,delete',
        'selected_ids' => 'required|array',
        'selected_ids.*' => 'integer|exists:user_funnels,id',
        
    ]);

    $action = $request->input('action');
    $ids = $request->input('selected_ids');
    $plan_duration = $request->input('plan_duration'); // Get plan duration from the form

    // Handle delete case
    if ($action === 'delete') {
        UserFunnel::whereIn('id', $ids)->delete();
        return redirect()->back()->with('success', 'Selected funnels have been deleted.');
    }

    // Update the status for selected funnels
    UserFunnel::whereIn('id', $ids)->update(['status' => $action]);

    if (in_array($action, ['rejected', 'pending'])) {
    UserFunnel::whereIn('id', $ids)->update(['is_active' => false]);
    return redirect()->back()->with('success', 'Selected funnels have been updated to ' . $action . '.');
}


    // Handle approval logic
   if ($action === 'approved') {
    foreach ($ids as $id) {
        $funnel = UserFunnel::find($id);

        if ($funnel) {
            $plan_duration = $funnel->plan_duration; // Get the user's own plan duration


            // 1. Copy default video thumbnail from public/assets/images to storage/app/public/funnel_video_thumbnail
            $defaultVideoThumbnail = public_path('assets/images/default_thumbnail.png');
            $targetVideoPath = 'funnel_video_thumbnail/default_thumbnail.png';

            if (File::exists($defaultVideoThumbnail) && !Storage::disk('public')->exists($targetVideoPath)) {
                Storage::disk('public')->put(
                    $targetVideoPath,
                    File::get($defaultVideoThumbnail)
                );
            }

            // 2. Copy default testimonial images from public/assets/images to storage/app/public/testimonial_images
            $testimonialImages = ['default1.png', 'default2.png', 'default3.png'];

            foreach ($testimonialImages as $image) {
                $sourcePath = public_path("assets/images/{$image}");
                $targetPath = "testimonial_images/{$image}";

                if (File::exists($sourcePath) && !Storage::disk('public')->exists($targetPath)) {
                    Storage::disk('public')->put(
                        $targetPath,
                        File::get($sourcePath)
                    );
                }
            }
                        
             $funnel->funnel_content = json_encode([
                'headline' => 'Empowering the Digital Future with Smart IT Solutions',
                'subheadline' => 'Modernize your operations with trusted IT infrastructure and expert support',
                'video_thumbnail' => Storage::url('funnel_video_thumbnail/default_thumbnail.png'),
                'video_link' => 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4',
                'testimonial_headline' => 'What Our Clients Say',
                'testimonial_subheadline' => 'Real results from real people',
                'testimonial_images' => [
                    Storage::url('testimonial_images/default1.png'),
                    Storage::url('testimonial_images/default2.png'),
                    Storage::url('testimonial_images/default3.png'),
                ],
                'testimonial_video_link' => [
                    'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4',
                    'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4',
                ],
                'fomo_countdown' => [
                    'days' => 2,
                    'hours' => 6,
                    'minutes' => 45
                ],
                'Messenger_link' => 'https://m.me/yourpage',
                'Referral_link' => 'https://yourdomain.com/referral-code',
                'Group_chat_link' => 'https://chat.whatsapp.com/yourgroup',
                'Messenger_link_toggle' => true,
                'Referral_link_toggle' => true,
                'Group_chat_link_toggle' => true
            ]);


                 $funnel->status = 'approved';
            $funnel->is_active = true;
            $funnel->approval_date = now();  
            $funnel->submitted_at = now();

            // Set expiration based on their own plan duration
            if ($plan_duration > 0) {
                $funnel->expiration_date = now()->addMonths($plan_duration);
            } else {
                $funnel->expiration_date = null;
            }

            $funnel->save();
        }
    }

    return redirect()->back()->with('success', 'Selected funnels have been approved and expiration dates updated.');
}

}



// ################ Update sales funnel Function ##################################
public function updateFunnel(Request $request)
{
    $userId = Auth::id();
    $funnel = UserFunnel::where('user_id', $userId)->first();

    if (!$funnel) {
        return redirect()->back()->with('error', 'Funnel not found.');
    }

    $funnelContent = json_decode($funnel->funnel_content, true) ?? [];

    // Handle video thumbnail upload
    if ($request->hasFile('video_thumbnail')) {
        $uploadedFile = $request->file('video_thumbnail');
        $originalName = $uploadedFile->getClientOriginalName();

        $existingPath = $funnelContent['video_thumbnail'] ?? null;
        $existingRelativePath = $existingPath ? str_replace('/storage/', '', $existingPath) : null;
        $existingFileName = $existingRelativePath ? basename($existingRelativePath) : null;

        if ($existingFileName && $originalName === $existingFileName && Storage::exists('public/' . $existingRelativePath)) {
            Storage::putFileAs('public/' . dirname($existingRelativePath), $uploadedFile, $existingFileName);
            $funnelContent['video_thumbnail'] = Storage::url('public/' . $existingRelativePath);
        } else {
            $newFileName = time() . '_' . $originalName;
            $newPath = $uploadedFile->storeAs('public/funnel_video_thumbnail/funnel_video_thumbnail-stored', $newFileName);
            $funnelContent['video_thumbnail'] = Storage::url($newPath);
        }
    }

    // Handle testimonial images
    for ($i = 1; $i <= 3; $i++) {
        $field = "testimonial_image_$i";
        if ($request->hasFile($field)) {
            $uploadedFile = $request->file($field);
            $originalName = $uploadedFile->getClientOriginalName();

            $existingPath = $funnelContent['testimonial_images'][$i - 1] ?? null;
            $existingRelativePath = $existingPath ? str_replace('/storage/', '', $existingPath) : null;
            $existingFileName = $existingRelativePath ? basename($existingRelativePath) : null;

            if ($existingFileName && $originalName === $existingFileName && Storage::exists('public/' . $existingRelativePath)) {
                Storage::putFileAs('public/' . dirname($existingRelativePath), $uploadedFile, $existingFileName);
                $funnelContent['testimonial_images'][$i - 1] = Storage::url('public/' . $existingRelativePath);
            } else {
                $newFileName = time() . '_' . $originalName;
                $newPath = $uploadedFile->storeAs('public/testimonial_images', $newFileName);
                $funnelContent['testimonial_images'][$i - 1] = Storage::url($newPath);
            }
        }
    }

    // Text and link fields
    $funnelContent['headline'] = $request->input('headline', $funnelContent['headline'] ?? '');
    $funnelContent['subheadline'] = $request->input('subheadline', $funnelContent['subheadline'] ?? '');
    $funnelContent['video_link'] = $request->input('video_link', $funnelContent['video_link'] ?? '');
    $funnelContent['testimonial_headline'] = $request->input('testimonial_headline', $funnelContent['testimonial_headline'] ?? '');
    $funnelContent['testimonial_subheadline'] = $request->input('testimonial_subheadline', $funnelContent['testimonial_subheadline'] ?? '');

    // Testimonial video links
    $testimonialVideos = [];
    $testimonialVideos[] = $request->input('testimonial_video_1', $funnelContent['testimonial_video_link'][0] ?? '');
    $testimonialVideos[] = $request->input('testimonial_video_2', $funnelContent['testimonial_video_link'][1] ?? '');
    $funnelContent['testimonial_video_link'] = $testimonialVideos;

    // FOMO countdown
    $funnelContent['fomo_countdown']['days'] = $request->input('fomo_days', $funnelContent['fomo_countdown']['days'] ?? 0);
    $funnelContent['fomo_countdown']['hours'] = $request->input('fomo_hours', $funnelContent['fomo_countdown']['hours'] ?? 0);
    $funnelContent['fomo_countdown']['minutes'] = $request->input('fomo_minutes', $funnelContent['fomo_countdown']['minutes'] ?? 0);

    // Social links and toggles
    $funnelContent['Messenger_link'] = $request->input('Messenger_link', $funnelContent['Messenger_link'] ?? '');
    $funnelContent['Messenger_link_toggle'] = $request->has('Messenger_link_toggle');

    $funnelContent['Referral_link'] = $request->input('Referral_link', $funnelContent['Referral_link'] ?? '');
    $funnelContent['Referral_link_toggle'] = $request->has('Referral_link_toggle');

    $funnelContent['Group_chat_link'] = $request->input('Group_chat_link', $funnelContent['Group_chat_link'] ?? '');
    $funnelContent['Group_chat_link_toggle'] = $request->has('Group_chat_link_toggle');

    // Save the updated content
    $funnel->funnel_content = json_encode($funnelContent);
    $funnel->save();

    return redirect()->back()->with('success', 'Funnel updated successfully!');
}

}

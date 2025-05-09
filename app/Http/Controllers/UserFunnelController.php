<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\UserFunnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class UserFunnelController extends Controller
{
public function showFunnelPage()
{
    // Get the logged-in user ID
    $user_id = Auth::id();

    // Fetch the user's funnel data
    $funnel = UserFunnel::where('user_id', $user_id)->first();

    // Fetch the latest setting_value from the funnel_plans table
    $setting_value = DB::table('funnel_plans')->orderByDesc('id')->value('setting_value');

    // Fetch all the funnel plans
    $plans = DB::table('funnel_plans')->get();

    // Fetch the package_type from the packages table
    $package = DB::table('packages')
        ->where('user_id', $user_id)
        ->value('free_funnel'); // returns a string (e.g., 'diamond-pack')

    // Attach plan_price if plan_duration is set
    if ($funnel && $funnel->plan_duration) {
        $selectedPlan = $plans->where('months', $funnel->plan_duration)->first();
        $funnel->plan_price = $selectedPlan ? $selectedPlan->price : 0;
    }

    // Pass the funnel, setting value, plans, and package type to the view
    return view('user.funnel', compact('funnel', 'setting_value', 'plans', 'package'));
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

    // Generate 6-character random strings for page_link_1 and page_link_2
    $funnel->page_link_1 = Str::random(6);  // Random 6 characters for page_link_1
    $funnel->page_link_2 = Str::random(6);  // Random 6 characters for page_link_2

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

     // Generate 6-character random strings for page_link_1 and page_link_2
        $funnel->page_link_1 = Str::random(6);  // Random 6 characters for page_link_1
        $funnel->page_link_2 = Str::random(6);  // Random 6 characters for page_link_2

    // #################################### For Funnel Page ###########################################
            
     // Assuming $request->video_link contains the user-provided video link
            $providedLink = $request->video_link;
            $defaultYouTube = 'https://youtu.be/m3rykLJ64Z4?si=v7ztrgM0rrH9JL8q'; // Default YouTube link
            $defaultMP4 = 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4'; // Default MP4 link

            // Choose which default video to use (uncomment one)
            $defaultVideoLink = $defaultYouTube;
            // $defaultVideoLink = $defaultMP4;

            // Final video link assignment
            $videoLink = $providedLink ? $this->processVideoLink($providedLink) : $this->processVideoLink($defaultVideoLink);

                $plan_duration = $funnel->plan_duration; // Get the user's own plan duration

                // #################################### For Funnel Page ###########################################
                // 1. Copy default video thumbnail from public/assets/images to storage/app/public/funnel_video_thumbnail
                $defaultVideoThumbnail = public_path('assets/images/default_thumbnail.png');
                $targetVideoPath = 'funnel_video_thumbnail/default_thumbnail.png';

                if (File::exists($defaultVideoThumbnail) && !Storage::disk('public')->exists($targetVideoPath)) {
                    Storage::disk('public')->put(
                        $targetVideoPath,
                        File::get($defaultVideoThumbnail)
                    );
                }

                // 2. Copy default testimonial images from public/assets/images to storage/app/public/funnel_testimonial_images
                $testimonialImages = ['default1.png', 'default2.png', 'default3.png'];

                foreach ($testimonialImages as $image) {
                    $sourcePath = public_path("assets/images/{$image}");
                    $targetPath = "funnel_testimonial_images/{$image}";

                    if (File::exists($sourcePath) && !Storage::disk('public')->exists($targetPath)) {
                        Storage::disk('public')->put(
                            $targetPath,
                            File::get($sourcePath)
                        );
                    }
                }
                 if (empty($funnel->funnel_content)) {

                $funnel->funnel_content = [
                    'headline' => 'Kung May Paraan Para Kumita Habang Kasama ang Pamilya… Di Mo Ba Susubukan?',
                    'subheadline' => 'Alam naming hindi madali ang buhay. Pero kung may chance na makatulong sayo at sa pamilya mo—bakit hindi subukan? Wala namang mawawala, lalo na kung may pangarap ka.',
                    'video_thumbnail' => Storage::url('funnel_video_thumbnail/default_thumbnail.png'),
                    'video_link' => $videoLink,

                 
                    'intro_headline' => 'Mahalaga ba sayo ang magkaroon ng dagdag na kita?',
                    'intro_paragraph' => 'Baka hindi mo pa nasusubukan, pero ang pagkakataon na ito ay pwedeng magbago ng buhay mo at ng pamilya mo. Hindi mo kailangang maghintay ng perfect na panahon, baka ito na yun!',
                    
                    'benefits_title' => 'Why you join us?',
                    'benefits_list' => [
                        'Pagkakataon kumita ng malaki para sa pamilya at mga pangarap mo',
                        'Mas maraming oras para sa mga mahal mo sa buhay—hindi lang para magtrabaho',
                        'Kontrolin ang oras at diskarte mo para magkaroon ng mas magaan na buhay',
                        'Suporta mula sa mga taong magtutulungan upang magtagumpay ka',
                        'Simula ng isang bagong journey na magbubukas ng mas magagandang opportunities para sa’yo',
                    ],
                    
                    'testimonial_headline' => 'What Our Clients Say',
                    'testimonial_subheadline' => 'Real results from real people',
                    'testimonial_images' => [
                        Storage::url('funnel_testimonial_images/default1.png'),
                        Storage::url('funnel_testimonial_images/default2.png'),
                        Storage::url('funnel_testimonial_images/default3.png'),
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
    
                    // Referral button content
                    'Referral_button_text' => 'Sign Up To Start Earning',
                    'Referral_button_subtext' => '✅ Reserve Your Free Slot Now',

                     // Group chat button content
                    'Group_chat_button_text' => 'Get More Info — Join Group Chat',
                    'Group_chat_button_subtext' => '✅ Click Here To Join Now',
                                                    
                    'Messenger_link' => 'https://m.me/yourpage',
                    'Referral_link' => 'https://yourdomain.com/referral-code',
                    'Group_chat_link' => 'https://chat.whatsapp.com/yourgroup',
                    'Messenger_link_toggle' => true,
                    'Referral_link_toggle' => true,
                    'Group_chat_link_toggle' => true
                ];
            }

        
     
// #################################### For Landing Page ###########################################

  // Assuming $request->video_link contains the user-provided video link
            $providedLink = $request->video_link;
            $defaultYouTube = 'https://youtu.be/E4GMDFmIPfo?si=Z6Mkf2_JmV0t8mqf'; // Default YouTube link
            $defaultMP4 = 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4'; // Default MP4 link

            // Choose which default video to use (uncomment one)
            $defaultVideoLink = $defaultYouTube;
            // $defaultVideoLink = $defaultMP4;

            // Final video link assignment
            $videoLink = $providedLink ? $this->processVideoLink($providedLink) : $this->processVideoLink($defaultVideoLink);


// 1. Copy default video thumbnail from public/assets/images to storage/app/public/landing_video_thumbnail
$defaultVideoThumbnail = public_path('assets/images/default_thumbnail.png');
$targetVideoPath = 'landing_video_thumbnail/default_thumbnail.png';

if (File::exists($defaultVideoThumbnail) && !Storage::disk('public')->exists($targetVideoPath)) {
    Storage::disk('public')->put(
        $targetVideoPath,
        File::get($defaultVideoThumbnail)
    );
}

// 2. Copy default testimonial images from public/assets/images to storage/app/public/landing_testimonial_images
$testimonialImages = ['default1.png', 'default2.png', 'default3.png'];

foreach ($testimonialImages as $image) {
    $sourcePath = public_path("assets/images/{$image}");
    $targetPath = "landing_testimonial_images/{$image}";

    if (File::exists($sourcePath) && !Storage::disk('public')->exists($targetPath)) {
        Storage::disk('public')->put(
            $targetPath,
            File::get($sourcePath)
        );
    }
}

// ➕ Set default landing_page_content here
if (empty($funnel->landing_page_content)) {
$funnel->landing_page_content = [
    'headline' => 'Laging Pagod? Parang Lagi Ka Na Lang Walang Gana?',
    'subheadline' => 'Discover how Salveo Barley Grass can naturally boost your energy and immunity — even on your busiest days!',
    'video_thumbnail' => Storage::url('landing_video_thumbnail/default_thumbnail.png'),
     'video_link' => $videoLink,

    'intro_headline' => 'Mahalaga ba talaga sayo ang kalusugan mo?',
                    'intro_paragraph' => ' Baka oras na para alagaan ang sarili — hindi lang tuwing may sakit, kundi araw-araw. Sa isang simpleng habit, pwede mong simulan ang pagbabago ng pakiramdam mo',
                    
                    'benefits_title' => 'Why Barley Grass?',
                    'benefits_list' => [
                        'Boost sa natural energy levels',
                        'Mas malakas na immune system',
                        'Better digestion & detox',
                        'Better focus and sleep',
                        'Anti-fatigue & anti-inflammatory',
                    ],

    'testimonial_headline' => 'Legit Testimonials',
    'testimonial_subheadline' => 'Real results from real people',
    'testimonial_images' => [
        Storage::url('landing_testimonial_images/default1.png'),
        Storage::url('landing_testimonial_images/default2.png'),
        Storage::url('landing_testimonial_images/default3.png'),
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

    // Referral button content
    'Referral_button_text' => 'Try It for 7 Days — Order Now!',
    'Referral_button_subtext' => '✅ Claim Your Discount Now',

    // Group chat button content
     'Group_chat_button_text' => 'Get More Info — Join Group Chat',
     'Group_chat_button_subtext' => '✅ Click Here To Join Now',

    'Messenger_link' => 'https://m.me/yourpage',
    'Referral_link' => 'https://yourdomain.com/referral-code',
    'Group_chat_link' => 'https://chat.whatsapp.com/yourgroup',
    'Messenger_link_toggle' => true,
    'Referral_link_toggle' => true,
    'Group_chat_link_toggle' => true
];

}


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


 // ################ Activate Free Funnel Based on the package type No Payment Required Function ##################################
public function activateFreeFunnel(Request $request)
{
    $user_id = Auth::id();
    
    // Fetch the user's package type from the packages table
    $package = DB::table('packages')->where('user_id', $user_id)->first();

    if (!$package) {
        return redirect()->back()->with('error', 'Package not found for this user.');
    }

    $packageType = $package->packages_type;

    // Determine the number of months to add based on package type
    $monthsToAdd = 0;

    if ($packageType === 'diamond_pack') {
        $monthsToAdd = 3; // 3 months free for diamond pack
    } elseif ($packageType === 'elite_pack') {
        $monthsToAdd = 6; // 6 months free for elite pack
    } elseif ($packageType === 'vip_pack') {
        $monthsToAdd = 12; // 12 months free for vip pack
    }

    // Fetch the funnel associated with the user
    $funnel = UserFunnel::where('user_id', $user_id)->first();

    // If the funnel doesn't exist, create a new one
    if (!$funnel) {
        $funnel = new UserFunnel();
        $funnel->user_id = $user_id;
        $funnel->status = 'approved';
        $funnel->is_active = true;
        $funnel->approval_date = now();
        $funnel->submitted_at = now();
        $funnel->plan_duration = $monthsToAdd;  // Set plan_duration to monthsToAdd
        $funnel->expiration_date = now()->addMonths($monthsToAdd);
        
        // Generate 6-character random strings for page_link_1 and page_link_2
        $funnel->page_link_1 = Str::random(6);  // Random 6 characters for page_link_1
        $funnel->page_link_2 = Str::random(6);  // Random 6 characters for page_link_2

         // Assuming $request->video_link contains the user-provided video link
            $providedLink = $request->video_link;
            $defaultYouTube = 'https://youtu.be/m3rykLJ64Z4?si=v7ztrgM0rrH9JL8q'; // Default YouTube link
            $defaultMP4 = 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4'; // Default MP4 link

            // Choose which default video to use (uncomment one)
            $defaultVideoLink = $defaultYouTube;
            // $defaultVideoLink = $defaultMP4;

            // Final video link assignment
            $videoLink = $providedLink ? $this->processVideoLink($providedLink) : $this->processVideoLink($defaultVideoLink);

                $plan_duration = $funnel->plan_duration; // Get the user's own plan duration

                // #################################### For Funnel Page ###########################################
                // 1. Copy default video thumbnail from public/assets/images to storage/app/public/funnel_video_thumbnail
                $defaultVideoThumbnail = public_path('assets/images/default_thumbnail.png');
                $targetVideoPath = 'funnel_video_thumbnail/default_thumbnail.png';

                if (File::exists($defaultVideoThumbnail) && !Storage::disk('public')->exists($targetVideoPath)) {
                    Storage::disk('public')->put(
                        $targetVideoPath,
                        File::get($defaultVideoThumbnail)
                    );
                }

                // 2. Copy default testimonial images from public/assets/images to storage/app/public/funnel_testimonial_images
                $testimonialImages = ['default1.png', 'default2.png', 'default3.png'];

                foreach ($testimonialImages as $image) {
                    $sourcePath = public_path("assets/images/{$image}");
                    $targetPath = "funnel_testimonial_images/{$image}";

                    if (File::exists($sourcePath) && !Storage::disk('public')->exists($targetPath)) {
                        Storage::disk('public')->put(
                            $targetPath,
                            File::get($sourcePath)
                        );
                    }
                }
                 if (empty($funnel->funnel_content)) {

                $funnel->funnel_content = [
                    'headline' => 'Kung May Paraan Para Kumita Habang Kasama ang Pamilya… Di Mo Ba Susubukan?',
                    'subheadline' => 'Alam naming hindi madali ang buhay. Pero kung may chance na makatulong sayo at sa pamilya mo—bakit hindi subukan? Wala namang mawawala, lalo na kung may pangarap ka.',
                    'video_thumbnail' => Storage::url('funnel_video_thumbnail/default_thumbnail.png'),
                    'video_link' => $videoLink,

                 
                    'intro_headline' => 'Mahalaga ba sayo ang magkaroon ng dagdag na kita?',
                    'intro_paragraph' => 'Baka hindi mo pa nasusubukan, pero ang pagkakataon na ito ay pwedeng magbago ng buhay mo at ng pamilya mo. Hindi mo kailangang maghintay ng perfect na panahon, baka ito na yun!',
                    
                    'benefits_title' => 'Why you join us?',
                    'benefits_list' => [
                        'Pagkakataon kumita ng malaki para sa pamilya at mga pangarap mo',
                        'Mas maraming oras para sa mga mahal mo sa buhay—hindi lang para magtrabaho',
                        'Kontrolin ang oras at diskarte mo para magkaroon ng mas magaan na buhay',
                        'Suporta mula sa mga taong magtutulungan upang magtagumpay ka',
                        'Simula ng isang bagong journey na magbubukas ng mas magagandang opportunities para sa’yo',
                    ],
                    
                    'testimonial_headline' => 'What Our Clients Say',
                    'testimonial_subheadline' => 'Real results from real people',
                    'testimonial_images' => [
                        Storage::url('funnel_testimonial_images/default1.png'),
                        Storage::url('funnel_testimonial_images/default2.png'),
                        Storage::url('funnel_testimonial_images/default3.png'),
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
    
                    // Referral button content
                    'Referral_button_text' => 'Sign Up To Start Earning',
                    'Referral_button_subtext' => '✅ Reserve Your Free Slot Now',

                     // Group chat button content
                    'Group_chat_button_text' => 'Get More Info — Join Group Chat',
                    'Group_chat_button_subtext' => '✅ Click Here To Join Now',
                                                    
                    'Messenger_link' => 'https://m.me/yourpage',
                    'Referral_link' => 'https://yourdomain.com/referral-code',
                    'Group_chat_link' => 'https://chat.whatsapp.com/yourgroup',
                    'Messenger_link_toggle' => true,
                    'Referral_link_toggle' => true,
                    'Group_chat_link_toggle' => true
                ];
            }

        
     
// #################################### For Landing Page ###########################################

  // Assuming $request->video_link contains the user-provided video link
            $providedLink = $request->video_link;
            $defaultYouTube = 'https://youtu.be/E4GMDFmIPfo?si=Z6Mkf2_JmV0t8mqf'; // Default YouTube link
            $defaultMP4 = 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4'; // Default MP4 link

            // Choose which default video to use (uncomment one)
            $defaultVideoLink = $defaultYouTube;
            // $defaultVideoLink = $defaultMP4;

            // Final video link assignment
            $videoLink = $providedLink ? $this->processVideoLink($providedLink) : $this->processVideoLink($defaultVideoLink);


// 1. Copy default video thumbnail from public/assets/images to storage/app/public/landing_video_thumbnail
$defaultVideoThumbnail = public_path('assets/images/default_thumbnail.png');
$targetVideoPath = 'landing_video_thumbnail/default_thumbnail.png';

if (File::exists($defaultVideoThumbnail) && !Storage::disk('public')->exists($targetVideoPath)) {
    Storage::disk('public')->put(
        $targetVideoPath,
        File::get($defaultVideoThumbnail)
    );
}

// 2. Copy default testimonial images from public/assets/images to storage/app/public/landing_testimonial_images
$testimonialImages = ['default1.png', 'default2.png', 'default3.png'];

foreach ($testimonialImages as $image) {
    $sourcePath = public_path("assets/images/{$image}");
    $targetPath = "landing_testimonial_images/{$image}";

    if (File::exists($sourcePath) && !Storage::disk('public')->exists($targetPath)) {
        Storage::disk('public')->put(
            $targetPath,
            File::get($sourcePath)
        );
    }
}

// ➕ Set default landing_page_content here
if (empty($funnel->landing_page_content)) {
$funnel->landing_page_content = [
    'headline' => 'Laging Pagod? Parang Lagi Ka Na Lang Walang Gana?',
    'subheadline' => 'Discover how Salveo Barley Grass can naturally boost your energy and immunity — even on your busiest days!',
    'video_thumbnail' => Storage::url('landing_video_thumbnail/default_thumbnail.png'),
     'video_link' => $videoLink,

    'intro_headline' => 'Mahalaga ba talaga sayo ang kalusugan mo?',
                    'intro_paragraph' => ' Baka oras na para alagaan ang sarili — hindi lang tuwing may sakit, kundi araw-araw. Sa isang simpleng habit, pwede mong simulan ang pagbabago ng pakiramdam mo',
                    
                    'benefits_title' => 'Why Barley Grass?',
                    'benefits_list' => [
                        'Boost sa natural energy levels',
                        'Mas malakas na immune system',
                        'Better digestion & detox',
                        'Better focus and sleep',
                        'Anti-fatigue & anti-inflammatory',
                    ],

    'testimonial_headline' => 'Legit Testimonials',
    'testimonial_subheadline' => 'Real results from real people',
    'testimonial_images' => [
        Storage::url('landing_testimonial_images/default1.png'),
        Storage::url('landing_testimonial_images/default2.png'),
        Storage::url('landing_testimonial_images/default3.png'),
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

    // Referral button content
    'Referral_button_text' => 'Try It for 7 Days — Order Now!',
    'Referral_button_subtext' => '✅ Claim Your Discount Now',

    // Group chat button content
     'Group_chat_button_text' => 'Get More Info — Join Group Chat',
     'Group_chat_button_subtext' => '✅ Click Here To Join Now',

    'Messenger_link' => 'https://m.me/yourpage',
    'Referral_link' => 'https://yourdomain.com/referral-code',
    'Group_chat_link' => 'https://chat.whatsapp.com/yourgroup',
    'Messenger_link_toggle' => true,
    'Referral_link_toggle' => true,
    'Group_chat_link_toggle' => true
];

}
        
        $funnel->save();

        return redirect()->route('funnel.page')->with('success', 'Your funnel has been activated successfully.');
    }

    // If funnel already exists, you can add additional logic or return a message
    return redirect()->back()->with('error', 'Funnel already activated.');
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

      // Generate 6-character random strings for page_link_1 and page_link_2
                $funnel->page_link_1 = Str::random(6);  // Random 6 characters for page_link_1
                $funnel->page_link_2 = Str::random(6);  // Random 6 characters for page_link_2

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
public function handlePage($subdomain, $slug)
{
    $user = User::where('subdomain', $subdomain)->first();

    if (!$user) {
        return abort(404, 'User with this subdomain not found.');
    }

    // Try to find funnel by page_link_1
    $funnel = UserFunnel::where('user_id', $user->id)
                        ->where('page_link_1', $slug)
                        ->first();

    if ($funnel) {
        // Check if funnel is expired or inactive
        if ($funnel->status === 'expired' || $funnel->is_active == 0) {
            return abort(404, 'This funnel page has expired.');
        }

        $funnel_content = is_string($funnel->funnel_content)
            ? json_decode($funnel->funnel_content, true)
            : $funnel->funnel_content;

        return view('sales_funnel', compact('funnel_content', 'subdomain', 'user', 'slug', 'funnel'));

    }

    // Try to find landing page by page_link_2
    $funnel = UserFunnel::where('user_id', $user->id)
                        ->where('page_link_2', $slug)
                        ->first();

    if ($funnel) {
        // Check if landing page is expired or inactive
        if ($funnel->status === 'expired' || $funnel->is_active == 0) {
            return abort(404, 'This landing page has expired.');
        }

        $landing_page_content = is_string($funnel->landing_page_content)
            ? json_decode($funnel->landing_page_content, true)
            : $funnel->landing_page_content;

        return view('landing-page', compact('landing_page_content', 'subdomain', 'user', 'slug', 'funnel'));

    }

    return abort(404, 'Page not found.');
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
    // Get all the funnels to delete
    $funnels = UserFunnel::whereIn('id', $ids)->get();

    // Loop through each funnel and delete the associated files from storage
foreach ($funnels as $funnel) {
    // Delete funnel page video thumbnail
    if (!empty($funnel->funnel_content)) {
        $funnelContent = $funnel->funnel_content;
        
        // Ensure $funnelContent['video_thumbnail'] is a string (URL)
        if (!empty($funnelContent['video_thumbnail']) && is_string($funnelContent['video_thumbnail'])) {
            $videoThumbnailPath = str_replace(Storage::url(''), '', $funnelContent['video_thumbnail']);
            if (Storage::disk('public')->exists($videoThumbnailPath)) {
                Storage::disk('public')->delete($videoThumbnailPath);
            }
        }

        // Delete the funnel testimonial images (ensure it's an array)
        if (!empty($funnelContent['testimonial_images']) && is_array($funnelContent['testimonial_images'])) {
            foreach ($funnelContent['testimonial_images'] as $image) {
                if (is_string($image)) {
                    $imagePath = str_replace(Storage::url(''), '', $image);
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
            }
        }
    }

    // Delete the landing page content if it exists
    if (!empty($funnel->landing_page_content)) {
        $landingPageContent = $funnel->landing_page_content;

        // Delete landing page video thumbnail (ensure it's a string)
        if (!empty($landingPageContent['video_thumbnail']) && is_string($landingPageContent['video_thumbnail'])) {
            $landingVideoThumbnailPath = str_replace(Storage::url(''), '', $landingPageContent['video_thumbnail']);
            if (Storage::disk('public')->exists($landingVideoThumbnailPath)) {
                Storage::disk('public')->delete($landingVideoThumbnailPath);
            }
        }

        // Delete landing page testimonial images (ensure it's an array)
        if (!empty($landingPageContent['testimonial_images']) && is_array($landingPageContent['testimonial_images'])) {
            foreach ($landingPageContent['testimonial_images'] as $image) {
                if (is_string($image)) {
                    $imagePath = str_replace(Storage::url(''), '', $image);
                    if (Storage::disk('public')->exists($imagePath)) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
            }
        }
    }

    // ✅ Delete the proof_image if it exists
    if (!empty($funnel->proof_image) && is_string($funnel->proof_image)) {
        $proofImagePath = str_replace(Storage::url(''), '', $funnel->proof_image);
        if (Storage::disk('public')->exists($proofImagePath)) {
            Storage::disk('public')->delete($proofImagePath);
        }
    }
}

// Delete the funnels from the database
UserFunnel::whereIn('id', $ids)->delete();
return redirect()->back()->with('success', 'Selected funnels and their associated files, including landing page content, have been deleted.');
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

                // Assuming $request->video_link contains the user-provided video link
            $providedLink = $request->video_link;
            $defaultYouTube = 'https://youtu.be/m3rykLJ64Z4?si=v7ztrgM0rrH9JL8q'; // Default YouTube link
            $defaultMP4 = 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4'; // Default MP4 link

            // Choose which default video to use (uncomment one)
            $defaultVideoLink = $defaultYouTube;
            // $defaultVideoLink = $defaultMP4;

            // Final video link assignment
            $videoLink = $providedLink ? $this->processVideoLink($providedLink) : $this->processVideoLink($defaultVideoLink);

                $plan_duration = $funnel->plan_duration; // Get the user's own plan duration

                // #################################### For Funnel Page ###########################################
                // 1. Copy default video thumbnail from public/assets/images to storage/app/public/funnel_video_thumbnail
                $defaultVideoThumbnail = public_path('assets/images/default_thumbnail.png');
                $targetVideoPath = 'funnel_video_thumbnail/default_thumbnail.png';

                if (File::exists($defaultVideoThumbnail) && !Storage::disk('public')->exists($targetVideoPath)) {
                    Storage::disk('public')->put(
                        $targetVideoPath,
                        File::get($defaultVideoThumbnail)
                    );
                }

                // 2. Copy default testimonial images from public/assets/images to storage/app/public/funnel_testimonial_images
                $testimonialImages = ['default1.png', 'default2.png', 'default3.png'];

                foreach ($testimonialImages as $image) {
                    $sourcePath = public_path("assets/images/{$image}");
                    $targetPath = "funnel_testimonial_images/{$image}";

                    if (File::exists($sourcePath) && !Storage::disk('public')->exists($targetPath)) {
                        Storage::disk('public')->put(
                            $targetPath,
                            File::get($sourcePath)
                        );
                    }
                }
                 if (empty($funnel->funnel_content)) {

                $funnel->funnel_content = [
                    'headline' => 'Kung May Paraan Para Kumita Habang Kasama ang Pamilya… Di Mo Ba Susubukan?',
                    'subheadline' => 'Alam naming hindi madali ang buhay. Pero kung may chance na makatulong sayo at sa pamilya mo—bakit hindi subukan? Wala namang mawawala, lalo na kung may pangarap ka.',
                    'video_thumbnail' => Storage::url('funnel_video_thumbnail/default_thumbnail.png'),
                    'video_link' => $videoLink,

                 
                    'intro_headline' => 'Mahalaga ba sayo ang magkaroon ng dagdag na kita?',
                    'intro_paragraph' => 'Baka hindi mo pa nasusubukan, pero ang pagkakataon na ito ay pwedeng magbago ng buhay mo at ng pamilya mo. Hindi mo kailangang maghintay ng perfect na panahon, baka ito na yun!',
                    
                    'benefits_title' => 'Why you join us?',
                    'benefits_list' => [
                        'Pagkakataon kumita ng malaki para sa pamilya at mga pangarap mo',
                        'Mas maraming oras para sa mga mahal mo sa buhay—hindi lang para magtrabaho',
                        'Kontrolin ang oras at diskarte mo para magkaroon ng mas magaan na buhay',
                        'Suporta mula sa mga taong magtutulungan upang magtagumpay ka',
                        'Simula ng isang bagong journey na magbubukas ng mas magagandang opportunities para sa’yo',
                    ],
                    
                    'testimonial_headline' => 'What Our Clients Say',
                    'testimonial_subheadline' => 'Real results from real people',
                    'testimonial_images' => [
                        Storage::url('funnel_testimonial_images/default1.png'),
                        Storage::url('funnel_testimonial_images/default2.png'),
                        Storage::url('funnel_testimonial_images/default3.png'),
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
    
                    // Referral button content
                    'Referral_button_text' => 'Sign Up To Start Earning',
                    'Referral_button_subtext' => '✅ Reserve Your Free Slot Now',

                     // Group chat button content
                    'Group_chat_button_text' => 'Get More Info — Join Group Chat',
                    'Group_chat_button_subtext' => '✅ Click Here To Join Now',
                                                    
                    'Messenger_link' => 'https://m.me/yourpage',
                    'Referral_link' => 'https://yourdomain.com/referral-code',
                    'Group_chat_link' => 'https://chat.whatsapp.com/yourgroup',
                    'Messenger_link_toggle' => true,
                    'Referral_link_toggle' => true,
                    'Group_chat_link_toggle' => true
                ];
            }

        
     
// #################################### For Landing Page ###########################################

  // Assuming $request->video_link contains the user-provided video link
            $providedLink = $request->video_link;
            $defaultYouTube = 'https://youtu.be/E4GMDFmIPfo?si=Z6Mkf2_JmV0t8mqf'; // Default YouTube link
            $defaultMP4 = 'https://d1yei2z3i6k35z.cloudfront.net/4624298/674856edaa387_Untitled6.mp4'; // Default MP4 link

            // Choose which default video to use (uncomment one)
            $defaultVideoLink = $defaultYouTube;
            // $defaultVideoLink = $defaultMP4;

            // Final video link assignment
            $videoLink = $providedLink ? $this->processVideoLink($providedLink) : $this->processVideoLink($defaultVideoLink);


// 1. Copy default video thumbnail from public/assets/images to storage/app/public/landing_video_thumbnail
$defaultVideoThumbnail = public_path('assets/images/default_thumbnail.png');
$targetVideoPath = 'landing_video_thumbnail/default_thumbnail.png';

if (File::exists($defaultVideoThumbnail) && !Storage::disk('public')->exists($targetVideoPath)) {
    Storage::disk('public')->put(
        $targetVideoPath,
        File::get($defaultVideoThumbnail)
    );
}

// 2. Copy default testimonial images from public/assets/images to storage/app/public/landing_testimonial_images
$testimonialImages = ['default1.png', 'default2.png', 'default3.png'];

foreach ($testimonialImages as $image) {
    $sourcePath = public_path("assets/images/{$image}");
    $targetPath = "landing_testimonial_images/{$image}";

    if (File::exists($sourcePath) && !Storage::disk('public')->exists($targetPath)) {
        Storage::disk('public')->put(
            $targetPath,
            File::get($sourcePath)
        );
    }
}

// ➕ Set default landing_page_content here
if (empty($funnel->landing_page_content)) {
$funnel->landing_page_content = [
    'headline' => 'Laging Pagod? Parang Lagi Ka Na Lang Walang Gana?',
    'subheadline' => 'Discover how Salveo Barley Grass can naturally boost your energy and immunity — even on your busiest days!',
    'video_thumbnail' => Storage::url('landing_video_thumbnail/default_thumbnail.png'),
     'video_link' => $videoLink,

    'intro_headline' => 'Mahalaga ba talaga sayo ang kalusugan mo?',
                    'intro_paragraph' => ' Baka oras na para alagaan ang sarili — hindi lang tuwing may sakit, kundi araw-araw. Sa isang simpleng habit, pwede mong simulan ang pagbabago ng pakiramdam mo',
                    
                    'benefits_title' => 'Why Barley Grass?',
                    'benefits_list' => [
                        'Boost sa natural energy levels',
                        'Mas malakas na immune system',
                        'Better digestion & detox',
                        'Better focus and sleep',
                        'Anti-fatigue & anti-inflammatory',
                    ],

    'testimonial_headline' => 'Legit Testimonials',
    'testimonial_subheadline' => 'Real results from real people',
    'testimonial_images' => [
        Storage::url('landing_testimonial_images/default1.png'),
        Storage::url('landing_testimonial_images/default2.png'),
        Storage::url('landing_testimonial_images/default3.png'),
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

    // Referral button content
    'Referral_button_text' => 'Try It for 7 Days — Order Now!',
    'Referral_button_subtext' => '✅ Claim Your Discount Now',

    // Group chat button content
     'Group_chat_button_text' => 'Get More Info — Join Group Chat',
     'Group_chat_button_subtext' => '✅ Click Here To Join Now',

    'Messenger_link' => 'https://m.me/yourpage',
    'Referral_link' => 'https://yourdomain.com/referral-code',
    'Group_chat_link' => 'https://chat.whatsapp.com/yourgroup',
    'Messenger_link_toggle' => true,
    'Referral_link_toggle' => true,
    'Group_chat_link_toggle' => true
];

}

                 $funnel->status = 'approved';
            $funnel->is_active = true;
            $funnel->approval_date = now();  
            $funnel->submitted_at = now();

            // Set expiration based on their own plan duration
           if ($plan_duration === 'lifetime') {
    $funnel->expiration_date = null; // Walang expiration
} elseif (is_numeric($plan_duration) && (int)$plan_duration > 0) {
    $funnel->expiration_date = now()->addMonths((int)$plan_duration);
} else {
    $funnel->expiration_date = null; // fallback for invalid strings
}


            $funnel->save();
        }
    }

    return redirect()->back()->with('success', 'Selected funnels have been approved and expiration dates updated.');
}


}

 // ✅ Converts both MP4 and YouTube links
private function processVideoLink($link)
{
    if (str_ends_with($link, '.mp4')) {
        return $link; // Return direct MP4 link
    }

    return $this->embedYouTubeLink($link);
}

// ✅ Converts YouTube link to embed format
private function embedYouTubeLink($youtubeLink)
{
    $videoId = $this->getYouTubeVideoId($youtubeLink);

    return $videoId ? "https://www.youtube.com/embed/$videoId" : null;
}

// ✅ Extracts YouTube video ID from URL
private function getYouTubeVideoId($url)
{
    $parts = parse_url($url);

    if (isset($parts['query'])) {
        parse_str($parts['query'], $query);
        if (isset($query['v'])) {
            return $query['v'];
        }
    }

    if (isset($parts['path'])) {
        return ltrim($parts['path'], '/');
    }

    return null;
}

// ################ Update show page of sales funnel Function ##################################
public function editFunnel()
{
    // Fetch the funnel content for the logged-in user
    $funnel = UserFunnel::where('user_id', Auth::id())->first();

    // Decode funnel content if it is stored as a JSON string in the database
    $funnelContent = $funnel ? (is_string($funnel->funnel_content) ? json_decode($funnel->funnel_content, true) : $funnel->funnel_content) : null;

    // Pass the funnel content to the view
    return view('edit-funnel', compact('funnel', 'funnelContent'));
}


// ################ Update sales funnel Function ##################################
public function updateFunnel(Request $request)
{
    // Validate the input
    $request->validate([
        'page_link_1' => ['nullable', 'regex:/^[a-zA-Z0-9-]*$/'], // Allow only letters, numbers, and dashes
    ]);
    
    $userId = Auth::id();
    $funnel = UserFunnel::where('user_id', $userId)->first();

    if (!$funnel) {
        return redirect()->back()->with('error', 'Funnel not found.');
    }

    // Decode funnel content if it is stored as a JSON string in the database
    $funnelContent = $funnel ? (is_string($funnel->funnel_content) ? json_decode($funnel->funnel_content, true) : $funnel->funnel_content) : null;

    // VIDEO THUMBNAIL
    if ($request->hasFile('video_thumbnail')) {
        $videoThumb = $request->file('video_thumbnail');
        $thumbPath = $videoThumb->store('funnel_video_thumbnail', 'public');
        $videoThumbnailUrl = Storage::url($thumbPath);

        if (($funnelContent['video_thumbnail'] ?? '') !== $videoThumbnailUrl) {
            if (!empty($funnelContent['video_thumbnail'])) {
                $oldPath = str_replace(Storage::url(''), '', $funnelContent['video_thumbnail']);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $funnelContent['video_thumbnail'] = $videoThumbnailUrl;
        }
    }

    // VIDEO LINK CONVERSION
    if ($request->filled('video_link')) {
        $videoLink = $request->input('video_link');
        
        // Match YouTube URLs (standard youtube.com and shortened youtu.be)
        if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube|youtu|youtube-nocookie)\.(?:com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $videoLink, $matches)) {
            // YouTube video ID is in $matches[1]
            $videoId = $matches[1];
            
            // Convert to embedded URL
            $embeddedVideoUrl = "https://www.youtube.com/embed/{$videoId}";
            
            // Save the embedded link to funnel content
            $funnelContent['video_link'] = $embeddedVideoUrl;
        } else {
            // If the URL is not a YouTube link, you can keep it as is or handle the error
            $funnelContent['video_link'] = $videoLink;
        }
    }

    // TESTIMONIAL IMAGES
    if ($request->hasFile('testimonial_images')) {
        $newUploaded = [];

        foreach ($request->file('testimonial_images') as $image) {
            if ($image) {
                $path = $image->store('testimonial_images', 'public');
                $newUploaded[] = Storage::url($path);
            }
        }

        // Remove all old images if any
        if (!empty($funnelContent['testimonial_images'])) {
            foreach ($funnelContent['testimonial_images'] as $oldImage) {
                $oldPath = str_replace(Storage::url(''), '', $oldImage);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        }

        $funnelContent['testimonial_images'] = $newUploaded;
    } elseif ($request->has('testimonial_images') && empty($request->input('testimonial_images'))) {
        $funnelContent['testimonial_images'] = [
            Storage::url('testimonial_images/default1.png'),
            Storage::url('testimonial_images/default2.png'),
            Storage::url('testimonial_images/default3.png')
        ];
    }

    // TEXT FIELDS
   $fields = [
    'headline', 'subheadline', 'video_link',
    'testimonial_headline', 'testimonial_subheadline',
    'intro_headline', 'intro_paragraph', 'benefits_title', 'benefits_list',
    'Referral_button_text', 'Referral_button_subtext',
    'Group_chat_button_text', 'Group_chat_button_subtext',
];

    foreach ($fields as $field) {
        if ($request->filled($field)) {
            $funnelContent[$field] = $request->input($field);
        }
    }

   
// Handle video link conversion to embedded format
if ($request->filled('video_link')) {
    $videoLink = $request->input('video_link');
    
    // Check if the link is a YouTube URL
    if (strpos($videoLink, 'youtube.com') !== false || strpos($videoLink, 'youtu.be') !== false) {
        $funnelContent['video_link'] = $this->embedYouTubeLink($videoLink);
    } else {
        // If it's not a YouTube link (e.g., an MP4 link), don't convert
        $funnelContent['video_link'] = $videoLink;
    }
}

    // TESTIMONIAL VIDEO LINKS
    $testimonialVideos = [];
    if ($request->filled('testimonial_video_1')) {
        $testimonialVideos[] = $request->input('testimonial_video_1');
    }
    if ($request->filled('testimonial_video_2')) {
        $testimonialVideos[] = $request->input('testimonial_video_2');
    }
    if (!empty($testimonialVideos)) {
        $funnelContent['testimonial_video_link'] = $testimonialVideos;
    }

    // FOMO COUNTDOWN
    $fomoInput = [
        'days' => $request->input('fomo_days'),
        'hours' => $request->input('fomo_hours'),
        'minutes' => $request->input('fomo_minutes'),
    ];

    if (array_filter($fomoInput, fn($v) => $v !== null && $v !== '')) {
        $funnelContent['fomo_countdown'] = [
            'days' => $fomoInput['days'] !== '' ? (int)$fomoInput['days'] : 0,
            'hours' => $fomoInput['hours'] !== '' ? (int)$fomoInput['hours'] : 0,
            'minutes' => $fomoInput['minutes'] !== '' ? (int)$fomoInput['minutes'] : 0,
        ];
    }

    // SOCIAL LINKS & TOGGLES
    $socialFields = ['Messenger', 'Referral', 'Group_chat'];
    foreach ($socialFields as $field) {
        $linkKey = $field . '_link';
        $toggleKey = $field . '_link_toggle';

        if ($request->filled($linkKey)) {
            $funnelContent[$linkKey] = $request->input($linkKey);
        }

        $funnelContent[$toggleKey] = $request->boolean($toggleKey); // uses `true` or `false`
    }

    // Update page_link_1 (direct column)
    if ($request->filled('page_link_1')) {
        $funnel->page_link_1 = $request->input('page_link_1');
    }

    // FINAL SAVE
    $funnel->funnel_content = json_encode($funnelContent);
    $wasChanged = $funnel->isDirty('funnel_content') || $funnel->isDirty('page_link_1');
    $funnel->save();

    return redirect()->back()->with($wasChanged ? 'success' : 'error', $wasChanged ? 'Funnel updated successfully!' : 'No changes were made.');
}




// ################ Update show page of landing page Function ##################################
public function editLanding()
{
    // Fetch the landing page content for the logged-in user
    $funnel = UserFunnel::where('user_id', Auth::id())->first();

    // Decode landing page content if it is stored as a JSON string in the database
    $landingPageContent = $funnel ? (is_string($funnel->landing_page_content) ? json_decode($funnel->landing_page_content, true) : $funnel->landing_page_content) : null;

    // Pass the landing page content to the view
    return view('edit-landing-page', compact('funnel', 'landingPageContent'));
}



// ################ Update sales landing page Function ##################################
public function updateLanding(Request $request)
{
    // Validate the input
    $request->validate([
        'page_link_2' => ['nullable', 'regex:/^[a-zA-Z0-9-]*$/'], // Allow only letters, numbers, and dashes
    ]);

    $userId = Auth::id();
    $funnel = UserFunnel::where('user_id', $userId)->first();

    if (!$funnel) {
        return redirect()->back()->with('error', 'Funnel not found.');
    }

    // Decode landing page content if it is stored as a JSON string in the database
    $landingPageContent = $funnel ? (is_string($funnel->landing_page_content) ? json_decode($funnel->landing_page_content, true) : $funnel->landing_page_content) : null;

    // VIDEO THUMBNAIL
    if ($request->hasFile('video_thumbnail')) {
        $videoThumb = $request->file('video_thumbnail');
        $thumbPath = $videoThumb->store('landing_video_thumbnail', 'public');
        $videoThumbnailUrl = Storage::url($thumbPath);

        if (($landingPageContent['video_thumbnail'] ?? '') !== $videoThumbnailUrl) {
            if (!empty($landingPageContent['video_thumbnail'])) {
                $oldPath = str_replace(Storage::url(''), '', $landingPageContent['video_thumbnail']);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $landingPageContent['video_thumbnail'] = $videoThumbnailUrl;
        }
    }

    // TESTIMONIAL IMAGES
    if ($request->hasFile('testimonial_images')) {
        $newUploaded = [];

        foreach ($request->file('testimonial_images') as $image) {
            if ($image) {
                $path = $image->store('landing_testimonial_images', 'public');
                $newUploaded[] = Storage::url($path);
            }
        }

        // Remove all old images if any
        if (!empty($landingPageContent['testimonial_images'])) {
            foreach ($landingPageContent['testimonial_images'] as $oldImage) {
                $oldPath = str_replace(Storage::url(''), '', $oldImage);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        }

        $landingPageContent['testimonial_images'] = $newUploaded;
    } elseif ($request->has('testimonial_images') && empty($request->input('testimonial_images'))) {
        $landingPageContent['testimonial_images'] = [
            Storage::url('testimonial_images/default1.png'),
            Storage::url('testimonial_images/default2.png'),
            Storage::url('testimonial_images/default3.png')
        ];
    }

      // TEXT FIELDS
   $fields = [
    'headline', 'subheadline', 'video_link',
    'testimonial_headline', 'testimonial_subheadline',
    'intro_headline', 'intro_paragraph', 'benefits_title', 'benefits_list',
    'Referral_button_text', 'Referral_button_subtext',
    'Group_chat_button_text', 'Group_chat_button_subtext',
];

    foreach ($fields as $field) {
        if ($request->filled($field)) {
            $landingPageContent[$field] = $request->input($field);
        }
    }

   // Handle video link conversion to embedded format
if ($request->filled('video_link')) {
    $videoLink = $request->input('video_link');
    
    // Check if the link is a YouTube URL
    if (strpos($videoLink, 'youtube.com') !== false || strpos($videoLink, 'youtu.be') !== false) {
        $funnelContent['video_link'] = $this->embedYouTubeLink($videoLink);
    } else {
        // If it's not a YouTube link (e.g., an MP4 link), don't convert
        $funnelContent['video_link'] = $videoLink;
    }
}

    // TESTIMONIAL VIDEO LINKS
    $testimonialVideos = [];
    if ($request->filled('testimonial_video_1')) {
        $testimonialVideos[] = $request->input('testimonial_video_1');
    }
    if ($request->filled('testimonial_video_2')) {
        $testimonialVideos[] = $request->input('testimonial_video_2');
    }
    if (!empty($testimonialVideos)) {
        $landingPageContent['testimonial_video_link'] = $testimonialVideos;
    }

    // FOMO COUNTDOWN
    $fomoInput = [
        'days' => $request->input('fomo_days'),
        'hours' => $request->input('fomo_hours'),
        'minutes' => $request->input('fomo_minutes'),
    ];

    if (array_filter($fomoInput, fn($v) => $v !== null && $v !== '')) {
        $landingPageContent['fomo_countdown'] = [
            'days' => $fomoInput['days'] !== '' ? (int)$fomoInput['days'] : 0,
            'hours' => $fomoInput['hours'] !== '' ? (int)$fomoInput['hours'] : 0,
            'minutes' => $fomoInput['minutes'] !== '' ? (int)$fomoInput['minutes'] : 0,
        ];
    }

    // SOCIAL LINKS & TOGGLES
    $socialFields = ['Messenger', 'Referral', 'Group_chat'];
    foreach ($socialFields as $field) {
        $linkKey = $field . '_link';
        $toggleKey = $field . '_link_toggle';

        if ($request->filled($linkKey)) {
            $landingPageContent[$linkKey] = $request->input($linkKey);
        }

        $landingPageContent[$toggleKey] = $request->boolean($toggleKey); // uses `true` or `false`
    }

    // Update page_link_1 (direct column)
    if ($request->filled('page_link_2')) {
        $funnel->page_link_2 = $request->input('page_link_2');
    }

    // FINAL SAVE
    $funnel->landing_page_content = json_encode($landingPageContent); // Update the correct column here

    // Ensure changes are detected
    $wasChanged = $funnel->isDirty('landing_page_content') || $funnel->isDirty('page_link_2');
    
    // Save only if there are changes
    if ($wasChanged) {
        $funnel->save();
    }

    return redirect()->back()->with($wasChanged ? 'success' : 'error', $wasChanged ? 'Funnel updated successfully!' : 'No changes were made.');
}


}





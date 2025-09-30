<?php

namespace App\Http\Controllers\Funnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Funnel\FunnelLead;
use App\Models\Funnel\UserFunnel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\User\Users; 
use App\Models\Funnel\FunnelView;
use App\Models\Funnel\WhoIAmSection;


class LeadController extends Controller
{

// ###################################################################
// ###################################################################
// Show landing page and save page analytics user cookies 
// ###################################################################
// ###################################################################

    public function landingPage($username, $page_link, Request $request)
    {
        // Hanapin user based sa subdomain
        $user = Users::where('username', $username)->firstOrFail();

        // Hanapin funnel sa user
        $funnel = UserFunnel::where('user_id', $user->id)
                            ->where('page_link', $page_link)
                            ->firstOrFail();

        // Fetch Who I Am section
        $whoIamSection = WhoIAmSection::where('user_id', $user->id)->first();

        // Visitor cookie
        $cookieName = 'visitor_id';
        if ($request->hasCookie($cookieName)) {
            $visitorCookie = $request->cookie($cookieName);
        } else {
            $visitorCookie = uniqid('visitor_', true);
            cookie()->queue(cookie($cookieName, $visitorCookie, 60*24*30));
        }

        // Save view (1x per funnel + visitor)
        FunnelView::firstOrCreate([
            'user_id'     => $user->id,
            'page_link'   => $page_link,
            'user_cookie' => $visitorCookie,
        ]);

        // Pass Who I Am section to view
        return view('funnel.landing-page', compact('funnel', 'user', 'whoIamSection'));
    }





    // Store lead submission
    public function store(Request $request)
    {
    $validator = \Validator::make($request->all(), [
    'page_link' => 'required|string',
    'name'      => 'required|string|max:255',
    'email'     => [
        'required',
        'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', 
    ],
    'phone'     => [
        'required',
        'regex:/^[0-9]{11,15}$/', 
    ],
], [
    'email.regex'   => 'The email must be a valid Gmail address (e.g., juan@gmail.com).',
    'phone.regex'   => 'The phone number must be between 11 to 15 digits.',
]);

// ✅ Kung validation failed, return JSON errors
if ($validator->fails()) {
    return response()->json([
        'status' => 'error',
        'errors' => $validator->errors()
    ], 422);
}


        // ✅ Find funnel
        $funnel = UserFunnel::where('page_link', $request->page_link)->firstOrFail();

        // ✅ Create lead
        FunnelLead::create([
            'user_funnel_id' => $funnel->id,
            'user_id'        => $funnel->user_id,
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
        ]);

        // ✅ Return success JSON (AJAX)
        return response()->json([
            'status'  => 'success',
            'redirect' => route('funnel.salesPage', ['page_link' => $funnel->page_link])
        ]);
    }

// Sales page after lead capture
public function salesPage($page_link)
{
    $funnel = UserFunnel::where('page_link', $page_link)->firstOrFail();

    // Get the user who owns this funnel
    $user = Users::find($funnel->user_id);



    return view('funnel.sales-page', compact('funnel', 'user'));
}




// My leads
public function myLeads()
{
    $leads = FunnelLead::with('funnel') // include funnel info
                ->where('user_id', auth()->id())
                ->latest()
                ->paginate(10); // paginate instead of get

    return view('funnel.leads-list', compact('leads'));
}


public function exportLeads()
{
    $leads = FunnelLead::where('user_id', auth()->id())
                ->latest()
                ->get();

    $filename = 'my_leads_' . now()->format('Ymd_His') . '.csv';

    $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename={$filename}",
    ];

    $columns = ['No', 'Name', 'Email', 'Phone', 'Date Submitted'];

    $callback = function() use ($leads, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($leads as $index => $lead) {
            fputcsv($file, [
                $index + 1,
                $lead->name,
                $lead->email,
                $lead->phone,
                $lead->created_at->format('Y-m-d H:i'), // 24-hour format
            ]);
        }

        fclose($file);
    };

    return Response::stream($callback, 200, $headers);
}

    // Delete Function
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if(!$ids || count($ids) === 0){
            return response()->json(['success' => false, 'message' => 'No leads selected.']);
        }

        FunnelLead::where('user_id', auth()->id())
            ->whereIn('id', $ids)
            ->delete();

        return response()->json(['success' => true, 'message' => 'Selected leads deleted successfully.']);
}



}

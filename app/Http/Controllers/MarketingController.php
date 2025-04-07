<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketingContent;
use Illuminate\Support\Facades\Storage;

class MarketingController extends Controller
{
    public function upload()
    {
          // Check if the user is authenticated and is an admin
        if (!auth()->check() || auth()->user()->is_admin == 0) {
            return redirect()->route('login');
        }
        
        $marketingContents = MarketingContent::latest()->get(); // Fetch uploaded images
        return view('upload-marketing', compact('marketingContents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:15360', // 15MB
        ]);
    
        // Save file to "storage/app/public/marketing_image"
        $imagePath = $request->file('image')->store('marketing_image', 'public');
    
        // Save to database
        MarketingContent::create([
            'caption' => $request->caption,
            'image' => $imagePath, // Will store "marketing_image/filename.jpg"
        ]);
    
        return redirect()->back()->with('success', 'Marketing content uploaded successfully!');
    }

    public function destroy($id)
    {
        $content = MarketingContent::findOrFail($id);

        // Delete image from storage
        Storage::disk('public')->delete($content->image);

        // Delete from database
        $content->delete();

        return redirect()->back()->with('success', 'Marketing content deleted successfully!');
    }

    public function showDownloadable()
    {
        // Fetch all marketing content from the database
        $marketingContents = MarketingContent::all();
        $marketingContents = MarketingContent::orderBy('created_at', 'desc')->get();


        // Return the view and pass the fetched content
        return view('downloadable-marketing', compact('marketingContents'));
    }
}

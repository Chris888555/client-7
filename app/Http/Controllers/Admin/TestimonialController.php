<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // Show create form
    public function createView()
    {
        return view('admin.testimonials.create');
    }

    // Store new testimonial (AJAX)
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'message'    => 'required|string',
            'video_link' => 'nullable|string',
        ]);

        $data = $request->all();

        if (!empty($data['video_link'])) {
            $data['video_link'] = $this->convertVideoLink($data['video_link']);
        }

        $testimonial = Testimonial::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Testimonial created successfully.',
            'data'    => $testimonial
        ]);
    }

  // Show list of testimonials with pagination
        public function list()
        {
            $testimonials = Testimonial::latest()->paginate(10); // 10 per page
            return view('admin.testimonials.list', compact('testimonials'));
        }


    // Update existing testimonial (AJAX)
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'message'    => 'required|string',
            'video_link' => 'nullable|string',
        ]);

        $data = $request->all();

        if (!empty($data['video_link'])) {
            $data['video_link'] = $this->convertVideoLink($data['video_link']);
        }

        $testimonial->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Testimonial updated successfully.',
            'data'    => $testimonial
        ]);
    }

    // Delete testimonial (AJAX)
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Testimonial deleted successfully.'
        ]);
    }

    // Optional: Bulk delete for checkboxes
    public function bulkDelete(Request $request)
    {
        $ids = $request->ids ?? [];
        if(!empty($ids)){
            Testimonial::whereIn('id', $ids)->delete();
            return response()->json(['status'=>'success','message'=>'Testimonials deleted successfully.']);
        }
        return response()->json(['status'=>'error','message'=>'No testimonials selected.']);
    }

    // Convert YouTube/Vimeo links to embed format
    private function convertVideoLink($url)
    {
        // YouTube long link
        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $match)) {
            return 'https://www.youtube.com/embed/' . $match[1];
        }

        // YouTube short link
        if (preg_match('/youtu\.be\/([^?]+)/', $url, $match)) {
            return 'https://www.youtube.com/embed/' . $match[1];
        }

        // Vimeo link
        if (preg_match('/vimeo\.com\/(\d+)/', $url, $match)) {
            return 'https://player.vimeo.com/video/' . $match[1];
        }

        return $url; // return original if not matched
    }
}

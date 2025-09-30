<?php

namespace App\Http\Controllers\Funnel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Funnel\WhoIAmSection;

class WhoIAmSectionController extends Controller
{
    // Show page with form + existing sections
    public function create()
    {
        $sections = WhoIAmSection::where('user_id', auth()->id())->get();
        return view('funnel.create-section', compact('sections'));
    }

    // Store new section
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hook' => 'required|string',
            'intro' => 'required|string',
            'transition' => 'required|string',
            'bullets' => 'required|array|min:1',
            'bullets.*' => 'required|string',
            'motivation' => 'required|string',
            'testimonial' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('images', 'public') 
            : null;

        $section = WhoIAmSection::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'hook' => $request->hook,
            'intro' => $request->intro,
            'transition' => $request->transition,
            'bullets' => $request->bullets,
            'motivation' => $request->motivation,
            'testimonial' => $request->testimonial,
            'image_path' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Section saved successfully!',
            'section' => $section
        ]);
    }

    // Update section
    public function update(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:who_i_am_sections,id',
            'name' => 'required|string|max:255',
            'hook' => 'required|string',
            'intro' => 'required|string',
            'transition' => 'required|string',
            'bullets' => 'required|array|min:1',
            'bullets.*' => 'required|string',
            'motivation' => 'required|string',
            'testimonial' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $section = WhoIAmSection::where('user_id', auth()->id())->findOrFail($request->section_id);

        if ($request->hasFile('image')) {
            if ($section->image_path && Storage::disk('public')->exists($section->image_path)) {
                Storage::disk('public')->delete($section->image_path);
            }
            $section->image_path = $request->file('image')->store('images', 'public');
        }

        $section->update([
            'name' => $request->name,
            'hook' => $request->hook,
            'intro' => $request->intro,
            'transition' => $request->transition,
            'bullets' => $request->bullets,
            'motivation' => $request->motivation,
            'testimonial' => $request->testimonial,
        ]);

        return response()->json(['success' => true, 'message' => 'Section updated successfully!']);
    }

    // Delete section
    public function delete(Request $request)
    {
        $section = WhoIAmSection::where('user_id', auth()->id())->findOrFail($request->id);

        if ($section->image_path && Storage::disk('public')->exists($section->image_path)) {
            Storage::disk('public')->delete($section->image_path);
        }

        $section->delete();

        return response()->json(['success' => true, 'message' => 'Section deleted successfully!']);
    }

   // Fetch single section for AJAX update
public function show($id)
{
    $section = WhoIAmSection::where('user_id', auth()->id())->findOrFail($id);

    // Ensure bullets are returned as array
    $section->bullets = is_string($section->bullets) ? json_decode($section->bullets, true) : $section->bullets;

    return response()->json($section);
}

}

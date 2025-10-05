<?php

namespace App\Http\Controllers\Materials;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Materials\Material;

class MaterialController extends Controller
{
    // ✅ List all materials (for user view)
    public function index()
    {
        $materials = Material::all();
        return view('user.materials.index', compact('materials'));
    }

    // ✅ Single material view (optional)
    public function show($id)
    {
        $material = Material::findOrFail($id);
        return view('materials.show', compact('material'));
    }

    // ✅ Show create form (admin only)
    public function create()
    {
        return view('admin.materials.create');
    }

    // ✅ Store image with caption + category
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png',
            'caption' => 'nullable|string',
            'category' => 'required|string|max:100',
        ]);

        $filePath = $request->file('file')->store('materials', 'public');

        Material::create([
            'file_path' => $filePath,
            'caption' => $request->caption,
            'category' => $request->category,
        ]);

        return response()->json(['message' => 'Image uploaded successfully.']);
    }

    public function showByCategory(Request $request)
        {
            $category = $request->get('category', 'All');

            if ($category === 'All') {
                $materials = Material::all();
            } else {
                $materials = Material::where('category', $category)->get();
            }

            $categories = Material::select('category')->distinct()->pluck('category');

            return view('user.materials.images', compact('materials', 'category', 'categories'));
        }



public function showpage(Request $request)
{
    $query = Material::query();

    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    $materials = $query->paginate(10);

    $categories = Material::distinct()->pluck('category');

    return view('admin.materials.update', compact('materials', 'categories'));
}



    
    // ✅ Update caption, category, image (admin)
    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        $validated = $request->validate([
            'caption' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'file' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $material->caption = $validated['caption'] ?? $material->caption;
        $material->category = $validated['category'] ?? $material->category;

        if ($request->hasFile('file')) {
            if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
                Storage::disk('public')->delete($material->file_path);
            }
            $filePath = $request->file('file')->store('materials', 'public');
            $material->file_path = $filePath;
        }

        $material->save();

        return response()->json(['message' => 'Material updated successfully.']);
    }

    // ✅ Bulk delete (admin)
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'No materials selected'], 400);
        }

        $materials = Material::whereIn('id', $ids)->get();

        foreach ($materials as $material) {
            if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
                Storage::disk('public')->delete($material->file_path);
            }
            $material->delete();
        }

        return response()->json(['message' => 'Selected materials deleted successfully.']);
    }
}

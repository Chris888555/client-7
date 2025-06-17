<?php

namespace App\Http\Controllers\Materials;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller; 
use App\Models\Materials\Material;

class MaterialController extends Controller
{
 

 public function index()
{
    $materials = Material::all();
    return view('user.materials.index', compact('materials'));
}



    public function show($id)
    {
        $material = Material::findOrFail($id);
        return view('materials.show', compact('material'));
    }

    public function create()
{
   
    return view('admin.materials.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required_unless:category,Marketing Images,Marketing Videos',
        'file' => 'required|file',
        'caption' => 'required_if:category,Marketing Images|string|nullable',
        'category' => 'required|string',
    ]);

    $file = $request->file('file');
    $filePath = $file->store('materials', 'public');

    Material::create([
        'title' => $request->title,
        'file_path' => $filePath,
        'caption' => $request->caption,
        'category' => $request->category,
    ]);

    return response()->json(['message' => 'Uploaded successfully']);
}


public function showByCategory($category)
{
    $materials = Material::where('category', urldecode($category))->get();

    return view('materials.showByCategory', compact('materials', 'category'));
}



public function showpage(Request $request)
{
    $query = Material::query();

    if ($request->has('category') && $request->category !== 'all') {
        $query->where('category', $request->category);
    }

    $materials = $query->paginate(10)->withQueryString(); 

    $categories = Material::select('category')->distinct()->pluck('category');

    return view('admin.materials.update', compact('materials', 'categories'));
}


public function update(Request $request, $id)
{
    $material = Material::findOrFail($id);

    $validated = $request->validate([
        'title' => 'nullable|string|max:255',
        'caption' => 'nullable|string',
        'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,pdf',
    ]);

    $material->title = $validated['title'] ?? $material->title;
    $material->caption = $validated['caption'] ?? $material->caption;

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



   
public function bulkDelete(Request $request)
{
    $ids = $request->input('ids');

    if (!is_array($ids) || empty($ids)) {
        return response()->json(['message' => 'No materials selected'], 400);
    }

    $materials = Material::whereIn('id', $ids)->get();

    foreach ($materials as $material) {
        if ($material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }
        $material->delete();
    }

    return response()->json(['message' => 'Selected materials deleted successfully']);
}


}
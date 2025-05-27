<?php

namespace App\Http\Controllers\Materials;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller; 
use App\Models\Materials\Material;

class MaterialController extends Controller
{
 public function __construct()
    {
        date_default_timezone_set("Asia/Manila");
    }

    protected function adminsession()
    {
        return session()->get('adminsession');
    }

 public function index()
{
    $materials = Material::all();
    return view('materials.index', compact('materials'));
}



    public function show($id)
    {
        $material = Material::findOrFail($id);
        return view('materials.show', compact('material'));
    }

    public function create()
{
    if (!$this->adminsession()) {
        return redirect()->route('login'); 
    }
    return view('materials.create');
}

public function store(Request $request)
{
    
   $request->validate([
    'title' => 'required',
    'file' => 'required|file',
    'caption' => 'nullable|string',
    'category' => 'required|string',  
]);

    $file = $request->file('file');
    $filePath = $file->store('materials', 'public');
    $mime = $file->getMimeType();

    $fileType = 'other';
    if (str_contains($mime, 'image')) $fileType = 'image';
    elseif (str_contains($mime, 'video')) $fileType = 'video';
    elseif (str_contains($mime, 'pdf')) $fileType = 'pdf';

   Material::create([
    'title' => $request->title,
    'file_path' => $filePath,
    'file_type' => $fileType,
    'caption' => $fileType === 'image' ? $request->caption : null,
    'category' => $request->category,  
]);

  return redirect()->route('materials.create')->with('success', 'Material uploaded.');


}


public function showByCategory($type)
{
    $materials = Material::where('category', $type)->get();

    return view('materials.showByCategory', compact('materials'));
}


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Package;
use App\Models\Mop\PaymentMethod;
use App\Models\User\Users; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Funnel\UserFunnel;

class PackageController extends Controller
{
  public function choose($page_link)
{
    $packages = Package::all();
    $funnel   = UserFunnel::where('page_link', $page_link)->firstOrFail();
    $user     = $funnel->user;
    $mops     = PaymentMethod::where('user_id', $user->id)->get();

    // kahit nasa "buy-now" folder yung blade, wala yang effect sa URL
    return view('buy-now.choose-package', compact('packages', 'mops', 'user', 'funnel'));
}


    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'price'      => 'required|numeric',
            'features'   => 'required|array',
            'features.*' => 'required|string|max:255',
            'image'      => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('packages', 'public')
            : null;

        Package::create([
            'name'     => $request->name,
            'price'    => $request->price,
            'features' => $request->features, // auto-cast → JSON
            'image'    => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Package created successfully!'
        ]);
    }


 public function list()
{
   
    $packages = Package::paginate(10); 

    return view('admin.packages.list', compact('packages'));
}


    public function update(Request $request)
    {
        $request->validate([
            'id'        => 'required|exists:packages,id',
            'name'      => 'required|string|max:255',
            'price'     => 'required|numeric',
            'features'  => 'required|array',
            'features.*'=> 'required|string|max:255',
            'image'     => 'nullable|image|max:2048',
        ]);

        $pkg = Package::findOrFail($request->id);

        $imagePath = $pkg->image; // keep old by default
        if ($request->hasFile('image')) {
            if ($pkg->image && Storage::disk('public')->exists($pkg->image)) {
                Storage::disk('public')->delete($pkg->image);
            }
            $imagePath = $request->file('image')->store('packages', 'public');
        }

        $pkg->update([
            'name'     => $request->name,
            'price'    => $request->price,
            'features' => $request->features,
            'image'    => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Package updated successfully!'
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:packages,id',
        ]);

        $packages = Package::whereIn('id', $request->ids)->get();

        foreach ($packages as $pkg) {
            // delete image file if exists
            if ($pkg->image && Storage::disk('public')->exists($pkg->image)) {
                Storage::disk('public')->delete($pkg->image);
            }
            $pkg->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully!'
        ]);
    }
}

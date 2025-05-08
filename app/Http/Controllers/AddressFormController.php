<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AddressFormController extends Controller
{
    public function showForm()
    {
        // Load regions from JSON file
        $regions = json_decode(File::get(public_path('ph-json/region.json')), true);

        return view('form', compact('regions'));
    }

    public function submitForm(Request $request)
    {
        // Example validation
        $request->validate([
            'region' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
        ]);

        // Handle the data (store to DB or process)
        return back()->with('success', 'Address submitted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\NavSetting;
use Illuminate\Http\Request;

class NavSettingController extends Controller
{
    // Display the navigation settings form
    public function index()
    {
        $navSettings = NavSetting::first(); // Assuming only one record exists
        return view('nav-settings.index', compact('navSettings'));
    }

    // Update the navigation settings
    public function update(Request $request)
    {
        $request->validate([
            'nav_bg_color' => 'nullable|string',
            'nav_text_color' => 'nullable|string',
            'nav_text_list_hover_color' => 'nullable|string',
            'nav_list_bg_hover_color' => 'nullable|string',
        ]);

        $navSettings = NavSetting::first();

        if (!$navSettings) {
            $navSettings = new NavSetting();
        }

        $navSettings->nav_bg_color = $request->nav_bg_color ?? null;
        $navSettings->nav_text_color = $request->nav_text_color ?? null;
        $navSettings->nav_text_list_hover_color = $request->nav_text_list_hover_color ?? null;
        $navSettings->nav_list_bg_hover_color = $request->nav_list_bg_hover_color ?? null;

        $navSettings->save();

        return redirect()->route('nav-settings.index')->with('success', 'Settings updated successfully');
    }

    // Fetch and display all settings (or a specific one)
    public function showAllSettings()
    {
        $navSettings = NavSetting::all(); // This will fetch all records
        return view('nav-settings.show', compact('navSettings'));
    }
}

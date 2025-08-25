<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThemeSetting;

class ThemeSettingController extends Controller
{
    public function edit()
    {
        $theme = ThemeSetting::firstOrCreate([]);
        return view('admin.theme.settings', compact('theme'));
    }

  public function update(Request $request)
{
    $theme = ThemeSetting::first();
    $theme->update($request->only([
        'sidebar_bg',
        'nav_hover_bg_color',
        'nav_text_color',
        'nav_text_hover_color',
        'icon_bg_color',
        'icon_text',
        'logo_color',
    ]));

    if ($request->ajax()) {
        return response()->json(['message' => 'Theme updated successfully!']);
    }

    return back()->with('success', 'Theme updated successfully!');
}

}
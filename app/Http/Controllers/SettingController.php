<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_logo' => 'nullable|image|max:2048',
            'site_favicon' => 'nullable|image|max:1028',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'default_language' => 'required|string|in:' . implode(',', array_keys(languages())),
        ]);

        Setting::set('site_name', $request->input('site_name'));
        Setting::set('meta_title', $request->input('meta_title'));
        Setting::set('meta_description', $request->input('meta_description'));
        Setting::set('meta_keywords', $request->input('meta_keywords'));
        Setting::set('default_language', $request->input('default_language'));

        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $path);
        }

        if ($request->hasFile('site_favicon')) {
            $oldFavicon = Setting::get('site_favicon');
            if ($oldFavicon) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $path = $request->file('site_favicon')->store('settings', 'public');
            Setting::set('site_favicon', $path);
        }

        return redirect()->back()->with('success', 'Site settings updated successfully.');
    }
}

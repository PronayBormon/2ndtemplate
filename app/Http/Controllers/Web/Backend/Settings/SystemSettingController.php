<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;

class SystemSettingController extends Controller
{
    public function edit()
    {
        $settings = SystemSetting::first();
        return view('backend.layouts.settings.system', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SystemSetting::first();

        $validated = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:1024',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            // SEO
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',

            // Socials
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
        ]);

        // Handle file uploads with custom names
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/settings', $filename, 'public');
            $validated['logo'] = 'storage/' . $path;
        }

        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/settings', $filename, 'public');
            $validated['favicon'] = 'storage/' . $path;
        }

        if ($request->hasFile('og_image')) {
            $file = $request->file('og_image');
            $filename = 'og_image_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads/settings', $filename, 'public');
            $validated['og_image'] = 'storage/' . $path;
        }

        $settings->update($validated);
        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully!');
    }
}

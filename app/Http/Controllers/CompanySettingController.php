<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    public function index()
    {
        $setting = CompanySetting::first();
        return view('admin.company-settings', compact('setting'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'cover_image' => 'nullable|image|max:2048'
        ]);

        $setting = CompanySetting::first() ?? new CompanySetting();

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = 'cover_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $validated['cover_image'] = $filename;
        }

        $setting->fill($validated);
        $setting->save();

        return redirect()->back()->with('success', 'Company settings updated successfully');
    }
}

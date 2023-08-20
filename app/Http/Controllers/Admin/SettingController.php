<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:settings-read')->only(['index']);
        $this->middleware('permission:settings-update')->only(['update']);
    }

    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {

        $setting = Setting::findOrFail($id);
        $setting->update([
            'name_ar'          => $request->input('name_ar'),
            'name_en'          => $request->input('name_en'),
            'phone'          => $request->input('phone'),
            'email'          => $request->input('email'),
            'facebook'          => $request->input('facebook'),
            'twitter'          => $request->input('twitter'),
            'instagram'          => $request->input('instagram'),
            'linkedin'          => $request->input('linkedin'),
            'address_ar'       => $request->input('address_ar'),
            'address_en'       => $request->input('address_en'),
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->hashName();
            $destinationPath = public_path('/dashboard');
            $file->move($destinationPath, $filename);
            $setting['image'] = $filename;
        }

        $setting->save();
        return response()->json(['status' => 'success', 'data' => $setting]);
    }
}

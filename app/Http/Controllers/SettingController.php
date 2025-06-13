<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function show()
    {
        $setting = Setting::first();

        return view('settings.show', [
            'setting' => $setting,
            'membership_fee' => $setting?->membership_fee,
            'updated_at' => $setting?->updated_at,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'membership_fee' => 'required|numeric|min:0',
        ]);

        $setting = Setting::first();

        if (!$setting) {
            $setting = new Setting();
        }

        $setting->membership_fee = $request->membership_fee;
        $setting->save();

        return redirect()->back()->with('success', 'Membership fee updated.');
    }

}

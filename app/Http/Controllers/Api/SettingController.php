<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return response()->json($settings);
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            // If value is array, json_encode it. 
            // However, client might send JSON string or array.
            // If the Seeder uses json_encode, DB expects string.
            // Laravel casts aren't used here because 'value' is generic longText.
            // So we must handle serialization manually or ensure client sends string.
            // Better: Client sends JSON object/array, we encode it.

            if (is_array($value) || is_object($value)) {
                $value = json_encode($value);
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json(['message' => 'Settings updated successfully']);
    }
}

<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Core\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $values = Setting::query()->pluck('value', 'key')->toArray();

        return view('admin::settings.index', compact('values'));
    }

    public function update(Request $request)
    {
        $settings = setting()->all();

        $rules = [];
        foreach ($settings as $key => $config) {
            $rules[$key] = $config->getRules();
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use ($validated) {
            foreach ($validated as $key => $value) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value],
                );
            }
        });

        return redirect()
            ->route('admin.settings.index')
            ->with('success', __('admin.settings.update_success'));
    }
}

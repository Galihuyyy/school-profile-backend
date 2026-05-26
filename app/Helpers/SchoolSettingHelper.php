<?php

use App\Models\SchoolSettings;
use Illuminate\Support\Facades\Cache;

if (! function_exists('schoolSetting')) {

    function schoolSetting($column = null)
    {
        $setting = Cache::rememberForever('school_setting', function () {
            return SchoolSettings::first();
        });

        if (!$setting) return null;

        return $column ? data_get($setting, $column) : $setting;
    }

}
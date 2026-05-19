<?php

namespace App\Http\Services\BusinessLogic\Setting;

use App\Http\Services\BusinessLogic\Tools\ServiceResult;
use App\Http\Services\BusinessLogic\Tools\ServiceWrapper;
use App\Http\Services\Image\Facades\ImageService;
use App\Models\Content\Post;
use App\Models\Setting\Setting;

class SettingService
{
    public function showOrCreateSetting(): ServiceResult
    {
        return app(ServiceWrapper::class)(function (){

            $setting = Setting::first();

            if (is_null($setting))
            {
                Setting::create([
                    'title' => 'site title',
                    'description' => 'site description',
                    'keywords' => 'site keywords',
                    'logo' => 'logo.png',
                    'icon' => 'icon.png',
                ]);

                $setting = Setting::first();
            }

            return $setting;

        });
    }

    public function updateSetting($inputs, Setting $setting): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs, $setting){

            if (array_key_exists('logo', $inputs))
            {
                ImageService::deleteImage($setting->logo);
                $inputs['logo'] = ImageService::save($inputs['logo'], 'setting');
            }

            if (array_key_exists('icon', $inputs))
            {
                ImageService::deleteImage($setting->icon);
                $inputs['icon'] = ImageService::save($inputs['icon'], 'setting');
            }

            $setting->update($inputs);
            return $setting->refresh();

        });
    }
}

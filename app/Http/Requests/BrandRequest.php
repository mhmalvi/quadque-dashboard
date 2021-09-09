<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\TUserActivity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BrandRequest extends FormRequest
{
    use TUserActivity {
        userActivity as activity;
    }

    protected function storeThumbnail()
    {
        $image = $this->file('thumbnail');
        $ext = $image->getClientOriginalExtension();
        $filename = Str::slug($this->name) . "." . $ext;

        if (!Storage::exists("public/brands")) {
            Storage::makeDirectory("public/brands");
        }

        Image::make($image->getRealPath())
            ->fit(150)
            ->save(storage_path('app/public/brands/' . $filename));

        return $filename;
    }
}

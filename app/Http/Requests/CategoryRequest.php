<?php

namespace App\Http\Requests;

use App\Helpers\TUserActivity;
use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryRequest extends FormRequest
{
    use TUserActivity {
        userActivity as activity;
    }

    protected function storeThumbnail()
    {
        $image = $this->file('thumbnail');
        $ext = $image->getClientOriginalExtension();
        $filename = Str::slug($this->name) . "." . $ext;

        if (!Storage::exists("public/categories")) {
            Storage::makeDirectory("public/categories");
        }

        Image::make($image->getRealPath())
            ->fit(80)
            ->save(storage_path('app/public/categories/' . $filename));

        return "categories/{$filename}";
    }
}

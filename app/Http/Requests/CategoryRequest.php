<?php

namespace App\Http\Requests;

use App\Models\Activity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryRequest extends FormRequest
{
    protected function userActivity(string $activity): void
    {
        Activity::create([
            'user_id' => Auth::id(),
            'activity' => $activity,
            'ip' => $this->ip(),
            'agent' => $this->header('User-Agent')
        ]);
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

        return $filename;
    }
}

<?php

namespace App\Http\Requests;

use App\Helpers\TUserActivity;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryRequest extends FormRequest
{
    use TUserActivity {
        userActivity as activity;
    }

    /**
     * retrive file extension from base64 string
     */
    private function getOrigianlFileExtension($file)
    {
        $encodedImgString = explode(',', $file, 2)[1];
        $decodedImgString = base64_decode($encodedImgString);
        $info = getimagesizefromstring($decodedImgString);

        $ext = image_type_to_extension($info[2]);

        return $ext;
    }

    /**
     * Make directory if not exist
     */
    private function makeDirectory()
    {
        if (!Storage::exists("public/temp")) {
            Storage::makeDirectory("public/temp");
        }

        if (!Storage::disk('temp')->exists("storage/categories")) {
            Storage::disk('temp')->makeDirectory("storage/categories");
        }
    }

    protected function storeThumbnail()
    {
        $file = $this->thumbnail;
        $extension = $this->getOrigianlFileExtension($file);
        $name = Str::slug($this->name);
        $filename = "{$name}{$extension}";

        /**
         * We will store the image first in our app storage
         * Then transfer the file into ftp
         * Then delete the file for app storage
         */
        $image = Image::make($file)
            ->fit(100)
            ->save(storage_path('app/public/temp/' . $filename));

        Storage::disk('ftp')->put(
            'storage/categories/' . $filename,
            $image
        );

        Storage::delete("public/temp/" . $filename);

        return $filename;
    }

    protected function getSlug()
    {
        $slug = $this->filled('slug') ? Str::slug($this->slug) : Str::slug($this->name);

        $parent = is_null($this->parent) ? null :
            Category::where('uuid', $this->parent)->first();

        if ($parent && !$this->filled('slug')) {
            $slug = Str::slug($parent->slug . ' ' . $slug);
        }

        return $slug;
    }
}

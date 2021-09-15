<?php

namespace App\Http\Requests;

use App\Models\ProductImage;
use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
{
    /**
     * Get the base64 image file extension
     */
    private function getOrigianlFileExtension($file)
    {
        $encodedImgString = explode(',', $file, 2)[1];
        $decodedImgString = base64_decode($encodedImgString);
        $info = getimagesizefromstring($decodedImgString);

        $ext = image_type_to_extension($info[2]);

        return $ext;
    }


    public function storeThumbnailImages()
    {
        $file = $this->thumbnail;
        $name = $this->image_title ? Str::slug($this->image_title) : Str::slug($this->title);
        $extension = $this->getOrigianlFileExtension($file);

        $filename = "{$name}{$extension}";

        if (!Storage::exists("public/thumbnails")) {
            Storage::makeDirectory("public/thumbnails");
        }

        Image::make($file)
            ->fit(1000)
            ->save(storage_path('app/public/thumbnails/' . $filename));

        return $filename;
    }

    /**
     * Storing base64 encoded
     *  image files
     */
    public function storeGallaryImages($product_id)
    {
        $files = $this->images;

        foreach ($files as $key => $file) {

            $filename = Str::slug($this->title) . "({$key})" . $this->getOrigianlFileExtension($file);

            ProductImage::create([
                'product_id' => $product_id,
                'image' => $filename,
                'alt' => $filename,
                'extension' => $this->getOrigianlFileExtension($file),
            ]);

            if (!Storage::exists("public/gallary")) {
                Storage::makeDirectory("public/gallary");
            }

            Image::make($file)
                ->fit(600)
                ->save(storage_path('app/public/gallary/' . $filename));
        }
    }
}

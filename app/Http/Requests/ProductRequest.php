<?php

namespace App\Http\Requests;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductSeo;
use App\Models\UnitType;
use App\Models\ProductVariant;
use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductRequest extends FormRequest
{
    /**
     * Get category id
     */
    protected function getCategoryId()
    {
        return Category::where('slug', $this->category)->first()->id;
    }

    /**
     * Get brand id
     */
    protected function getBrandId()
    {
        return Brand::where('slug', $this->brand)->first()->id;
    }

    /**
     * Get unit type id
     */
    protected function getUnitTypeId()
    {
        return UnitType::where('unit_type', $this->unit_type)->first()->id;
    }

    /**
     * Saving products seos
     */
    protected function saveProductSeo($product_id)
    {
        ProductSeo::create([
            'product_id' => $product_id,
            'keywords' => $this->keywords,
            'tags' => $this->tags,
            'descriptions' => $this->meta_des
        ]);
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

        if (!Storage::disk('ftp')->exists("storage/products")) {
            Storage::disk('ftp')->makeDirectory("storage/products");
        }
    }

    /**
     * store product thumbanil
     * base64 encoded
     */
    protected function storeThumbnailImages()
    {
        $file = $this->thumbnail;
        $name = $this->image_title ? Str::slug($this->image_title) : Str::slug($this->title);
        $extension = $this->getOrigianlFileExtension($file);
        $filename = "{$name}{$extension}";

        $this->makeDirectory();

        /**
         * We will store the image first in our app storage
         * Then transfer the file into ftp
         * Then delete the file for app storage
         */
        $image = Image::make($file)
            ->fit(1000)
            ->save(storage_path('app/public/temp/' . $filename));

        Storage::disk('ftp')->put(
            'storage/products/' . $filename,
            $image
        );

        Storage::delete("public/temp/" . $filename);

        return $filename;
    }

    /**
     * Storing base64 encoded
     *  image files
     */
    protected function storeGallaryImages($product_id)
    {
        $files = $this->images;

        foreach ($files as $key => $file) {
            $filename = Str::slug($this->title) . "_{$key}" . $this->getOrigianlFileExtension($file);

            ProductImage::create([
                'product_id' => $product_id,
                'image' => $filename,
                'alt' => $filename,
                'extension' => $this->getOrigianlFileExtension($file),
            ]);

            $this->makeDirectory();

            /**
             * We will store the image first in our app storage
             * Then transfer the file into ftp
             * Then delete the file for app storage
             */
            $image = Image::make($file)
                ->fit(600)
                ->save(storage_path('app/public/temp/' . $filename));

            Storage::disk('ftp')->put(
                'storage/products/' . $filename,
                $image
            );

            Storage::delete("public/temp/" . $filename);
        }
    }

    protected function saveVariants($product, $variant_data)
    {
        $variants = json_decode($variant_data, true);

        foreach ($variants as $key => $variant) {
            if (
                !empty($variant['price']) ||
                !empty($variant['sku']) ||
                !empty($variant['quantity'])
            ) {
                if ($variant['sku'] == '') {
                    $variant['sku'] = Str::slug($key);
                }

                if ($variant['price'] == '') {
                    $variant['price'] = $product->price;
                }

                if (empty($variant['quantity'])) {
                    $variant['quantity'] = 1;
                }

                ProductVariant::create([
                    'SKU' => $variant['sku'],
                    'product_id' => $product->id,
                    'variant_name' => $key,
                    'price' => $variant['price'],
                    'quantity' => $variant['quantity'],
                ]);
            }
        }
    }
}

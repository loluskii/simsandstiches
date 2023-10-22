<?php

namespace App\Actions;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;

class ProductActions
{
    public static function create($request)
    {
        return DB::transaction(function () use ($request) {
            // Generate SKU with a random number
            $sku = "SKU" . rand(2020, 989990);

            // Create a new Product with mass assignment
            $product = Product::create([
                'sku' => $sku,
                'name' => $request->name,
                'slug' => $request->slug,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'additional_information' => $request->additional_information,
            ]);

            // Create ProductAttributes
            if ($request->has('attributes')) {
                $attributes = collect($request->attributes)->map(function ($attribute) use ($product) {
                    return new ProductAttribute([
                        'attribute_name' => $attribute['attribute_name'],
                        'value' => $attribute['value'],
                    ]);
                });

                $product->attributes()->saveMany($attributes);
            }

            // Upload and save images
            if ($request->has('image')) {
                $product->images()->createMany(array_map(function ($imagefile) use ($product) {
                    $path = $imagefile->storeOnCloudinary($product->slug);
                    return [
                        'thumbnail' => $product->slug,
                        'url' => $path->getSecurePath(),
                    ];
                }, $request->file('image')));

                return true;
            } else {
                return false;
            }
        });
    }

    public static function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            // TODO: Implement the update logic here
            return true;
        });
    }
}

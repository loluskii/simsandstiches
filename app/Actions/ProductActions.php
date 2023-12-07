<?php

namespace App\Actions;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductActions
{
    public static function create($request)
    {
        // dd($request->all());
        return DB::transaction(function () use ($request) {
            // Generate SKU with a random number
            $sku = "SKU" . rand(2020, 989990);

            // Create a new Product with mass assignment
            $product = Product::create([
                'sku' => $sku,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'category_id' => $request->category_id,
                'description' => $request->description,
            ]);

            // Create ProductAttributes
            if ($request->has('attributes')) {
                foreach ($request->collect('attributes') as $value) {
                    $attribute = new ProductAttribute;
                    $attribute->product_id = $product->id;
                    $attribute->attribute_name = $value['attribute_name'];
                    $attribute->value = $value['value'];
                    $attribute->cost = $value['has_extra_cost'] ?? 0;
                    $attribute->save();
                }
            }
            // Upload and save images
            if ($request->has('image_urls')) {
                foreach ($request->collect('image_urls') as $value) {
                    $image = new Image;
                    $image->product_id = $product->id;
                    $image->thumbnail = $product->slug;
                    $image->url = $value;
                    $image->save();
                }
                return true;
            } else {
                return false;
            }
        });
    }

    public static function update($request, $id)
    {
        dd($request->all());
        return DB::transaction(function () use ($request, $id) {

            $product = Product::findOrFail($id);
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'description' => $request->description,
            ]);
            // Remove existing attributes
            $product->attributes()->delete();
            if ($request->has('attributes')) {
                foreach ($request->collect('attributes') as $value) {
                    $attribute = new ProductAttribute;
                    $attribute->product_id = $product->id;
                    $attribute->attribute_name = $value['attribute_name'];
                    $attribute->value = $value['value'];
                    $attribute->cost = $value['has_extra_cost'] ?? 0;
                    $attribute->save();
                }
            }

            $product->images()->delete();
            if ($request->has('image_urls')) {
                foreach ($request->collect('image_urls') as $value) {
                    $image = new Image;
                    $image->product_id = $product->id;
                    $image->thumbnail = $product->slug;
                    $image->url = $value;
                    $image->save();
                }
            }

            return true;
        });
    }
}

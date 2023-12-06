<?php

namespace App\Http\Controllers\Admin;

use App\Actions\ProductActions;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $category = Category::all();
        return view('admin.products.index', compact('products', 'category'));
    }

    public function create(Request $request)
    {

        try {
            $res = ProductActions::create($request);
            if ($res) {
                noty()->addSuccess('Product creation successful');
                return back();
            } else {
                noty()->addError($res);
                return back();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $res = ProductActions::update($request, $id);
            if ($res) {
                return back()->with('success', 'Product updated!');
            } else {
                return back()->with('error', 'An error occured');
            }
        } catch (\Exception $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function activateOrDeactivate($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'status' => $product->status ? 0 : 1,
        ]);
        noty()->addSuccess('Operation successful!');
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        $totalPrice = $product->price;
        $attributes = [];
        foreach ($request->except('_token', 'quantity') as $key => $value) {
            $attribute = ProductAttribute::findOrFail((int) $value);
            if ($attribute) {
                $attributes[$attribute->attribute_name]['value'] = $attribute->value;
                $attributes[$attribute->attribute_name]['cost'] = $attribute->cost;
                $totalPrice += $attribute->cost;
            }
        }

        \Cart::session(Helper::getSessionID())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $totalPrice,
            'quantity' => $request->quantity,
            'attributes' => $attributes,
            'associatedModel' => $product,
        ));
        return back();
    }

    public function update($id)
    {
        \Cart::session(Helper::getSessionID())->update($id, [
            'quantity' => array(
                'relative' => false,
                'value' => request('quantity'),
            ),
        ]);

        return back();
    }

    public function destroy($id)
    {
        $cartItems = \Cart::session(Helper::getSessionID())->remove($id);

        return back();
    }

}

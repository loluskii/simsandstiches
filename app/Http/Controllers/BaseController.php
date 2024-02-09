<?php

namespace App\Http\Controllers;

use App\Models\Custom;
use App\Helpers\Helper;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {

        $this->middleware('force_maintenance');
        if (session()->has('session') == false) {
            session()->put('session', session_create_id());
        }
    }

    public function getSessionID()
    {
        if (!Auth::check()) {
            return 'guest';
        }
        return auth()->id();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::check() && Auth::user()->is_admin == 1) {
        //     return redirect()->route('admin.dashboard');
        // }
        $products = Product::where('status', 1)->take(8)->get();
        $categories = Category::all();
        // if(session()->has('session') == false){
        //     session()->put('session',session_create_id());
        // }
        return view('welcome', compact('products', 'categories'));
    }

    public function viewShop(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();
        $data = $request->all();
        if ($request->has('category')) {
            if ($request->category != "") {
                $category = Category::where('slug', $request->category)->first();
                $checked = $request->category;
                $collection_title = $category->name;
                $products = Product::where('category_id', $category->id)
                    ->where('status', 1)->get();
            } else {
                $products = Product::where('status', 1)->get();
                $collection_title = null;
            }
        } else {
            $products = Product::where('status', 1)->get();
            $collection_title = null;
        }
        // return view('ses.store.index')->with('data', $data)->with('products', $products)->with('categories', $categories)->with('stores', $stores);
        return view('shop.index', compact('products', 'categories', 'collection_title'));
    }

    public function getCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $collection_title = $category->name;
        $products = Product::where('category_id', $category->id)
            ->where('status', 1)->get();
        $categories = Category::all();
        return view('shop.index', compact('products', 'categories', 'collection_title'));
    }

    public function viewProduct($id)
    {
        $product = Product::where('slug', $id)->first();
        $group = $product->attributes->groupBy('attribute_name');
        $similar = Product::where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->where('status', 1)
            ->take(4)
            ->get();
        return view('shop.product-detail', compact('product', 'similar', 'group'));
    }

    public function viewCart()
    {

        $cartTotalQuantity = \Cart::session(Helper::getSessionID())->getContent()->count();
        $cartItems = \Cart::session(Helper::getSessionID())->getContent();
        if (session()->has('session') == false) {
            session()->put('session', session_create_id());
        }
        return view('shop.cart', compact('cartItems', 'cartTotalQuantity'));
    }
}

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
    public function __construct(){

        $this->middleware('force_maintenance');
        if(session()->has('session') == false){
            session()->put('session',session_create_id());
        }
    }

    public function getSessionID(){
        if(!Auth::check()){
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
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return redirect()->route('admin.dashboard');
        }
        $products = Product::take(8)->get();
        $categories = Category::all();
        // if(session()->has('session') == false){
        //     session()->put('session',session_create_id());
        // }
        return view('welcome', compact('products','categories'));
    }

    public function viewShop(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();
        $data = $request->all();
        if ($request->has('category')) {
            if($request->category != ""){
                $category = Category::where('slug',$request->category)->first();
                $checked = $request->category;
                $collection_title = $category->name;
                $products = Product::where('category_id', $category->id)->get();
            }else{
                $products = Product::all();
                $collection_title = null;
            }
        } else {
            $products = Product::all();
            $collection_title = null;
        }
        // return view('ses.store.index')->with('data', $data)->with('products', $products)->with('categories', $categories)->with('stores', $stores);
        return view('shop.index', compact('products','categories','collection_title'));
    }

    public function getCategory($slug){
        $category = Category::where('slug',$slug)->first();
        $collection_title = $category->name;
        $products = Product::where('category_id', $category->id)->get();
        $categories = Category::all();
        return view('shop.index', compact('products','categories','collection_title'));
    }

    public function viewProduct($id)
    {
        $product = Product::where('slug',$id)->first();
        $group = $product->attributes->groupBy('attribute_name');
        $similar = Product::where('id','!=',$product->id)
                            ->where('category_id',$product->category_id)
                            ->take(4)
                            ->get();
        return view('shop.product-detail', compact('product', 'similar','group'));
    }

    public function viewCart(){

        $cartTotalQuantity = \Cart::session(Helper::getSessionID())->getContent()->count();
        $cartItems = \Cart::session(Helper::getSessionID())->getContent();
        if(session()->has('session') == false){
            session()->put('session',session_create_id());
        }
        return view('shop.cart', compact('cartItems', 'cartTotalQuantity'));
    }


    public function storeCustom(Request $request){
        // dd($request->all());
        try {
            if($request->image != null){
                $path = $request->file('image')->storeOnCloudinary('custom_orders');
                $imageUrl =  $path->getSecurePath();
            }
            $res = Custom::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'occassion' => $request->occassion,
                'event_date' => $request->event_date,
                'measurements' => $request->measurements,
                'order_description' => $request->order_desc,
                'budget' => $request->budget,
                'image' => $imageUrl ?? ''
            ]);

            if($res){
                return back()->with('success','Your order has been received. You will recieve a confirmation email soon.');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }







}

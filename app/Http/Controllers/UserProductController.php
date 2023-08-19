<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProductController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()) {
            $categories = Category::withCount('products')->get();
            $products = Product::with('category')->when(request('key'), function ($q) {

                $searchKey = request('key');
                $q->where('name', 'Like', '%' . $searchKey . '%');
            })->paginate(8);
// $products = Product::with('category')->get();
// dd($products->toArray());

            return view('User.Product.product', compact('products', 'categories', ));

        } else {
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            $categories = Category::withCount('products')->get();
            $products = Product::with('category')->when(request('key'), function ($q) {

                $searchKey = request('key');
                $q->where('name', 'Like', '%' . $searchKey . '%');
            })->paginate(8);
// $products = Product::with('category')->get();
// dd($products->toArray());

            return view('User.Product.product', compact('products', 'categories', 'carts'));

        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function filter($id)
    {
        if (!Auth::user()) {
            $categories = Category::withCount('products')->get();
            $products = Product::where('category_id', $id)->when(request('key'), function ($q) {

                $searchKey = request('key');
                $q->where('name', 'Like', '%' . $searchKey . '%');
            })->paginate(8);

            return view('User.Product.product', compact('products', 'categories'));

        } else {
            $carts = Cart::where('user_id', Auth::user()->id)->get();

            $categories = Category::withCount('products')->get();
            $products = Product::where('category_id', $id)->when(request('key'), function ($q) {

                $searchKey = request('key');
                $q->where('name', 'Like', '%' . $searchKey . '%');
            })->paginate(8);

            return view('User.Product.product', compact('products', 'categories', 'carts'));

        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function view(Request $request)
    {
        // dd($request->all());
        $id = $request->id;
        $product = Product::where('id', $id)->first();
        return view('User.Product.view', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(c $c)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index(Request $request){
       $carts =  Cart::all();
        // $carts = Cart::find(2)->product;
    //   $data = Cart::select('carts.*','products.name as product_name','products.image as product_image')->join('products','products.id','carts.product_id')->get();
        // dd($data->toArray());
        // $carts = cart::select('carts.*', 'products.name', 'products.image as product_image', 'products.price as product_price', 'users.name as user_name')
        // ->leftJoin('products', 'carts.product_id', 'products.product_id')
        // ->leftJoin('users', 'carts.user_id', 'users.id')->where('user_id', Auth::user()->id)->get();

    $totalPrice = 0;
    foreach ($carts as $cart) {
        $totalPrice += $cart->getProduct->price * $cart->qty;
    }

    $total = $totalPrice;
    $Total = $totalPrice + 3000;
    //dd($total);
    //dd($carts->toArray());

    //  return view('user.detail.newCart', compact('carts', 'total', 'Total'));
        return view('User.Cart.cart',compact('carts','Total','total'));
    }
    public function delete($id){
        $cart = Cart::where('id',$id)->delete();
        return redirect()->route('user#cart')->with(['success'=>'Delete Success']);
    }
}

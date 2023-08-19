<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\orderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //user
    public function index(Request $request){
        $orders = Order::select('products.*','orders.*')->leftJoin('products','products.id','orders.product_id')->where('user_id',Auth::user()->id)->get();
        // dd($orders->toArray());
        return view('user.Order.order',compact('orders'));
    }
    public function home(Request $request){
        $data = Order::when(request('kye'),function($q){
            $searchKey = request('key');
            $q->where('user_id','Like','%'.$searchKey.'%')->orWhere('product_id','Like','%'.$searchKey.'%')->orWhere('status','Like','%'.$searchKey.'%');
        })->paginate(6);
        return view('Admin.orderList.order',compact('data'));
    }
}

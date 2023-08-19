<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\orderList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function index(Request $request)
    {

        //dd($data->toArray());

        if ($request->status == 'desc') {
            $data = Product::with('category')->orderBy('created_at', 'desc')->get();
        } else {
            $data = Product::with('category')->get();

        }
        return $data;

    }
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $data = [
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'total' => $request->qty * $request->price,
        ];
        // Log::alert($data);
        Cart::create($data);
        return [
            'status' => 'success',
            'message' => 'Add To Cart Complete',
        ];
        // Log::info($data);
    }
    public function order(Request $request){
        Log::info($request->all());
        $total = 0;
        foreach ($request->all() as $item) {
            $data = orderList::create([
                'user_id' => $item['user_id'],
                'product_id' =>$item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code']
            ]);
            $total += $data->total;
        }
        logger($data);
        Order::create([
            'user_id' => Auth::user()->id,
            'product_id' => $data->product_id,
            'total_price' => $total + 3000,
        ]);
        Cart::where('user_id', Auth::user()->id)->delete();
        return \response()->json([
            'status' => 'true',
            'message' => 'order completed',
        ], 200);
    }
    public function status(Request $request){
        Order::where('id', $request->orderId)->update(
            [
                'status' => $request->status,
            ]);
    }
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

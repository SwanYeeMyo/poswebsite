<?php

namespace App\Http\Controllers;

use App\Models\orderList;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    public function index(Request $request){
        $data = orderList::when(request('key'),function($q){
            $searchKey = request('key');
            $q->where('user_id','Like','%'.$searchKey.'%')->orWhere('product_id','Like','%'.$searchKey.'%')
            ->orWhere('order_code','Like','%'.$searchKey.'%');
        })->paginate(10);
        // dd($data->toArray());
        return view('Admin.orderList.orderList',compact('data'));
    }
}

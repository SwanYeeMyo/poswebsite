<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home(Request $request)
    {

        $product = Product::inRandomOrder()->where('category_id', '1')->limit(3)->get();
        $products = Product::orderBy('created_at', 'desc')->where('category_id', '4')->limit(4)->get();

        return view('User.home', compact('product', 'products'));
    }
    public function account(Request $request)
    {
        return view('User.Profile.account');
    }
    public function update(Request $request)
    {
        $id = Auth::user()->id;
        $this->getValidationData($request);

        $data = $this->getUserData($request);

        if ($request->hasFile('image')) {
            $image = User::select('image')->where('id', $id)->first();
            $oldImage = $image->image;
            Storage::delete('public/' . $oldImage);
            $fileName = uniqid() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('user#account')->with(['success' => 'Update Success']);

    }
    private function getValidationData($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:users,name,' . Auth::user()->id,
            'email' => 'required|unique:users,email,' . Auth::user()->id,
            'address' => 'required',
            'phone' => 'required',

        ])->validate();
    }
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,

        ];
    }
}

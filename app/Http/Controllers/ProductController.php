<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function home()
    {
        $categories = Category::all();
        $products = Product::select('products.*', 'categories.name as category_name')
            ->LeftJoin('categories', 'categories.id', 'products.category_id')
            ->when(\request('key'), function ($q) {
                $searchKey = \request('key');
                $q->where('products.name', 'Like', '%' . $searchKey . '%')->orWhere('categories.name', 'Like', '%' . $searchKey . '%');

            })->orderBy('created_at', 'desc')->paginate(5);

        // $products = Product::select('products.*', 'categories.name as category_name')->
        //     LeftJoin('categories', 'categories.category_id', 'products.category_id')->get();

        return view('Admin.product.home', compact('products', 'categories'));
    }
    public function create(Request $request)
    {

        $this->getValidationData($request, "create");
        $data = $this->getData($request);

        if ($request->hasFile('image')) {
            $fileName = \uniqid() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/', $fileName);
            $data['image'] = $fileName;
        }
        Product::create($data);
        return back()->with(['success' => 'Create Success']);

    }

    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::where('id', $id)->first();
        return view('Admin.product.edit', compact('product', 'categories'));
    }
    public function update(Request $request)
    {

        $this->getValidationData($request, "update");
        $data = $this->getData($request);
        if ($request->hasFile('image')) {
            $image = Product::select('image')->where('id', $request->product_id)->first();
            $oldImage = $image->image;
            Storage::delete('public/' . $oldImage);
            $fileName = \uniqid() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/', $fileName);
            $data['image'] = $fileName;
        }
        Product::where('id', $request->product_id)->update($data);
        return redirect()->route('admin#product')->with(['success' => 'Update Success']);
        // dd($request->all());
    }
    public function view($id)
    {

        $categories = Category::all();
        $product = Product::where('id', $id)->first();
        return view('Admin.product.view', compact('product', 'categories'));

    }
    public function delete(Request $request)
    {
        $id = $request->product_id;
        $image = Product::select('image')->where('id', $id)->first();
        $oldImage = $image->image;
        Storage::delete('public/' . $oldImage);
        Product::where('id', $id)->delete();
        return back()->with(['success' => 'Delete Success']);
    }

    private function getData($request)
    {
        return [
            'name' => $request->productName,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
        ];
    }
    private function getValidationData($request, $action)
    {
        $validationRule = [
            'productName' => 'required|unique:products,name,' . $request->product_id,
            'category_id' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,webp|file',
            'price' => 'required',
        ];
        $validationRule['image'] = $action == 'create' ? 'required|mimes:jpg,jpeg,png,webp|file' : '';
        Validator::make($request->all(), $validationRule)->validate();

        // $validationRule = [
        //     'productName' => 'required|unique:products,name,',
        //     'category_id' => 'required',
        //     'description' => 'required',
        //     'price' => 'required',
        //     'image' => 'required|mimes:png,jpeg,webp',
        // ];
        // $validationRule['image'] = $action == "create" ? 'required|mimes:png,jpeg,webp,file' : '';
        // // dd($validationRule);
        // Validator::make($request->all(), $validationRule)->validate();
    }
}

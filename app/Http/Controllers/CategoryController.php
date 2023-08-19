<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function home(Request $request)
    {
        $categories = Category::when(request('key'), function ($query) {
            $searchKey = \request('key');
            $query->orWhere('name', 'like', '%' . $searchKey . '%');
        })->orderBy('created_at', 'desc')->paginate(6);

        // $categories = Category::orderBy('created_at', 'desc')->get();
        return view('Admin.category.category', compact('categories'));
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name',
        ])->validate();
        //dd($request->all());
        $data = [
            'name' => $request->categoryName,
        ];
        Category::create($data);
        return \redirect()->route('category#home')->with(['success' => 'Category Create Success']);
    }
    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('Admin.category.edit', compact('category'));

    }
    public function update(Request $request)
    {
        //dd($request->all());
        $id = $request->category_id;

        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name,' . $id,
        ])->validate();
        $data = [
            'name' => $request->categoryName,
        ];

        Category::where('id', $id)->update($data);
        return \redirect()->route('category#home')->with(['success' => 'Update Successfully']);
    }

    public function delete(Request $request)
    {
        //dd($request->all());
        $id = $request->category_id;
        Category::where('id', $id)->delete();
        return \redirect()->route('category#home')->with(['success' => 'Delete Successfully']);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    function list(Request $request) {

        $admins = User::when(request('key'), function ($q) {
            $searchKey = request('key');
            $q->where('name', 'like', '%' . $searchKey . '%')
                ->orWhere('email', 'like', '%' . $searchKey . '%')
                ->orWhere('role', 'Like', '%' . $searchKey . '%')
                ->orWhere('address', 'Like', '%' . $searchKey . '%');
        })->paginate(6);
        return view('Admin.adminList.home', compact('admins'));
    }
    public function edit($id)
    {
        $admin = User::where('id', $id)->first();
        return view('Admin.adminList.edit', \compact('admin'));
    }
    public function update(Request $request)
    {
        $this->getValidationData($request);
        $data = $this->getUserData($request);
        if ($request->hasFile('image')) {
            $image = User::select('image')->where('id', $request->id)->first();
            $oldImage = $image->image;
            Storage::delete('public/' . $oldImage);
            $fileName = uniqid() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $request->id)->update($data);
        return redirect()->route('admin#list')->with(['success' => 'Update Success']);

    }
    public function delete(Request $request)
    {
        $image = User::select('image')->where('id', $request->admin_id)->first();
        $oldImage = $image->image;
        Storage::delete('public/' . $oldImage);
        User::where('id', $request->admin_id)->delete();
    }
    private function getValidationData($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:users,name,' . $request->id,
            'email' => 'required|unique:users,email,' . $request->id,
            'address' => 'required',
            'phone' => 'required',
            'role' => 'required',
        ])->validate();
    }
    private function getUserData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => $request->role,
        ];
    }
}

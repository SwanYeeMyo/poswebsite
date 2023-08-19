<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function home(Request $request)
    {

        return view('Admin.profile.home');
    }
    public function update(Request $request)
    {

        $this->userValidation($request);
        $data = $this->getUserData($request);
        if ($request->hasFile('adminImage')) {
            $oldimage = User::select('image')->where('id', $request->id)->first();
            $oldImageName = $oldimage->image;

            Storage::delete('public/' . $oldImageName);
            $fileName = \uniqid() . '-' . $request->file('adminImage')->getClientOriginalName();
            $request->file('adminImage')->storeAs('public/', $fileName);
            $data['image'] = $fileName;

        }
        User::where('id', $request->id)->update($data);
        return redirect()->route('admin#home')->with(['successs' => 'Update Successfully']);
    }

    //admin change Password
    public function password()
    {
        return view('Admin.profile.privacy');
    }

    public function changePassword(Request $request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmationPassword' => 'required|same:newPassword',
        ])->validate();
        //oldPassword //$2y$10$f3DuiBR3f2Y7u81bkZt6q.HAk5ZpVew1RUjwE/gt25Hx0tG7x0PB

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbPassword = $user->password;
        if (Hash::check($request->oldPassword, $dbPassword)) {
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id', Auth::user()->id)->update($data);
            return back()->with(['success' => `Password Change Success`]);
        } else {
            return \redirect()->route('admin#password')->with(['success' => `Old password doesn't seem right`]);

        }

    }

    private function getUserData($request)
    {
        return [
            'name' => $request->adminName,
            'email' => $request->adminEmail,
            'address' => $request->adminAddress,
            'phone' => $request->adminPhone,
        ];
    }
    private function userValidation($request)
    {
        Validator::make($request->all(), [
            'adminName' => 'required|unique:users,name,' . $request->id,
            'adminEmail' => 'required',
            'adminAddress' => 'required',
            'adminPhone' => 'required',
        ])->validate();
        // Validator::make($request->all(), [
        //     'adminName' => 'required|unique:users,name',
        //     'adminEmial' => 'required',
        //     'adminAddress' => 'required',
        //     'adminPhone' => 'required',

        // ])->validate();
    }
}

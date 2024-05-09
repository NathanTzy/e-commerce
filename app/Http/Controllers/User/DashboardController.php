<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.user.index');
    }
    public function changePassword()
    {
        $title = 'Change Password';
        return view('pages.user.changepassword', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        // validate
        $this->validate($request, [
            'currentPassword' => 'required',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6'
        ]);

        // check current password status
        $currentPasswordStatus = Hash::check($request->currentPassword, auth()->user()->password);

        if ($currentPasswordStatus) {

            if ($request->password == $request->confirmPassword) {
                // get user login by id
                $user = auth()->user();

                //update new password
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('success', 'password has been updated');
            } else {
                return redirect()->back()->with('errors', 'password doesnt match!');
            }
        } else {
            return redirect()->back()->with('errors', 'Current password is incorrect!');
        }
    }
}

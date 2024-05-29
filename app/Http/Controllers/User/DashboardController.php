<?php

namespace App\Http\Controllers\User;

use App\Models\transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\transaction as ModelsTransaction;

class DashboardController extends Controller
{
    public function index()
    {
        $pending = transaction::where('user_id', auth()->user()->id)->where('status', 'PENDING')->count();
        $settlement = transaction::where('user_id', auth()->user()->id)->where('status', 'SETTLEMENT')->count();
        $expired = transaction::where('user_id', auth()->user()->id)->where('status', 'EXPIRED')->count();
        $success = transaction::where('user_id', auth()->user()->id)->where('status', 'SUCCESS')->count();
        return view('pages.user.index',compact('pending','settlement','expired','success'));
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

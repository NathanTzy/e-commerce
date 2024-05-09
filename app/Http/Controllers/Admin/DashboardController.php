<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $category = category::count();
        $product = product::count();
        $user = User::where('role', 'user')->count();
        $users = User::where('role', 'user')->get();
        return view('pages.admin.index', compact('category', 'product', 'user', 'users'));
    }

    public function resetPassword($id)
    {
        $user = User::find($id);
        $user->password = Hash::make('password'); // Set default password 'password'
        $user->save();
        return redirect()->back()->with('success', 'Password reset successfully.');
    }

    
}

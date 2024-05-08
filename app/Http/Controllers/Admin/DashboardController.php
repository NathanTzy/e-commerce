<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $category = category::count();
        $product = product::count();
        $user = User::where('role','user')->count();
        return view('pages.admin.index', compact('category','product','user'));
    }
}

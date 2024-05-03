<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = category::select('id', 'name', 'image')->latest()->get();
        return view('pages.admin.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image|mimes:png,jpeg,jpg|max:2048',
        ]);
        try {      
            // create category
            $data = $request->all();

            //store image
            $image = $request->file('image');
            $image->storeAs('public/category', $image->hashName());

            $data['image'] = $image->hashName();
            $data['slug'] = Str::slug($request->name);

            category::create($data);

            return redirect()->back()->with('success', 'Success To Add Category');

            // dd($category);

        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', 'Failed To Add Category');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'image' => 'image|mimes:png,jpeg,jpg|max:2048',
        ]);

        try {

            $category = category::find($id);

            if ($request->hasFile('image') == '') {
                $data = $request->all();
                $data['slug'] = Str::slug($request->name);


                $category->update($data);
            } else {
                // delete old image
                Storage::disk('local')->delete('public/category/' . basename($category->image));

                // store new image
                $image = $request->file('image');
                $image->storeAs('public/category', $image->hashName());

                $data = $request->all();
                $data['image'] = $image->hashName();
                $data['slug'] = Str::slug($request->name);

                $category->update($data);
            }
            return redirect()->back()->with('success', 'Success To Edit Category');
        } catch (Exception $e) {
            $e->getMessage();
            return redirect()->back()->with('error', 'Failed To Edit Category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // find category by id
            $category = category::find($id);
            // delete image
            Storage::disk('local')->delete('public/category/' . basename($category->image));
            // delete cat
            $category->delete();
            return redirect()->back()->with('success', 'Success To Delete Category');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed To Delete Category');
        }
    }
}

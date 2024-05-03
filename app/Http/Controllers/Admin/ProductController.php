<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\product;
use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = category::all();
        $product = product::select('id', 'name', 'price', 'category_id', 'description')->latest()->get();
        return view('pages.admin.product.index', compact('product', 'category'));
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
            'price' => 'required',
            'category_id' => 'required',
            'description' => 'required'
        ]);
        try {
            // create prod
            $data = $request->all();

            $data['name'] = $request->name;
            $data['price'] = $request->price;
            $data['slug'] = Str::slug($request->name);
            $data['category_id'] = $request->category_id;
            $data['description'] = $request->description;

            product::create($data);

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
    { {
            $this->validate($request, [
                'name' => 'required',
                'category_id' => 'required',
                'price' => 'required',
                'description' => 'required'
            ]);

            try {

                $product = product::find($id);

                $data = $request->all();

                $data['slug'] = Str::slug($request->name);

                $product->update($data);

                return redirect()->back()->with('success', 'Success To Edit Category');
            } catch (Exception $e) {
                $e->getMessage();
                return redirect()->back()->with('error', 'Failed To Edit Category');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // find prod by id
            $product = product::find($id);
            // delete prod
            $product->delete();
            return redirect()->back()->with('success', 'Success To Delete Category');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed To Delete Category');
        }
    }
}

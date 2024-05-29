<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\transaction;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = transaction::with('user')->select('id', 'user_id','slug','status', 'payment_url', 'payment', 'name', 'email', 'phone', 'total_price')->latest()->get();
        return view('pages.admin.transaction.index', compact('transaction'));
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
        //
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

        //get data transaction by id
        $transaction = transaction::findOrFail($id);

        try {
            $transaction->update([
                'status' => $request->status
            ]);
            return redirect()->route('admin.transaction.index')->with('success', 'Updated');
        } catch (Exception $e) {
            return redirect()->route('admin.transaction.index')->with('error', 'error nyed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function showTransactionBySlugId($slug, $id){

        $transaction = transaction::where('slug', $slug)->where('id', $id)->first();

        // dd($transaction);

        return view('pages.admin.transaction.show', compact('transaction'));
    }
}

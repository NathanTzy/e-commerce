<?php

namespace App\Http\Controllers\frontEnd;

use Exception;
use Midtrans\Snap;
use App\Models\cart;
use Midtrans\Config;
use App\Models\product;
use App\Models\category;
use App\Models\transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\transactionItem;
use App\Http\Controllers\Controller;
use Illuminate\Cache\RateLimiting\Limit;

class frontEndController extends Controller
{

    public function index()
    {
        $category = category::select('id', 'name', 'slug')->latest()->get();
        $product = product::with('product_galleries')->select('id', 'name', 'price', 'slug')->latest()->Limit(5)->get();
        return view('pages.frontEnd.index', compact('category', 'product'));
    }

    public function detailProduct($slug)
    {
        $recom = product::with('product_galleries')->select('id', 'name', 'slug', 'price')->inRandomOrder()->limit(4)->get();
        $category = category::select('id', 'name', 'slug')->latest()->get();
        $product = product::with('product_galleries')->where('slug', $slug)->first();
        return view('pages.frontEnd.detail-product',  compact('product', 'category', 'recom'));
    }

    public function detailCategory($slug)
    {
        $category = category::select('id', 'name', 'slug')->latest()->get();
        $categories = category::where('slug', $slug)->first();
        $product = product::with('product_galleries')->where('category_id', $categories->id)->get();

        return view('pages.frontEnd.parent.detail-category', compact('categories', 'category', 'product'));
    }
    public function cart()
    {
        $category = category::Select('id', 'name', 'slug')->latest()->get();
        $cart = cart::with('product')->where('user_id', auth()->user()->id)->latest()->get();
        return view('pages.frontEnd.parent.cart', compact('category', 'cart'));
    }
    public function addToCart(Request $request, $id)
    {
        try {
            cart::Create([
                'product_id' => $id,
                'user_id' => auth()->user()->id
            ]);
            return redirect()->route('cart');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'blog');
        }
    }
    public function deleteCart($id)
    {
        try {
            cart::findOrFail($id)->delete();
            return redirect()->route('cart');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'blog');
        }
    }
    public function checkOut(Request $request)
    {
        try {
            // request data
            $data = $request->all();
            // get cart user
            $cart = cart::with('product')->where('user_id', auth()->user()->id)->get();
            // dd data cart
            // dd($cart);

            // create transaction
            $transaction = transaction::create([
                'user_id' => auth()->user()->id,
                'name' => $data['name'],
                'slug'=>Str::slug($data['name']) . '-' . time(),
                'email' => $data['email'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'total_price' => $cart->sum('product.price')
            ]);

            // create transaction item
            foreach ($cart as $item) {
                transactionItem::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $item->product_id,
                    'transaction_id' => $transaction->id
                ]);
            }

            // delete cart
            cart::where('user_id', auth()->user()->id)->delete();

            // config midtrans
            // use midtrans\config;
            // use midtrans\snap;
            Config::$serverKey = config('services.midtrans.serverKey');
            Config::$isProduction = config('services.midtrans.isProduction');
            Config::$isSanitized = config('services.midtrans.isSanitized');
            Config::$is3ds = config('services.midtrans.is3ds');
            Config::$clientKey = config('services.midtrans.clientKey');

            // setup variable for midtrans
            $midtrans = [
                'transaction_details' => [
                    'order_id' => ' NathanTzy' . $transaction->id,
                    'gross_amount' => (int) $transaction->total_price
                ],
                'customer_details' => [
                    'first_name' => $transaction->name,
                    'email' => $transaction->email,
                    'phone' => $transaction->phone
                ],
                'enable_payments' => ['gopay', 'bank_transfer'],
                'vtweb' => []

            ];
            // create payment url from midtrans
                $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

                // update payment url
                $transaction->update([
                    'payment_url'=>$paymentUrl
                ]);
                return redirect($paymentUrl);

        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->back();
        }
    }
}

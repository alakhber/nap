<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('front.index', compact('products'));
    }


    public function shop()
    {
        $shops = ProductOrder::select('id', 'product_id', 'user_id', 'price','count')->where('user_id', auth()->user()->id)->with('product:id,name')->paginate(10);

        return view('front.shop', compact('shops'));
    }

    public function addOrder(Request $request)
    {
        $rules = [
            'shop_id' => ['required', 'integer', 'exists:product_orders,id'],
        ];
        $messages = [
            'shop_id.required' => 'Səbət Üçün Məhsul Seçilməyib !',
            'shop_id.integer' => 'Məhsul Məlumatı Düzgün Deyil !',
            'shop_id.exists' => 'Məhsul Mövcud Deyil !',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->toArray()['product_id'][0]);
        }


        $productOrder = ProductOrder::find($request->shop_id);
        $product  = Product::find($productOrder->product_id);
        
        Order::create([
            'product_id' => $productOrder->product_id,
            'user_id' => auth()->user()->id,
            'product_name' => $product->name,
            'user_name' => auth()->user()->name,
            'price'=>$productOrder->price,
            'count'=>$productOrder->count,
        ]);

        return back()->with('success', 'Sifarisiniz Qəbul Olundu !');
    }

    public function getOrder(){
        $orders = Order::with('product','user')->paginate(10);
        return view('admin.home.order',compact('orders'));
    }
}

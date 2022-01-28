<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    public function addProduct(Request $request)
    {

        $rules = [
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ];
        $messages = [
            'product_id.required' => 'Səbət Üçün Məhsul Seçilməyib !',
            'product_id.integer' => 'Məhsul Məlumatı Düzgün Deyil !',
            'product_id.exists' => 'Məhsul Mövcud Deyil !',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->toArray()['product_id'][0]);
        }

        $product = Product::find($request->product_id);
        $price = is_null($product->discount) ? $product->price : $product->price - $product->discount;

        $productOrder = ProductOrder::where([['product_id', $request->product_id], ['user_id', auth()->user()->id]])->first();
        if (!is_null($productOrder)) {
            $productOrder->update(['price' => $productOrder->price + $price]);
            $productOrder->increment('count');

            return back()->with('success', 'Məhsul Səbətə Əlavə Olundu !');
        }

        ProductOrder::create([
            'product_id' => $request->product_id,
            'user_id' => auth()->user()->id,
            'price' => $price
        ]);

        return back()->with('success', 'Məhsul Səbətə Əlavə Olundu !')->with('errorValidation', false);
    }

    public function removeProduct(Request $request)
    {
        $rules = [
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ];
        $messages = [
            'product_id.required' => 'Səbət Üçün Məhsul Seçilməyib !',
            'product_id.integer' => 'Məhsul Məlumatı Düzgün Deyil !',
            'product_id.exists' => 'Məhsul Mövcud Deyil !',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->toArray()['product_id'][0]);
        }

        $productOrder = ProductOrder::where([['product_id', $request->product_id], ['user_id', auth()->user()->id]])->first();
        
        $productOrder->delete();

        return back()->with('success', 'Məhsul Səbətdən Silindi !');
    }

    public function increment(Request $request)
    {

        $rules = [
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ];
        $messages = [
            'product_id.required' => 'Səbət Üçün Məhsul Seçilməyib !',
            'product_id.integer' => 'Məhsul Məlumatı Düzgün Deyil !',
            'product_id.exists' => 'Məhsul Mövcud Deyil !',
            'product_id.exists' => 'Məhsul Səbətdə Mövcud Deyil !',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->toArray()['product_id'][0]);
        }

        $productOrder = ProductOrder::where([['product_id', $request->product_id], ['user_id', auth()->user()->id]])->first();
        if(is_null($productOrder)){
            return back()->with('error', 'Səbətdə Məhsul Mövcud Deyil !');
        }
        $productOrder->increment('count');

        return back()->with('success', 'Məhsulun Sayı Artırıld!');
    }

    public function decrement(Request $request)
    {

        $rules = [
            'product_id' => ['required', 'integer', 'exists:products,id', 'exists:product_orders,product_id'],
        ];
        $messages = [
            'product_id.required' => 'Səbət Üçün Məhsul Seçilməyib !',
            'product_id.integer' => 'Məhsul Məlumatı Düzgün Deyil !',
            'product_id.exists' => 'Məhsul Mövcud Deyil !',
            'product_id.exists' => 'Məhsul Səbətdə Mövcud Deyil !',

        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->toArray()['product_id'][0]);
        }

        $productOrder = ProductOrder::where([['product_id', $request->product_id], ['user_id', auth()->user()->id]])->first();
        if(is_null($productOrder)){
            return back()->with('error', 'Səbətdə Məhsul Mövcud Deyil !');
        }
        if($productOrder->count<2){
            return back()->with('error', 'Məhsul Sayı Birdən Az Olmamalıdır !');
        }
        $productOrder->decrement('count');

        return back()->with('success', 'Məhsulun Sayı Artırıld!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::paginate(10);
        
        return view('admin.product.index',compact('products'));
    }


    public function create()
    {
        return view('admin.product.new');
    }

    public function store(StoreProductRequest $request)
    {
        try {
            Product::create($request->validated());
            return redirect()->back()->with('success','Məhsul Uğurla Əlavə Olundu !');
        } catch (Exception $e) {
            return redirect()->back()->with('error','Məhsul Əlavə Olunmadı !');
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);

        return view('admin.product.edit',compact('product'));
    }


    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = Product::find($id);
            if (is_null($product)) {
                return redirect()->back()->with('error','Məhsul Tapılmadı !');
            }
            $product->update($request->validated());
            return redirect()->back()->with('success','Məhsul Uğurla Redaktə Olundu !');
        } catch (Exception $e) {
            return redirect()->back()->with('error','Məhsul Redaktə Olunmadı !');
        }
        
    }


    public function destroy($id)
    {
        try {
            $product =  Product::find($id);
            if (is_null($product)) {
                return redirect()->back()->with('error','Məhsul Tapılmadı !');
            }
            $product->delete();
            return redirect()->back()->with('success','Məhsul Uğurla Silindi !');
        } catch (Exception $e) {
            return redirect()->back()->with('error','Məhsul Silinmədi!');
        }
    }
}

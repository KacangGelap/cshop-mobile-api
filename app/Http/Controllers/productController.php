<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\earning;
class productController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index')->with('product',product::simplePaginate(15));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => 'required|string|max:20',
            'description' => 'required|string|max:50',
            'stock' => 'required|numeric|min:1|max:10000',
            'price' => 'required|numeric|min:5000',
            'image' => 'required|mimes:jpg,jpeg,png,bmp|max:3056',
        ]);
        try {
            $item = new product();
            $item->product = $request->input('product');
            $item->description = $request->input('description');
            $item->stock = $request->input('stock');
            $item->price = $request->input('price');
            $item->image = base64_encode(file_get_contents($request->file('image'))); 
            $item->category_id = 1;
            $item->save();
        } catch (\Throwable $th) {
            // throw $th;
            // return redirect()->route('home')->with('fail','Error Encountered');
        }
        return redirect()->route('product.index')->with('success','Product created successfuly');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

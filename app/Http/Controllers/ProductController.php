<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(5);
      
        return view('products.index',data: compact('products'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
      
        Product::create($request->all());
       
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
      
        $product->update($request->all());
      
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
       
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function saveProductCat(Request $request){
        $request->validate([
            'name' => 'required|unique:product-cats',
        ]);
        ProductCat::create($request->all());
        return response()->json(['message' => 'Product Category information saved successfully'], 201);
    
    }
    
    public function saveProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products',
            'price' => 'required|numeric',
            'cat_id' => 'required|integer'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        
        Product::create($request->all());
        return response()->json(['message' => 'Product information saved successfully'], 201);
    
    }

    public function getProduct(Request $request){
        //from product category model one to many
        $product_cats = ProductCat::with('products')->get();
        //from product model one to one
        $products = Product::with('category')->get();
        return response()->json(['message' => 'Product information get successfully','data'=>$products], 201);
    
    }
}

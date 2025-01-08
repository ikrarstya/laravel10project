<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
 
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->get();
  
        return view('products.index', compact('product'));
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
        Product::create($request->all());
 
        return redirect()->route('products')->with('success', 'Product added successfully');
    }
  
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
  
        return view('products.show', compact('product'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
  
        return view('products.edit', compact('product'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
  
        $product->update($request->all());
  
        return redirect()->route('products')->with('success', 'product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
  
        $product->delete();
  
        return redirect()->route('products')->with('success', 'product deleted successfully');
    }

    public function getData(): JsonResponse
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function addData(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string',
            'price' => 'required|numeric',
            'product_code' => 'required|string|unique:products',
            'description' => 'nullable|string',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function getDetail($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function updateData(Request $request, $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'title' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'product_code' => 'sometimes|required|string|unique:products,product_code,' . $product->id,
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());
        return response()->json($product);
    }

    public function deleteData($id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|string|max:255',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:png,jpg,jpeg,svg',
        ]);
        DB::beginTransaction();

        try {
            if ($request->hasFile('photo')) {
                $pathPhoto = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $pathPhoto;
            }
            $validated['slug'] = Str::slug($request->name);
            Product::create($validated);
            DB::commit();
            return to_route('admin.products.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!', $e->getMessage()]
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|string|max:255',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'photo' => 'sometimes|image|mimes:png,jpg,jpeg,svg',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('photo')) {
                if (Storage::disk('public')->exists($product->photo)) {
                    Storage::disk('public')->delete($product->photo);
                }
                $photoPath = $request->file('photo')->store('product_photos', 'public');
                $validated['photo'] = $photoPath;
            }
            $validated['slug'] = Str::slug($request->name);
            $product->update($validated);
            DB::commit();
            return to_route('admin.products.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $erro = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()]
            ]);
            throw $erro;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            if (Storage::disk('public')->exists($product->photo)) {
                Storage::disk('public')->delete($product->photo);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}

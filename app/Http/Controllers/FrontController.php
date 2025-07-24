<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTransaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        $mostSoldProducts = TransactionDetail::join('product_transactions', 'transaction_details.product_transaction_id', '=', 'product_transactions.id')
            ->select('transaction_details.product_id', DB::raw('COUNT(*) as total'))
            ->where('product_transactions.is_paid', 1)
            ->groupBy('transaction_details.product_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        $products = Product::with('category')->orderBy('created_at', 'desc')->take(6)->get();
        $categories = Category::all();
        return view('front.index', [
            'products' => $products,
            'categories' => $categories,
            'mostSoldProducts' => $mostSoldProducts
        ]);
    }

    public function show(Product $product)
    {
        return view('front.show', compact('product'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::where('title', 'LIKE', '%' . $keyword . '%')->get();

        return view('front.search', [
            'products' => $products,
            'keyword' => $keyword
        ]);
    }

    public function category(Category $category)
    {
        $products = $category->products()->get();

        return view('front.category', [
            'products' => $products,
            'category' => $category
        ]);
    }
}

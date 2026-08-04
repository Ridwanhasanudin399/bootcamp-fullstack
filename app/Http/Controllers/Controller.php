<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $page_title = "Beranda - WebDev App";
        
        // Ambil filter dari request
        $search = $request->input('search');
        $category = $request->input('category');

        // Ambil daftar kategori unik untuk dropdown filter
        $categories = Product::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->orderBy('category')
            ->pluck('category');

        // Query produk menggunakan Eloquent dengan Query Builder
        $products = Product::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->when($category, function ($query, $category) {
                return $query->where('category', $category);
            })
            ->paginate(12)
            ->withQueryString(); // Mempertahankan query string saat ganti halaman

        return view('products.index', compact('page_title', 'products', 'categories', 'search', 'category'));
    }
}



<!-- <?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
} -->

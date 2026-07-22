<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageKitService;

class ProductController extends Controller
{
    // User: Home Page
    public function home()
    {
        $products = Product::latest()->take(4)->get();
        return view('home', compact('products'));
    }

    // User: All Products
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('brand') && $request->brand != 'all') {
            $query->where('brand', $request->brand);
        }

        $products = $query->latest()->get();
        $brands = Product::select('brand')->distinct()->pluck('brand');

        return view('products.index', compact('products', 'brands'));
    }

    // Admin: List
    public function adminIndex()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // Admin: Create Form
    public function create()
    {
        return view('admin.products.create');
    }

    // Admin: Store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $uploadResult = ImageKitService::upload($request->file('image'));

        if (!$uploadResult['success']) {
            return back()->withErrors(['image' => 'خطأ أثناء الرفع لـ ImageKit: ' . $uploadResult['error']])->withInput();
        }

        $path = $uploadResult['url'];

        Product::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'image' => $path,
            'type' => $request->brand, // Using brand as type for now or separate field
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully.');
    }

    // Admin: Delete
    public function destroy(Product $product)
    {
        if ($product->image && !filter_var($product->image, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}

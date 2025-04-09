<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function list(Request $request)
    {
        $query = Product::with('category')->where('status', 1);

        // Tìm kiếm theo tên
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo khoảng giá
        if ($request->has('price_range') && $request->price_range != '') {
            switch ($request->price_range) {
                case 'under_500':
                    $query->where('price', '<', 500000);
                    break;
                case '500_1000':
                    $query->whereBetween('price', [500000, 1000000]);
                    break;
                case 'above_1000':
                    $query->where('price', '>', 1000000);
                    break;
            }
        }

        $products = $query->orderBy('id', 'desc')->paginate(6);

        return view('client.list', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Lấy các sản phẩm cùng danh mục, loại trừ sản phẩm hiện tại
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Loại bỏ sản phẩm hiện tại
            ->get();

        return view('client.show', compact('product', 'relatedProducts'));
    }
}

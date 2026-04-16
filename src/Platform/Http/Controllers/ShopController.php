<?php

declare(strict_types=1);

namespace Meubleo\Platform\Http\Controllers;

use Illuminate\Http\Request;
use Meubleo\Platform\Models\Category;
use Meubleo\Platform\Models\Product;
use Meubleo\Platform\Services\CartService;

class ShopController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function home()
    {
        return view('meubleo::shop.home', [
            'featured'   => Product::active()->featured()->inStock()->with('primaryImage','category')->take(8)->get(),
            'categories' => Category::withCount('products')->get(),
            'newArrivals'=> Product::active()->inStock()->with('primaryImage')->latest()->take(4)->get(),
        ]);
    }

    public function index(Request $request)
    {
        $query = Product::active()->with('primaryImage','category');

        if ($request->category) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }
        if ($request->search) {
            $s = $request->search;
            $query->where(fn ($q) => $q->where('name','like',"%$s%")->orWhere('description','like',"%$s%"));
        }
        if ($request->min_price) $query->where('price','>=',$request->min_price);
        if ($request->max_price) $query->where('price','<=',$request->max_price);

        $query->orderBy(match($request->sort) {
            'price_asc'  => 'price',
            'price_desc' => 'price',
            'newest'     => 'created_at',
            default      => 'name',
        }, str_contains($request->sort ?? '', 'desc') ? 'desc' : 'asc');

        return view('meubleo::shop.index', [
            'products'   => $query->paginate(config('meubleo.products_per_page',12))->withQueryString(),
            'categories' => Category::all(),
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::active()->with('images','category')->where('slug',$slug)->firstOrFail();
        $related = Product::active()->where('category_id',$product->category_id)
            ->where('id','!=',$product->id)->with('primaryImage')->take(4)->get();

        return view('meubleo::shop.show', compact('product','related'));
    }
}

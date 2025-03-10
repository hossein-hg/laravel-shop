<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Content\Page;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\ContentCategory\Entities\PostCategory;

class HomeController extends Controller
{
    public function home()
    {

        $slideShowImages = Banner::query()->where('position',0)->where('status',1)->get();
        $topBanners = Banner::query()->where('position',1)->where('status',1)->take(2)->get();

        $middleBanners = Banner::query()->where('position',2)->where('status',1)->take(2)->get();
        $bottomBanner = Banner::query()->where('position',3)->where('status',1)->first();

        $brands = Brand::all();
        $mostVisitedProducts = Product::query()->latest()->take(10)->get();
        $offerProducts = Product::query()->latest()->take(10)->get();
        return view('customer.home',compact(['slideShowImages','topBanners','middleBanners','bottomBanner','brands','mostVisitedProducts','offerProducts']));
    }





    public function products(Request $request,ProductCategory $category=null)
    {
        if ($category){
            $productModel = $category->products();
        }
        else{
            $productModel = new Product();
        }
        switch ($request->sort){
            case 1:
                $column = 'created_at';
                $direction = 'DESC';
                break;
            case 2:
                $column = 'price';
                $direction = 'DESC';
                break;
            case 3:
                $column = 'price';
                $direction = 'ASC';
                break;
            case 4:
                $column = 'view';
                $direction = 'DESC';
                break;
            case 5:
                $column = 'sold_number';
                $direction = 'DESC';
                break;
            default:
                $column = 'created_at';
                $direction = 'ASC';
        }
        if ($request->filled('search')){
            $query = $productModel->where('name','LIKE','%'.$request->search.'%')->orderBy($column,$direction);

        }
        else{

            $query = $productModel->orderBy($column,$direction);
        }
        $brands = Brand::all();
        $categories = ProductCategory::query()->where('parent_id',null)->get();


        $products = $request->max_price && $request->min_price ? $query->whereBetween('price',[$request->min_price,$request->max_price]) :$query->when($request->min_price,function ($query)use($request){
            $query->where('price','>=',$request->min_price)->get();
        })->when($request->max_price,function ($query)use($request){
            $query->where('price','<=',$request->max_price)->get();
        });
        $products = $products->when($request->brands,function ()use ($request,$products){
            $products->whereIn('brand_id',$request->brands);
        });
        $products = $products->paginate(10);
        $products->appends($request->query());
        return view('customer.products',compact('products','brands','categories'));
    }

    public function page(Page $page)
    {
        return view('customer.page',compact('page'));

    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CustomerAddress;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Place;
use App\Models\Product;
use App\Models\User;
use App\Models\VariantAttribute;
use Attribute;
use Illuminate\Http\Request;
use Auth;
class FrontendController extends Controller
{
    public function home()
    {
        $banners = Banner::activeBanner('main-banner');
        $second_banners = Banner::activeBanner('2nd-banner');
        $third_banners = Banner::activeBanner('3rd-banner');

        $new_products = Product::activeNewProducts();
        $offer_products = Product::activeTopOfferProducts();
        $repair_tools = Product::activeRepairToolOfferProducts();
        $accessories = Product::activeAccessoryOfferProducts();
        $spair_parts = Product::activeSpairPartOfferProducts();
        $popular_categories = Category::popularCategories();
        $popular_products = Product::activePopularProducts();
        $featured_products = Product::activeFeaturdProducts();

        $brands = Brand::activeBrands();
        // print_r(json_encode($offer_products));
       return view('frontend.home', compact('popular_products', 'featured_products', 'brands','second_banners','banners', 'new_products', 'offer_products', 'repair_tools', 'spair_parts', 'accessories', 'popular_categories', 'third_banners'));
    }

    public function shop(Request $request, $slug_1 = null, $slug_2 = null)
    {
        //dd($request->all());

        $page = Page::where(['slug' => $slug_1])->first();
        if($page) {
            return $this->renderPage($page);
        }

        $filters = VariantAttribute::where('status', 'active')->get();
        dd($filters);
        $brands = Brand::where('status', 'active')->get();
        $filter_categories = [];
       
        array_push($filter_categories, $slug_1);
        if($slug_2 != null) {
            array_push($filter_categories, $slug_2);
        }
        $res = compact('filters', 'brands', 'request', 'slug_1', 'slug_2', 'filter_categories');
        dd($res);
        return view('frontend.shop', compact('filters', 'brands', 'request', 'slug_1', 'slug_2', 'filter_categories'));
    }

    private function renderPage($page) {
        return view('frontend.page', compact('page'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function faq()
    {
        $faqs = Faq::orderBy('sequance')->get();
        return view('frontend.faq', compact('faqs'));
    }

    public function checkout()
    {
        $addresses = [];
        if(Auth::check()) {
            $addresses = CustomerAddress::get();
        }
        $states = Place::where('type', 'state')->get();
        $stores = User::where('type', 'store')->where('status', 'active')->get();
    
        return view('frontend.checkout', compact('addresses', 'states', 'stores'));
    }

    public function thanks()
    {
        return view('frontend.thank');
    }

    public function paymentFailed()
    {
        return view('frontend.payment_failed');
    }

}

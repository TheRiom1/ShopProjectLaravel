<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\AppDownloadSection;
use App\Models\BannerSlider;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Contact;
use App\Models\Counter;
use App\Models\Coupon;
use App\Models\DailyOffer;
use App\Models\PrivacyPolicy;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\Reservation;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\Subscriber;
use App\Models\Testimonial;
use App\Models\TramsAndCondition;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Mail;

use function Ramsey\Uuid\v1;

class FrontendController extends Controller
{
    function index() : View {
         $sectionTitles = $this->getSectionTitles();
         $sliders = Slider::where('status', 1)->get();
         $whyChooseUs = WhyChooseUs::where('status', 1)->get();
         $categories = Category::where(['show_at_home' => 1, 'status' => 1])->get();
         return view('frontend.home.index',
                compact(
                    'sliders',
                    'sectionTitles',
                    'whyChooseUs',
                    'categories'
                ));
    }

    function getSectionTitles() : Collection {
        $keys = [
            'why_choose_top_title',
            'why_choose_main_title',
            'why_choose_sub_title',
            // 'daily_offer_top_title',
            // 'daily_offer_main_title',
            // 'daily_offer_sub_title',
            // 'chef_top_title',
            // 'chef_main_title',
            // 'chef_sub_title',

        ];


        return SectionTitle::whereIn('key', $keys)->pluck('value','key');
     }

    // function chef() : View {
    //     $chefs = Chef::where(['status' => 1])->paginate(12);
    //     return view('frontend.pages.chefs', compact('chefs'));
    // }



    function about() : View {
        $keys = [
            'why_choose_top_title',
            'why_choose_main_title',
            'why_choose_sub_title',
            'chef_top_title',
            'chef_main_title',
            'chef_sub_title',
            'testimonial_top_title',
            'testimonial_main_title',
            'testimonial_sub_title'
        ];

        $sectionTitles = SectionTitle::whereIn('key', $keys)->pluck('value','key');;
        $about = About::first();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();


        return view('frontend.pages.about', compact('about', 'whyChooseUs'));
    }

    function contact() : View {
        $contact = Contact::first();
        return view('frontend.pages.contact', compact('contact'));
    }

    function showProduct(string $slug) : View {

         $product = Product::with(['productImages', 'productSizes', 'productOptions'])->where(['slug' => $slug, 'status' => 1])

        ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)->take(8)

            ->latest()->get();

        return view('frontend.pages.product-view', compact('product', 'relatedProducts'));
    }

    function loadProductModal($productId) {
        $product = Product::with(['productSizes', 'productOptions'])->findOrFail($productId);

        return view('frontend.layouts.ajax-files.product-popup-modal', compact('product'))->render();
    }

}

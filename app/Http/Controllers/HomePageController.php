<?php

namespace App\Http\Controllers;

use App\Models\Miscs;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Models\AboutUsBanner;
use App\Models\AboutUsConfig;

class HomePageController extends Controller
{
    //



    public function index()
    {


        // Get Data Details
        $aboutConfig = AboutUsConfig::with(['homeAboutUs', 'rightImage'])->where('isVisible', true)->get();
        $aboutUsBanner = AboutUsBanner::with(['bannerImage', 'bannerBars'])->get();
        $seoDetails = Miscs::first();
        $portfolio = Portfolio::get();

        return view('livewire.pages.home', compact('aboutConfig', 'aboutUsBanner', 'portfolio', 'seoDetails'));
    }

    public function about_us()
    {

        $testimonials = 'Testimonials';

        $description = 'See what our clients say about us.';
        $seoDetails = Miscs::first();



        return  view('livewire.pages.about-us', compact('testimonials', 'description', 'seoDetails'));
    }

    public function services()
    {
        $seoDetails = Miscs::first();

        $pageHeader = 'Lee </span><span class="text-yellow-500"> Marketing </span>Services:';

        $headerDescription = 'Lee Marketing services is specialized in alot of services, we pride
                    ourselves in delivering the best';

        return view('livewire.pages.services', compact('pageHeader', 'headerDescription', 'seoDetails'));
    }

    public function join_us()
    {
        $seoDetails = Miscs::first();
        return view('livewire.pages.join-us', compact('seoDetails'));
    }

    public function view_post($title)
    {
        return view('livewire.actions.view-post', ['title' => $title]);
    }

}

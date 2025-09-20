<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Analytics\SEOAnalytics;
use App\Services\SeoAnalytics\SeoAnalyzerServices;
use Illuminate\Http\Request;


class SEOAnalysisController extends Controller
{
    //

    protected $seo;

    public function __construct(SeoAnalyzerServices $seo)
    {
        $this->seo = $seo;
    }

    public function analyzeBlog(Request $request)
    {
        $url = $request->input('url');
        $keyword = $request->input('keyword');




        // Scrape Blog meta

        $html = file_get_contents($url);
        preg_match('/<title>(.*?)<\/title>/', $html, $title);
        preg_match('/<meta name="description" content="(.*?)"/', $html, $description);



        // Call Apis for ranking

        $rank = $this->seo->getGoogleRank($url, $keyword);

        // Save In Db

        SEOAnalytics::create([
            'url' => $url,
            'title' => $title[1],
            'keyword' => $keyword,
            'snippet' => $description[1],
            'rank' => $rank
        ]);


        return redirect()->back()->with('success', 'SEO analysis complete');

    }
}

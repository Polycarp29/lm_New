<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Tags;
use App\Models\Task;
use App\Models\Quote;
use App\Models\Payment;
use App\Models\Pricing;
use App\Policies\AccountDetailsPolicy;
use App\Policies\Roles;
use App\Models\Category;
use App\Models\Services;
use App\Models\BannerBars;
use App\Models\TaskCategory;
use App\Policies\TagsPolicy;
use App\Models\AboutUsBanner;
use App\Models\AboutUsConfig;
use App\Policies\TasksPolicy;
use App\Policies\Testimonials;
use App\Models\RightAboutUsImg;
use App\Policies\PricingPolicy;
use App\Policies\PaymentsPolicy;
use App\Policies\ServicesPolicy;
use App\Policies\ViewQoutePolicy;
use App\Models\MiddleAboutSection;
use App\Policies\BannerBarsPolicy;
use Spatie\Permission\Models\Role;
use App\Policies\PermissionsPolicy;
use App\Policies\TaskCategoryPolicy;
use App\Policies\AboutUsBannerPolicy;
use App\Policies\AboutUsConfigPolicy;
use App\Policies\CategoryResourcePolicy;
use App\Policies\RightAboutUsImgsPolicy;
use Spatie\Permission\Models\Permission;
use App\Filament\Resources\CategoryResource;
use App\Models\Testimonials as ModelsTestimonials;
use App\Filament\Resources\QuoteResource\Pages\ViewQuote;
use App\Models\AccountDetails;
use App\Models\UpperAboutSection;
use App\Policies\MiddleAboutSection as PoliciesMiddleAboutSection;
use App\Policies\UpperAboutSection as PoliciesUpperAboutSection;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        AboutUsBanner::class => AboutUsBannerPolicy::class,
        BannerBars::class => BannerBarsPolicy::class,
        Permission::class => PermissionsPolicy::class,
        Role::class => Roles::class,
        Category::class => CategoryResourcePolicy::class,
        Tags::class => TagsPolicy::class,
        Quote::class => ViewQoutePolicy::class,
        Services::class => ServicesPolicy::class,
        Task::class => TasksPolicy::class,
        Payment::class => PaymentsPolicy::class,
        Pricing::class => PricingPolicy::class,
        TaskCategory::class => TaskCategoryPolicy::class,
        ModelsTestimonials::class => Testimonials::class,
        RightAboutUsImg::class => RightAboutUsImgsPolicy::class,
        AboutUsConfig::class => AboutUsConfigPolicy::class,
        MiddleAboutSection::class => PoliciesMiddleAboutSection::class,
        UpperAboutSection::class => PoliciesUpperAboutSection::class,
        AccountDetails::class => AccountDetailsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}

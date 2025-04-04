<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\GeneralSetting\Entities\Setting;
use Modules\Language\Entities\Language;
use Modules\Page\Entities\HomePage;
use Modules\Page\Entities\CustomPage;
use Modules\GeneralSetting\Entities\GoogleRecaptcha;
use Modules\GeneralSetting\Entities\GoogleAnalytic;
use Modules\GeneralSetting\Entities\FacebookPixel;
use Modules\GeneralSetting\Entities\TawkChat;
use Modules\GeneralSetting\Entities\CookieConsent;
use Modules\Currency\app\Models\MultiCurrency;
use Modules\Blog\Entities\Blog;
use View;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Session::put('admin_lang', 'en');

        View::composer('*', function($view){
            $setting = Setting::first();
            $language_list = Language::where('status', 1)->get();
            $currency_list = MultiCurrency::where('status', 'active')->get();
            $google_recaptcha = GoogleRecaptcha::first();
            $custom_pages = CustomPage::where('status', 1)->get();
            $google_analytic = GoogleAnalytic::first();
            $facebook_pixel = FacebookPixel::first();
            $tawk_chat = TawkChat::first();
            $cookie_consent = CookieConsent::first();
            $footer_blogs = Blog::where('status', 1)->orderBy('id','desc')->get()->take(2);

            $view->with('breadcrumb', $setting->breadcrumb_image);
            $view->with('setting', $setting);
            $view->with('language_list', $language_list);
            $view->with('currency_list', $currency_list);
            $view->with('google_recaptcha', $google_recaptcha);
            $view->with('custom_pages', $custom_pages);
            $view->with('google_analytic', $google_analytic);
            $view->with('facebook_pixel', $facebook_pixel);
            $view->with('tawk_chat', $tawk_chat);
            $view->with('cookie_consent', $cookie_consent);
            $view->with('footer_blogs', $footer_blogs);
        });
    }
}

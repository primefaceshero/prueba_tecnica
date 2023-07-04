<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Shop extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'domain',
        'theme',
        'tax',
        'include_tax',
        'active',
        'created_at',
        'updated_at',
    ];

    public static function findBySlug($slug): Shop
    {
//        Log::info('findBySlug', [$slug]);

        return new Shop([
            "id" => 1,
            "name" => "prueba",
            "slug" => "prueba",
            "domain" => "/prueba",
            "logo" => null,
            "theme" => "{{ env('APP_URL_CDN', '') }}/themes/intranet/themes/type-e/theme-ocean.min.css",
            "tax" => 19,
            "include_tax" => 1,
            "active" => 1,
            "created_at" => "2020-03-03 12:52:25",
            "updated_at" => "2020-03-03 12:52:25"
        ]);


        //return self::where('slug', 'like', $slug)->first();
    }

    public function scopeShop($id)
    {
        return self::where('id', $id);
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }


    /******************************
     *  CMS Functions
     ******************************/

    public function cms_menus(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CmsMenu::class);
    }

    public function cms_pages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CmsPage::class);
    }

    public function cms_slider(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CmsSlider::class);
    }

    public static function serviceProvider()
    {
        if (!Cache::has('shop_service_provider')) {
            $shop = self::with([
                'cms_menus.cms_menu_items',
                'cms_slider.cms_slider_items'
            ])->where('slug', 'prueba')->first();

            Cache::put('shop_service_provider', $shop, now()->addDays(30));
        }
        return Cache::get('shop_service_provider');
    }
}

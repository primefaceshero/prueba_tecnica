<?php


namespace App\Http\Controllers\Intranet\Shops;

use App\Models\Shop;

class ShopSession
{

    /**
     * Esta función encuentra la tienda y si no fuerza el rediret al selector de tiendas
     * @param $slug
     * @return mixed
     */
    public static function getShop($slug){
        if(!self::setSessionShop($slug)){
            self::forceRedirect('intranet.shops.index');
        }
        return self::getSessionShop();
    }

    public static function forgetSessionShop(){
        if(session()->get('shop')){
            session()->forget('shop');
            return true;
        }
        return false;
    }


    public static function setSessionShop($slug)
    {
        self::forgetSessionShop();
        $shop = Shop::findBySlug($slug);
        if($shop){
            session()->put('shop', $shop);
            return true;
        }
        return false;
    }

    public static function getSessionShop(){
        return session()->get('shop');
    }


    public static function forceRedirect($route_name){
        $route = route($route_name);
        header('Location: '. $route);
        exit;
    }


}

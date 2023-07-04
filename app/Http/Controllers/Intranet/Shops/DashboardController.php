<?php

namespace App\Http\Controllers\Intranet\Shops;

use App\Models\Shop;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductShop;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    private $route = 'intranet.shops.dashboard.' ;
    public $folder = 'intranet.shops.dashboard.';

    public function __construct()
    {

    }

    function index(Request $request, $slug){
        return view($this->folder . 'index');
    }

}

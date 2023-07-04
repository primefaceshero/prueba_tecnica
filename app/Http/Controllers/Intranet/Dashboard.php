<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Intranet\Shops\ShopSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    private $route = 'intranet.' ;
    public $folder = 'intranet.dashboard.';

    function index(){
        return view($this->folder . 'index');
    }

}

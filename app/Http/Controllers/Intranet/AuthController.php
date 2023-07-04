<?php

namespace App\Http\Controllers\Intranet;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Intranet\Shops\ShopSession;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        //return $this->middleware('guest', ['only' => ['showLogin','showSendPassword','showRecoveryPassword']]);
        $this->middleware(function ($request, $next) {
            session()->forget('shop');
            return $next($request);
        });
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if (Auth::guard('intranet')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth()->guard('intranet')->user()->active == 1) {
                $shop = ShopSession::getShop('prueba');
                return redirect()->route('intranet.shops.index', ['prueba']);
            } else {
                return back()->withErrors(['error' => 'Su usuario se encuentra inactivo, comuníquese con un administrador del sistema para regularizar su situación.'])->withInput();
            }
        }
        return back()->withErrors(['error' => 'La combinación de email y contraseña es incorrecta.'])->withInput();
    }

    public function show()
    {
        if (auth()->guard('intranet')->user()) {
            $shop = ShopSession::getShop('prueba');
            return redirect()->route('intranet.shops.index', ['prueba']);
        }
        return view('intranet.auth.show');
    }

    protected function guard()
    {
        return Auth::guard('guard-name');
    }


    public function logout()
    {
        Auth::guard('intranet')->logout();
        return redirect(route('intranet.dashboard'));
    }
}

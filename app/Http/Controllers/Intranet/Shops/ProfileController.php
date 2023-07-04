<?php

namespace App\Http\Controllers\Intranet\Shops;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends GlobalShopController
{

    protected $options = [
        'route' => 'intranet.shops.profile.',
        'folder' => 'intranet.shops.profile.',
        'pluralName' => 'Editar perfil',
        'singularName' => 'Editar perfil',
        'disableActions' => ['show', 'active', 'changeStatus'],
        'forgetSession' => [
            'shop'
        ],
    ];

    public function __construct()
    {
        parent::__construct($this->options);
    }

    public function index($slug)
    {
        $shop = ShopSession::getShop($slug);

        if (Auth::check()){

            $user = User::find(Auth::user()->id);

            if (empty($user)) {

                session()->flash('danger', 'Usuario no encontrado.');

                return redirect()->route('intranet.shops.index', ['prueba']);
            }

            return view('intranet.shops.profile.index',['user'=> $user]);
        } else {
            return redirect()->route('intranet.shops.index', ['prueba']);
        }
    }

    public function updateProfile($slug, Request $request)
    {
        $shop = ShopSession::getShop($slug);

        $user = User::find(Auth::user()->id);

        if (empty($user)) {
            session()->flash('danger', 'Usuario no encontrado.');

            return redirect()->route('intranet.shops.index', ['prueba']);
        }

        $this->validate($request, [
            'email' => 'required|unique:users,email,'.$user->id.',id|max:255',
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100'
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if($request->password != ""){
            $this->validate($request, [
                'password' => 'max:255|min:4'
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if($request->imagen){
            if(file_exists(storage_path('app/public/perfil/'.$user->id.'.jpg')) || file_exists(storage_path('app/public/perfil/'.$user->id.'.png'))){
                if(file_exists(storage_path('app/public/perfil/'.$user->id.'.jpg'))){
                    \Storage::delete('public/perfil/'.$user->id.'.jpg');
                } else {
                    \Storage::delete('public/perfil/'.$user->id.'.png');
                }
            }
            $ext = $request->file("imagen")->getClientOriginalExtension();
            $request->file("imagen")
            ->storeAs('public/perfil', $user->id.'.'.$ext);
        }

        session()->flash('success', 'Se han guardado los cambios en su perfil.');

        return redirect(route('intranet.shops.profile.index', [$shop->slug]));
    }
}

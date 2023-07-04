<?php

namespace App\Http\Controllers\Intranet\Shops;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends GlobalShopController
{

    protected $options = [
        'route' => 'intranet.shops.users.',
        'folder' => 'intranet.shops.users.',
        'pluralName' => 'Usuarios',
        'singularName' => 'Usuario',
        'addToBlade' => [
            'viewPermission' => 'Permisos del Usuario'
        ],
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
        $users = User::orderBy('first_name')->with('roles')->get()->except(1);
        return view($this->folder . 'index', compact('users'));
    }

    public function create($slug)
    {
        $shop = ShopSession::getShop($slug);
        $roles = Role::all()->except(1);
        return view($this->folder . 'create', compact('roles'));
    }

    public function store($slug, Request $request)
    {
        $shop = ShopSession::getShop($slug);
        $rules = [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4|string',
            'first_name' => 'required',
            'last_name' => 'required',
            'role_id' => 'required'
        ];

        $messages = [
            'role_id.required' => 'Debes seleccionar un rol para el usuario.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $object = User::create($request->all());
            $object->assignRole($request->role_id);
            $object->password = bcrypt($request->password);
            $object->save();

            if ($object) {
                session()->flash('success', 'Usuario creado correctamente.');
                return redirect()->route($this->route . 'index', [$shop->slug]);
            }

            return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al crear el usuario.'])->withInput();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($slug, $id)
    {
        $shop = ShopSession::getShop($slug);
        $object = User::find($id);
        if (!$object) {
            session()->flash('warning', 'Usuario no encontrado.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }
        if ($object->id == 1) {
            session()->flash('warning', 'Este usuario no puede ser modificado.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }

        $roles = Role::all()->except(1);
        return view($this->folder . 'edit', compact('object', 'roles'));
    }

    public function update($slug, Request $request, $id)
    {
        $shop = ShopSession::getShop($slug);
        $object = User::find($id);

        if (!$object) {
            session()->flash('warning', 'Usuario no encontrado.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }
        if ($object->id == 1) {
            session()->flash('warning', 'Este usuario no puede ser modificado.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }

        $rules = [
            'email' => 'required|email|unique:users,email,' . $id,
            'first_name' => 'required',
            'last_name' => 'required',
            'role_id' => 'required'
        ];

        $messages = [
            'role_id.required' => 'Debes seleccionar un rol para el usuario.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $object->update($request->except('password', 'id'));
            $object->assignRole($request->role_id);
            if ($request->password) {
                $object->password = bcrypt($request->password);
            }
            $object->save();

            if ($object) {
                session()->flash('success', 'Usuario actualizado correctamente.');
                return redirect()->route($this->route . 'index', [$shop->slug]);
            }
            return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al modificar el usuario.'])->withInput();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function destroy($slug, $id)
    {
        $shop = ShopSession::getShop($slug);
        $object = User::find($id);

        if (!$object) {
            session()->flash('warning', 'Usuario no encontrado.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }

        if ($object->id == 1) {
            session()->flash('warning', 'Este usuario no puede ser eliminado.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }

        if ($object->delete()) {
            session()->flash('success', 'Usuario eliminado correctamente.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }
        session()->flash('error', 'No se ha podido eliminar el usuario.');
        return redirect()->route($this->route . 'index', [$shop->slug]);
    }

    public function active($slug, Request $request)
    {
        $shop = ShopSession::getShop($slug);
        try {

            $object = User::find($request->id);

            if ($object) {

                $object->active = $request->active == 'true' ? 1 : 0;
                $object->save();

                return response()->json([
                    'status' => 'success',
                    'message' => $object->active == 1 ? 'Usuario activado correctamente.' : 'Usuario desactivado correctamente.',
                    'object' => $object
                ]);

            } else {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Usuario no encontrado.'
                ]);
            }

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Ha ocurrido un error inesperado, inténtelo denuevo más tarde.' . $e->getMessage()
            ]);
        }

    }

    public function changeStatus(Request $request)
    {

    }

    public function permissionsEdit($slug, $id)
    {
        $shop = ShopSession::getShop($slug);
        $object = User::with(['permissions', 'roles.permissions'])->find($id);
        if (!$object) {
            session()->flash('warning', 'Usuario no encontrado.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }

        if ($object->id == 1) {
            session()->flash('warning', 'Este rol no puede ser editado.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }

        $permissions = Permission::all();
        $groups = $permissions->pluck('public_group')->unique();
        return view($this->folder . 'permissions', compact('object', 'permissions', 'groups'));
    }

    public function permissionsUpdate($slug, Request $request, $id)
    {
        $shop = ShopSession::getShop($slug);
        $object = User::find($id);

        if (!$object) {
            session()->flash('warning', 'Usuario no encontrado.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }
        if ($object->id == 1) {
            session()->flash('warning', 'Este usuario no puede ser modificado.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }
        $object->syncPermissions($request->permissions ?? []);
        $object->save();

        if ($object) {
            session()->flash('success', 'Permisos de usuario actualizado correctamente.');
            return redirect()->route($this->route . 'index', [$shop->slug]);
        }
        $this->print();
        return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al actualizar los permisos del usuario.'])->withInput();

    }

}

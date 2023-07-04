<?php

namespace App\Http\Controllers\Intranet\Shops;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends GlobalShopController
{
    protected $options = [
        'route' => 'intranet.shops.roles.',
        'folder' => 'intranet.shops.roles.',
        'pluralName' => 'Roles',
        'singularName' => 'Rol',
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
        $roles = Role::all()->except(1);
        return view($this->folder . 'index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $shop = ShopSession::getShop($slug);
        $permissions = Permission::all();
        $groups = $permissions->pluck('public_group')->unique();
        return view($this->folder . 'create', compact('permissions', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug, Request $request)
    {
        $shop = ShopSession::getShop($slug);
        $request->all();
        $rules = [
            'name' => 'required|unique:roles,name',
        ];

        $messages = [
            'name.required' => 'Nombre del rol es requerido',
            'name.unique' => 'Nombre del rol ya se encuentra registrado',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $object = Role::create(['name' => $request->name]);
            $object->syncPermissions($request->permissions ?? []);
            if ($object) {
                session()->flash('success', 'Rol creado correctamente.');
                     return redirect()->route($this->route . 'index', [$shop->slug]);
            }
            return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al crear el attributo.'])->withInput();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        $shop = ShopSession::getShop($slug);
        $object = Role::with('permissions')->find($id);
        if (!$object) {
            session()->flash('warning', 'Rol no encontrado.');
                 return redirect()->route($this->route . 'index', [$shop->slug]);
        }

        if ($object->id == 1) {
            session()->flash('warning', 'Este rol no puede ser modificado.');
                 return redirect()->route($this->route . 'index', [$shop->slug]);
        }
        $permissions = Permission::all();
        $groups = $permissions->pluck('public_group')->unique();
        return view($this->folder . 'edit', compact('object', 'permissions', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($slug, Request $request, $id)
    {
        $shop = ShopSession::getShop($slug);
        $object = Role::findById($id);

        if (!$object) {
            session()->flash('warning', 'Rol no encontrado.');
                 return redirect()->route($this->route . 'index', [$shop->slug]);
        }

        if ($object->id == 1) {
            session()->flash('warning', 'Este rol no puede ser modificado.');
                 return redirect()->route($this->route . 'index', [$shop->slug]);
        }

        $rules = [
            'name' => 'required|unique:roles,name,' . $id,
        ];

        $messages = [
            'name.required' => 'Nombre del rol es requerido',
            'name.unique' => 'Nombre del rol ya se encuentra registrado',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->passes()) {

            $object->update(['name' => $request->name]);
            $object->syncPermissions($request->permissions ?? []);
            if ($object) {
                session()->flash('success', 'Rol actualizado correctamente.');
                     return redirect()->route($this->route . 'index', [$shop->slug]);
            }
            return redirect()->back()->withErrors(['mensaje' => 'Error inesperado al modificar el rol.'])->withInput();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $id)
    {
        $shop = ShopSession::getShop($slug);
        $object = Role::findById($id);

        if (!$object) {
            session()->flash('warning', 'Rol no encontrado.');
                 return redirect()->route($this->route . 'index', [$shop->slug]);
        }

        if ($object->id == 1) {
            session()->flash('warning', 'Este rol no puede ser eliminado.');
                 return redirect()->route($this->route . 'index', [$shop->slug]);
        }
        if ($object->delete()) {
            session()->flash('success', 'Rol eliminado correctamente.');
                 return redirect()->route($this->route . 'index', [$shop->slug]);
        }
        session()->flash('error', 'No se ha podido eliminar el rol.');
             return redirect()->route($this->route . 'index', [$shop->slug]);
    }

    public function active(Request $request)
    {
        try {

            $object = Role::findById($request->id);

            if ($object) {

                $object->active = $request->active == 'true' ? 1 : 0;
                $object->save();

                return response()->json([
                    'status' => 'success',
                    'message' => $object->active == 1 ? 'Rol activado correctamente.' : 'Rol desactivado correctamente.',
                    'object' => $object
                ]);

            } else {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Rol no encontrado.'
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
}

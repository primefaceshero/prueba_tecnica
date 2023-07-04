<?php
use App\Http\Controllers\Intranet\Shops\UserController;
use App\Http\Controllers\Intranet\AuthController;
use App\Http\Controllers\Intranet\Dashboard;
use App\Http\Controllers\Intranet\Shops\DashboardController;
use App\Http\Controllers\Intranet\Shops\RoleController;
use App\Http\Controllers\Intranet\Shops\ProfileController;
use Illuminate\Support\Facades\Route;

if (!function_exists('getResourceRoutesForNameHelper')) {

    function getResourceRoutesForNameHelper($name)
    {
        return [
            'index' => $name . ".index",
            'create' => $name . ".create",
            'store' => $name . ".store",
            'show' => $name . ".show",
            'edit' => $name . ".edit",
            'update' => $name . ".update",
            'destroy' => $name . ".destroy",
        ];
    }
}


Route::name('intranet.')
    ->prefix('intranet')
    ->group(function () {

        Route::resourceVerbs([
            'create' => 'crear',
            'edit' => 'editar',
            'change-status' => 'cambiar-estado',
        ]);

//        AUTH ROUTES

        Route::get('/acceso', [AuthController::class, 'show'])->name('auth.show');
        Route::post('/acceso', [AuthController::class, 'login'])->name('auth.login');
        Route::get('/salir', [AuthController::class, 'logout'])->name('auth.logout');
        Route::post('/salir', [AuthController::class, 'logout'])->name('auth.logout');

        Route::get('/acceso/enviar-contrasena', [AuthController::class, 'showSendPassword'])->name('auth.show-send-password');
        Route::post('/acceso/enviar-contrasena', [AuthController::class, 'sendPassword'])->name('auth.send-password');
        Route::get('/acceso/recuperar-contrasena', [AuthController::class, 'showRecoveryPassword'])->name('auth.show-recovery-password');
        Route::post('/acceso/recuperar-contrasena', [AuthController::class, 'recoveryPassword'])->name('auth.recovery-password');

        Route::group(['middleware' => 'auth:intranet'], function () {

            Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

            Route::get('tiendas/{shop}/editar-perfil', [ProfileController::class, 'index'])->name('shops.profile.index');
            Route::post('tiendas/{shop}/editar-perfil', [ProfileController::class, 'updateProfile'])->name('shops.profile.updateProfile');

            Route::get('tiendas/{shop}/panel', [DashboardController::class, 'index'])->name('shops.index');

            Route::post('tiendas/{shop}/usuarios/active', [UserController::class, 'active'])->name('shops.users.active');
            Route::get('tiendas/{shop}/usuarios/{usuario}/permissions', [UserController::class, 'permissionsEdit'])->name('shops.users.permissionsEdit');
            Route::put('tiendas/{shop}/usuarios/{usuario}/permissions', [UserController::class, 'permissionsUpdate'])->name('shops.users.permissionsUpdate');
            Route::post('tiendas/{shop}/usuarios/change-status', [UserController::class, 'changeStatus'])->name('shops.users.changeStatus');
            Route::resource('tiendas/{shop}/usuarios', UserController::class, ['names' => getResourceRoutesForNameHelper('shops.users')]);

            Route::post('tiendas/{shop}/roles/active', [RoleController::class, 'active'])->name('shops.roles.active');
            Route::post('tiendas/{shop}/roles/change-status', [RoleController::class, 'changeStatus'])->name('shops.roles.changeStatus');
            Route::resource('tiendas/{shop}/roles', RoleController::class, ['names' => getResourceRoutesForNameHelper('shops.roles')]);

        });

        Route::group(['middleware' => ['auth:intranet', 'auth.intranet']], function () {

            Route::get('/', [Dashboard::class, 'index'])->name('dashboard');

        });
    });


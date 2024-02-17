<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('give-permission-to-role', function () {
    $role = Role::findOrFail(3); // valuenya author
    $permission = Permission::findOrFail(3); // valuenya create article

    $role->givePermissionTo($permission);
});

Route::get('assign-role-to-user', function () {
    $user = User::findOrFail(3);
    $role = Role::findOrFail(3);

    $user->assignRole($role);
});


Route::get('spatie-method', function () {
    $user = User::findOrFail(1);
    dd($user->getPermissionsViaRoles());
});

// shadow login
// $user = User::findOrFail(1);
// Auth::login($user);

Auth::logout();

Route::get('create-article', function () {
    dd('Ini adalah fitur create article, hanya bisa diakses oleh author atau moderator');
})->middleware('can:create artikel');

Route::get('edit-article', function () {
    dd('Ini adalah fitur edit article, hanya bisa diakses oleh editor atau moderator');
})->middleware('can:edit article');
Route::get('delete-article', function () {
    dd('Ini adalah fitur create article, hanya bisa diakses oleh moderator');
})->middleware('can:delete article');

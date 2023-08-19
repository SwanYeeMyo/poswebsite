<?php

use App\Models\User;
use App\Models\orderList;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\UserProductController;

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
Route::get('/', [UserController::class, 'home'])->name('user#home');

// Route::get('/', function () {
//     return view('User.home');
// })->name('user#home');

//github

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login.github');

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();

   $user =  User::firstOrCreate(['email' => $user->email,],[
        'name' => $user->name,
        'image' => $user->avatar,
        'password' => 'password',
        'address' => $user->location,
        'phone' => 'phone',
    ]);
    Auth::login($user);
    return redirect()->route('user#home');
    // $user->token
});

Route::middleware(['auth'])->group(function () {
    Route::get('user/account', [UserController::class, 'account'])->name('user#account');
    Route::post('user/update', [UserController::class, 'update'])->name('user#update');
});
Route::prefix('user')->group(function () {
    Route::get('products', [UserProductController::class, 'index'])->name('user#products');
    Route::get('filter/{id}', [UserProductController::class, 'filter'])->name('user#filter');
    Route::post('product/view', [UserProductController::class, 'view'])->name('user#view');
    Route::get('cart',[CartController::class,'index'])->name("user#cart");
    Route::get('cart/delete/{id}',[CartController::class,'delete'])->name('user#cartDelete');
    Route::get('order',[OrderController::class,'index'])->name('user#order');
});
Route::post('user/view/product/', [UserProductController::class, 'view'])->name('user#viewProduct');
Route::prefix('ajax')->group(function () {
    Route::get('products', [AjaxController::class, 'index'])->name('user#AjaxAesc');
    Route::get('addtocart', [AjaxController::class, 'addToCart'])->name('user#AjaxAddToCart');
    Route::get('order',[AjaxController::class,'order'])->name('user#AjaxOrder');
    Route::get('change/status',[AjaxController::class,'status'])->name('admin#ajaxStatus');
});
Route::middleware([
    'auth:sanctum',
    'login_auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.home');
    })->name('dashboard');
    //admin side
    //category

    Route::prefix('category')->group(function () {
        Route::get('home', [CategoryController::class, 'home'])->name('category#home');
        Route::post('create', [CategoryController::class, 'store'])->name('category#create');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
        Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        Route::post('delete', [CategoryController::class, 'delete'])->name('category#delete');
    });
    //admin profile
    Route::prefix('admin')->group(function () {
        Route::get('profile', [AuthController::class, 'home'])->name('admin#home');
        Route::post('update', [AuthController::class, 'update'])->name('admin#update');
        Route::get('password', [AuthController::class, 'password'])->name('admin#password');
        Route::post('/change/password', [AuthController::class, 'changePassword'])->name('admin#changePassword');
    });
    //admin product
    Route::prefix('product')->group(function () {
        Route::get('home', [ProductController::class, 'home'])->name('admin#product');
        Route::post('create', [ProductController::class, 'create'])->name('admin#ProductCreate');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('admin#ProductEdit');
        Route::post('update', [ProductController::class, 'update'])->name('admin#ProductUpdate');
        Route::post('delete', [ProductController::class, 'delete'])->name('admin#ProductDelete');
        Route::get('view/{id}', [ProductController::class, 'view'])->name('admin#productView');

    });
    //adminList
    Route::prefix('admin')->group(function () {
        Route::get('list', [AdminController::class, 'list'])->name('admin#list');
        Route::get('list/edit/{id}', [AdminController::class, 'edit'])->name('admin#listEdit');
        Route::post('list/update/', [AdminController::class, 'update'])->name('admin#listUpdate');
        Route::post('list/delete', [AdminController::class, 'delete'])->name('admin#listDelete');
        Route::get('orderList',[OrderListController::class,'index'])->name('admin#orderList');
        Route::get('order',[OrderController::class,'home'])->name('admin#order');
    });

    //order
});

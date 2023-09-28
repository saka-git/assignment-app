<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Company\CompanyLoginController;
use App\Http\Controllers\Company\CompanyRegisterController;
use App\Http\Controllers\Company\CompanySwitchController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| 管理者用ルーティング
|--------------------------------------------------------------------------
*/
Route::prefix('company')->name('company.')->group(function () {
    // 登録
    Route::get('/register', [CompanyRegisterController::class, 'create']);
    Route::post('/register', [CompanyRegisterController::class, 'store'])
        ->name('register');

    // ログイン
    Route::get('/login', [CompanyLoginController::class, 'showLoginPage']);
    Route::post('/login', [CompanyLoginController::class, 'login'])->name('login');

    // アカウント切り替え
    Route::get('/link', [CompanySwitchController::class, 'create'])->name('link.create');
    Route::post('/link', [CompanySwitchController::class, 'link'])->name('link');
    Route::get('/switch/{companyId}', [CompanySwitchController::class, 'switch'])->name('switch');

    // 以下の中は認証必須のエンドポイントとなる
    Route::middleware(['auth:company'])->group(function () {
        // ダッシュボード
        Route::get('/dashboard', function () {
            return view('company.dashboard');
        })->name('dashboard');
    });
});


/*
|--------------------------------------------------------------------------
| 管理者用ルーティング
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    // 登録
    Route::get('/register', [AdminRegisterController::class, 'create']);
    Route::post('/register', [AdminRegisterController::class, 'store'])
        ->name('register');

    // ログイン
    Route::get('/login', [AdminLoginController::class, 'showLoginPage']);
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login');

    // 以下の中は認証必須のエンドポイントとなる
    Route::middleware(['auth:admin'])->group(function () {
        // ダッシュボード
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
});

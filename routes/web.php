<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\ContactPhoneVerifier;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\debugController;
use App\Http\Controllers\UploadController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/user', function () {
    return redirect(Auth::user()->name);
})->middleware('auth');

Route::get('/page',[userController::class, 'edit'])->middleware(['auth']);

require __DIR__.'/auth.php';

Route::post('/contact-phone-verifier',[ContactPhoneVerifier::class, 'verify']);

Route::get('/account', [UserAccountController::class, 'show']);
Route::post('/account/{attribute}', [UserAccountController::class, 'store']);

Route::post('/upload',[UploadController::class, 'store']);

Route::post('/update-user-info',[userController::class, 'updateInfo'])->middleware(['auth']);

Route::get('/', function () {

    if(Auth::check()){
        return redirect(Auth::user()->name);
    }else{
       return view('landing.landing');
    }
});
Route::get('/card-maker',[\App\Http\Controllers\CardMakerController::class,'handle']);
Route::get('debug', [debugController::class, 'show']);
Route::get('/{user}',[userController::class, 'show'])->name('userPage');



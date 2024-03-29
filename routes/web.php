<?php

use App\Http\Controllers\Admin\RecipeController as AdminRecipeController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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




Route::prefix('supermasala581')->group(function(){

	Route::group(['middleware' => 'auth'], function () {

		Route::get('/', [AdminController::class, 'home']);
		Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Recipe's Controller
        Route::get('recipes', [AdminRecipeController::class, 'index'])->name('admin.recipes');
        Route::get('recipes/user', [AdminRecipeController::class, 'index'])->name('admin.recipes.user');
        Route::get('recipes/create', [AdminRecipeController::class, 'create'])->name('admin.recipes.create');
//        Route::get('recipes/create', [AdminRecipeController::class, 'create'])->name('admin.recipes.user.create');
        Route::get('recipes/blog/healthy', [AdminRecipeController::class, 'index'])->name('admin.recipes.blogs');
        Route::get('recipes/blog/create', [AdminRecipeController::class, 'create'])->name('admin.recipes.blogs.create');

        // Daily Recipe
        Route::get('daily-recipes', [AdminRecipeController::class, 'index'])->name('admin.daily-recipes');
        Route::get('daily-recipes/create', [AdminRecipeController::class, 'createDailyRecipe'])->name('admin.daily-recipes.create');
        Route::post('daily-recipes', [AdminRecipeController::class, 'storeDailyRecipe'])->name('admin.daily-recipes.store');

        // Healthy Video
        Route::get('healthy-video', [AdminRecipeController::class, 'index'])->name('admin.healthy-video');
        Route::get('healthy-video/create', [AdminRecipeController::class, 'createHealthyVideo'])->name('admin.healthy-video.create');
        Route::post('healthy-video', [AdminRecipeController::class, 'storeHealthyVideo'])->name('admin.healthy-video.store');

		Route::get('recipes/{recipe}/edit', [AdminRecipeController::class, 'edit'])->name('admin.recipes.edit');
		Route::post('recipe/{recipe}/update', [AdminRecipeController::class, 'update'])->name('admin.recipes.update');
		Route::post('recipe/{recipe}/delete', [AdminRecipeController::class, 'destroy'])->name('admin.recipe.destroy');
		Route::post('recipe/{recipe}/status', [AdminRecipeController::class, 'updateStatus'])->name('admin.recipe.status');
        Route::post('daily-recipe/{recipe}/delete', [AdminRecipeController::class, 'destroyDailyRecipe'])->name('admin.daily-recipe.destroy');

		// Route::get('banners', [AdminController::class, 'banners'])->name('banners');
		// Route::get('user-management', function () {
		// 	return view('laravel-examples/user-management');
		// })->name('user-management');
		Route::get('static-sign-in', function () {
			return view('static-sign-in');
		})->name('sign-in');

		Route::get('/logout', [SessionsController::class, 'destroy'])->name('logout');
		Route::get('/user-profile', [InfoUserController::class, 'create']);
		Route::post('/user-profile', [InfoUserController::class, 'store']);
		Route::get('/login', function () {
			return view('dashboard');
		})->name('sign-up');
	});

	Route::group(['middleware' => 'guest'], function () {
		Route::get('/register', [RegisterController::class, 'create']);
		Route::post('/register', [RegisterController::class, 'store'])->name('register');
		Route::get('/login', [SessionsController::class, 'create']);
		Route::post('/session', [SessionsController::class, 'store'])->name('session');
		Route::get('/login/forgot-password', [ResetController::class, 'create']);
		Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
		Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
		Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

	});

	Route::get('/login', function () {
		return view('session/login-session');
	})->name('login');

});


Route::group(['middleware' => 'guest'], function () {

    // Routes Pages
    Route::get('', [HomeController::class, 'home'])->name('home');
    Route::get('about' ,[HomeController::class, 'about'])->name('about');
    Route::get('recipes', [RecipeController::class, 'index'])->name('recipes');
    Route::get('daily-recipes', [HomeController::class, 'dailyRecipe'])->name('daily-recipes');
    Route::get('recipes/vegetables', [RecipeController::class, 'index'])->name('recipes.vegetables');
    Route::get('recipes/users', [RecipeController::class, 'index'])->name('recipes.users');
    Route::get('recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
    Route::get('healthy-living', [HomeController::class, 'healthy'])->name('healthy');
    Route::get('healthy-living/{blog}', [HomeController::class, 'showBlog'])->name('healthy.show');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('contact/store',[HomeController::class, 'storeContact'])->name('contact.store');

    // Ajax Routes
    Route::get('modal/recipes/{recipe}', [RecipeController::class, 'getModalDetails'])->name('recipes.modal.details');
    Route::get('load-recipe',[RecipeController::class, 'getModalDetails']);
});

Route::post('recipes', [RecipeController::class, 'store'])->name('recipes.store');
//
//Route::get('email', function(){
//    \Illuminate\Support\Facades\Mail::to('hasnainmohammad145@gmail.com')->send(new \App\Mail\RecipeCreatedMail());
//    return new \App\Mail\RecipeCreatedMail();
//});


Route::get('clear-everything', function(){
    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";
    Hash::make('password');
    Hash::make('password');
    
    'Hjfhshfahsfhsdfjhfjkhsdfshdfkj';




    $clearconfig = Artisan::call('config:cache');
    echo "Config cleared<br>";

    $cleardebugbar = Artisan::call('debugbar:clear');
    echo "Debug Bar cleared<br>"; 
});
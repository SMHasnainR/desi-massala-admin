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




Route::prefix('admin')->group(function(){

	Route::group(['middleware' => 'auth'], function () {

		Route::get('/', [AdminController::class, 'home']);

		Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Recipe's Contorller
        Route::get('recipes', [AdminRecipeController::class, 'index'])->name('recipes.index');
        Route::get('recipes/user', [AdminRecipeController::class, 'index'])->name('recipes.user');

        Route::get('recipes/create', [AdminRecipeController::class, 'create'])->name('recipes.create');
		Route::post('recipes', [AdminRecipeController::class, 'store'])->name('recipes.store');
		Route::get('recipes/{recipe}/edit', [AdminRecipeController::class, 'edit'])->name('recipes.edit');
		Route::post('recipe/{recipe}/update', [AdminRecipeController::class, 'update'])->name('recipes.update');
		Route::post('recipe/{recipe}/delete', [AdminRecipeController::class, 'destroy'])->name('recipe.destroy');
		Route::post('recipe/{recipe}/status', [AdminRecipeController::class, 'updateStatus'])->name('recipe.status');

		// Route::post('recipe/upload', [RecipeController::class, 'uploadImage'])->name('upload-image');

		Route::get('user-recipes', [RecipeController::class, 'userRecipe'])->name('user-recipes');
		Route::get('banners', [AdminController::class, 'banners'])->name('banners');

		Route::get('user-management', function () {
			return view('laravel-examples/user-management');
		})->name('user-management');

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


Route::get('', [HomeController::class, 'home'])->name('home');
Route::get('about', [HomeController::class, 'about'])->name('about');
Route::get('recipes', [RecipeController::class, 'index'])->name('recipes');
Route::get('recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');


Route::get('recipe-detail', function(){
    return view('recipes_details');
})->name('recipes-details
');
Route::get('veg-recipes', [HomeController::class, 'vegRecipes'])->name('veg-recipes');
Route::get('healthy-living', [HomeController::class, 'healthyLiving'])->name('healthy-living');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

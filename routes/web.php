<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    echo "This is Home Page";
});


// Route::get('/about', function () {
//     return view('about');
// })->middleware('check');

Route::get('/about', function () {
    return view('about');
});


Route::get('/contact', [ContactController::class, 'index']);

//Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

// Route::get('/contact', [ContactController::class, 'index'])->name('con');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

        //Query Builder
        $users = DB::table('users')->get();
        

        // Ellequent ORM
    // $users = User::all();
    return view('dashboard', compact('users'));
})->name('dashboard');

<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderHeaderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CartHeaderController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['middleware' => 'guestM'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/landing', [PageController::class, 'landingPage'])->name('landing');
});

Route::middleware(['middleware' => 'userM'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/', [BookController::class, 'home'])->name('home');
    Route::get('/newRelease', [BookController::class, 'newRelease'])->name('newRelease');
    Route::get('/popularBooks', [BookController::class, 'popularBooks'])->name('popularBooks');
    Route::get('/editorsPick', [BookController::class, 'editorsPick'])->name('editorsPick');
    Route::get('/search', [BookController::class, 'search'])->name('search');
    Route::get('/bookDetail/{id}', [BookController::class, 'bookDetail']);
    Route::post('add-book/{bookId}', [BookController::class, 'addBookToCart']);
    Route::get('/category/{name}', [BookController::class, 'category'])->name('category');
    Route::get('/BooksBy/{authorName}', [BookController::class, 'bookAuthor'])->name('bookAuthor');
    Route::get('/books', [BookController::class, 'viewAll'])->name('books');
    Route::get('/search', [BookController::class, 'searchBook'])->name('search');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/editPassword', [ProfileController::class, 'editPasswordPage'])->name('editPassword');
    Route::post('/profile/editPassword', [ProfileController::class, 'editPassword']);
});

Route::middleware(['middleware' => 'memberM'])->group(function () {
    Route::get('/cart', [CartHeaderController::class, 'cart'])->name('cart');
    Route::delete('/cart/delete/{libraryId}/{bookId}', [CartHeaderController::class, 'removeFromCart']);
    Route::post('/cart/checkout/{libraryId}', [CartHeaderController::class, 'checkout']);
    Route::get('/pickup', [CourierController::class, 'pickup'])->name('pickup');
    Route::post('/pickup/confirm/{orderId}', [CourierController::class, 'checkout']);
    Route::get('/history', [MemberController::class, 'history'])->name('history');
    Route::get('/profile/editProfile', [ProfileController::class, 'editProfilePage'])->name('editProfile');
    Route::post('/profile/editProfile', [ProfileController::class, 'editProfile']);
});

Route::middleware(['middleware' => 'adminM'])->group(function () {
    Route::get('/manageBook', [BookController::class, 'getBookDetail'])->name('manageBook');
    Route::delete('admin/delete-book/{bookId}', [AdminController::class, 'deleteBook']);
    Route::get('/updateBook/{bookId}', [BookController::class, 'updateBook'])->name('updateBook');
    Route::patch('/updateBook/{bookId}', [BookController::class, 'updateBooktoMaster']);
    Route::get('/insertBook', [BookController::class, 'insertBook'])->name('insertBook');
    Route::post('/insertBooktoMaster', [BookController::class, 'insertBooktoMaster']);
    Route::get('/viewAddToLibrary', [BookController::class, 'viewAddToLibrary'])->name('viewAddToLibrary');
    Route::post('/addToLibrary', [BookController::class, 'AddToLibrary']);
    Route::get('/manageOrder', [OrderHeaderController::class, 'manageOrder'])->name('manageOrder');
    Route::get('/orderDetail/{orderHeaderid}/{bookId}', [OrderHeaderController::class, 'orderDetail'])->name('orderDetail');
    Route::post('/manageOrder/updateStatus/{orderHeaderId}', [OrderHeaderController::class, 'updateStatus']);
});

Route::get('/notFound', [PageController::class, 'notFound'])->name('notFound');

Route::fallback(function(){
    return redirect()->route('notFound');
});

Route::get('/storage/app/public/images/{folder}/{name}', function($folder, $name){
    $content = Storage::get('public/images/'.$folder.'/'.$name);
    $mime = Storage::mimeType('public/images/'.$folder.'/'.$name);
    $response = Response::make($content, 200);
    return $response->header('Content-Type', $mime);
});

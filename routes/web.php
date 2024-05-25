<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchasedBookController;
use App\Http\Controllers\MyBookController;

use App\Http\Controllers\StockController;
use App\Http\Controllers\AdminController;



Route::get('/public', function () {
    return redirect()->route('reader.books.index');
});

Route::resource('books', BookController::class);

Route::get('books', [BookController::class, 'index'])->name('reader.books.index');
Route::get('books/{book}', [BookController::class, 'show'])->name('reader.books.show');

Route::resource('auth', AuthController::class);

Route::delete('auth', [AuthController::class, 'destroy'])->name('auth.destroy');

Route::get('login', fn() => to_route('auth.create'))->name('login');





//Route::redirect('/order/{order}', '/MyOrders/{order}');
//Route::redirect('/order', '/MyOrders');



Route::middleware('auth')->group(function () {


        Route::resource('cart', PurchasedBookController::class);
        Route::resource('order', OrderController::class);

        Route::get('/Cart/ReviewOrder/changeAddress', [OrderController::class, 'create'])->name('order.changeAddress');
        Route::get('/Cart/ReviewOrder', [OrderController::class, 'create'])->name('order.reviewOrder');
        Route::put('/Cart/ReviewOrder/updateAddress/{order}', [OrderController::class, 'updateAddress'])->name('order.updateAddress');
        Route::get('/MyOrders', [OrderController::class, 'index'])->name('order.index');
        Route::get('/MyOrders/{order}', [OrderController::class, 'show'])->name('order.show');
        //Route::get('/Cart/OutOfStock', [PurchasedBookController::class, 'create'])->name('cart.outofstock');


        Route::get('publisher/books/StockRequests', [StockController::class, 'myrequests'])->name('stocks.myrequests');
        Route::resource('publisher/books', MyBookController::class);
        Route::resource('publisher/books.stocks', StockController::class);


        Route::get('admin/orders', [AdminController::class, 'orders'])->name('admin.orders');
        Route::get('admin/bookrequests', [AdminController::class, 'bookRequests'])->name('admin.bookrequests');
        Route::get('admin/book/show/{book}', [AdminController::class, 'showBook'])->name('admin.book.show');
        Route::get('admin/stockrequests', [AdminController::class, 'stockRequests'])->name('admin.stockrequests');

        Route::put('admin/stockrequests/{stock}', [AdminController::class, 'stockUpdate'])->name('admin.stock.update');

        Route::put('admin/updatepermission/{book}', [AdminController::class, 'updatePermission'])->name('admin.permission.update');
        Route::get('admin/order/{order}', [AdminController::class, 'showOrder'])->name('admin.order.show');
        Route::put('admin/order/{order}', [AdminController::class, 'updateOrder'])->name('admin.order.update');
        Route::resource('admin', AdminController::class);



});



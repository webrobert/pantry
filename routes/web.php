<?php

use App\Http\Controllers\TestController;
use App\Http\Livewire\ShoppingLists\{ShoppingList, ShoppingLists};
use Illuminate\Support\Facades\Route;

Route::get('/test/', [TestController::class, 'index']);

Route::get('/', fn () => redirect()->route('login') );

Route::middleware(['auth:sanctum', 'verified'])->group( function () {

    Route::get('/dashboard', fn () => redirect()->route('shoppingLists.index') )
        ->name('dashboard');

    Route::get('/shopping-lists/{id}', ShoppingList::class)
        ->name('shoppingLists.show');

    Route::get('/shopping-lists', ShoppingLists::class)
        ->name('shoppingLists.index')
        ->middleware('clear.buy.later');

    Route::get('/items', ShoppingList::class)
        ->name('items.index');

});

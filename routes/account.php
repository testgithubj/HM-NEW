<?php
/************************************************************************
 * This file responsible for Account in admin panel
 *************************************************************************/

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['local', 'XSS','auth'], 'namespace' => 'Account'], function () {
    Route::controller('AccountTypeController')->as('account-types.')->prefix('account-types')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
    });

    Route::controller('AccountController')->as('accounts.')->prefix('accounts')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
    });

    Route::controller('TransactionController')->as('transactions.')->prefix('transactions')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
    });

    Route::controller('ReportController')->as('report.')->prefix('reports')->group(function () {
        Route::get('/trail-balance', 'trailBalance')->name('TrailBalance');
        Route::get('/balance-sheet', 'balanceSheet')->name('BalanceSheet');
        Route::get('/income-statement', 'incomeStatement')->name('IncomeStatement');
    });
});



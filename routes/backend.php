<?php

use App\Models\PharmacyExpense;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['auth', 'XSS','local']], function () {
    Route::name('user.')->prefix('users')->controller('UserController')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store')->middleware('isDemo');
        Route::get('/edit/{user}', 'edit')->name('edit');
        Route::put('/update/{user}', 'update')->name('update')->middleware('isDemo');
        Route::delete('/delete/{user}', 'delete')->name('delete')->middleware('isDemo');
    });

    Route::name('role.')->prefix('roles')->controller('RoleController')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store')->middleware('isDemo');
        Route::get('/edit/{role}', 'edit')->name('edit');
        Route::put('/update/{role}', 'update')->name('update')->middleware('isDemo');
        Route::delete('/delete/{role}', 'delete')->name('delete')->middleware('isDemo');
    });

    Route::name('language.')->prefix('languages')->controller('LanguageController')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store')->middleware('isDemo');
        Route::get('/edit/{language}', 'edit')->name('edit');
        Route::put('/update/{language}', 'update')->name('update')->middleware('isDemo');
        Route::delete('/delete/{language}', 'delete')->name('delete')->middleware('isDemo');
        Route::match(['get', 'post'], '/update/terms/{language}', 'updateTerms')->name('terms.update');
    });

    Route::name('customer.')->prefix('customers')->controller('CustomerController')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store')->middleware('isDemo');
        Route::get('/edit/{customer}', 'edit')->name('edit');
        Route::get('/show/{customer}', 'show')->name('show');
        Route::put('/update/{customer}', 'update')->name('update')->middleware('isDemo');
        Route::delete('/delete/{customer}', 'delete')->name('delete')->middleware('isDemo');
        Route::post('due-payment','duePayment')->name('paydue');
    });

    Route::name('expense-categories.')->prefix('expense-categories')->controller('ExpenseCategoryController')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{expenseCategory}', 'edit')->name('edit');
        Route::put('/update/{expenseCategory}', 'update')->name('update');
        Route::delete('/delete/{expenseCategory}', 'delete')->name('delete')->middleware('isDemo');
    });

    Route::name('expenses.')->prefix('expenses')->controller('ExpenseController')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{expense}', 'edit')->name('edit');
        Route::put('/update/{expense}', 'update')->name('update')->middleware('isDemo');
        Route::delete('/delete/{expense}', 'delete')->name('delete')->middleware('isDemo');
    });

    Route::prefix('report')->as('report.')->controller('ReportController')->group(function () {
        Route::get('instock-medicine', 'inStockMedicine')->name('instock');
        Route::get('lowstock-medicine', 'lowStockMedicine')->name('low_stock');
        Route::get('stockout-medicine', 'stockoutMedicine')->name('stockout');
        Route::get('upcoming-expire-medicine', 'upcomingExpireMedicine')->name('upcoming_expire');
        Route::get('already-expire-medicine', 'alreadyExpireMedicine')->name('already_expire');

        Route::get('due-customer', 'dueCustomer')->name('due_customer');
        Route::get('payable-manufacturer', 'payableManufacturer')->name('payable_manufacturer');
        Route::get('sale-purchase', 'salePurchase')->name('sale_purchase');
        Route::get('profit-loss', 'profitLoss')->name('profit_loss');
    });

    Route::name('setting.')->prefix('settings')->controller('SettingController')->group(function () {
        Route::match(['get','post'],'/', 'generalSetting')->name('generalSetting')->middleware('isDemo');
        Route::match(['get','post'],'/email-setting', 'emailSetting')->name('emailSetting')->middleware('isDemo');
    });
});

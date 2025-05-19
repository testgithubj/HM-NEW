<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BanksController;
use App\Http\Controllers\BanktransController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\PaymentController;
use App\Http\Controllers\NPurchaseController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    if (!empty(env('DB_DATABASE')) && !empty(env('DB_USERNAME'))) {
        if (!Auth::check()) {
            return view('auth.login');
        } else {
            return redirect()->route('dashboard');
        }
    } else {
        return redirect()->route('LaravelInstaller::welcome');
    }
});

Route::group(['domain' => '{username}.pharmacyss.com', 'middleware' => ['cartid']], function () {
    Route::get('/', 'HomeController@shop')->name('shop.index');
    Route::get('/cart', 'HomeController@cart')->name('shop.cart');
    Route::post('/place_order', 'HomeController@order')->name('shop.order');
    Route::get('/addcart/{id}', 'HomeController@addcart')->name('shop.addcart');
    Route::get('/delcart/{id}', 'HomeController@delcart')->name('shop.delcart');
    Route::get('/thank/{id}', 'HomeController@thank')->name('thank');
    Route::get('/contact.html', 'HomeController@contact')->name('home.contact');
    Route::any('login', 'HomeController@login')->name('signin');
});

Route::group(['middleware' => ['local']], function () {

   
    

    Route::get('/logout', function () {
        Auth::logout();
        return Redirect::to('login');
    });


    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

    Auth::routes(['register' => true]);
    Route::group(['middleware' => ['auth', 'XSS']], function () {
       
        Route::post('sendbulksms', 'MessageController@sendssms')->name('sendbulksms');
        Route::get('sms/area/{city_id?}', 'MessageController@get_area')->name('sms.get_area');
        Route::get('sms/city/{state_id?}', 'MessageController@get_city')->name('sms.get_city');
        Route::get('bulksms', 'MessageController@bulksms')->name('bulksms');
        Route::get('message/{username?}', 'MessageController@message')->name('messageAdmin');
        Route::match(['get', 'post'], 'sms', 'MessageController@smsPanel')->name('smsPanel');
       

        


        

        Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
//        Route::any('/settings', 'DashboardController@settings')->name('settings');
      


        Route::group(['middleware' => ['EXPIRE']], function () {
            Route::any('/updateprice/{id}', 'MedicineController@update_price')->name('update.price');
//            Route::get('/stockout', 'MedicineController@stockout')->name('stockout');
//            Route::get('/expired', 'MedicineController@expired')->name('expired');
            Route::get('/expired/delete/{id}', 'MedicineController@expired_delete')->name('expired.delete');
            Route::get('/in_stock', 'MedicineController@instock')->name('instock');
            Route::get('/emergency-stock', 'MedicineController@emergencyStock')->name('emergency_stock');
            Route::get('/upcoming', 'MedicineController@upcoming')->name('upcoming');
            Route::get('/returned_history', 'InvoiceController@return_history')->name('return.history');
            Route::any('/returned/{id}', 'InvoiceController@returned')->name('returned');
            Route::get('/purchase/purchase_returned_history', 'PurchaseController@return_history')->name('purchase.return.history');
            Route::any('/purchase/returned/{id}', 'PurchaseController@returned')->name('purchase.returned');
            Route::any('/purchase/returned/invoice/{id}', 'PurchaseController@purchase_return_invoice')->name('purchase.return_invoice');
            Route::any('/returned/{id}', 'InvoiceController@returned')->name('returned');
            Route::any('/profile_setting', 'ProfileController@setting')->name('profile.setting');
            Route::any('/profile_info_setting', 'ProfileController@info_setting')->name('profile.info.setting');




            Route::name('supplier.')->controller('SupplierController')->prefix('supplier')->group(function (){
                Route::get('list','index')->name('list');
                Route::match(['get','post'],'add','add')->name('add');
                Route::get('view/{id}','view')->name('view');
                Route::get('edit/{id}','edit')->name('edit');
                Route::put('update/{id}','update')->name('update');
                Route::delete('delete/{id}','delete')->name('delete');
                Route::post('due-payment','duePayment')->name('paydue');
            });

            Route::get('/customer/send-email', 'CustomerController@sendEmail')->name('customer.send_email');
            Route::post('/customer/send-email/process', 'CustomerController@sendEmailProcess')->name('customer.send_email.process');
            //Report Routes
            Route::prefix('report')->name('report.')->group(function () {
                Route::get('customer/due', 'ReportController@customerDue')->name('customer_due');
                Route::get('supplier/due', 'ReportController@supplierDue')->name('supplier_due');
                // Route::get('supplier/duess', 'ReportController@suplierdues')->name('supplier_duess');
                
                 
                Route::get('medicine/topsell', 'ReportController@topSellMedicine')->name('topsell_medicine');
                Route::get('/business/profit-loss', 'ReportController@businessProfitLoss')->name('businessprofitloss');
            });

            Route::prefix('admin')->group(function () {
                Route::resource('admin',   'AdminController');
                Route::resource('role',    'RoleController');
                Route::get('role/delete/{id}',    'RoleController@delete')->name('role.delete');
                Route::any('config/mail-sms',    'AdminController@mailSmsConfig')->name('admin.mail_sms_config');
            });

            Route::get('/ecommerce/view', 'InvoiceController@ecommerce')->name('ecommerce');




      

           

            Route::get('/bank/view', [BanksController::class, 'viewbank'])->name('bank.view'); // For viewing the bank form or data
            Route::get('/bank/addform', [BanksController::class, 'viewform'])->name('bank.form');
            Route::post('/bank/add', [BanksController::class, 'bank'])->name('bank.add'); // For adding a new bank
            Route::get('/bank/edit/{id}', [BanksController::class, 'bankEditform'])->name('bank.edit'); // For showing the edit form
            Route::put('/bank/update/{id}', [BanksController::class, 'updatebank'])->name('bank.update'); // For updating a bank record
            Route::delete('/bank/delete/{id}', [BanksController::class, 'deletebank'])->name('bank.delete'); // For deleting a bank record


            Route::get('/banktrans', [BanktransController::class, 'index'])->name('banktrans.index');
            Route::get('/banktransform', [BanktransController::class, 'create'])->name('banktrans.form');
            Route::post('/banktrans/store', [BanktransController::class, 'storeTransaction'])->name('banktrans.store');
            Route::get('/banktrans/edit{id}', [BankTransController::class, 'edit'])->name('banktrans.edit');
            Route::put('/banktrans/update/{id}', [BankTransController::class, 'updateTransaction'])->name('banktrans.update');
            Route::delete('banktrans/{id}', [BanktransController::class, 'deleteTransaction'])->name('banktrans.delete');

            Route::prefix('payment/method')->group(function () {
                Route::get('/', [App\Http\Controllers\PaymentController::class, 'method'])->name('payment.method');
                Route::get('/edit/{id}', [App\Http\Controllers\PaymentController::class, 'edit'])->name('payment.method.edit');
                Route::put('/update/{id}', [App\Http\Controllers\PaymentController::class, 'update'])->name('payment.method.update'); 
                Route::post('/add', [App\Http\Controllers\PaymentController::class, 'add'])->name('payment.method.add');
                Route::post('/deduct/{id}', [App\Http\Controllers\PaymentController::class, 'deduct'])->name('payment.method.deduct');
                Route::post('/delete/{id}', [App\Http\Controllers\PaymentController::class, 'delete'])->name('payment.method.delete');
            });
            
            



            Route::get('/report/supplier', [ReportController::class, 'supplierreport'])->name('report.supplier');

            


            


            Route::get('/medicines/list', 'MedicineController@index')->name('medicine.list');
            Route::get('/medicines/fmcg', 'MedicineController@fmcgproducts')->name('medicine.fmcg');
            Route::any('/medicines/edit/{id}', 'MedicineController@edit')->name('medicine.edit');
            Route::any('/medicines/delete/{id}', 'MedicineController@delete')->name('medicine.delete');
            Route::any('/medicines/view/{id}', 'MedicineController@view')->name('medicine.view');
            Route::any('/medicines/add', 'MedicineController@add')->name('medicine.add');
            Route::get('/medicines/lowstock', 'MedicineController@lowstock')->name('lowstock');
            Route::get('/medicines/stockout', 'MedicineController@stockout')->name('stockout');
            Route::get('/medicines/expired', 'MedicineController@expired')->name('expired');
            Route::get('/medicines/leaf', 'LeafController@leaf')->name('leaf');
            Route::get('/medicines/unit', 'UnitController@unit')->name('units');
            Route::any('/medicines/unit/add', 'UnitController@add')->name('unit.add');
            Route::any('/medicines/unit/edit/{id}', 'UnitController@edit')->name('unit.edit');
            Route::get('/medicines/unit/delete/{id}', 'UnitController@delete')->name('unit.delete');

            // Medicine Import
            Route::get('/medicines/import', 'MedicineController@importFormView')->name('medicines.import');
            Route::post('/medicines/import/process', 'MedicineController@importProcess')->name('medicines.import.process');
            Route::get('/medicines/export/{slug}','MedicineController@exporter')->name('medicines.csv.exporter');


            Route::get('/medicines/type', 'TypeController@type')->name('types');
            Route::any('/medicines/type/add', 'TypeController@add')->name('type.add');
            Route::any('/medicines/type/edit/{id}', 'TypeController@edit')->name('type.edit');
            Route::any('/medicines/type/delete/{id}', 'TypeController@delete')->name('type.delete');

            Route::group(['prefix' => 'accounts', 'as' => 'accounting.'], function () {
                Route::get('/charts/list', 'AccountingController@chartlist')->name('charts.list');
            });

            Route::any('/medicines/leaf/add', 'LeafController@add')->name('leaf.add');
            Route::any('/medicines/leaf/edit/{id}', 'LeafController@edit')->name('leaf.edit');
            Route::any('/medicines/leaf/delete/{id}', 'LeafController@delete')->name('leaf.delete');

            Route::get('/medicines/categories', 'CategoryController@categories')->name('category');
            Route::any('/medicines/categories/edit/{id}', 'CategoryController@edit')->name('category.edit');
            Route::any('/medicines/categories/delete/{id}', 'CategoryController@delete')->name('category.delete');
            Route::any('/medicines/categories/view/{id}', 'CategoryController@view')->name('category.view');
            Route::any('/medicines/categories/add', 'CategoryController@add')->name('category.add');

            Route::any('/purchase/reports', 'PurchaseController@reports')->name('purchase.reports');
            Route::any('/purchase/new/{id?}', 'PurchaseController@new')->name('purchase.new');

            Route::any('/purchase/view/{id}', 'PurchaseController@view')->name('purchase.view');
            Route::any('/cart/remove/{id}', 'InvoiceController@recart')->name('rcart');

            Route::any('/purchase/delete/{id?}', 'PurchaseController@delete')->name('purchase.delete');
            Route::any('/purchase/inv/add/{id?}', 'PurchaseController@addtrx')->name('purchase.trx');
            Route::any('/invoice/inv/add/{id?}', 'InvoiceController@addtrx')->name('invoice.trx');
            Route::any('/invoice/reports', 'InvoiceController@reports')->name('invoice.reports');
            Route::any('/invoice/new', 'InvoiceController@new')->name('invoice.new');
            Route::get('/invoice/view/{id}', 'InvoiceController@view')->name('invoice.view');
            Route::get('/invoice/return/view/{id}', 'InvoiceController@return_invoce_view')->name('invoice.return_invoice.view');
            Route::get('/invoice/print/{id}', 'InvoiceController@print')->name('invoice.print');
            Route::get('/invoice/return-invoice/print/{id}', 'InvoiceController@returnInvoicePrint')->name('invoice.return_invoice.print');
            Route::get('/invoice/pdf/{id}', 'InvoiceController@pdf')->name('invoice.pdf');
            Route::get('/invoice/delete/{id}', 'InvoiceController@delete')->name('invoice.delete');
            Route::any('/reports', 'InvoiceController@allreports')->name('reports');
            Route::any('/profit', 'InvoiceController@profit')->name('profit');
            Route::any('/payment_method', 'PaymentController@method')->name('payment.method');
            Route::any('/payment_methdod/add', 'PaymentController@add')->name('payment.add');
            


            Route::any('/payment_methdod/delete/{id}', 'PaymentController@delete')->name('payment.delete');
//            Route::any('/settings', 'DashboardController@settings')->name('settings');
            Route::any('/cart_add/{id}/{shop}', 'InvoiceController@cart')->name('invoice.cart');
            Route::any('/cart_checkout', 'InvoiceController@checkout')->name('continue.cart');
            Route::any('/invoice/approve/{id}', 'InvoiceController@approve')->name('invoice.approve');


            //pos management
            Route::group(['prefix' => 'purchase', 'as' => 'sell.'], function () {
                Route::get('/', 'SellController@index')->name('index');
                Route::get('quick-view', 'SellController@quick_view')->name('quick-view');
                Route::post('variant_price', 'SellController@variant_price')->name('variant_price');
                Route::post('add-to-cart', 'SellController@addToCart')->name('add-to-cart');
                Route::post('remove-from-cart', 'SellController@removeFromCart')->name('remove-from-cart');
                Route::post('cart-items', 'SellController@cart_items')->name('cart_items');
                Route::post('update-quantity', 'SellController@updateQuantity')->name('updateQuantity');
                Route::post('empty-cart', 'SellController@emptyCart')->name('emptyCart');
                Route::post('tax', 'SellController@update_tax')->name('tax');
                Route::post('discount', 'SellController@update_discount')->name('discount');
                Route::get('customers', 'SellController@get_customers')->name('customers');
                Route::post('order', 'SellController@place_order')->name('order');
                Route::get('orders', 'SellController@order_list')->name('orders');
                Route::get('order-details/{id}', 'SellController@order_details')->name('order-details');
                // Route::get('invoice/{id}', 'SellController@generate_invoice');
                Route::get('invoice/{id}', 'SellController@generate_invoice_order')->name('order.invoice');
                Route::any('store-keys', 'SellController@store_keys')->name('store-keys');
                Route::get('search-products', 'SellController@search_product')->name('search-products');





                
                Route::get('change-cart', 'SellController@change_cart')->name('change-cart');
                Route::get('new-cart-id', 'SellController@new_cart_id')->name('new-cart-id');
                Route::post('remove-discount', 'SellController@remove_discount')->name('remove-discount');
                Route::get('clear-cart-ids', 'SellController@clear_cart_ids')->name('clear-cart-ids');
                Route::get('get-cart-ids', 'SellController@get_cart_ids')->name('get-cart-ids');

                Route::post('customer-store', 'SellController@customer_store')->name('customer-store');
            });


            //pos management
            Route::group(['prefix' => 'pos', 'as' => 'pos.'], function () {
                Route::get('/', 'POSController@index')->name('index');
                Route::get('quick-view', 'POSController@quick_view')->name('quick-view');
                Route::get('emrg-quick-view', 'POSController@emrg_quick_view')->name('emrg-quick-view');
                Route::post('variant_price', 'POSController@variant_price')->name('variant_price');
                Route::post('add-to-cart', 'POSController@addToCart')->name('add-to-cart');
                Route::post('add-to-batch', 'POSController@addToBatch')->name('add-to-batch');
                Route::post('remove-from-cart', 'POSController@removeFromCart')->name('remove-from-cart');
                Route::post('cart-items', 'POSController@cart_items')->name('cart_items');

                Route::post('quantity/increment', 'POSController@quantityIncrement')->name('quantity-increment');
                Route::post('quantity/decrement', 'POSController@quantityDecrement')->name('quantity-decrement');
                Route::post('quantity/inputed', 'POSController@quantityInputed')->name('quantity-inputed');
                Route::post('set-batch', 'POSController@setBatch')->name('set-batch');
                Route::post('set-product-discount', 'POSController@setProductDiscount')->name('set-product-discount');

                Route::post('update-quantity', 'POSController@updateQuantity')->name('updateQuantity');
                Route::post('empty-cart', 'POSController@emptyCart')->name('emptyCart');
                Route::post('tax', 'POSController@update_tax')->name('tax');
                Route::post('discount', 'POSController@update_discount')->name('discount');
                Route::get('customers', 'POSController@get_customers')->name('customers');
                Route::post('order', 'POSController@place_order')->name('order');
                Route::get('orders', 'POSController@order_list')->name('orders');
                Route::get('order-details/{id}', 'POSController@order_details')->name('order-details');
                Route::get('invoice/{id}', 'POSController@generate_invoice');
                Route::any('store-keys', 'POSController@store_keys')->name('store-keys');
                Route::get('search-products', 'POSController@search_product')->name('search-products');

                Route::post('coupon-discount', 'POSController@coupon_discount')->name('coupon-discount');
                Route::get('change-cart', 'POSController@change_cart')->name('change-cart');
                Route::get('new-cart-id', 'POSController@new_cart_id')->name('new-cart-id');
                Route::post('remove-discount', 'POSController@remove_discount')->name('remove-discount');
                Route::get('clear-cart-ids', 'POSController@clear_cart_ids')->name('clear-cart-ids');
                Route::get('get-cart-ids', 'POSController@get_cart_ids')->name('get-cart-ids');

                Route::post('customer-store', 'POSController@customer_store')->name('customer-store');
                Route::get('invoice-mail/{id}', 'POSController@sendInvoiceMail')->name('send_invoice_to_email');
            });

            // New purchase Interface
            Route::group(['prefix' => 'purchase','as' => 'purchase.'], function (){
                Route::get('index','NPurchaseController@index')->name('index');
                Route::get('create','NPurchaseController@create')->name('create');
                Route::post('store','NPurchaseController@store')->name('store');
                Route::get('show/{id}','NPurchaseController@show')->name('show');
                Route::get('destroy/{id}','NPurchaseController@destroy')->name('destroy');
                Route::post('add-to-cart','NPurchaseController@addToCart')->name('add_to_cart');
                Route::post('remove-from-cart','NPurchaseController@removeFromCart')->name('remove_from_cart');
                Route::post('update-cart','NPurchaseController@updateCart')->name('update_cart');

                Route::get('return-history','NPurchaseController@returnHistory')->name('return');
                Route::get('return-form/{id}','NPurchaseController@showReturnForm')->name('return.form');
                Route::post('return-process/{id}','NPurchaseController@returnProcess')->name('return.process');
                Route::get('return-invoice/{id}','NPurchaseController@returnInvoice')->name('return.invoice');
                Route::get('get-medicines','NPurchaseController@getMedicines')->name('get_medicines');
                // Route::patch('/returns/update-status/{id}', 'NPurchaseController@updateStatus')->name('returns.updateStatus');
                Route::post('/returns/update-status//{id}', [NPurchaseController::class, 'updateStatus'])->name('returns.updateStatus');



            });

            Route::prefix('notifications')->name('notification.')->group(function() {
                Route::get('/index','NotificationController@index')->name('index');
                Route::get('/show/{id}','NotificationController@show')->name('show');
            });
        });
    });
});
Route::get('order/invoice/{id}', 'Controller@viewCustomerInvoice')->name('view.customer.invoice');
// CACHE CLEAR
Route::get('/clear', function () {
    Artisan::call('optimize:clear');
    return response()->json("Cache Cleared Successfully!");
});
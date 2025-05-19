<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <x-menu.link title="Dashboard" route="{{ route('dashboard') }}" activeUrl="dashboard"
                 icon="fa fa-tachometer"></x-menu.link>

    @if (hasPermission(['user.index', 'role.index']))
        <li class=" nav-item {{ active_if_match('admin/admin') }} || {{ active_if_match('admin/role') }}">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-user-gear"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                    {{ translate('menu.User & Role') }}
                </span>
            </a>
            <ul class="menu-content">
                @can('user.index')
                    <x-menu.link title="Users" route="{{ route('user.index') }}" activeUrl="user/index"></x-menu.link>
                @endcan
                @can('user.index')
                    <x-menu.link title="Roles & Permissions" route="{{ route('role.index') }}"
                                 activeUrl="admin/role"></x-menu.link>
                @endcan
            </ul>
        </li>
    @endif
    @if (hasPermission(['setting.generalSetting','email.update']))
        <li class=" nav-item {{ active_if_match('admin/admin') }} || {{ active_if_match('admin/role') }}">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-gear"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                    {{ translate('menu.Settings') }}
                </span>
            </a>
            <ul class="menu-content">
                @can('setting.generalSetting')
                    <x-menu.link title="General Setting" route="{{ route('setting.generalSetting') }}"
                                 activeUrl="settings"></x-menu.link>
                @endcan
                @can('email.update')
                    <x-menu.link title="Email Setting" route="{{ route('setting.emailSetting') }}"
                                 activeUrl="admin/config/mail-sms"></x-menu.link>
                @endcan
               
            </ul>
        </li>
    @endif
    @if (hasPermission(['customer.index', 'customer.create']))
        <li class=" nav-item {{ active_if_match('customer/add') }} || {{ active_if_match('customer/list') }}">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-users"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                    {{ translate('menu.Customers') }}
                </span>
            </a>
            <ul class="menu-content">
                @can('customer.create')
                    <x-menu.link title="add Customer " route="{{ route('customer.create') }}"
                                 activeUrl="customer/create"></x-menu.link>
                @endcan
                @can('customer.index')
                    <x-menu.link title="Customer list" route="{{ route('customer.index') }}"
                                 activeUrl="customer/list"></x-menu.link>
                @endcan
            </ul>
        </li>
    @endif


    @if(hasPermission(['supplier.list','supplier.add']))
        <li class=" nav-item {{ active_if_match('supplier/*') }}"><a class="d-flex align-items-center"
                                                                     href="#"><i
                        class="fa-solid fa-people-carry-box"></i><span class="menu-title text-truncate"
                                                                       data-i18n="Invoice">{{ translate('common.supplier') }}</span></a>
            <ul class="menu-content">
                @can('vendor.create')
                    <x-menu.link title="add Supplier" route="{{ route('supplier.add') }}"
                                 activeUrl="supplier/add"></x-menu.link>
                @endcan
                @can('vendor.create')
                    <x-menu.link title="Supplier list" route="{{ route('supplier.list') }}"
                                 activeUrl="supplier/list"></x-menu.link>
                @endcan


            </ul>
        </li>
    @endif



    @if(hasPermission(['medicine.list','medicine.create','category.index','medicine.import']))
        <li class=" nav-item {{ active_if_match('medicines/add') }} || {{ active_if_match('medicines/list') }} || {{ active_if_match('medicines/import') }} || {{ active_if_match('medicines/categories') }} || {{ active_if_match('medicines/unit') }} || {{ active_if_match('medicines/leaf') }} || {{ active_if_match('medicines/types') }}">
            <a class="d-flex align-items-center" href="#"><i class="fas fa-pills"></i><span
                        class="menu-title text-truncate"
                        data-i18n="Invoice">{{ translate('common.medicine') }}</span></a>
            <ul class="menu-content">

                @can('medicine.create')
                    <x-menu.link title="add Medicine" route="{{ route('medicine.add') }}"
                                 activeUrl="medicines/add"></x-menu.link>
                @endcan

                <x-menu.link title="FMCG products" route="{{ route('medicine.fmcg') }}"
                activeUrl="medicines/fmcg"></x-menu.link>

                @can('medicine.list')
                    <x-menu.link title="Mdicine list" route="{{ route('medicine.list') }}"
                                 activeUrl="medicines/list"></x-menu.link>
                @endcan

                @can('category.index')
                    <x-menu.link title="categories" route="{{ route('category') }}"
                                 activeUrl="medicines/categories"></x-menu.link>
                @endcan
                <x-menu.link title="Units" route="{{ route('units') }}"
                             activeUrl="medicines/unit"></x-menu.link>

                <x-menu.link title="Leaf" route="{{ route('leaf') }}"
                             activeUrl="medicines/leaf"></x-menu.link>
                @can('purchase.create')
                    <x-menu.link title="Types" route="{{ route('types') }}"
                                 activeUrl="medicines/type"></x-menu.link>
                @endcan
                @can('purchase.create')
                    <x-menu.link title="Medicine Import" route="{{ route('medicines.import') }}"
                                 activeUrl="medicines/import"></x-menu.link>
                @endcan
            </ul>
        </li>
    @endif

    @if(hasPermission(['purchase.index','purchase.create']))
        <li class=" nav-item {{ active_if_match('purchase/*') }} ">
            <a class="d-flex align-items-center"
               href="#"><i class="fas fa-cart-shopping"></i><span class="menu-title text-truncate"
                                                                  data-i18n="Invoice">{{ translate('menu.purchase') }}</span>
            </a>
            <ul class="menu-content">
                @can('purchase.create')
                    <x-menu.link title="Add purchase" route="{{ route('purchase.create') }}"
                                 activeUrl="purchase/create"></x-menu.link>
                @endcan
                @can('purchase.create')
                    <x-menu.link title="Purchase history" route="{{ route('purchase.index') }}"
                                 activeUrl="purchase/index"></x-menu.link>
                @endcan
                @can('purchase.create')
                    <x-menu.link title="Return History" route="{{ route('purchase.return') }}"
                                 activeUrl="purchase/return-history"></x-menu.link>
                @endcan
            </ul>
        </li>
    @endif

    @if(hasPermission(['report.instock','report.low_stock','report.stockout','report.upcoming_expire','report.already_expire']))
        <li class="nav-item {{ active_if_match(['report.instock','report.low_stock','report.stockout','report.upcoming_expire','report.already_expire']) }}">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-pills"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                    {{ translate('menu.Medicine Stock') }}
                </span>
            </a>
            <ul class="menu-content">
                @can('report.instock')
                    <x-menu.link title="In Stock" route="{{ route('report.instock') }}"
                                 activeUrl="report/instock-medicine"></x-menu.link>
                @endcan
                @can('report.low_stock')
                    <x-menu.link title="Low Stock" route="{{ route('report.low_stock') }}"
                                 activeUrl="report/lowstock-medicine"></x-menu.link>
                @endcan
                @can('report.stockout')
                    <x-menu.link title="Stockout" route="{{ route('report.stockout') }}"
                                 activeUrl="report/stockout-medicine"></x-menu.link>
                @endcan
                @can('report.upcoming_expire')
                    <x-menu.link title="Upcoming Expired" route="{{ route('report.upcoming_expire') }}"
                                 activeUrl="report/upcoming-expire-medicine"></x-menu.link>
                @endcan
                @can('report.already_expire')
                    <x-menu.link title="Already Expired" route="{{ route('report.already_expire') }}"
                                 activeUrl="report/already-expire-medicine"></x-menu.link>
                @endcan
            </ul>
        </li>
    @endif

    @if(hasPermission(['sale.index','sale.create']))
        <li class="nav-item {{ active_if_match('invoice*') }} || {{ active_if_match('returned_history') }}"><a
                    class="d-flex align-items-center" href="#"><i class="fa-solid fa-file-invoice"></i><span
                        class="menu-title text-truncate" data-i18n="Invoice">{{ translate('Sales') }}</span></a>
            <ul class="menu-content">
                @can('sale.create')
                    <x-menu.link title="New Invoice" route="{{ route('pos.index') }}"
                                 activeUrl="invoice/new*">
                    </x-menu.link>
                @endcan
                @can('sale.index')
                    <x-menu.link title="Invoice History" route="{{ route('invoice.reports') }}"
                                 activeUrl="invoice/reports">
                    </x-menu.link>
                @endcan
                @can('sale.index')
                    <x-menu.link title="Return History" route="{{ route('return.history') }}"
                                 activeUrl="returned_history">
                    </x-menu.link>
                @endcan
            </ul>
        </li>
    @endif









    @if (hasPermission(['expenses.create', 'expenses.index','expense-categories.create','expense-categories.index']))
        <li class=" nav-item {{ active_if_match(['expense/index','expense-categories/index']) }}">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-gear"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                    {{ translate('menu.Expense') }}
                </span>
            </a>
            <ul class="menu-content">
                @can('expenses.create')
                    <x-menu.link title="New Expense" route="{{ route('expenses.create') }}"
                                 activeUrl="expense-category/index"></x-menu.link>
                @endcan
                @can('expenses.index')
                    <x-menu.link title="Expense List" route="{{ route('expenses.index') }}"
                                 activeUrl="expenses/index"></x-menu.link>
                @endcan
                @can('expense-categories.create')
                    <x-menu.link title="New Category" route="{{ route('expense-categories.create') }}"
                                 activeUrl="language"></x-menu.link>
                @endcan
                @can('expense-categories.index')
                    <x-menu.link title="Category List" route="{{ route('expense-categories.index') }}"
                                 activeUrl="expense-categories/index"></x-menu.link>
                @endcan
            </ul>
        </li>
    @endif


    @if(hasPermission(['bank.index','bank.create','bank.store','bank.update']))
        <li class=" nav-item {{ active_if_match('report/medicine/topsell') }} || {{ active_if_match('report/customer-due') }} || {{ active_if_match('report/supplier/due') }} || {{ active_if_match('reports') }} || {{ active_if_match('profit') }}">
            <a class="d-flex align-items-center" href="#">
            <i class="fa-solid fa-piggy-bank bank-icon"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                {{ translate('Bank account') }}
            </span>
            </a>
            <ul class="menu-content">
            @can('bank.index')
            <x-menu.link title="Bank account" route="{{ route('bank.view') }}"
                 activeUrl=""></x-menu.link>
            @endcan
            @can('bank.create')
            <x-menu.link title="add Bank account" route="{{ route('bank.form') }}"
                 activeUrl=""></x-menu.link>
            @endcan
            @can('banktrans.index')
            <x-menu.link title="Bank Transaction" route="{{ route('banktrans.index') }}"
            activeUrl=""></x-menu.link>
            @endcan           
            </ul>
        </li>
    @endif

   
    @php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Support\Facades\File;
    @endphp
<!-- Ecommerce Setup -->
    @if (Schema::hasTable('settings') && Schema::hasTable('products'))
        <li class=" nav-item {{ active_if_match('ecommerce/*') }}">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-shopping-bag"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                    {{ translate('common.Ecommerce Management') }}
                </span>
                <span class="badge bg-danger">Addon</span>
            </a>
            <ul class="menu-content">
                <li class="{{ active_if_full_match('ecommerce/setting') }}">
                    <a class="d-flex align-items-center" href="{{ route('ecommerce.setting.show') }}">
                        <i class="fas fa-cogs"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Settings') }}
                        </span>
                    </a>
                </li>
                <li class="{{ active_if_full_match('ecommerce/pages') }}">
                    <a class="d-flex align-items-center" href="{{ route('ecommerce.setting.pages') }}">
                        <i class="fas fa-cogs"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Pages') }}
                        </span>
                    </a>
                </li>
                <li
                        class="{{ active_if_full_match('ecommerce/slider') }} || {{ active_if_full_match('ecommerce/slider/*') }}">
                    <a class="d-flex align-items-center" href="{{ route('ecommerce.slider.index') }}">
                        <i class="fas fa-images"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Slider') }}
                        </span>
                    </a>
                </li>
                <li class="{{ active_if_full_match('ecommerce/product-list') }}">
                    <a class="d-flex align-items-center" href="{{ route('ecommerce.product.index') }}">
                        <i class="fas fa-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Products') }}
                        </span>
                    </a>
                </li>
                <li
                        class="{{ active_if_full_match('ecommerce/product/instock') }} || {{ active_if_full_match('ecommerce/customer/*') }}">
                    <a class="d-flex align-items-center" href="{{ route('ecommerce.product.instock') }}">
                        <i class="fas fa-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Instock Product') }}
                        </span>
                    </a>
                </li>
                <li
                        class="{{ active_if_full_match('ecommerce/product-types') }} || {{ active_if_full_match('ecommerce/product-type/*') }}">
                    <a class="d-flex align-items-center" href="{{ route('ecommerce.product_type.index') }}">
                        <i class="fas fa-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Categories') }}
                        </span>
                    </a>
                </li>
                <li
                        class="{{ active_if_full_match('ecommerce/order') }} || {{ active_if_full_match('ecommerce/order/*') }}">
                    <a class="d-flex align-items-center" href="{{ route('ecommerce.order.index') }}">
                        <i class="fas fa-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Orders') }}
                        </span>
                    </a>
                </li>
                <li class="{{ active_if_match('ecommerce/report/*') }}">
                    <a class="d-flex align-items-center" href="#">
                        <i class="fas fa-list"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Reports') }}
                        </span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ active_if_full_match('ecommerce/report/top-sale-product') }}">
                            <a class="d-flex align-items-center" href="{{ route('ecommerce.report.top_sale') }}">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate" data-i18n="List">
                                    {{ translate('common.Top Sale Product') }}
                                </span>
                            </a>
                        </li>
                        <li class="{{ active_if_full_match('ecommerce/report/sale') }}">
                            <a class="d-flex align-items-center" href="{{ route('ecommerce.report.sale') }}">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate">
                                    {{ translate('common.Sales Report') }}
                                </span>
                            </a>
                        </li>
                        <li class="{{ active_if_full_match('ecommerce/report/profit-loss') }}">
                            <a class="d-flex align-items-center" href="{{ route('ecommerce.report.profit_loss') }}">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate">
                                    {{ translate('common.Profit & Loss') }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li
                        class="{{ active_if_full_match('ecommerce/customer') }} || {{ active_if_full_match('ecommerce/customer/*') }}">
                    <a class="d-flex align-items-center" href="{{ route('ecommerce.customer.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Customers') }}
                        </span>
                    </a>
                </li>
                <li
                        class="{{ active_if_full_match('csv/export-import') }} || {{ active_if_full_match('csv/export-import/*') }}">
                    <a class="d-flex align-items-center" href="{{ route('ecommerce.csv.export_import') }}">
                        <i class="fas fa-cloud-upload"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Export & Import') }}
                        </span>
                    </a>
                </li>
            </ul>
        </li>
    @endif

<!-- HRM -->


    @if (Schema::hasTable('accounts') && Schema::hasTable('transactions'))
        <li class=" nav-item {{ active_if_match(['account-types','accounts','transactions','reports/trail-balance','reports/balance-sheet','reports/income-statement']) }}">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-bank"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                    {{ translate('common.Accounts') }}
                </span>
                <!-- <span class="badge bg-danger">Addon</span> -->
            </a>
            <ul class="menu-content">
                <li class="{{ active_if_full_match('account-types') }}">
                    <a class="d-flex align-items-center" href="{{ route('account-types.index') }}">
                        <i class="fas fa-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Account Type') }}
                        </span>
                    </a>
                </li>
                <li class="{{ active_if_full_match('accounts') }}">
                    <a class="d-flex align-items-center" href="{{ route('accounts.index') }}">
                        <i class="fas fa-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Account') }}
                        </span>
                    </a>
                </li>
                <li class="{{ active_if_full_match('transactions') }}">
                    <a class="d-flex align-items-center" href="{{ route('transactions.index') }}">
                        <i class="fas fa-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Transaction') }}
                        </span>
                    </a>
                </li>
                <li class="{{ active_if_full_match('reports/trail-balance') }}">
                    <a class="d-flex align-items-center" href="{{ route('report.TrailBalance') }}">
                        <i class="fas fa-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Trail Balance') }}
                        </span>
                    </a>
                </li>
                <li
                        class="{{ active_if_full_match('reports/balance-sheet') }} || {{ active_if_full_match('ecommerce/customer/*') }}">
                    <a class="d-flex align-items-center" href="{{ route('report.BalanceSheet') }}">
                        <i class="fas fa-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Balance Sheet') }}
                        </span>
                    </a>
                </li>
                <li
                        class="{{ active_if_full_match('reports/income-statement') }} || {{ active_if_full_match('ecommerce/product-type/*') }}">
                    <a class="d-flex align-items-center" href="{{ route('report.IncomeStatement') }}">
                        <i class="fas fa-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Income Statement') }}
                        </span>
                    </a>
                </li>
            </ul>
        </li>
    @endif
    @if(hasPermission(['report.due_customer','report.payable_manufacturer','report.sale_purchase','report.profit_loss']))
        <li class=" nav-item {{ active_if_match('report/medicine/topsell') }} || {{ active_if_match('report/customer-due') }} || {{ active_if_match('report/supplier/due') }} || {{ active_if_match('reports') }} || {{ active_if_match('profit') }}">
            <a class="d-flex align-items-center" href="#">
                <i class="fa-solid fa-chart-line"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                {{ translate('Reports') }}
            </span>
            </a>
            <ul class="menu-content">
                @can('report.due_customer')
                    <x-menu.link title="Customer due" route="{{ route('report.customer_due') }}"
                                 activeUrl="report/customer/due">
                    </x-menu.link>
                @endcan
                @can('report.payable_manufacturer')
                    <x-menu.link title="Payable supplier" route="{{ route('report.supplier_due') }}"
                                 activeUrl="report/supplier/due">
                    </x-menu.link>
                @endcan
                @can('report.sale_purchase')
                    <x-menu.link title="Sells & Purchase Reports" route="{{ route('reports') }}"
                                 activeUrl="reports">
                        @endcan
                    </x-menu.link>
                    <x-menu.link title="Top Sell Medicine" route="{{ route('report.topsell_medicine') }}"
                                 activeUrl="report/medicine/topsell">
                    </x-menu.link>
                    @can('supplier.report')
                    <x-menu.link title="supplier report" route="{{ route('report.supplier') }}"
                                 activeUrl="report/business/profit-loss">
                    </x-menu.link>
                    @endcan
                   
                    

                    @can('report.profit_loss')
                        <x-menu.link title="Medicine Profit & Loss" route="{{ route('profit') }}"
                                     activeUrl="profit">
                            @endcan
                        </x-menu.link>
                        @if (Schema::hasTable('expenses'))
                            <x-menu.link title="Business Profit & Loss" route="{{ route('report.businessprofitloss') }}"
                                         activeUrl="report/business/profit-loss">
                            </x-menu.link>
                        @endif
                       
            </ul>
        </li>
    @endif
    
   


    @if(hasPermission(['paymentmethod.index']))
        <li class=" nav-item {{ active_if_match('doctor') }} || {{ active_if_match('patient') }} || {{ active_if_match('test') }} || {{ active_if_match('prescription') }}">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-prescription"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                {{ translate('menu.Payment method') }}
            </span>
            </a>
            <ul class="menu-content">
            @can('paymentmethod.index')
            <x-menu.link title="Payment method" route="{{ route('payment.method') }}"
                     activeUrl="payment_methdod"></x-menu.link>
            @endcan
               
            </ul>
        </li>
    @endif

    </ul>
    
                           

    
    

<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class=" nav-item {{ active_if_full_match('dashboard') }}">
        <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
            <i class="fa fa-tachometer" aria-hidden="true"></i>
            <span class="menu-title text-truncate" data-i18n="Dashboards">{{ translate('common.dashboard') }}</span>
        </a>
    </li>
    <li class=" nav-item {{ active_if_match('customer/add') }} || {{ active_if_match('customer/list') }}">
        <a class="d-flex align-items-center" href="#">
            <i class="fas fa-users"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">
                {{ translate('common.customer') }}
            </span>
        </a>
        <ul class="menu-content">
            <li class="{{ active_if_full_match('customer/add') }}">
                <a class="d-flex align-items-center" href="{{ route('customer.add') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('common.customer_add') }}
                    </span>
                </a>
            </li>
            <li
                class="{{ active_if_full_match('customer/list') }} {{ active_if_full_match('customer/edit/*') }} {{ active_if_full_match('customer/view/*') }}">
                <a class="d-flex align-items-center" href="{{ route('customer.list') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">
                        {{ translate('common.customer_list') }}
                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li
        class=" nav-item {{ active_if_match('in_stock') }} || {{ active_if_match('emergency-stock') }} || {{ active_if_match('medicines/stockout') }} || {{ active_if_match('upcoming') }} || {{ active_if_match('medicines/expired') }}">
        <a class="d-flex align-items-center" href="#">
            <i class="fas fa-pills"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">
                {{ translate('Medicine Stock') }}
            </span>
        </a>
        <ul class="menu-content">
            <li class="{{ active_if_full_match('in_stock') }}">
                <a class="d-flex align-items-center" href="{{ route('instock') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('In Stock') }}
                    </span>
                </a>
            </li>
            {{-- <li class="{{ active_if_full_match('emergency-stock') }}">
                <a class="d-flex align-items-center" href="{{ route('emergency_stock') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('Emergency Stock') }}
                    </span>
                </a>
            </li> --}}
            <li class="{{ active_if_full_match('medicines/lowstock') }}">
                <a class="d-flex align-items-center" href="{{ route('lowstock') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('Low Stock') }}
                    </span>
                </a>
            </li>
            <li class="{{ active_if_full_match('medicines/stockout') }}">
                <a class="d-flex align-items-center" href="{{ route('stockout') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('Stockout') }}
                    </span>
                </a>
            </li>


            <li class="{{ active_if_full_match('upcoming') }}">
                <a class="d-flex align-items-center" href="{{ route('upcoming') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('Upcoming Expired') }}
                    </span>
                </a>
            </li>

            <li class="{{ active_if_full_match('medicines/expired') }}">
                <a class="d-flex align-items-center" href="{{ route('expired') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('Already Expired') }}
                    </span>
                </a>
            </li>
        </ul>
    </li>

    <!--Systems menus -->
    <li class=" nav-item {{ active_if_match('admin/admin') }} || {{ active_if_match('admin/role') }}">
        <a class="d-flex align-items-center" href="#">
            <i class="fas fa-cogs"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">
                {{ translate('Systems') }}
            </span>
        </a>
        <ul class="menu-content">
            <li class="{{ active_if_full_match('admin/admin') }}">
                <a class="d-flex align-items-center" href="{{ route('admin.index') }}">
                    <i class="fas fa-user"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('Admin User') }}
                    </span>
                </a>
            </li>
            <li class="{{ active_if_full_match('admin/role') }}">
                <a class="d-flex align-items-center" href="{{ route('role.index') }}">
                    <i class="fas fa-lock"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('Roles') }}
                    </span>
                </a>
            </li>
            <li class="{{ active_if_full_match('admin/config/mail-sms') }}">
                <a class="d-flex align-items-center" href="{{ route('admin.mail_sms_config') }}">
                    <i class="fas fa-envelope"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('Config. Mail ') }}
                    </span>
                </a>
            </li>
        </ul>
    </li>
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
    @if (Schema::hasTable('attendances') && Schema::hasTable('departments'))
        <li class="nav-item {{ active_if_match('hrm/*') }}">
            <a class="d-flex align-items-center" href="#">
                <i class="fas fa-address-book"></i>
                <span class="menu-title text-truncate" data-i18n="Invoice">
                    {{ translate('common.HR Management') }}
                </span>
                <span class="badge bg-danger">Addon</span>
            </a>
            <ul class="menu-content">
                <li class="{{ active_if_full_match('hrm/employee/designation') }}">
                    <a class="d-flex align-items-center" href="{{ route('hrm.department.index') }}">
                        <i class="fas fa-user-graduate"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Departments') }}
                        </span>
                    </a>
                </li>
                <li class="{{ active_if_full_match('hrm/employee/designation') }}">
                    <a class="d-flex align-items-center" href="{{ route('hrm.designation.index') }}">
                        <i class="fas fa-user-cog"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Designations') }}
                        </span>
                    </a>
                </li>
                <li class="{{ active_if_full_match('hrm/employee') }}">
                    <a class="d-flex align-items-center" href="{{ route('hrm.employee.index') }}">
                        <i class="fas fa-user-friends"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Employees') }}
                        </span>
                    </a>
                </li>
                <li
                    class="{{ active_if_full_match('hrm/attendance') }} || {{ active_if_full_match('hrm/attendance/*') }}">
                    <a class="d-flex align-items-center" href="{{ route('hrm.attendance.index') }}">
                        <i class="fas fa-user-check"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Attendance') }}
                        </span>
                    </a>
                </li>
                <li class="{{ active_if_match('hrm/payroll/*') }}">
                    <a class="d-flex align-items-center" href="#">
                        <i class="fas fa-pager"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Payroll') }}
                        </span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ active_if_full_match('hrm/payroll/benefit') }}">
                            <a class="d-flex align-items-center" href="{{ route('hrm.benefit.index') }}">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate" data-i18n="List">
                                    {{ translate('common.Benefits') }}
                                </span>
                            </a>
                        </li>
                        <li class="{{ active_if_full_match('hrm/payroll/salary-setup') }}">
                            <a class="d-flex align-items-center" href="{{ route('hrm.salarysetup.index') }}">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate">
                                    {{ translate('common.Salary Setup') }}
                                </span>
                            </a>
                        </li>
                        <li class="{{ active_if_full_match('hrm/payroll/salary-sheet/generate') }}">
                            <a class="d-flex align-items-center" href="{{ route('hrm.salarysheet.generate') }}">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate">
                                    {{ translate('common.Salary Generate') }}
                                </span>
                            </a>
                        </li>
                        <li class="{{ active_if_full_match('hrm/payroll/salary-sheet') }}">
                            <a class="d-flex align-items-center" href="{{ route('hrm.salarysheet.index') }}">
                                <i class="fas fa-circle"></i>
                                <span class="menu-item text-truncate">
                                    {{ translate('common.Salary Sheet') }}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ active_if_full_match('hrm/expense') }}">
                    <a class="d-flex align-items-center" href="{{ route('hrm.expense.index') }}">
                        <i class="fas fa-wallet"></i>
                        <span class="menu-item text-truncate" data-i18n="List">
                            {{ translate('common.Expense') }}
                        </span>
                    </a>
                </li>
            </ul>
        </li>
    @endif

    <li class=" nav-item {{ active_if_match('supplier/*') }}"><a class="d-flex align-items-center"
            href="#"><i class="fa-solid fa-people-carry-box"></i><span class="menu-title text-truncate"
                data-i18n="Invoice">{{ translate('common.supplier') }}</span></a>
        <ul class="menu-content">
            <li class="{{ active_if_full_match('supplier/add') }}"><a class="d-flex align-items-center"
                    href="{{ route('supplier.add') }}"><i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="List">
                        {{ translate('common.supplier_add') }}
                    </span>
                </a>
            </li>
            <li
                class="{{ active_if_full_match('supplier/list*') }} {{ active_if_full_match('supplier/edit/*') }} {{ active_if_full_match('supplier/view/*') }}">
                <a class="d-flex align-items-center" href="{{ route('supplier.list') }}"><i
                        data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">
                        {{ translate('common.supplier_list') }}
                    </span>
                </a>
            </li>
        </ul>
    </li>

    <!-- Vendors Routes -->
    <li class=" nav-item {{ active_if_match('vendor/*') }}">
        <a class="d-flex align-items-center" href="#">
            <i class="fa-solid fa-store"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">{{ translate('common.vendors') }}</span>
        </a>
        <ul class="menu-content">
            <li class="{{ active_if_full_match('vendor/create') }}">
                <a class="d-flex align-items-center" href="{{ route('vendor.create') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate"
                        data-i18n="List">{{ translate('common.vendor_add') }}</span>
                </a>
            </li>
            <li class="{{ active_if_full_match('vendor/list') }} {{ active_if_full_match('vendor/*/view') }}">
                <a class="d-flex align-items-center" href="{{ route('vendor.index') }}"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview">{{ translate('common.vendor_list') }}</span></a>
            </li>
        </ul>
    </li>


    <li
        class=" nav-item {{ active_if_match('medicines/add') }} || {{ active_if_match('medicines/list') }} || {{ active_if_match('medicines/import') }} || {{ active_if_match('medicines/categories') }} || {{ active_if_match('medicines/unit') }} || {{ active_if_match('medicines/leaf') }} || {{ active_if_match('medicines/types') }}">
        <a class="d-flex align-items-center" href="#"><i class="fas fa-pills"></i><span
                class="menu-title text-truncate" data-i18n="Invoice">{{ translate('common.medicine') }}</span></a>
        <ul class="menu-content">
            <li class="{{ active_if_full_match('medicines/add') }}"><a class="d-flex align-items-center"
                    href="{{ route('medicine.add') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate"
                        data-i18n="List">{{ translate('common.medicine_add') }}</span></a>
            </li>
            <li class="{{ active_if_full_match('medicines/list') }} {{ active_if_match('medicines/edit/*') }}">
                <a class="d-flex align-items-center" href="{{ route('medicine.list') }}"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview">{{ translate('common.medicine_list') }}</span></a>
            </li>

            <li class="{{ active_if_full_match('medicines/categories') }}"><a class="d-flex align-items-center"
                    href="{{ route('category') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate"
                        data-i18n="Add">{{ translate('common.categories') }}</span></a>
            </li>
            <li class="{{ active_if_full_match('medicines/unit') }}"><a class="d-flex align-items-center"
                    href="{{ route('units') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Add">{{ translate('common.units') }}</span></a>
            </li>
            <li class="{{ active_if_full_match('medicines/leaf') }}"><a class="d-flex align-items-center"
                    href="{{ route('leaf') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Add">{{ translate('common.leaf') }}</span></a>
            </li>
            <li class="{{ active_if_full_match('medicines/type*') }}"><a class="d-flex align-items-center"
                    href="{{ route('types') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Add">{{ translate('common.types') }}</span></a>
            </li>
            <li class="{{ active_if_full_match('medicines/import') }}">
                <a class="d-flex align-items-center" href="{{ route('medicines.import') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Medicine Import">
                        {{ translate('common.Medicine Import') }}
                    </span>
                </a>
            </li>
        </ul>
    </li>


    <li class=" nav-item {{ active_if_match('purchase/*') }} "><a class="d-flex align-items-center"
            href="#"><i class="fas fa-cart-shopping"></i><span class="menu-title text-truncate"
                data-i18n="Invoice">{{ translate('common.purchase') }}</span></a>
        <ul class="menu-content">
            <li class="{{ active_if_full_match('purchase/create') }} {{ active_if_match('purchase/create') }}"><a
                    class="d-flex align-items-center" href="{{ route('purchase.create') }}"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="List">{{ translate('common.new_purchase') }}</span></a>
            </li>
            <li class="{{ active_if_full_match('purchase/index') }} {{ active_if_match('purchase/index') }}"><a
                    class="d-flex align-items-center" href="{{ route('purchase.index') }}"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview">{{ translate('common.purchase_history') }}</span></a>
            </li>
            <li class="{{ active_if_full_match('purchase/return-history') }}">
                <a class="d-flex align-items-center" href="{{ route('purchase.return') }}"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview">{{ translate('Return History') }}</span></a>
            </li>
        </ul>
    </li>

    <li class=" nav-item {{ active_if_match('invoice*') }} || {{ active_if_match('returned_history') }}"><a
            class="d-flex align-items-center" href="#"><i class="fa-solid fa-file-invoice"></i><span
                class="menu-title text-truncate" data-i18n="Invoice">{{ translate('Sales') }}</span></a>
        <ul class="menu-content">
            <li class="{{ active_if_full_match('invoice/new*') }}"><a class="d-flex align-items-center"
                    href="{{ route('pos.index') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="List">{{ translate('New Invoice') }}</span></a>
            </li>
            <li class="active_if_full_match('invoice/reports*') }} {{ active_if_match('invoice/reports') }}"><a
                    class="d-flex align-items-center" href="{{ route('invoice.reports') }}"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview">{{ translate('Invoice History') }}</span></a>
            </li>
            <li class="active_if_full_match('returned_history') }} {{ active_if_match('returned_history') }}"><a
                    class="d-flex align-items-center" href="{{ route('return.history') }}"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Preview">{{ translate('Return History') }}</span></a>
            </li>
        </ul>
    </li>
    <li
        class=" nav-item {{ active_if_match('report/medicine/topsell') }} || {{ active_if_match('report/customer-due') }} || {{ active_if_match('report/supplier/due') }} || {{ active_if_match('reports') }} || {{ active_if_match('profit') }}">
        <a class="d-flex align-items-center" href="#">
            <i class="fa-solid fa-chart-line"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">
                {{ translate('Reports') }}
            </span>
        </a>
        <ul class="menu-content">
            <li class="{{ active_if_full_match('report/customer/due') }}"><a class="d-flex align-items-center"
                    href="{{ route('report.customer_due') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate"
                        data-i18n="List">{{ translate('common.customer_due') }}</span></a>
            </li>
            <li
                class="{{ active_if_full_match('report/supplier/due') }} {{ active_if_match('report/supplier/due') }}">
                <a class="d-flex align-items-center" href="{{ route('report.supplier_due') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Add">{{ translate('Payable Manufacturer') }}
                    </span>
                </a>
            </li>
            <li class="active_if_full_match('reports') }} {{ active_if_match('reports') }}">
                <a class="d-flex align-items-center" href="{{ route('reports') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">
                        {{ translate('Sells & Purchase Reports') }}
                    </span>
                </a>
            </li>
            <li
                class="active_if_full_match('report/medicine/topsell') }} {{ active_if_match('report/medicine/topsell') }}">
                <a class="d-flex align-items-center" href="{{ route('report.topsell_medicine') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">
                        {{ translate('Top Sell Medicine') }}
                    </span>
                </a>
            </li>
            <li class="{{ active_if_full_match('profit') }} {{ active_if_match('profit') }}">
                <a class="d-flex align-items-center" href="{{ route('profit') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="Preview">
                        {{ translate('Medicine Profit & Loss') }}
                    </span>
                </a>
            </li>
            @if (Schema::hasTable('expenses'))
                <li
                    class="{{ active_if_full_match('report/business/profit-loss') }} {{ active_if_match('report/business/profit-loss') }}">
                    <a class="d-flex align-items-center" href="{{ route('report.businessprofitloss') }}">
                        <i data-feather="circle"></i>
                        <span class="menu-item text-truncate" data-i18n="Preview">
                            {{ translate('Business Profit & Loss') }}
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    </li>

    <li
        class=" nav-item {{ active_if_match('doctor') }} || {{ active_if_match('patient') }} || {{ active_if_match('test') }} || {{ active_if_match('prescription') }}">
        <a class="d-flex align-items-center" href="#">
            <i class="fas fa-prescription"></i>
            <span class="menu-title text-truncate" data-i18n="Invoice">
                {{ translate('Prescription') }}
            </span>
        </a>
        <ul class="menu-content">
            <li class="{{ active_if_full_match('doctor/index') }}">
                <a class="d-flex align-items-center " href="{{ route('doctor.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-item text-truncate">
                        {{ translate('Doctors') }}
                    </span>
                </a>
            </li>
            <li class="{{ active_if_full_match('patient/*') }}">
                <a class="d-flex align-items-center " href="{{ route('patient.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-item text-truncate">
                        {{ translate('Patients') }}
                    </span>
                </a>
            </li>
            <li class="{{ active_if_full_match('test/*') }}">
                <a class="d-flex align-items-center " href="{{ route('test.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-item text-truncate">
                        {{ translate('Diagnosis & Tests') }}
                    </span>
                </a>
            </li>
            <li class="{{ active_if_full_match('prescription/*') }}">
                <a class="d-flex align-items-center " href="{{ route('prescription.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-circle">
                        <circle cx="12" cy="12" r="10"></circle>
                    </svg>
                    <span class="menu-item text-truncate">
                        {{ translate('Prescriptions') }}
                    </span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item {{ active_if_full_match('payment_methdod') }}">
        <a class="d-flex align-items-center" href="{{ route('payment.method') }}">
            <i class="fa-solid fa-money-bill-wave"></i>
            <span class="menu-title text-truncate" data-i18n="Dashboards">
                {{ translate('common.payment_method') }}
            </span>
        </a>
    </li>

    <li class=" nav-item {{ active_if_full_match('settings') }}">
        <a class="d-flex align-items-center" href="{{ route('settings') }}">
            <i class="fa-solid fa-cog"></i>
            <span class="menu-title text-truncate" data-i18n="Dashboards">
                {{ translate('common.site_setting') }}
            </span>
        </a>
    </li>
</ul>
<div class="software-version">
    <div class="box">
        <strong>Pharmacy management software version <span
                class="version">{{ env('SOFTWARE_VERSION', '1.18') }}</span></strong>
    </div>
</div>
<div class="software-version-mini-sidebar">
    <div class="box">
        <strong>{{ env('SOFTWARE_VERSION', '1.18') }}</strong>
    </div>
</div>

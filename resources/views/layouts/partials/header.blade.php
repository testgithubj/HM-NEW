<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light  container-xxl navBar"
     id="desktopmenu">
    <div class="navbar-container d-flex content align-items-center  ">
        <ul class="nav navbar-nav align-items-center px-2">
            @if(hasPermission(['medicine.create','supplier.add','vendor.create','purchase.create']))
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-primary border-r20" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            Add New <i class="fa fa-plus-circle"></i>
                        </button>

                        <ul class="dropdown-menu border-r20 border-0 shadow-lg overflow-hidden"
                            aria-labelledby="dropdownMenuButton1">
                            @can('medicine.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('medicine.add') }}">
                                        <i class="fas fa-pills"></i> Add Medicine
                                    </a>
                                </li>
                            @endcan
                            @can('supplier.add')
                                <li>
                                    <a class="dropdown-item" href="{{ route('supplier.add') }}">
                                        <i class="fa-solid fa-people-carry-box"></i> Add supplier
                                    </a>
                                </li>
                            @endcan
                            @can('purchase.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('purchase.create') }}">
                                        <i class="fas fa-cart-shopping"></i> Add Purchase
                                    </a>
                                </li>
                            @endcan
                            {{-- @can('vendor.create')
                                <li>
                                    <a class="dropdown-item" href="{{ route('vendor.create') }}">
                                        <i class="fa-solid fa-store"></i> Add Vendor
                                    </a>
                                </li>
                            @endcan --}}
                        </ul>
                    </div>
                </li>
            @endif
        </ul>
        <ul class="nav navbar-nav align-items-center px-2 m-auto">
            <li class="nav-item">
                <h5 class="m-0 fw-bold date">
                    {{ date('l, F j, Y') }}
                </h5>
            </li>
        </ul>
        <ul class="nav navbar-nav align-items-center ms-auto gap-1">
        @php
            use Illuminate\Support\Facades\Schema;
            use App\Models\Ecommerce\Order;
        @endphp
        <!-- Ecommerce order notification -->
            @if (Schema::hasTable('orders'))
                @php
                    $now = \Illuminate\Support\Carbon::now();
                    $orders = [];
                    $query = Order::with('orderDetails', 'orderDetails.product')->whereDate('created_at', $now->toDateString());
                    $orders = $query
                        ->latest()
                        ->take(10)
                        ->get();
                @endphp
            @endif

            <li class="nav-item dropdown dropdown-cart me-25">
                <a class="nav-link h5 fw-bold mb-0" href="{{ route('pos.index') }}">(POS)
                    &nbsp;<i class="fas fa-print"></i></a>
            </li>
            @php
                $notifications = \App\Models\Notification::orderBy('seen','asc')->limit(10)->get();
            @endphp
            <li class="nav-item dropdown mx-3">
                <a class="nav-link" title="Ecommerce orders" href="#" data-bs-toggle="dropdown" aria-expanded="true">
                    <i class="ficon text-dark" data-feather="bell"></i>
                    <span class="badge rounded-pill bg-danger badge-up">{{ $notifications->where('seen',0)->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropDown shadow-lg border-0 admin-notification-dropdown">
                    <div class="list-group  list-group-flush">
                        <div class="list-group-item">
                            <h4 class="position-relative text-primary">{{ translate('Notifications') }}
                                ({{ count($notifications) }})</h4>
                        </div>
                    </div>
                    <div class="notification-box">
                        @forelse($notifications as $notification)
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex">
                                    <i class="ficon {{ $notification->seen ? 'text-secondary': 'text-primary' }}  me-1"
                                       data-feather="bell"></i>
                                    <a href="{{ route('notification.show', $notification->id) }}"
                                       class="{{ $notification->seen ? 'text-muted': 'text-dark' }}">
                                        <h5 class="{{ $notification->seen ? 'text-muted': 'text-dark' }}">{{ $notification->title }}</h5>
                                        <div class="description">
                                            {{ \Illuminate\Support\Str::of($notification->description)->words(7,'...') }}
                                            <br><small class="text-muted">{{ $notification->created_at }}</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="list-group  list-group-flush">
                                <div class="list-group-item">
                                    <h5 class="text-center my-5">
                                        <i class="ficon text-dark fa-2x" data-feather="info"></i>
                                        <p>{{ translate('You do not have any notification') }}!</p>
                                    </h5>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="list-group list-group-flush">
                        <div class="list-group-item justify-content-center">
                            <a href="{{ route('notification.index') }}"
                               class="d-block text-center text-decoration-underline">
                                {{ translate('View All Notification') }}
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                                                           id="dropdown-user" href="#" data-bs-toggle="dropdown"
                                                           aria-haspopup="true"
                                                           aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span
                                class="user-name fw-bolder">{{ \Auth::user()->name }}</span><span
                                class="user-status">
                            @if(count(Auth::user()->getRoleNames()))
                                {{ Auth::user()->getRoleNames()[0] }}
                            @endif
                        </span>
                    </div>
                    <span class="avatar">
    <img class="round"
         @if (!empty(Auth::user()->image)) 
         src="{{ asset('storage/images/profile/' . Auth::user()->image) }}"
         @else 
             src="{{ url('public\images\employee\9977332.png') }}" 
         @endif
         alt="avatar" height="40" width="40">
    <span class="avatar-status-online"></span>
</span>


                <div class="dropdown-menu dropdown-menu-end dropDown shadow-lg border-0"
                     aria-labelledby="dropdown-user">

                    <a class="dropdown-item" href="{{ route('dashboard') }}"><i class="me-50 fas fa-th"></i>
                        {{ __('Dashboard') }}</a>
                    <a class="dropdown-item py-1" href="{{ route('profile.setting') }}"><i class="me-50"
                                                                                           data-feather="lock"></i> {{ __('Change Password') }}
                    </a>

                    <a class="dropdown-item py-1" href="{{ route('profile.info.setting') }}"><i class="me-50"
                                                                                                data-feather="eye"></i> {{ __('Change Info') }}
                    </a>
                    <a class="dropdown-item py-1" href="{{ route('setting.generalSetting') }}"><i class="me-50"
                                                                                                  data-feather="settings"></i> {{ __('Settings') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item py-1" href="{{ route('logout') }}"><i class="me-50"
                                                                                  data-feather="power"></i> {{ __('Logout') }}
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- END: Header-->


<!--Mobile Menu-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light  container-xxl navBar"
     id="mobilemenu">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li id="mm" class="nav-item"><a class="nav-link menu-toggle" href="#"><i
                                class="fa fa-bars"></i></a>
                </li>
            </ul>
        </div>
        <ul id="mul" class="nav navbar-nav align-items-center">

            <li id="mm" class="nav-item dropdown dropdown-cart me-25"><a class="nav-link"
                                                                         href="{{ route('profit') }}"><i
                            class="fas fa-file-text"></i></a></li>

            <li id="mm" class="nav-item dropdown dropdown-cart me-25"><a class="nav-link"
                                                                         href="{{ route('pos.index') }}"><i
                            class="fas fa-print"></i></a></li>

            <li id="mm" class="nav-item dropdown dropdown-cart me-25"><a class="nav-link"
                                                                         href="{{ route('profile.info.setting') }}"><i
                            class="fas fa-cog"></i></a></li>

            <li id="mm" class="nav-item dropdown dropdown-cart me-25"><a class="nav-link"
                                                                         href="{{ route('logout') }}"><i
                            class="fa fa-power-off"></i></a></li>
        </ul>
    </div>
</nav>

<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>

    </form>
    <ul class="navbar-nav navbar-right">


        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset(auth()->user()->avatar) }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="#"
                        onclick="event.preventDefault();
                    this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class=active><a class="nav-link" href="index-0.html"><i class="fas fa-fire"></i>General Dashboard</a>
            </li>
            <li class="menu-header">Starter</li>


            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-columns"></i>
                    <span>Manage Products </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.category.index') }}">Product Categories</a></li>
                    <li><a class="nav-link" href="{{ route('admin.product.index') }}">Products</a></li>

                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-columns"></i>
                    <span>Orders </span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.orders.index') }}">All orders</a></li>
                    <li><a class="nav-link" href="{{ route('admin.pending-orders') }}">Pending Orders</a></li>
                    <li><a class="nav-link" href="{{ route('admin.inprocess-orders') }}">In Process Orders</a></li>
                    <li><a class="nav-link" href="{{ route('admin.delivered-orders') }}">Delivered Orders</a></li>
                    <li><a class="nav-link" href="{{ route('admin.declined-orders') }}">Declined Orders</a></li>
                </ul>
            </li>

            <li><a class="nav-link" href="{{ route('admin.slider.index') }}">Slider</a></li>
            <li><a class="nav-link" href="{{ route('admin.why-choose-us.index') }}">Why choose us</a></li>
            <li><a class="nav-link" href="{{ route('admin.about.index') }}">About</a></li>
            <li><a class="nav-link" href="{{ route('admin.contact.index') }}">Contact</a></li>

            <li><a class="nav-link" href="{{ route('admin.setting.index') }}">Settings</a></li>
            <li><a class="nav-link" href="{{ route('admin.delivery-area.index') }}">Delivery areas</a></li>
            <li><a class="nav-link" href="{{ route('admin.footer-info.index') }}">Footer info</a></li>

            <li><a class="nav-link" href="{{ route('admin.menu-builder.index') }}">Menu builder</a></li>
            {{-- <li class="dropdown {{ setSidebarActive([
            'admin.category.*',
            'admin.product.*',
            'admin.product-reviews.index',
        ]) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-shopping-cart"></i>
                <span>Manage Products </span></a>
            <ul class="dropdown-menu">
                <li class="{{ setSidebarActive(['admin.category.*']) }}" ><a class="nav-link" href="{{ route('admin.category.index') }}">Product Categories</a></li>
                <li class="{{ setSidebarActive(['admin.product.*']) }}" ><a class="nav-link" href="{{ route('admin.product.index') }}">Products</a></li>
                {{-- <li class="{{ setSidebarActive(['admin.product-reviews.index']) }}" ><a class="nav-link" href="{{ route('admin.product-reviews.index') }}">Product Reviews</a> --}}
            {{--           </li>
            </ul>
        </li> --}}

            {{--

            <li><a class="nav-link" href="bootstrap-alert.html">Alert</a></li>
            <li><a class="nav-link" href="bootstrap-badge.html">Badge</a></li>
            <li><a class="nav-link" href="bootstrap-breadcrumb.html">Breadcrumb</a></li>
            <li><a class="nav-link" href="bootstrap-buttons.html">Buttons</a></li>
            <li><a class="nav-link" href="bootstrap-card.html">Card</a></li>
            <li><a class="nav-link" href="bootstrap-carousel.html">Carousel</a></li>
            <li><a class="nav-link" href="bootstrap-collapse.html">Collapse</a></li>
            <li><a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a></li>
            <li><a class="nav-link" href="bootstrap-form.html">Form</a></li>
            <li><a class="nav-link" href="bootstrap-list-group.html">List Group</a></li>
            <li><a class="nav-link" href="bootstrap-media-object.html">Media Object</a></li>
            <li><a class="nav-link" href="bootstrap-modal.html">Modal</a></li>
            <li><a class="nav-link" href="bootstrap-nav.html">Nav</a></li>
            <li><a class="nav-link" href="bootstrap-navbar.html">Navbar</a></li>
            <li><a class="nav-link" href="bootstrap-pagination.html">Pagination</a></li>
            <li><a class="nav-link" href="bootstrap-popover.html">Popover</a></li>
            <li><a class="nav-link" href="bootstrap-progress.html">Progress</a></li>
            <li><a class="nav-link" href="bootstrap-table.html">Table</a></li>
            <li><a class="nav-link" href="bootstrap-tooltip.html">Tooltip</a></li>
            <li><a class="nav-link" href="bootstrap-typography.html">Typography</a></li>
          </ul>
        </li> --}}

        </ul>

    </aside>
</div>

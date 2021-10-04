<div class="slimscroll-menu">

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul class="metismenu" id="side-menu">

            <li>
                <a href="{{route('dashboard')}}" class="{{Route::currentRouteName() == 'dashboard' ? 'active' : ''}}">
                    <i class="fe-airplay"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            {{-- Module One --}}

            <li class="menu-title">PRODUCT</li>

            <li>
                <a href="javascript: void(0);" class="{{request()->segment(1) == 'products' ? 'active' : ''}}">
                    <i class="bi bi-basket2-fill"></i>
                    <span>  Products </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li class="{{request()->segment(1) == 'products' ? 'mm-active' : ''}}">
                        <a href="{{route('product.all')}}" class="{{request()->segment(1) == 'products' ? 'active' : ''}}">
                            All Products
                        </a>
                    </li>
                    <li class="{{request()->segment(1) == 'categories' ? 'mm-active' : ''}}">
                        <a href="{{route('category.all')}}" class="{{request()->segment(1) == 'categories' ? 'active' : ''}}">
                            Categories
                        </a>
                    </li>
                    <li class="{{request()->segment(1) == 'brands' ? 'mm-active' : ''}}">
                        <a href="{{route('brand.all')}}" class="{{request()->segment(1) == 'brands' ? 'active' : ''}}">
                            Brands
                        </a>
                    </li>
                    <li class="{{request()->segment(1) == 'attributes' ? 'mm-active' : ''}}">
                        <a href="{{route('attribute.all')}}" class="{{request()->segment(1) == 'attributes' ? 'active' : ''}}">
                            Attributes
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="{{request()->segment(1) == 'bulk-items' ? 'active' : ''}}">
                    <i class="fe-layers"></i>
                    <span>  Bulk Items </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="{{route('bulk.import')}}" class="{{Route::currentRouteName() == 'bulk.import' ? 'active' : ''}}">
                            Import
                        </a>
                    </li>
                    <li>
                        <a href="{{route('bulk.export')}}" class="{{Route::currentRouteName() == 'bulk.export' ? 'mm-active' : ''}}">
                            Export
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('order.index') }}" class="{{request()->segment(1) == 'orders' ? 'active' : ''}}">
                    <i class="fe-navigation"></i>
                    <span>Orders</span> <span class="badge badge-primary float-right">12</span>
                </a>
            </li>

            {{-- Module Two --}}

            <li class="menu-title">Apps</li>

            <li>
                <a href="javascript: void(0);">
                    <i class="bi bi-sliders"></i>
                    <span> Settings </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li><a href="{{route('settings.general')}}">General</a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('seo')}}">
                    <i class="fab fa-searchengin"></i>
                    <span> Global SEO </span>
                </a>
            </li>
        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->
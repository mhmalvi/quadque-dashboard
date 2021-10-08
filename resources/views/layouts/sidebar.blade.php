<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect {{Route::currentRouteName() == 'dashboard' ? 'mm-active' : ''}}">
                        <i class="bi bi-columns-gap"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                <li class="menu-title">E-Commerce</li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="bi bi-bag-check-fill"></i>
                        <span> Products 
                            <span class="float-right menu-arrow">
                                <i class="mdi mdi-chevron-right"></i>
                            </span>
                        </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('product.all')}}">All Products</a></li>
                        <li><a href="{{route('category.all')}}">Categories</a></li>
                        <li><a href="{{route('brand.all')}}">Brands</a></li>
                        <li><a href="{{route('attribute.all')}}">Attributes</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('order.index') }}" class="waves-effect">
                        <i class="bi bi-cart-check-fill"></i>
                        <span class="badge badge-success badge-pill float-right">9+</span> 
                        <span> Orders </span>
                    </a>
                </li>

                <li class="menu-title">Configurations</li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="bi bi-sliders"></i>
                        <span> Settings 
                            <span class="float-right menu-arrow">
                                <i class="mdi mdi-chevron-right"></i>
                            </span> 
                        </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('settings.general')}}">General</a></li>
                        <li><a href="{{route('seo')}}">SEO</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" class="waves-effect">
                        <i class="bi bi-tool"></i>
                        <span>
                            Site Customization
                            <span class="float-right menu-arrow">
                                <i class="mdi mdi-chevron-right"></i>
                            </span>
                        </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('site_customization.logo.index') }}">Logo</a></li>
                    </ul>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
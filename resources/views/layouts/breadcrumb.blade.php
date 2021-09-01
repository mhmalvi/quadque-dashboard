<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{route('dashboard')}}">Quadmin</a>
                    </li>
                    @if (request()->segment(1))
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">
                                {{request()->segment(1)}}
                            </a>
                        </li>
                    @endif
                    @if (request()->segment(2))
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">
                                {{request()->segment(2)}}
                            </a>
                        </li>
                    @endif
                    @if (request()->segment(3))
                        <li class="breadcrumb-item">
                            <a href="javascript: void(0);">
                                {{request()->segment(3)}}
                            </a>
                        </li>
                    @endif
                </ol>
            </div>
            <h4 class="page-title">
                @yield('title')

                @yield('links')
            </h4>
        </div>
    </div>
</div>
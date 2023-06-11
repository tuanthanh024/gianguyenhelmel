<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('admin.dashboard') }}" aria-expanded="false"><i class="mdi me-2 mdi-gauge"></i><span
                            class="hide-menu">Dashboard</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('admin.profile.index') }}" aria-expanded="false">
                        <i class="mdi me-2 mdi-account-check"></i><span class="hide-menu">Profile</span></a>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('admin.categories.index') }}" aria-expanded="false"><i
                            class="mdi me-2 mdi-table"></i><span class="hide-menu">Categories</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('admin.products.index') }}" aria-expanded="false"><i
                            class="mdi me-2 mdi-store"></i><span class="hide-menu">Products</span></a></li>

                <li class="sidebar-item {{ $selected ?? '' }}"> <a
                        class="sidebar-link waves-effect waves-dark sidebar-link {{ $active ?? '' }}"
                        href="{{ route('admin.orders.index') }}" aria-expanded="false"><i
                            class="mdi me-2 mdi-cart-outline"></i><span class="hide-menu">Orders</span></a></li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('admin.users.index') }}" aria-expanded="false"><i
                            class="mdi me-2 mdi-account"></i><span class="hide-menu">Users</span></a>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('admin_logout') }}" aria-expanded="false"><i
                            class="mdi me-2 mdi-logout"></i><span class="hide-menu">Logout</span></a>
                </li>

            </ul>

        </nav>
    </div>
    <div class="sidebar-footer">
        <div class="row">
            <div class="col-4 link-wrap">
                <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i
                        class="ti-settings"></i></a>
            </div>
            <div class="col-4 link-wrap">
                <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
                        class="mdi mdi-gmail"></i></a>
            </div>
            <div class="col-4 link-wrap">
                <a href="{{ route('admin_logout') }}" class="link" data-toggle="tooltip" title=""
                    data-original-title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
        </div>
    </div>
</aside>

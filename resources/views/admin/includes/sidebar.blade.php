<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <style>
        /* .nav-link-text,.nav-link-icon{
            color: #000000;
        } */
    </style>
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" aria-label="Toggle Navigation" data-bs-original-title="Toggle Navigation">
                <span class="navbar-toggle-icon">
                    <span class="toggle-line"></span>
                </span>
            </button>
        </div>
        <a class="navbar-brand" href="{{ route('admin.index') }}">
            <div class="d-flex align-items-center py-3">
                <img class="me-2" src="{{ asset('adminassets/assets/img/icons/spot-illustrations/falcon.png') }}" alt=""
                    width="40">
                <span class="font-sans-serif">Admin</span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-chart-pie"></i></span>
                            <span class="nav-link-text ps-1">Dashboard</span>
                        </div>
                    </a>
                </li>

                <!-- Site Settings -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">Site Settings</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <a class="nav-link dropdown-indicator {{ Request::segment(2) == 'site-settings' ? '' : 'collapsed' }}"
                        href="#dashboard6" role="button" data-bs-toggle="collapse"
                        aria-expanded="{{ Request::segment(2) == 'site-settings' ? 'true' : 'false' }}"
                        aria-controls="dashboard6">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                            <span class="nav-link-text ps-1">Site Settings</span>
                        </div>
                    </a>
                    <ul class="nav collapse {{ Request::segment(2) == 'site-settings' ? 'show' : '' }}" id="dashboard6">
                        @can('list_site_settings')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(2) == 'site-settings' ? 'active' : '' }}"
                                    href="{{ route('admin.site-settings.index') }}">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1"><i class="fa fa-angle-double-right"></i> Site
                                            Setting</span>
                                    </div>
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item">
                            <a class="nav-link {{ Request::segment(2) == 'favicons' ? 'active' : '' }}"
                                href="{{ route('admin.favicon.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1"><i class="fa fa-angle-double-right"></i>
                                        Favicon</span>
                                </div>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ Request::segment(2) == 'social-links' ? 'active' : '' }}"
                                href="{{ route('admin.social-links.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1"><i class="fa fa-angle-double-right"></i> Social
                                        Links</span>
                                </div>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <!-- Top-level link for AboutUs -->
                            <a class="nav-link {{ Request::is('admin/aboutus*') ? 'active' : '' }}"
                                href="{{ route('admin.aboutus.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-info-circle"></i></span>
                                    <span class="nav-link-text ps-1">About Us</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <!-- Top-level link for AboutUs -->
                            <a class="nav-link {{ Request::is('admin/team*') ? 'active' : '' }}"
                                href="{{ route('admin.team.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-info-circle"></i></span>
                                    <span class="nav-link-text ps-1">Team</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <!-- Top-level link for AboutUs -->
                            <a class="nav-link {{ Request::is('admin/aboutus*') ? 'active' : '' }}"
                                href="{{ route('admin.whyus.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-info-circle"></i></span>
                                    <span class="nav-link-text ps-1">Why Us</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <!-- Top-level link for AboutUs -->
                            <a class="nav-link {{ Request::is('admin/faqs*') ? 'active' : '' }}"
                                href="{{ route('admin.faqs.index') }}">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="fas fa-info-circle"></i></span>
                                    <span class="nav-link-text ps-1">FAQS</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Metadata -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/metadata*') ? 'active' : '' }}"
                        href="{{ route('admin.metadata.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-tag"></i></span>
                            <span class="nav-link-text ps-1">Metadata</span>
                        </div>
                    </a>
                </li>



            </li>

            <li class="nav-item">
                <!-- label-->
                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label">Settings</div>
                    <div class="col ps-0">
                        <hr class="mb-0 navbar-vertical-divider">
                    </div>
                </div>

            </li>
            <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/property*') ? 'active' : '' }}"
                        href="{{ route('property.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                            <span class="nav-link-text ps-1">Property</span>
                        </div>
                    </a>
                    <a class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                            <span class="nav-link-text ps-1">Category</span>
                        </div>
                    </a>
                    <a class="nav-link {{ Request::is('admin/subcategories*') ? 'active' : '' }}"
                        href="{{ route('subcategories.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                            <span class="nav-link-text ps-1">Subcategories</span>
                        </div>
                    </a>
                </li>

            <li class="nav-item">
                <!-- label-->
                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label">User Control</div>
                    <div class="col ps-0">
                        <hr class="mb-0 navbar-vertical-divider">
                    </div>
                </div>

                @can('hasPermission', 'view_roles')
                    <a class="nav-link" href="{{ route('admin.roles.index') }}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="fas fa-sort-alpha-up"></i>
                                <!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span
                                class="nav-link-text ps-1">Roles</span></div>
                    </a>
                @endcan

                @can('hasPermission', 'view_permissions')
                    <a class="nav-link" href="{{ route('admin.permissions.index') }}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="fas fa-sort-alpha-up"></i>
                                <!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span
                                class="nav-link-text ps-1">Permissions</span></div>
                    </a>
                @endcan

                @can('hasPermission', 'view_users')
                    <a class="nav-link" href="{{ route('admin.users.index') }}" role="button">
                        <div class="d-flex align-items-center"><span class="nav-link-icon">
                                <i class="fas fa-sort-alpha-up"></i>
                                <!-- <span class="fas fa-comments"></span> Font Awesome fontawesome.com --></span><span
                                class="nav-link-text ps-1">Users</span></div>
                    </a>
                @endcan

            </li>

            <li class="nav-item">
                <!-- label-->
                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                    <div class="col-auto navbar-vertical-label">History</div>
                    <div class="col ps-0">
                        <hr class="mb-0 navbar-vertical-divider">
                    </div>
                </div>




                {{-- @can('hasPermission', 'view_blogs') --}}
            <li class="nav-item">
                <!-- Top-level link for Blogs -->
                <a class="nav-link {{ Request::is('admin/blogs*') ? 'active' : '' }}"
                    href="{{ route('admin.blogs.index') }}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><i class="fas fa-blog"></i></span>
                        <span class="nav-link-text ps-1">Blogs</span>
                    </div>
                </a>
            </li>
            {{-- @endcan --}}


            {{-- @can('hasPermission', 'view_testimonials') --}}
            <li class="nav-item">
                <!-- Top-level link for Testimonials -->
                <a class="nav-link {{ Request::is('admin/testimonials*') ? 'active' : '' }}"
                    href="{{ route('testimonials.index') }}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                        <span class="nav-link-text ps-1">Testimonials</span>
                    </div>
                </a>
            </li>
            {{-- @endcan --}}

            <li class="nav-item">
                <!-- Top-level link for Services -->
                <a class="nav-link {{ Request::is('admin/services*') ? 'active' : '' }}"
                    href="{{ route('services.index') }}">
                    <div class="d-flex align-items-center">
                        <span class="nav-link-icon"><i class="fas fa-concierge-bell"></i></span>
                        <span class="nav-link-text ps-1">Services</span>
                    </div>
                </a>
            </li>

                <!-- Property, Categories, Subcategories -->
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/property*') ? 'active' : '' }}"
                        href="{{ route('property.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                            <span class="nav-link-text ps-1">Property</span>
                        </div>
                    </a>
                    <a class="nav-link {{ Request::is('admin/categories*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                            <span class="nav-link-text ps-1">Category</span>
                        </div>
                    </a>
                    <a class="nav-link {{ Request::is('admin/subcategories*') ? 'active' : '' }}"
                        href="{{ route('subcategories.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="fas fa-users"></i></span>
                            <span class="nav-link-text ps-1">Subcategories</span>
                        </div>
                    </a>
                </li>

                <!-- Additional App Settings -->
                <li class="nav-item">
                    <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                        <div class="col-auto navbar-vertical-label">App</div>
                        <div class="col ps-0">
                            <hr class="mb-0 navbar-vertical-divider">
                        </div>
                    </div>
                    <ul class="nav collapse" id="dashboard1">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Home</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
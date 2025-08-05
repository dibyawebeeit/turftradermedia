<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="{{ route('dashboard.index') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset('uploads/siteImage/' . sitesetting()->logo) }}" alt="logo" style="height: 50px;background-color: #fff;padding: 5px 30px;">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('uploads/siteImage/' . sitesetting()->favicon) }}" alt="small logo" style="background-color: #fff;">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('dashboard.index') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset('uploads/siteImage/' . sitesetting()->logo) }}" alt="dark logo" style="height: 50px;background-color: #fff;padding: 5px 30px;">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('uploads/siteImage/' . sitesetting()->favicon) }}" alt="small logo" style="background-color: #fff;">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        {{-- <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-image" height="42"
                    class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">Dominic Keller</span>
            </a>
        </div> --}}

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Navigation</li>

            <li class="side-nav-item">
                <a href="{{ route('dashboard.index') }}" class="side-nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    {{-- <span class="badge bg-success float-end">5</span> --}}
                    <span> Dashboard </span>
                </a>
            </li>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarAuthentication" aria-expanded="false"
                    aria-controls="sidebarAuthentication" class="side-nav-link">
                    <i class="fas fa-shield-alt"></i>
                    <span> Authentication </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarAuthentication">
                    <ul class="side-nav-second-level">

                        @can('user_list')
                            <li><a href="{{ route('user.index') }}">Users</a></li>
                        @endcan

                        @can('role')
                            <li><a href="{{ route('role.index') }}">Roles</a></li>
                        @endcan

                        @can('permission')
                            <li><a href="{{ route('permission.index') }}">Permissions</a></li>
                        @endcan

                    </ul>
                </div>
            </li>

            <li class="side-nav-title">Component</li>

            @can('banner_list')
                <li class="side-nav-item">
                    <a href="{{route('banner.index')}}" class="side-nav-link">
                        <i class="fas fa-images"></i>
                        <span> Banner </span>
                    </a>
                </li>
            @endcan

            @can('category_list')
                <li class="side-nav-item">
                    <a href="{{route('category.index')}}" class="side-nav-link">
                        <i class="fas fa-list"></i>
                        <span> Category </span>
                    </a>
                </li>
            @endcan

            @can('manufacturer_list')
                <li class="side-nav-item">
                    <a href="{{route('manufacturer.index')}}" class="side-nav-link">
                        <i class="fas fa-industry"></i>
                        <span> Manufacturer </span>
                    </a>
                </li>
            @endcan

            @can('equipmentmodel_list')
                <li class="side-nav-item">
                    <a href="{{route('equipmentmodel.index')}}" class="side-nav-link">
                        <i class="fas fa-industry"></i>
                        <span> Model </span>
                    </a>
                </li>
            @endcan

            @can('equipment_list')
                <li class="side-nav-item">
                    <a href="{{route('equipment.index')}}" class="side-nav-link">
                        <i class="fas fa-car"></i>
                        <span> Listings </span>
                    </a>
                </li>
            @endcan

            @can('customer_list')
                <li class="side-nav-item">
                    <a href="{{route('customer.index')}}" class="side-nav-link">
                        <i class="fas fa-user"></i>
                        <span> Customer </span>
                    </a>
                </li>
            @endcan

            @can('subscriptionplan_list')
                <li class="side-nav-item">
                    <a href="{{route('subscriptionplan.index')}}" class="side-nav-link">
                        <i class="fas fa-gem"></i>
                        <span> Subscription Plan </span>
                    </a>
                </li>
            @endcan

            @can('subscription_list')
                <li class="side-nav-item">
                    <a href="{{route('subscription.index')}}" class="side-nav-link">
                        <i class="fas fa-list"></i>
                        <span> Subscription List </span>
                    </a>
                </li>
            @endcan

             {{-- @can('equipment_enquiry_list')
                <li class="side-nav-item">
                    <a href="{{route('equipmentenquiry.index')}}" class="side-nav-link">
                        <i class="fas fa-question"></i>
                        <span> Enquiry </span>
                    </a>
                </li>
            @endcan --}}

            @can('faq_list')
                <li class="side-nav-item">
                    <a href="{{route('faq.index')}}" class="side-nav-link">
                        <i class="far fa-question-circle"></i>
                        <span style="display: none" class="badge bg-danger text-white float-end">New</span>
                        <span> FAQ </span>
                    </a>
                </li>
            @endcan
            
            
            {{-- <li class="side-nav-item">
                <a href="{{route('contact.index')}}" class="side-nav-link">
                    <i class="uil uil-tachometer-fast"></i>
                    <span> Contact </span>
                </a>
            </li> --}}
            {{-- <li class="side-nav-item">
                <a href="{{route('newsletter.index')}}" class="side-nav-link">
                    <i class="uil uil-tachometer-fast"></i>
                    <span> Newsletter </span>
                </a>
            </li> --}}

            @can('cms')
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#cmsSection" aria-expanded="false"
                    aria-controls="cmsSection" class="side-nav-link">
                    <i class="fas fa-file-alt"></i>
                    <span> Site Content </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="cmsSection">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('cms.home') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('cms.about_us') }}">About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('cms.contact_us') }}">Contact Us</a>
                        </li>
                        <li>
                            <a href="{{ route('cms.advertising') }}">Advertising</a>
                        </li>
                        <li>
                            <a href="{{ route('cms.terms_conditions') }}">Terms & Conditions</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endcan

            @can('setting')
                <li class="side-nav-item">
                    <a href="{{route('setting.index')}}" class="side-nav-link">
                        <i class="fas fa-cog"></i>
                        <span> Site Setting </span>
                    </a>
                </li>
            @endcan

           
            

            {{-- <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link">
                    <i class="uil-store"></i>
                    <span> Ecommerce </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="apps-ecommerce-products.html">Products</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-products-details.html">Products Details</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-orders.html">Orders</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-orders-details.html">Order Details</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-customers.html">Customers</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-shopping-cart.html">Shopping Cart</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-checkout.html">Checkout</a>
                        </li>
                        <li>
                            <a href="apps-ecommerce-sellers.html">Sellers</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->

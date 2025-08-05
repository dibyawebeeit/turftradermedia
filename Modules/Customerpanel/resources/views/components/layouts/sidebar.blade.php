<div class="col-cmn col-lg-4 col-md-4 col-sm-12 one">
                  <div class="section-content">
                     <div class="category-sidebar dashboard-sidebar">
                        <div class="student-profile-info">
                            @if (Auth::guard('customer')->user()->image == '')
                                <img loading="lazy" class="profile-image" src="{{ noImage() }}" alt="User Image">
                            @else
                                <img loading="lazy" class="profile-image" src="{{ asset('uploads/customerDoc/'.Auth::guard('customer')->user()->image) }}" alt="User Image">
                            @endif
                           
                           <h4>{{ Auth::guard('customer')->user()->first_name }} {{ Auth::guard('customer')->user()->last_name }} ({{ Auth::guard('customer')->user()->role }})</h4>
                           <span>{{ Auth::guard('customer')->user()->email }}</span>
                        </div>
                        <div class="category-menu Dashboard-left-menu">
                           <ul>
                              <li>
                                 <a class="btn-profile-menu {{ $activemenu && $activemenu=='dashboard'?'active':'' }}" href="{{ route('customer.dashboard') }}">
                                 <i class="fa-solid fa-shapes me-2"></i> Dashboard </a>
                              </li>
                              <li><a class="btn-profile-menu {{ $activemenu && $activemenu=='profile_setting'?'active':'' }}" href="{{ route('customer.profile_setting') }}">
                                 <i class="fa-solid fa-user-pen me-2"></i> Profile Settings </a>
                              </li>

                              <li><a class="btn-profile-menu {{ $activemenu && $activemenu=='change_password'?'active':'' }}" href="{{ route('customer.change_password') }}">
                                 <i class="fa-solid fa-key me-2"></i> Change Password </a>
                              </li>

                              @if (Auth::guard('customer')->user()->role === 'seller')

                                {{-- <li><a class="btn-profile-menu {{ $activemenu && $activemenu=='business_document'?'active':'' }}" href="{{ route('customer.business_document') }}">
                                    <i class="fa-solid fa-file me-2"></i> Business Documents </a>
                                </li> --}}

                                 <li><a class="btn-profile-menu {{ $activemenu && $activemenu=='equipment'?'active':'' }}" href="{{ route('customer.equipment.index') }}">
                                    <i class="fa-solid fa-car me-2"></i> Listings </a>
                                 </li>

                                 <li><a class="btn-profile-menu {{ $activemenu && $activemenu=='subscription'?'active':'' }}" href="{{ route('customer.subscription') }}">
                                    <i class="fa-solid fa-gift me-2"></i> Subscription </a>
                                 </li>

                                 {{-- <li><a class="btn-profile-menu {{ $activemenu && $activemenu=='enquiry'?'active':'' }}" href="{{ route('customer.enquiry') }}">
                                    <i class="fa-solid fa-question me-2"></i> Inquiries </a>
                                 </li> --}}

                              @endif


                              {{-- <li><a class="btn-profile-menu {{ $activemenu && $activemenu=='chat'?'active':'' }}" href="{{ route('customer.chat') }}">
                                    <i class="fa-solid fa-comments me-2"></i> Chat </a>
                              </li> --}}

                              

                              {{-- <li><a class="btn-profile-menu " href="#">
                                 <i class="fa-solid fa-cog me-2"></i> Settings </a>
                              </li> --}}
                              <li>
                                 <a class="btn-profile-menu" 
                                    href="{{ route('customer.logout') }}" 
                                    onclick="return confirm('Are you sure you want to log out?');">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i> Log Out
                                 </a>
                              </li>

                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
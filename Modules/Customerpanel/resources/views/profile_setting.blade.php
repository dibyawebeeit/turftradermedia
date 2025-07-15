<x-frontend::layouts.master :title="'Profile Setting'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

                <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                    <div class="section-content dashboard-right">
                        <div class="dashboard-header">
                            <h2>Profile Settings</h2>
                        </div>
                        <form action="{{ route('customer.update_profile') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="setting-card">
                                <div class="change-avatar img-upload">
                                    <div class="profile-img">
                                        @if ($profile->image == '')
                                            <img loading="lazy" class="profile-image" src="{{ noImage() }}" alt="User Image">
                                        @else
                                            <img loading="lazy" class="profile-image" src="{{ asset('uploads/customerDoc/'.$profile->image) }}" alt="User Image">
                                        @endif
                                        
                                    </div>
                                    <div class="upload-img">
                                        <h5>Profile Image</h5>
                                        <div class="imgs-load d-flex align-items-center">
                                            <div class="change-photo">
                                                <input type="file" name="image" class="form-control form-control-browse" accept="image/*">
                                                <input type="hidden" name="oldimage" value="">
                                            </div>
                                            
                                        </div>
                                        <p class="form-text">Your Image should Below 1 MB, Accepted format jpg,jpeg,png,webp</p>
                                    </div>
                                </div>
                            </div>
                            <div class="setting-title">
                                <h5>Information</h5>
                            </div>
                            <div class="setting-card custom-table">
                                <div class="row clearfix">
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" class="form-control-4" placeholder="First Name" value="{{ $profile->first_name }}" required="">
                                            @error('first_name')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" class="form-control-4" placeholder="Last Name" value="{{ $profile->last_name }}" required="">
                                            @error('last_name')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-cmn">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email" placeholder="Email" class="form-control-4" value="{{ $profile->email }}" required="">
                                            @error('email')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                            <input type="tel" name="phone" value="{{ $profile->phone }}" placeholder="Phone" class="form-control-4" required="">
                                            @error('phone')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Address <span class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control-4" placeholder="Address" value="{{ $profile->address }}" required="">
                                            @error('address')
                                                <div class="errmsg">
                                                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">City <span class="text-danger">*</span></label>
                                            <input type="text" name="city" class="form-control-4" placeholder="City" value="{{ $profile->city }}" required="">
                                            @error('city')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">State <span class="text-danger">*</span></label>
                                            <input type="text" name="state" class="form-control-4" placeholder="State" value="{{ $profile->state }}" required="">
                                            @error('state')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Country <span class="text-danger">*</span></label>
                                            <input type="text" name="country" class="form-control-4" placeholder="Country" value="{{ $profile->country }}" required="">
                                            @error('country')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-cmn col-lg-4">
                                        <div class="form-wrap">
                                            <label class="col-form-label">Postal Code <span class="text-danger">*</span></label>
                                            <input type="tel" name="postal_code" pattern="[0-9]{5}" onkeypress="if(this.value.length==5) return false;" class="form-control-4" placeholder="Postal Code" value="{{ $profile->postal_code }}" required="">
                                            @error('postal_code')
                                                <div class="errmsg">
                                                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-btn text-end">
                                <button type="submit" class="btn">Save Changes</button>
                            </div>
                        </form>
                    </div>
               </div>
            </div>
         </div>
      </section>
</x-frontend::layouts.master>

<x-frontend::layouts.master :title="'Change Password'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

                <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                  <div class="section-content dashboard-right change-pass">
                     <div class="dashboard-header">
                        <h2>Change Password</h2>
                     </div>
                     <form method="POST" action="{{ route('customer.update_password') }}" enctype="multipart/form-data">
                        @csrf    
                        <div class="card pass-card">
                           <div class="container card-body">
                              <div class="row clearfix">
                                 <div class="col-lg-8">
                                    <div class="input-block input-block-new">
                                       <label class="form-label">Old Password</label>
                                       <input type="password" class="form-control-4" name="old_password" placeholder="Old Password" value="{{ old('old_password') }}" required="">
                                       @error('old_password')
                                       <div class="errmsg">
                                       <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                       </div>
                                       @enderror
                                    </div>
                                    <div class="input-block input-block-new">
                                       <label class="form-label">New Password</label>
                                       <div class="pass-group">
                                          <input type="password" class="form-control-4 pass-input" name="password" placeholder="New Password" value="{{ old('password') }}" required="">
                                       </div>
                                       @error('password')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                       @enderror
                                    </div>
                                    <div class="input-block input-block-new mb-0">
                                       <label class="form-label">Confirm Password</label>
                                       <div class="pass-group">
                                          <input type="password" class="form-control-4 pass-input-sub" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="Confirm Password" required="">
                                          @error('confirm_password')
                                            <div class="errmsg">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                            </div>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="form-set-button">
                           <button class="btn" type="submit">Save Changes</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
</x-frontend::layouts.master>

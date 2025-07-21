<x-frontend::layouts.master :title="'Sign In'">
<hr>


<section class="signin-row p-t-60 p-b-60">
    <div class="container">    
    
    	<div class="row">    
        	<div class="col-cmn col-lg-6 col-md-6 col-sm-12 one">
            	<div class="section-content">
                	
                    <div class="login-block">
                        <h3>{{ sitesetting()->login_title }}</h3>
                        <p>{{ sitesetting()->login_desc }}</p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="errmsg">
                              <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                            </div>
                        @endif
                        <form action="{{ route('submit_signin') }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                            <label class="control-label" for="input-email">Email ID</label>
                            <input autocomplete="off" type="email" name="email" value="{{ old('email') }}" placeholder="Email ID" id="input-email" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label class="control-label" for="input-password">Password</label>
                            <input autocomplete="off" type="password" name="password" value="{{ old('password') }}" placeholder="Password" id="input-password" class="form-control" required>
                            <a class="forgot-pass-btn" href="{{ route('forgot_password') }}">Forgot Password</a></div>
                          <input type="submit" value="Login" class="">
                         </form>
                        <span class="block-sep"></span>
                     </div>
                
                </div>
            </div>  
            <div class="col-cmn col-lg-6 col-md-6 col-sm-12 two">
            	<div class="section-content">
                	
                    	
                      <div class="login-block registerBlock">
                        <h3>{{ sitesetting()->register_title }}</h3>
                        <p>{{ sitesetting()->register_desc }}</p>
                        <a href="{{ route('register') }}" class="btn">Continue</a>
                        <div class="terms-block">
                            {{-- <h3>Sign up today and you will be able to:</h3>
                            <ul>
                                <li>View all products, prices and promotions.</li>
                                <li>Place orders online and buy in store.</li>
                                <li>Favourite products and Quick Order. </li>
                            </ul> --}}
                            {!! sitesetting()->register_info !!}
                        </div>
                      </div>
                    
                
                </div>
            </div>            
       </div>
        
    </div>
</section>
</x-frontend::layouts.master>
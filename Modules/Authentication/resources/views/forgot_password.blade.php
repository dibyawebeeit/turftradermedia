<x-authentication::layouts.master :title="'Forgot Password'">
    <div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
        <svg xmlns='http://www.w3.org/2000/svg' width='100%' height='100%' viewBox='0 0 800 800'>
            <g fill-opacity='0.22'>
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.1);" cx='400' cy='400' r='600' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.2);" cx='400' cy='400' r='500' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.3);" cx='400' cy='400' r='300' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.4);" cx='400' cy='400' r='200' />
                <circle style="fill: rgba(var(--ct-primary-rgb), 0.5);" cx='400' cy='400' r='100' />
            </g>
        </svg>
    </div>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header py-4 text-center bg-primary">
                            <a href="{{ url('/') }}">
                                <span><img src="{{asset('uploads/siteImage/'.sitesetting()->logo)}}" alt="logo" height="60"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Forgot Password</h4>
                                {{-- <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p> --}}
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="emailaddress" class="form-label">Email address</label>
                                            <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email">
                                            <span class="error" id="email_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3" id="otp_section" style="display: none;">
                                            <label for="otp" class="form-label">Enter OTP</label>
                                            <input class="form-control" type="tel"id="otp" pattern="[0-9]{6}" onkeypress="if(this.value.length==6) return false;" placeholder="Enter OTP">
                                            <span class="error" id="otp_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <a href="{{ route('authentication.index') }}" class="text-muted float-end"><small>Go to login page?</small></a>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="submitButton">
                                         <div class="mb-3 mb-0 text-center">
                                            <button class="btn btn-primary" id="firstBtn" onclick="submitBtn()" type="button"> Submit </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="submitOtp" style="display: none;">
                                         <div class="mb-3 mb-0 text-center">
                                            <button class="btn btn-primary" id="secondBtn" onclick="submitOtpbtn()" type="button"> Submit OTP </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    {{-- <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-muted ms-1"><b>Sign Up</b></a></p>
                    </div> <!-- end col -->
                </div> --}}
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

    @section('script')
        <script>
            const email=document.getElementById("email");
            const otp=document.getElementById("otp");
            const email_error=document.getElementById("email_error");
            const otp_error=document.getElementById("otp_error");
            const otp_section=document.getElementById("otp_section");
            const submitButton=document.getElementById("submitButton");
            const submitOtp=document.getElementById("submitOtp");

            const submitBtn =()=>{
                const emailId=email.value;
                const dataUrl="{{route('admin.submit_forgot_password')}}";
                if(emailId=='')
                {
                    email_error.innerText="Enter your registered email id";
                    return false;
                }
                
                email_error.innerText="";
                const firstBtn = document.getElementById('firstBtn');
                firstBtn.innerText = 'Loading...';

                const formData = {
                    email: emailId,
                };
                

                fetch(dataUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // CSRF token for Laravel
                    },
                    body: JSON.stringify(formData),
                })
                .then(response => response.json())  // Parse the JSON response from Laravel
                .then(data => {
                    // console.log('Success:', data);
                    firstBtn.innerText = 'Submit';
                    if(data.status==true)
                    {
                        otp_error.innerText=data.msg;
                        otp_section.style.display="block";
                        submitButton.style.display="none";
                        submitOtp.style.display="flex";
                        email.disabled = true;
                    }
                    else
                    {
                        email_error.innerText=data.msg;
                    }
                    // Handle the success response, maybe display a success message
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Handle any error that occurred during the request
                });
                
            }

            const submitOtpbtn =()=>{
                const dataUrl="{{route('admin.submit_otp')}}";
                if(otp.value=='')
                {
                    otp_error.innerText="Enter OTP";
                    return false;
                }

                const secondBtn = document.getElementById('secondBtn');
                secondBtn.innerText = 'Loading...';

                const formData = {
                    otp: otp.value,
                };
                fetch(dataUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // CSRF token for Laravel
                    },
                    body: JSON.stringify(formData),
                })
                .then(response => response.json())  // Parse the JSON response from Laravel
                .then(data => {
                    // console.log('Success:', data);
                    secondBtn.innerText = 'Submit';
                    if(data.status==true)
                    {
                        otp_error.innerText=data.msg;
                        setTimeout(function() {
                            window.location.href = "{{route('admin.change_password')}}";  // Redirect to a new URL
                        }, 2000);
                        
                    }
                    else
                    {
                        otp_error.innerText=data.msg;
                    }
                    // Handle the success response, maybe display a success message
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Handle any error that occurred during the request
                });

            }
        </script>
    @endsection

</x-authentication::layouts.master>



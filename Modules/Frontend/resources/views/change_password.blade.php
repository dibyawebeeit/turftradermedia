<x-frontend::layouts.master :title="'Change Password'">
<hr>


<section class="signin-row p-t-60 p-b-60">
    <div class="container">    
    
    	<div class="row forgot-center">    
        	<div class="col-cmn col-lg-6 col-md-6 col-sm-12 one">
            	<div class="section-content">
                	
                    <div class="login-block">
                        <h3>Change Password</h3>
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
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <ul>
                                   <li>{{session('success')}}</li>
                                </ul>
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                @if(session('redirect_login'))
                                <script>
                                    setTimeout(function() {
                                        window.location.href = "{{ route('signin') }}";
                                    }, 3000);
                                </script>
                                @endif
                            </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        <form method="POST" action="{{route('frontend.submit_change_password')}}">
                            @csrf
                          <div class="form-group">
                            <label class="control-label" for="input-email">Password</label>
                            <input type="password" name="password" placeholder="Create New Password" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label class="control-label" for="input-email">Confirm Password</label>
                            <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" required>
                          </div>
                          
                          <div class="form-group">
                           <button type="submit" class="btn">Submit</button>
                          </div>
                         </form>
                        <span class="block-sep" style="display:none;"></span>
                     </div>
                
                </div>
            </div>             
       </div>
        
    </div>
</section>

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
                const dataUrl="{{route('frontend.submit_forgot_password')}}";
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
                const dataUrl="{{route('frontend.submit_otp')}}";
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
                            window.location.href = "{{route('frontend.change_password')}}";  // Redirect to a new URL
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

</x-frontend::layouts.master>
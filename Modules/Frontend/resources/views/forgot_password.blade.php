<x-frontend::layouts.master :title="'Forgot Password'">
<hr>


<section class="signin-row p-t-60 p-b-60">
    <div class="container">    
    
    	<div class="row forgot-center">    
        	<div class="col-cmn col-lg-6 col-md-6 col-sm-12 one">
            	<div class="section-content">
                	
                    <div class="login-block">
                        <h3>Forgot Password</h3>
                        <form>
                          <div class="form-group">
                            <label class="control-label" for="input-email">Email ID</label>
                            <input type="email" name="email" id="email" placeholder="Email ID" class="form-control">
                            <div class="errmsg" id="email_error"></div>
                          </div>
                          <div class="form-group" id="otp_section" style="display: none;">
                            <label class="control-label" for="input-password">Enter OTP</label>
                            <input type="tel" id="otp" pattern="[0-9]{6}" onkeypress="if(this.value.length==6) return false;" placeholder="Enter OTP" class="form-control">
                            <span class="errmsg" id="otp_error"></span>
                            
                          </div>
                           <div class="forgot-div">   
                          <a class="forgot-pass-btn" href="{{ route('signin') }}">Go to login page</a>
                          <div class="form-group" id="submitButton">
                           <button type="button" class="btn" id="firstBtn" onclick="submitBtn()">Submit</button>
                          </div>
                              </div>
                          <div class="form-group" id="submitOtp" style="display: none;">
                           <button type="button" class="btn" id="secondBtn" onclick="submitOtpbtn()">Submit OTP</button>
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
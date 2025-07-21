<x-dashboard::layouts.master :title="'Settings'">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        {{-- <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item active">Profile 2</li>
                        </ol>
                    </div> --}}
                        <h4 class="page-title">Settings</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('setting.update', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    File Info</h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Logo</label>
                                            <input type="file" class="form-control" name="logo">
                                            <input type="hidden" name="oldlogo" value="{{ $dataList->logo }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('uploads/siteImage/' . $dataList->logo) }}" alt="image"
                                            class="img-fluid avatar-md" style="height: 40px;">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Favicon</label>
                                            <input type="file" class="form-control" name="favicon">
                                            <input type="hidden" name="oldfavicon" value="{{ $dataList->favicon }}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('uploads/siteImage/' . $dataList->favicon) }}" alt="image"
                                            class="img-fluid avatar-md">
                                    </div>
                                </div> <!-- end row -->

                                <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle me-1"></i>
                                    General Info</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Contact Email <sup>*</sup></label>
                                            <input type="email" class="form-control" name="contact_email"
                                                placeholder="Enter Email" value="{{ $dataList->contact_email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Contact No" class="form-label">Contact No <sup>*</sup></label>
                                            <input type="text" class="form-control" name="contact_no"
                                                placeholder="Enter Contact No" value="{{ $dataList->contact_no }}" required>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address <sup>*</sup></label>
                                            <input type="text" class="form-control" name="address" placeholder="Address"
                                                value="{{ $dataList->address }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="opening" class="form-label">Opening Time </label>
                                            <input type="text" class="form-control" name="opening_time"
                                                placeholder="Opening Time" value="{{ $dataList->opening_time }}">
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="footer_text" class="form-label">Footer Text</label>
                                            <textarea class="form-control" name="footer_text" rows="4" placeholder="Write something...">{{ $dataList->footer_text }}</textarea>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="newsletter_title" class="form-label">Newsletter Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="newsletter_title" placeholder="Newsletter Title"
                                                value="{{ $dataList->newsletter_title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="newsletter_desc" class="form-label">Newsletter Desc <sup>*</sup></label>
                                            <input type="text" class="form-control" name="newsletter_desc" placeholder="Newsletter Desc"
                                                value="{{ $dataList->newsletter_desc }}" required>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth me-1"></i> Login Page Section</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="login_title" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="login_title" placeholder="Title"
                                                value="{{ $dataList->login_title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="login_desc" class="form-label">Desc </label>
                                            <textarea class="form-control" name="login_desc" placeholder=" Desc">{{ $dataList->login_desc }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth me-1"></i> Register Page Section</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="register_title" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="register_title" placeholder="Title"
                                                value="{{ $dataList->register_title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="register_desc" class="form-label">Desc </label>
                                            <textarea class="form-control" name="register_desc" placeholder=" Desc">{{ $dataList->register_desc }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="register_info" class="form-label">Info </label>
                                            <textarea class="editor form-control" name="register_info" placeholder=" Desc">{{ $dataList->register_info }}</textarea>
                                        </div>
                                    </div>
                                </div>


                                <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-earth me-1"></i> Social</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="social-fb" class="form-label">Facebook</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="mdi mdi-facebook"></i></span>
                                                <input type="text" class="form-control" id="social-fb"
                                                    name="facebook" value="{{ $dataList->facebook }}" placeholder="Url">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="social-tw" class="form-label">Twitter</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="mdi mdi-twitter"></i></span>
                                                <input type="text" class="form-control" id="social-tw" name="twitter"
                                                    value="{{ $dataList->twitter }}" placeholder="Url">
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="social-insta" class="form-label">Instagram</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="mdi mdi-instagram"></i></span>
                                                <input type="text" class="form-control" id="social-insta"
                                                    value="{{ $dataList->instagram }}" name="instagram"
                                                    placeholder="Url">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="social-lin" class="form-label">Linkedin</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="mdi mdi-linkedin"></i></span>
                                                <input type="text" class="form-control" id="social-lin"
                                                    value="{{ $dataList->linkedin }}" name="linkedin" placeholder="Url">
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="social-sky" class="form-label">Youtube</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="mdi mdi-youtube"></i></span>
                                                <input type="text" class="form-control" id="social-sky"
                                                    value="{{ $dataList->youtube }}" name="youtube" placeholder="Url">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="social-gh" class="form-label">Telegram</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="mdi mdi-earth"></i></span>
                                                <input type="text" class="form-control" id="social-gh"
                                                    value="{{ $dataList->telegram }}" name="telegram" placeholder="Url">
                                            </div>
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

                                {{-- <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-email me-1"></i> SMTP Info
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="smtp_host" class="form-label">SMTP Host </label>
                                            <input type="text" class="form-control" name="smtp_host"
                                                placeholder="SMTP Host" value="{{ $dataList->smtp_host }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="smtp_port" class="form-label">SMTP Port </label>
                                            <input type="text" class="form-control" name="smtp_port"
                                                placeholder="SMTP Port" value="{{ $dataList->smtp_port }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="smtp_username" class="form-label">SMTP Username </label>
                                            <input type="text" class="form-control" name="smtp_username"
                                                placeholder="SMTP Username" value="{{ $dataList->smtp_username }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="smtp_password" class="form-label">SMTP Password </label>
                                            <input type="text" class="form-control" name="smtp_password"
                                                placeholder="SMTP Password" value="{{ $dataList->smtp_password }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="smtp_encryption" class="form-label">SMTP Encryption </label>
                                            <input type="text" class="form-control" name="smtp_encryption"
                                                placeholder="SMTP Encryption" value="{{ $dataList->smtp_encryption }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="protocol" class="form-label">Protocol </label>
                                            <input type="text" class="form-control" name="protocol"
                                                placeholder="Protocol" value="{{ $dataList->protocol }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="checkbox" id="smtp_switch" name="smtp_status" value="1"
                                                {{ $dataList->smtp_status == 1 ? 'checked' : '' }} data-switch="bool" />
                                            <label for="smtp_switch" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div> <!-- end col -->
                                </div>  --}}

                                {{-- <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-google me-1"></i> Google
                                    reCAPTCHA v2
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recapcha_sitekey" class="form-label">RECAPTCHA SITEKEY </label>
                                            <input type="text" class="form-control" name="recapcha_sitekey"
                                                placeholder="RECAPTCHA SITEKEY"
                                                value="{{ $dataList->recapcha_sitekey }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recapcha_secretkey" class="form-label">RECAPTCHA SECRETKEY
                                            </label>
                                            <input type="text" class="form-control" name="recapcha_secretkey"
                                                placeholder="RECAPTCHA SECRETKEY"
                                                value="{{ $dataList->recapcha_secretkey }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="checkbox" id="recapcha_switch" name="recapcha_status"
                                                value="1" {{ $dataList->recapcha_status == 1 ? 'checked' : '' }}
                                                data-switch="bool" />
                                            <label for="recapcha_switch" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div> <!-- end col -->
                                </div>  --}}

                                {{-- <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-google me-1"></i> Google
                                    Sign In
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="google_client_id" class="form-label">GOOGLE CLIENT ID </label>
                                            <input type="text" class="form-control" name="google_client_id"
                                                placeholder="GOOGLE CLIENT ID" value="{{ $dataList->google_client_id }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="google_client_secret" class="form-label">GOOGLE CLIENT SECRET
                                            </label>
                                            <input type="text" class="form-control" name="google_client_secret"
                                                placeholder="GOOGLE CLIENT SECRET"
                                                value="{{ $dataList->google_client_secret }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="google_redirect_uri" class="form-label">GOOGLE REDIRECT URI
                                            </label>
                                            <input type="text" class="form-control" name="google_redirect_uri"
                                                placeholder="GOOGLE REDIRECT URI"
                                                value="{{ $dataList->google_redirect_uri }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3 mt-4">
                                            <input type="checkbox" id="google_signin_switch" name="google_signin_status"
                                                value="1" {{ $dataList->google_signin_status == 1 ? 'checked' : '' }}
                                                data-switch="bool" />
                                            <label for="google_signin_switch" data-on-label="On"
                                                data-off-label="Off"></label>
                                        </div>
                                    </div> <!-- end col -->
                                </div>  --}}

                                {{-- <h5 class="mb-3 text-uppercase bg-light p-2"><i
                                        class="mdi mdi-credit-card-check me-1"></i> Paypal
                                    Credentials
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="paypal_client_id_sandbox" class="form-label">PAYPAL CLIENT ID
                                                (sandbox)</label>
                                            <input type="text" class="form-control" name="paypal_client_id_sandbox"
                                                placeholder="PAYPAL CLIENT ID (SANDBOX)"
                                                value="{{ $dataList->paypal_client_id_sandbox }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="paypal_secret_sandbox" class="form-label">PAYPAL SECRET (Sandbox)
                                            </label>
                                            <input type="text" class="form-control" name="paypal_secret_sandbox"
                                                placeholder="PAYPAL SECRET (SANDBOX)"
                                                value="{{ $dataList->paypal_secret_sandbox }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="paypal_client_id_live" class="form-label">PAYPAL CLIENT ID
                                                (live)</label>
                                            <input type="text" class="form-control" name="paypal_client_id_live"
                                                placeholder="PAYPAL CLIENT ID (LIVE)"
                                                value="{{ $dataList->paypal_client_id_live }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="paypal_secret_live" class="form-label">PAYPAL SECRET (Live)
                                            </label>
                                            <input type="text" class="form-control" name="paypal_secret_live"
                                                placeholder="PAYPAL SECRET (LIVE)"
                                                value="{{ $dataList->paypal_secret_live }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="paypal_mode" class="form-label">PAYPAL MODE
                                            </label>
                                            <input type="text" class="form-control" name="paypal_mode"
                                                placeholder="PAYPAL MODE" value="{{ $dataList->paypal_mode }}">
                                            <span class="font-13 text-muted">sandbox # or 'live' when you're ready for
                                                production</span>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3 mt-4">
                                            <input type="checkbox" id="paypal_switch" name="paypal_status"
                                                value="1" {{ $dataList->paypal_status == 1 ? 'checked' : '' }}
                                                data-switch="bool" />
                                            <label for="paypal_switch" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div> <!-- end col -->
                                </div> --}}

                                {{-- <h5 class="mb-3 text-uppercase bg-light p-2"><i
                                        class="mdi mdi-credit-card-check me-1"></i> Stripe Credentials
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="stripe_key" class="form-label">STRIPE KEY </label>
                                            <input type="text" class="form-control" name="stripe_key"
                                                placeholder="STRIPE KEY " value="{{ $dataList->stripe_key }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="stripe_secret" class="form-label">STRIPE SECRET
                                            </label>
                                            <input type="text" class="form-control" name="stripe_secret"
                                                placeholder="STRIPE SECRET" value="{{ $dataList->stripe_secret }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="checkbox" id="stripe_switch" name="stripe_status"
                                                value="1" {{ $dataList->stripe_status == 1 ? 'checked' : '' }}
                                                data-switch="bool" />
                                            <label for="stripe_switch" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div> <!-- end col -->
                                </div>  --}}

                                {{-- <h5 class="mb-3 text-uppercase bg-light p-2"><i
                                        class="mdi mdi-credit-card-check me-1"></i> Razorpay
                                    Credentials
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="razorpay_key_id" class="form-label">RAZORPAY KEY ID </label>
                                            <input type="text" class="form-control" name="razorpay_key_id"
                                                placeholder="RAZORPAY KEY ID " value="{{ $dataList->razorpay_key_id }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="razorpay_key_secret" class="form-label">RAZORPAY KEY SECRET
                                            </label>
                                            <input type="text" class="form-control" name="razorpay_key_secret"
                                                placeholder="RAZORPAY KEY SECRET"
                                                value="{{ $dataList->razorpay_key_secret }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <input type="checkbox" id="razorpay_switch" name="razorpay_status"
                                                value="1" {{ $dataList->razorpay_status == 1 ? 'checked' : '' }}
                                                data-switch="bool" />
                                            <label for="razorpay_switch" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div> <!-- end col -->
                                </div>  --}}

                                {{-- <h5 class="mb-3 text-uppercase bg-light p-2"><i
                                        class="mdi mdi-credit-card-check me-1"></i> PayU Money Credentials
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="payu_merchant_key" class="form-label">PAYU MERCHANT KEY</label>
                                            <input type="text" class="form-control" name="payu_merchant_key"
                                                placeholder="PAYU MERCHANT KEY"
                                                value="{{ $dataList->payu_merchant_key }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="payu_merchant_salt" class="form-label">PAYU MERCHANT SALT</label>
                                            <input type="text" class="form-control" name="payu_merchant_salt"
                                                placeholder="PAYU MERCHANT SALT"
                                                value="{{ $dataList->payu_merchant_salt }}">
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="payu_sandbox" class="form-label">PAYU SANDBOX</label>
                                            <input type="text" class="form-control" name="payu_sandbox"
                                                placeholder="PAYU SANDBOX" value="{{ $dataList->payu_sandbox }}">
                                            <span class="font-13 text-muted">true # Set to "false" for production
                                                mode</span>
                                        </div>
                                    </div> <!-- end col -->
                                    <div class="col-md-6">
                                        <div class="mb-3 mt-4">
                                            <input type="checkbox" id="payu_switch" name="payu_status" value="1"
                                                {{ $dataList->payu_status == 1 ? 'checked' : '' }} data-switch="bool" />
                                            <label for="payu_switch" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div> <!-- end col -->
                                </div>  --}}

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success mt-2"><i
                                            class="mdi mdi-content-save"></i> Save</button>
                                </div>
                            </form>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div>
        <!-- container -->

    </div>
</x-dashboard::layouts.master>

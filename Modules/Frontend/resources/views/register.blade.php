<x-frontend::layouts.master :title="'Register'">
<hr>


<section class="register-row p-t-60 p-b-60">
    <div class="container"> 
    	  <div class="row row-col-center headingRow">   
          <div class="col-cmn col-lg-8 col-md-8 col-sm-12 one text-center">
            <div class="section-content">
                <h2>Register Account</h2>
                  {{-- <label class="switch">
                    <input type="checkbox" id="togBtn">
                    <div class="slider round"><!--ADDED HTML -->
                        <span class="on">Seller</span>
                        <span class="off">Buyer</span><!--END-->
                    </div>
                  </label> --}}
              </div>
          </div>
        </div>
        
    	  <div class="row row-col-center">    
        	<div class="col-cmn col-lg-8 col-md-8 col-sm-12 one">
            <div class="section-content">
              <div class="register-block">
                    <h3>New Customer Registration Form</h3>
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <div class="doc_section">
                      {!! sitesetting()->register_doc !!}
                    </div>

                    <form action="{{ route('submit_register') }}" method="post" enctype="multipart/form-data">
                      @csrf

                      
                      {{-- <div class="form-group form-groupFile doc_section">
                        <label>Upload Images</label>
                        <div class="dropzone-wrapper" id="dropzone-wrapper">
                            <div class="dropzone-desc">
                                <i class="fa fa-upload" style="font-size: 24px;"></i>
                                <p>Drag & Drop or Click to Upload</p>
                            </div>
                            <input type="file" 
                            id="imageInput" 
                            name="documents[]" 
                            multiple 
                            accept=".jpg,.jpeg,.pdf"
                            style="opacity:0; position:absolute; top:0; left:0; right:0; bottom:0; width:100%; height:100%; cursor:pointer;">
                        </div>

                        <div id="preview-zone" class="mt-3 d-flex flex-wrap"></div>
                        @if ($errors->has('documents'))
                            <div class="errmsg">
                                <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first('documents') }}
                            </div>
                        @endif

                        @foreach ($errors->get('documents.*') as $messages)
                            @foreach ($messages as $message)
                                <div class="errmsg">
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                </div>
                            @endforeach
                        @endforeach
                      </div> --}}
                      
                      
                      {{-- <div class="form-heading">
                        <h3>Your Details</h3>
                      </div> --}}
                      
                      <div class="frm-col2">
                          <div class="form-group">
                            <label class="control-label">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
                            <!-- Hidden field to submit actual value -->
                            <input type="hidden" name="role" id="user_type" value="{{ old('role','Buyer') }}">
                            @error('first_name')
                            <div class="errmsg">
                              <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label class="control-label">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
                            @error('last_name')
                            <div class="errmsg">
                              <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </div>
                            @enderror
                          </div>
                      </div>
                      <div class="frm-col2">
                          <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                            @error('email')
                            <div class="errmsg">
                              <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label class="control-label">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" class="form-control" required>
                            @error('phone')
                            <div class="errmsg">
                              <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </div>
                            @enderror
                          </div>
                      </div>
                          

                      <div class="frm-col2">
                          <div class="form-group">
                            <label class="control-label">Password</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" required>
                            @error('password')
                            <div class="errmsg">
                              <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label class="control-label">Re-Password</label>
                            <input type="password" name="repassword" value="{{ old('repassword') }}" class="form-control" required>
                            @error('repassword')
                            <div class="errmsg">
                              <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </div>
                            @enderror
                          </div>
                      </div>
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" name="agree" id="flexCheckChecked" required>
                          <label class="form-check-label" for="flexCheckChecked">
                            I agree with the <a href="{{ route('terms_conditions') }}" target="_blank" style="text-decoration: underline;">terms & conditions</a>
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                      <input type="submit" value="Submit" class="">
                      </div>
                    </form>
                    <span class="block-sep"></span>
              </div>
            </div>
          </div>             
        </div>
    </div>
</section>

@section('script')

<script>
  const userTypeInput = document.getElementById('user_type');
  let doc_sections = document.querySelectorAll(".doc_section");

  // Initially hide the doc_section elements
  // doc_sections.forEach(function(section) {
  //   section.style.display = "none";
  // });
  @if (old('role') !== 'Seller')
      doc_sections.forEach(function(section) {
          section.style.display = "none";
      });
  @else
      doc_sections.forEach(function(section) {
          section.style.display = "block";
      });
  @endif

  document.getElementById('togBtn').addEventListener('change', function() {
    const isChecked = this.checked;
    const selectedRole = isChecked ? 'Seller' : 'Buyer';
    console.log('Selected:', selectedRole);

    // Show/hide doc sections
    doc_sections.forEach(function(section) {
      section.style.display = selectedRole === 'Seller' ? 'block' : 'none';
    });

    // ✅ Store in hidden input for form submission
    userTypeInput.value = selectedRole;
  });

  // ✅ Set initial value on page load (in case user does not toggle)
  document.addEventListener('DOMContentLoaded', function () {
    const initialRole = document.getElementById('togBtn').checked ? 'Seller' : 'Buyer';
    userTypeInput.value = initialRole;
  });
</script>
@endsection
</x-frontend::layouts.master>
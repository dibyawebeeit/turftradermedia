<x-frontend::layouts.master :title="'Email Verification'">
<hr>


<section class="register-row p-t-60 p-b-60">
    <div class="container"> 
    	  <div class="row row-col-center headingRow">   
          <div class="col-cmn col-lg-8 col-md-8 col-sm-12 one text-center">
            <div class="section-content">
                <h2>Email Verification</h2>
              </div>
          </div>
        </div>
        
    	  <div class="row row-col-center">    
        	<div class="col-cmn col-lg-8 col-md-8 col-sm-12 one">
            <div class="section-content">
              <div class="register-block">
                    <p>We have sent an OTP to your email address: {{ Cache::get('cached_customer_data')['email'] ?? '' }}</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('submit_verify_email') }}" method="post" enctype="multipart/form-data">
                      @csrf

                      <div class="frm-col2">
                          <div class="form-group">
                            <label class="control-label">Enter OTP</label>
                            <input type="tel" name="otp" value="{{ old('otp') }}" pattern="[0-9]{6}" onkeypress="if(this.value.length==6) return false;" class="form-control" required>
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
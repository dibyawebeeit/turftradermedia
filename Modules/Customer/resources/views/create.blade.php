<x-dashboard::layouts.master :title="'Add Customer'">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                                {{-- <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li> --}}
                                <li class="breadcrumb-item active">Add Customer</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Customer</h4>
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

                            <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="type" class="form-label">User Type <sup>*</sup></label>
                                            <select class="form-control" id="usertype" name="role" required>
                                                <option value="">Select Type</option>
                                                <option value="seller">Seller</option>
                                                <option value="buyer">Buyer</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First Name <sup>*</sup></label>
                                            <input type="text" class="form-control" name="first_name"
                                                placeholder="First Name" value="{{ old('first_name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Last Name <sup>*</sup></label>
                                            <input type="text" class="form-control" name="last_name"
                                                placeholder="Last Name" value="{{ old('last_name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <sup>*</sup></label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone No <sup>*</sup></label>
                                            <input type="tel" class="form-control" name="phone"
                                                placeholder="Phone No" value="{{ old('phone') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address <sup>*</sup></label>
                                            <input type="text" class="form-control" name="address"
                                                placeholder="Address" value="{{ old('address') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City <sup>*</sup></label>
                                            <input type="text" class="form-control" name="city"
                                                placeholder="City" value="{{ old('city') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="state" class="form-label">State <sup>*</sup></label>
                                            <input type="text" class="form-control" name="state"
                                                placeholder="State" value="{{ old('state') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country <sup>*</sup></label>
                                            <input type="text" class="form-control" name="country"
                                                placeholder="Country" value="{{ old('country') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="postal_code" class="form-label">Postal Code <sup>*</sup></label>
                                            <input type="text" class="form-control" name="postal_code"
                                                placeholder="Postal Code" value="{{ old('postal_code') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Create Password<sup>*</sup></label>
                                            <input type="password" class="form-control" name="password"
                                                placeholder="Create Password" value="{{ old('password') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image <sup>*</sup></label>
                                            <input type="file" class="form-control" name="image" accept="image/*" required>
                                        </div>
                                    </div>

                                   
                                    {{-- <div class="col-md-4" id="document_section" style="display: none;">
                                        <div class="mb-3">
                                            <label for="documents" class="form-label">Documents <sup>*</sup></label>
                                            <input type="file" class="form-control" id="document" name="documents[]" multiple accept=".jpg,.jpeg,.pdf">
                                            <span>accept jpg,webp,pdf only</span>
                                        </div>
                                    </div> --}}
                                </div> <!-- end row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="siteurl" class="form-label">Status <sup>*</sup></label>
                                            <br>
                                            <input type="checkbox" id="switch1" name="status" checked data-switch="bool"/>
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="is_free_section" style="display: none;">
                                        <div class="mb-3">
                                            <label for="siteurl" class="form-label">Mark this seller as Free <sup>*</sup></label>
                                            <br>
                                            <input type="checkbox" id="switch2" name="is_free"  data-switch="bool"/>
                                            <label for="switch2" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div>


                                <div class="text-end">
                                    <button type="submit" class="btn btn-success mt-2"><i class="mdi mdi-content-save"></i>
                                        Save</button>
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
    @section('script')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const userType = document.getElementById("usertype");
        const freeSection = document.getElementById("is_free_section");
        // const documentSection = document.getElementById("document_section");
        // const documentInput = document.getElementById("document");

        function toggleDocumentSection() {
            if (userType.value === "seller") {
                freeSection.style.display = "block";
                // documentSection.style.display = "block";
                // documentInput.setAttribute("required", "required");
            } else {
                freeSection.style.display = "none";
                // documentSection.style.display = "none";
                // documentInput.removeAttribute("required");
                // documentInput.value = ""; // optional: clear file
            }
        }

        // On page load
        toggleDocumentSection();

        // On change
        userType.addEventListener("change", toggleDocumentSection);
    });
</script>
    @endsection
</x-dashboard::layouts.master>
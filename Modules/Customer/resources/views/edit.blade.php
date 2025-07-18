<x-dashboard::layouts.master :title="'Edit Customer'">
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
                                <li class="breadcrumb-item active">Edit Customer</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Customer</h4>
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

                            <form action="{{ route('customer.update',$dataList->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First Name <sup>*</sup></label>
                                            <input type="text" class="form-control" name="first_name"
                                                placeholder="First Name" value="{{ old('first_name',$dataList->first_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Last Name <sup>*</sup></label>
                                            <input type="text" class="form-control" name="last_name"
                                                placeholder="Last Name" value="{{ old('last_name',$dataList->last_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <sup>*</sup></label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Email" value="{{ old('email',$dataList->email) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone No <sup>*</sup></label>
                                            <input type="tel" class="form-control" name="phone"
                                                placeholder="Phone No" value="{{ old('phone',$dataList->phone) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address <sup>*</sup></label>
                                            <input type="text" class="form-control" name="address"
                                                placeholder="Address" value="{{ old('address',$dataList->address) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="city" class="form-label">City <sup>*</sup></label>
                                            <input type="text" class="form-control" name="city"
                                                placeholder="City" value="{{ old('city',$dataList->city) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="state" class="form-label">State <sup>*</sup></label>
                                            <input type="text" class="form-control" name="state"
                                                placeholder="State" value="{{ old('state',$dataList->state) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="country" class="form-label">Country <sup>*</sup></label>
                                            <input type="text" class="form-control" name="country"
                                                placeholder="Country" value="{{ old('country',$dataList->country) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="postal_code" class="form-label">Postal Code <sup>*</sup></label>
                                            <input type="text" class="form-control" name="postal_code"
                                                placeholder="Postal Code" value="{{ old('postal_code',$dataList->postal_code) }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image </label>
                                            <input type="file" class="form-control" name="image" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            @if ($dataList->image =='')
                                                <img src="{{ noImage() }}" alt="" style="height: 100px;width:100px;">
                                            @else
                                                <img src="{{ asset('uploads/customerDoc/'.$dataList->image) }}" alt="" style="height: 100px;width:100px;">
                                            @endif
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="siteurl" class="form-label">Status <sup>*</sup></label>
                                            <br>
                                            <input type="checkbox" id="switch1" name="status" {{ $dataList->status==1?'checked':'' }} data-switch="bool"/>
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                                @if (count($dataList->documents) > 0)
                                    <div class="col-md-12">
                                        <h4>Business Documents</h4>
                                        <div class="mb-3">
                                                <div class="row justify-content-center">
                                                    @foreach ($dataList->documents as $item)
                                                        @if ($item->type == "pdf")
                                                            <div class="col-md-2">
                                                                <a href="{{ asset('uploads/customerDoc/'.$item->file) }}" download>
                                                                    <i class="fas fa-file-pdf" style="font-size: 80px;"></i>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <div class="col-md-2">
                                                                <a href="{{ asset('uploads/customerDoc/'.$item->file) }}" download>
                                                                <img src="{{ asset('uploads/customerDoc/'.$item->file) }}" alt="Image" style="height: 100px;width:100px;">
                                                                </a>
                                                            </div>
                                                        @endif
                                                        
                                                    @endforeach
                                                </div>
                                        </div>
                                    </div>
                                    @endif


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
</x-dashboard::layouts.master>
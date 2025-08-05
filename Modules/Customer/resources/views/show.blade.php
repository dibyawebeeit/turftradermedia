<x-dashboard::layouts.master :title="'View Customer'">
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
                                <li class="breadcrumb-item active">View Customer</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View Customer</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <p><b>First Name : </b> {{ $customer->first_name }}</p>
                                            <p><b>Last Name : </b> {{ $customer->last_name }}</p>
                                            <p><b>Email : </b> {{ $customer->email }}</p>
                                            <p><b>Phone No : </b> {{ $customer->phone }}</p>
                                            <p><b>Postal Code : </b> {{ $customer->postal_code }}</p>
                                            <p><b>Address : </b> {{ $customer->address }}</p>
                                            <p><b>City : </b> {{ $customer->city }}</p>
                                            <p><b>State : </b> {{ $customer->state }}</p>
                                            <p><b>Country : </b> {{ $customer->country }}</p>
                                            <p><b>Type : </b> {{ ucwords($customer->role) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <p>{{ ucwords($customer->role) }} Image</p>
                                            @if ($customer->image =='')
                                                <img src="{{ noImage() }}" alt="Image" style="height: 200px;width:200px;">
                                            @else
                                                <img src="{{ asset('uploads/customerDoc/'.$customer->image) }}" alt="Image" style="height: 200px;width:200px;">
                                            @endif
                                        </div>
                                    </div>
                                    {{-- @if (count($customer->documents) > 0)
                                    <div class="col-md-12">
                                        <h4>Business Documents</h4>
                                        <div class="mb-3">
                                                <div class="row justify-content-center">
                                                    @foreach ($customer->documents as $item)
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
                                    @endif --}}
                                    
                                </div> <!-- end row -->


                                <div class="text-end">
                                    <a href="{{ route('customer.index') }}">
                                        <button type="button" class="btn btn-success mt-2">
                                            <i class="fas fa-long-arrow-alt-left"></i>
                                        Back to list</button>
                                    </a>
                                </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div>
        <!-- container -->

    </div>
</x-dashboard::layouts.master>
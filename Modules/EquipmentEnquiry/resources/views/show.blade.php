<x-dashboard::layouts.master :title="'View Enquiry'">
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
                                <li class="breadcrumb-item active">View Enquiry</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View Enquiry</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <p><b>Equipment : </b> {{ $enquiry->equipment->name ?? '' }}
                                                <a href="{{ route('product_details',$enquiry->equipment->slug ?? '') }}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                            </p>
                                            <p><b>First Name : </b> {{ $enquiry->first_name }}</p>
                                            <p><b>Last Name : </b> {{ $enquiry->last_name }}</p>
                                            <p><b>Email : </b> {{ $enquiry->email }}</p>
                                            <p><b>Phone No : </b> {{ $enquiry->phone }}</p>
                                            <p><b>Postal Code : </b> {{ $enquiry->postal_code }}</p>
                                            <p><b>Message : </b> {{ $enquiry->message }}</p>
                                        </div>
                                    </div>
                                    
                                </div> <!-- end row -->


                                <div class="text-end">
                                    <a href="{{ route('equipmentenquiry.index') }}">
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
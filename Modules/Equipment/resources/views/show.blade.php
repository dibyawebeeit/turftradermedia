<x-dashboard::layouts.master :title="'View Listing'">
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
                                <li class="breadcrumb-item active">View Listing</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View Listing</h4>
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
                                            <p><b>Seller : </b> {{ $equipment->customer->fullname ?? '' }} 
                                            <a href="{{ route('customer.show',$equipment->customer->id ?? '') }}" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                            </p>
                                            <p><b>Category : </b> {{ $equipment->category->name ?? '' }}</p>
                                            <p><b>Manufacturer : </b> {{ $equipment->manufacturer->name ?? '' }}</p>
                                            <p><b>Model : </b> {{ $equipment->manufacture_model->name ?? '' }}</p>
                                            <p><b>Name : </b> {{ $equipment->name }}</p>
                                            <p><b>Serial No / VIN : </b> {{ $equipment->vin }}</p>
                                            <p><b>Year : </b> {{ $equipment->year }}</p>
                                            <p><b>Hours : </b> {{ $equipment->hours }}</p>
                                            <p><b>Condition : </b> {{ $equipment->condition }}</p>
                                            <p><b>Price : </b> {{ $equipment->currency->sign ?? '' }}{{ $equipment->price }}</p>
                                            <p><b>Currency : </b> {{ $equipment->currency->name ?? '' }}</p>
                                            <p><b>Stock Number : </b> {{ $equipment->stock_no }}</p>
                                            <p><b>Machine Location : </b> {{ $equipment->machine_location }}</p>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <h4>Seller Information</h4>
                                            <p><b>Company Name : </b> {{ $equipment->company_name }}</p>
                                            <p><b>Contact Name : </b> {{ $equipment->contact_name }}</p>
                                            <p><b>Contact Email : </b> {{ $equipment->contact_email }}</p>
                                            <p><b>Contact No : </b> {{ $equipment->contact_no }}</p>

                                            <p>Thumbnail</p>
                                            @if ($equipment->thumbnail =='')
                                                <img src="{{ noImage() }}" alt="Image" style="height: 200px;width:200px;">
                                            @else
                                                <img src="{{ asset('uploads/equipmentImage/'.$equipment->thumbnail) }}" alt="Image" style="height: 200px;width:200px;">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <p><b>Description : </b> </p>
                                            <div>{!! $equipment->description !!}</div>
                                            
                                        </div>
                                    </div>
                                    @if (count($equipment->images) > 0)
                                    <div class="col-md-12">
                                        <h4>Gallery</h4>
                                        <div class="mb-3">
                                                <div class="row justify-content-center">
                                                    @foreach ($equipment->images as $item)
                                                        <div class="col-md-2">
                                                            <a href="{{ asset('uploads/equipmentImage/'.$item->file) }}" download>
                                                            <img src="{{ asset('uploads/equipmentImage/'.$item->file) }}" alt="Image" style="height: 100px;width:100px;">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                </div> <!-- end row -->


                                <div class="text-end">
                                    <a href="{{ route('equipment.index') }}">
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
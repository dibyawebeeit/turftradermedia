<x-dashboard::layouts.master :title="'Edit Ad'">
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
                                <li class="breadcrumb-item active">Edit Ad</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Ad</h4>
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

                            <form action="{{ route('ads.update',$dataList->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="type" class="form-label">Type <sup>*</sup></label>
                                            <select class="form-control" name="type" required>
                                                <option value="">Select</option>
                                                <option value="large" {{ $dataList->type=='large'?'selected':'' }}>Large</option>
                                                <option value="medium" {{ $dataList->type=='medium'?'selected':'' }}>Medium</option>
                                                <option value="small" {{ $dataList->type=='small'?'selected':'' }}>Small</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="external_link" class="form-label">External Link <sup>*</sup> </label>
                                            <input type="text" class="form-control" name="external_link"
                                                placeholder="External Link" value="{{ $dataList->external_link }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image </label>
                                            <input type="file" class="form-control" name="image" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <img src="{{ asset('uploads/adsImage/'.$dataList->image) }}" alt="" style="height: 100px;">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="siteurl" class="form-label">Status <sup>*</sup></label>
                                            <br>
                                            <input type="checkbox" id="switch1" name="status" {{ $dataList->status==1?'checked':'' }} data-switch="bool"/>
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <span>**Note:</span>
                                        <ul>
                                            <li>Large Ad: 1200px X 300px</li>
                                            <li>Medium Ad: 730px X 90px</li>
                                            <li>Small Ad: 300px X 250px</li>
                                        </ul>
                                    </div>
                                </div> <!-- end row -->


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
<x-dashboard::layouts.master :title="'About Us'">
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
                        <h4 class="page-title">About Us</h4>
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

                            <form action="{{ route('cms.submit_about_us') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h5 class="mb-4 text-uppercase bg-light p-2">
                                    <i class="mdi mdi-file me-1"></i>
                                    Main Section </h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="title" placeholder="Title"
                                                value="{{ $dataList->title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="title1" class="form-label">Sub Title </label>
                                            <input type="text" class="form-control" name="subtitle" placeholder="Sub Title"
                                                value="{{ $dataList->subtitle }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="banner" class="form-label">Banner</label>
                                            <input type="file" class="form-control" name="banner">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('uploads/cmsImage/' . $dataList->banner) }}" alt="image"
                                            class="img-fluid avatar-md" style="height: 40px;">
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="desc1" class="form-label">Desc <sup>*</sup></label>
                                            <textarea class="form-control editor" name="desc" rows="4" placeholder="Write something..." required>{{ $dataList->desc }}</textarea>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                            <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Section 2</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="section1_title" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="section1_title" placeholder="Title"
                                                value="{{ $dataList->section1_title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="section1_title2" class="form-label">Title 2</label>
                                            <input type="text" class="form-control" name="section1_title2" placeholder="Title"
                                                value="{{ $dataList->section1_title2 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="section1_button_text" class="form-label">Button Text <sup>*</sup></label>
                                            <input type="text" class="form-control" name="section1_button_text" placeholder="Button Text"
                                                value="{{ $dataList->section1_button_text }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="section1_button_url" class="form-label">Button Url <sup>*</sup></label>
                                            <div class="input-group">
                                                <span class="input-group-text">{{ url('') }}/</span>
                                                <input type="text" class="form-control" 
                                                    name="section1_button_url" value="{{ $dataList->section1_button_url }}" placeholder="Button Url" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="section1_image" class="form-label">Image</label>
                                            <input type="file" class="form-control" name="section1_image">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('uploads/cmsImage/' . $dataList->section1_image) }}" alt="image"
                                            class="img-fluid avatar-md" style="height: 40px;">
                                    </div>
                                </div> 

                            <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    Section 3</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="section2_title" class="form-label">Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="section2_title" placeholder="Title"
                                                value="{{ $dataList->section2_title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="section2_title2" class="form-label">Title 2</label>
                                            <input type="text" class="form-control" name="section2_title2" placeholder="Title"
                                                value="{{ $dataList->section2_title2 }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="section2_title3" class="form-label">Title 3</label>
                                            <textarea class="form-control" name="section2_title3" placeholder="Title 3">{{ $dataList->section2_title3 }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="section2_image" class="form-label">Image</label>
                                            <input type="file" class="form-control" name="section2_image">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{ asset('uploads/cmsImage/' . $dataList->section2_image) }}" alt="image"
                                            class="img-fluid avatar-md" style="height: 40px;">
                                    </div>
                                </div> 

                            <h5 class="mb-4 text-uppercase bg-light p-2"><i class="mdi mdi-file me-1"></i>
                                    SEO Section</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="meta_title" class="form-label">Meta Title <sup>*</sup></label>
                                            <input type="text" class="form-control" name="meta_title" placeholder="Title"
                                                value="{{ $dataList->meta_title }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="meta_keyword" class="form-label">Meta Keyword</label>
                                            <textarea class="form-control" name="meta_keyword" placeholder="Meta Keyword">{{ $dataList->meta_keyword }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="meta_desc" class="form-label">Meta Description</label>
                                            <textarea class="form-control" name="meta_desc" placeholder="Meta Keyword">{{ $dataList->meta_desc }}</textarea>
                                        </div>
                                    </div>
                                </div> 

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
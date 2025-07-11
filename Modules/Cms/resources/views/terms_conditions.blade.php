<x-dashboard::layouts.master :title="'Terms & Conditions'">
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
                        <h4 class="page-title">Terms & Conditions</h4>
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

                            <form action="{{ route('cms.submit_terms_conditions') }}" method="POST"
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
                                            <label for="title2" class="form-label">Title 2</label>
                                            <input type="text" class="form-control" name="title2" placeholder="Title 2"
                                                value="{{ $dataList->title2 }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="desc1" class="form-label">Desc <sup>*</sup></label>
                                            <textarea class="form-control editor" name="desc" rows="4" placeholder="Write something..." required>{{ $dataList->desc }}</textarea>
                                        </div>
                                    </div> <!-- end col -->
                                </div> <!-- end row -->

                           

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
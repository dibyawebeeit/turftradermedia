<x-dashboard::layouts.master :title="'Edit User'">
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
                                <li class="breadcrumb-item active">Edit User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit User</h4>
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

                            <form action="{{ route('user.update',$dataList->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                               <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role <sup>*</sup></label>
                                            <select class="form-control" name="role" required>
                                                <option value="">Select Role</option>
                                                @foreach ($roleList as $role)
                                                    <option value="{{ $role->id }}" {{ old('role',$dataList->role)==$role->id?'selected':'' }}>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name <sup>*</sup></label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter Name" value="{{ old('name',$dataList->name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">email <sup>*</sup></label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Enter Email" value="{{ old('email',$dataList->email) }}" required>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="siteurl" class="form-label">Status <sup>*</sup></label>
                                            <br>
                                            <input type="checkbox" id="switch1" name="status" value="1" {{ $dataList->status==1?'checked':'' }} data-switch="bool"/>
                                            <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                                        </div>
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
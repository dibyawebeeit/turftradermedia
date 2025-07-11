<x-dashboard::layouts.master :title="'Update Permission'">
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
                                <li class="breadcrumb-item active">Edit Permission</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Permission</h4>
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

                            <form action="{{ route('permission.update',$roleId) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role <sup>*</sup></label>
                                            <select class="form-control" name="role" disabled>
                                                <option value="">Select Role</option>
                                                @foreach ($roleList as $item)
                                                    <option value="{{ $item->id }}" {{$item->id==$roleId?'selected':''}}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                                <h4>Permissions</h4>
                                @foreach ($permissionList as $permission)
                                    <div class="row">
                                        @foreach ($permission as $item)
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="checkbox-signin"
                                                        name="permissions[]" value="{{ $item['id'] }}" {{in_array($item['id'],$userPermissionList)?'checked':''}}>
                                                    <label class="form-check-label"
                                                        for="checkbox-signin">{{ $item['display'] }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div> <!-- end row -->
                                    <hr>
                                @endforeach



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
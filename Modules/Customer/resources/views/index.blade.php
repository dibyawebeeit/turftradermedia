<x-dashboard::layouts.master :title="'Customer'">
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
                                <li class="breadcrumb-item active">Customer List</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Customer List</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-sm-5">
                                    @can('customer_add')
                                        <a href="{{ route('customer.create') }}" class="btn btn-danger mb-2"><i
                                            class="mdi mdi-plus-circle me-2"></i> Add Customer</a>
                                    @endcan
                                    
                                </div>
                                <div class="col-sm-7">
                                    <div class="text-sm-end">
                                        <form action="{{ route('exportCustomers') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="date" class="form-control" name="start_date" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="date" class="form-control" name="end_date" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-light mb-2">Export as Excel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered w-100 dt-responsive nowrap" id="basic-datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th> Sl </th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Added Date</th>
                                            <th style="width: 85px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($dataList as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    @if ($item->image =='')
                                                        <img src="{{ noImage() }}" alt="" style="height: 30px;width:30px;">
                                                    @else
                                                        <img src="{{ asset('uploads/customerDoc/'.$item->image) }}" alt="" style="height: 30px;width:30px;">
                                                    @endif
                                                </td>
                                                <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>{{ ucwords($item->role) }}</td>
                                                <td>
                                                    @if ($item->status==1)
                                                    <span class="badge bg-success">Active</span>
                                                    @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                                <td class="table-action">
                                                    @can('customer_view')
                                                        <a href="{{ route('customer.show', $item->id) }}" class="action-icon"> <i
                                                            class="mdi mdi-eye"></i></a>
                                                    @endcan
                                                    @can('customer_edit')
                                                        <a href="{{ route('customer.edit', $item->id) }}" class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i></a>
                                                    @endcan
                                                    @can('customer_delete')
                                                        <form action="{{ route('customer.destroy', $item->id) }}" method="POST"
                                                            id="deletesection_{{ $item->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <a href="javascript:void(0);" class="action-icon"
                                                                onclick="deleteData({{ $item->id }})"> <i
                                                                    class="mdi mdi-delete"></i></a>
                                                        </form>
                                                    @endcan
                                                    
                                                    
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
</x-dashboard::layouts.master>

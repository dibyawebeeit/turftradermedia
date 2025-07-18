<x-dashboard::layouts.master :title="'Subscription Plan'">
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
                                <li class="breadcrumb-item active">Subscription Plans</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Subscription Plans</h4>
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
                                    @can('subscriptionplan_add')
                                        <a href="{{ route('subscriptionplan.create') }}" class="btn btn-danger mb-2"><i
                                            class="mdi mdi-plus-circle me-2"></i> Add Plan</a>
                                    @endcan
                                    
                                </div>
                                {{-- <div class="col-sm-7">
                                    <div class="text-sm-end">
                                        <button type="button" class="btn btn-success mb-2 me-1"><i
                                                class="mdi mdi-cog-outline"></i></button>
                                        <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                        <button type="button" class="btn btn-light mb-2">Export</button>
                                    </div>
                                </div><!-- end col--> --}}
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered w-100 dt-responsive nowrap" id="basic-datatable">
                                    <thead class="table-light">
                                        <tr>
                                            <th> Sl </th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Duration (Days)</th>
                                            <th>No of Listing</th>
                                            <th>Status</th>
                                            <th>Added Date</th>
                                            <th style="width: 85px;">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($dataList as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ format_price($item->monthly_price) }}</td>
                                                <td>{{ $item->duration }}</td>
                                                <td>{{ $item->no_of_listing }}</td>
                                                <td>
                                                    @if ($item->status==1)
                                                    <span class="badge bg-success">Active</span>
                                                    @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                                <td class="table-action">
                                                    @can('subscriptionplan_edit')
                                                        <a href="{{ route('subscriptionplan.edit', $item->id) }}" class="action-icon"> <i
                                                            class="mdi mdi-square-edit-outline"></i></a>
                                                    @endcan
                                                    @can('subscriptionplan_delete')
                                                        <form action="{{ route('subscriptionplan.destroy', $item->id) }}" method="POST"
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

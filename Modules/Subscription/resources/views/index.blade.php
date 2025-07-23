<x-dashboard::layouts.master :title="'Subscription List'">
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
                                <li class="breadcrumb-item active">Subscription</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Subscription List</h4>
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
                                    
                                    
                                </div>
                                <div class="col-sm-7">
                                    <div class="text-sm-end">
                                        <form action="{{ route('exportSubscriptions') }}" method="POST">
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
                                            <th>Customer</th>
                                            <th>Plan</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Amount</th>
                                            <th>Txn ID</th>
                                            <th>Status</th>
                                            <th>Added Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($dataList as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->customer->first_name ?? '' }} {{ $item->customer->last_name ?? '' }}
                                                    <a href="{{ route('customer.show',$item->customer->id ?? '') }}" target="_blank">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                </td>
                                                <td>{{ $item->plan->name ?? '' }}</td>
                                                <td>{{ $item->start_date }}</td>
                                                <td>{{ $item->end_date }}</td>
                                                <td>{{ format_price($item->amount) }}</td>
                                                <td>{{ $item->txn_id }}</td>
                                                <td>{{ ucwords($item->status) }}</td>
                                                <td>{{ dateFormater($item->created_at) }}</td>
                                                
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

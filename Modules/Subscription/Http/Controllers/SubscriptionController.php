<?php

namespace Modules\Subscription\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Subscription\Models\Subscription;
use Spatie\SimpleExcel\SimpleExcelWriter;

class SubscriptionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:subscription_list', ['only' => ['index']]);
    }

    public function index()
    {
        $data['dataList'] = Subscription::orderBy('id','desc')->get();
        return view('subscription::index', $data);
    }

    public function exportSubscriptions(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $subscriptions = Subscription::whereBetween('created_at', [
            $request->start_date,
            $request->end_date
        ])->get();

        // Prepare data with SL No
        $rows = [];
        foreach ($subscriptions as $index => $data) {
            $rows[] = [
                'SL No'      => $index + 1,
                'Customer'   => $data->customer->fullname ?? '',
                'Plan'       => $data->plan->name ?? '',
                'Start Date' => $data->start_date,
                'End Date'   => $data->end_date,
                'Amount'   => $data->amount,
                'Txn Id'    => $data->txn_id,
                'Status'      => ucwords($data->status),
                'Created At' => $data->created_at->format('Y-m-d H:i:s'),
            ];
        }

         // Generate dynamic filename
        $date = now()->format('Y-m-d');
        $fileName = "subscripton_{$date}.xlsx";
        $filePath = storage_path("app/{$fileName}");

        SimpleExcelWriter::create($filePath)
            ->addHeader(['SL No', 'Customer', 'Plan', 'Start Date','End Date','Amount','Txn Id','Status', 'Created At'])
            ->addRows($rows);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    public function create()
    {
        return view('subscription::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('subscription::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('subscription::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}

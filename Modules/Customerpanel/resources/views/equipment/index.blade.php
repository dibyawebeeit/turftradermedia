<x-frontend::layouts.master :title="'Listings'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
    <form class="datatable-form">
         <div class="container">
            <div class="row col-middle-gap">
             
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

                <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                  <div class="section-content dashboard-right change-pass">
                     <div class="dashboard-header">
                        <h2>Listings</h2>
                     </div>

                     <p> <a href="{{ route('customer.equipment.create') }}" class="btn">Add+</a></p>
                     
                     <table id="example" class="display" cellspacing="0" width="100%">
                     <thead>
                           <tr>
                              <th></th>
                              <th>Sl</th>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Price</th>
                              <th>Publish Status</th>
                              <th>Admin Approval</th>
                              <th>Added On</th>
                              <th>Action</th>
                           </tr>
                     </thead>
               
                     {{-- <tfoot>
                           <tr>
                              <th>Name</th>
                              <th>Position</th>
                              <th>Office</th>
                              <th>Age</th>
                              <th>Start date</th>
                              <th><i class="fa-solid fa-pen-to-square"></i> </th>
                           </tr>
                     </tfoot> --}}
               
                     <tbody>
                           @foreach ($equipmentList as $item)
                               <tr>
                                 <td></td>
                                 <td>{{ $loop->iteration }}</td>
                                 <td><img class="image-thumbnail" src="{{ asset('uploads/equipmentImage/'.$item->thumbnail) }}" alt=""></td>
                                 <td>{{ $item->name }} <a href="{{ route('product_details',$item->slug) }}" target="_blank"><i class="fa-solid fa-external-link"></i></a></td>
                                 <td>{{ $item->currency->name ?? '' }}
                                    {{ $item->currency->sign ?? '' }}{{ $item->price }}
                                    </td>
                                 <td>
                                    <label class="my-toggle">
                                       <input class="publish_status_toggle" type="checkbox" id="switch_{{ $item->id }}" value="{{ $item->id }}"  {{ $item->publish_status == 1 ? 'checked' : '' }}>
                                       <span class="my-slider"></span>
                                    </label>
                                 </td>
                                 <td>
                                    @if ($item->admin_approval==1)
                                        <span class="badge badge-success approved">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                 </td>
                                 <td>{{ dateFormater($item->created_at) }}</td>
                                 <td class="action" style="text-align: center;">
                                    <a href="{{ route('customer.equipment.edit',$item->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('customer.equipment.destroy', $item->id) }}" method="POST" id="deletesection_{{ $item->id }}">
                                       @csrf
                                       @method('DELETE')
                                       <a href="javascript:void(0);" class="action-icon"
                                             onclick="deleteData({{ $item->id }})"> <i
                                                class="fa-solid fa-trash"></i></a>
                                    </form>
                                 </td>
                              </tr>
                           @endforeach
                           
                           
                     </tbody>
                     </table>

                  </div>
               </div>
            </div>
         </div>
      </form>
      </section>

@section('script')
<script>
   
document.querySelectorAll('.publish_status_toggle').forEach(toggle => {
    toggle.addEventListener('change', function () {
        const equipmentId = this.value;
        const isChecked = this.checked ? 1 : 0;
        const checkbox = this; // reference for later

        fetch("{{ route('customer.equipment.togglePublishStatus') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                id: equipmentId,
                publish_status: isChecked
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("Status updated successfully");
            } else {
               checkbox.checked = !checkbox.checked; // revert toggle
                alert(data.message);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
});


   function deleteData(id) {
            Swal.fire({
                text: "Do you want to delete?",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Proceed",
                denyButtonText: `Don't save`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    document.getElementById("deletesection_" + id).submit();
                }
            });
        }
</script>
@endsection
</x-frontend::layouts.master>
<x-frontend::layouts.master :title="'Enquiry List'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

                <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                  <div class="section-content dashboard-right change-pass">
                     <div class="dashboard-header">
                        <h2>Enquiry List</h2>
                     </div>
                     
                     <table id="example" class="display" cellspacing="0" width="100%">
                     <thead>
                           <tr>
                              <th></th>
                              <th>Sl</th>
                              <th>Equipment</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Added On</th>
                              <th>Action</th>
                           </tr>
                     </thead>
            
               
                     <tbody>
                           @foreach ($enquiryList as $item)
                               <tr>
                                 <td></td>
                                 <td>{{ $loop->iteration }}</td>
                                 <td>{{ $item->equipment->name ?? '' }} 
                                    <a href="{{ route('product_details',$item->equipment->slug ?? '') }}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                                 </td>
                                 <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                 <td>{{ $item->email }}</td>
                                 <td>{{ $item->phone }}</td>
                                 <td>{{ dateFormater($item->created_at) }}</td>
                                 <td class="action" style="text-align: center;">
                                    <a href="{{ route('customer.view_enquiry',$item->id) }}"><i class="fa-solid fa-eye"></i></a>
                                 </td>
                              </tr>
                           @endforeach
                           
                           
                     </tbody>
                     </table>

                  </div>
               </div>
            </div>
         </div>
      </section>


</x-frontend::layouts.master>

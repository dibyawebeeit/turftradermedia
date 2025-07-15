<x-frontend::layouts.master :title="'Equipment List'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

                <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                  <div class="section-content dashboard-right change-pass">
                     <div class="dashboard-header">
                        <h2>Equipment List</h2>
                     </div>

                     <p> <a href="{{ route('customer.equipment.create') }}" class="btn">Add+</a></p>
                     
                     <table id="example" class="display" cellspacing="0" width="100%">
                     <thead>
                           <tr>
                              <th>Name</th>
                              <th>Position</th>
                              <th>Office</th>
                              <th>Age</th>
                              <th>Start date</th>
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
                           
                           <tr>
                              <td>Airi Satou</td>
                              <td>Accountant</td>
                              <td>Tokyo</td>
                              <td>33</td>
                              <td>2008/11/28</td>
                              <td class="action" style="text-align: center;">
                                 <a href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                 <a href="#"><i class="fa-solid fa-trash"></i></a></td>
                           </tr>
                           
                     </tbody>
                     </table>

                  </div>
               </div>
            </div>
         </div>
      </section>
</x-frontend::layouts.master>

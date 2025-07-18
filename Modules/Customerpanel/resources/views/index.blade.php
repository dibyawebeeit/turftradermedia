<x-frontend::layouts.master :title="'Dashboard'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

               <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                  <div class="section-content dashboard-right">
                     <h2>Hello , {{ Auth::guard('customer')->user()->first_name }} {{ Auth::guard('customer')->user()->last_name }}</h2>
                     <p>Welcome to your dashboard</p>
                     <section class="container analytics-section dashboardmain ">
                        <div class="row">

                           <div class="col-cmn col-lg-3">
                              <div class="card">
                                 <h4>{{ $total_watchlist }}</h4>
                                 <a href="{{ route('frontend.watchlist') }}" target="_blank">
                                    <p>Total Watchlist</p>
                                 </a>
                              </div>
                           </div>

                           @if (Auth::guard('customer')->user()->role === 'seller')
                           <div class="col-cmn col-lg-3">
                              <div class="card">
                                 <h4>{{ $total_equipment }}</h4>
                                 <a href="{{ route('customer.equipment.index') }}">
                                    <p>Total Equipments</p>
                                 </a>
                              </div>
                           </div>
                           <div class="col-cmn col-lg-3">
                              <div class="card">
                                 <h4>{{ $total_enquiry }}</h4>
                                 <a href="{{ route('customer.enquiry') }}">
                                    <p>Total Enquiry</p>
                                 </a>
                              </div>
                           </div>
                           @endif
                           
                           
                           
                        </div>
                     </section>
                  </div>
               </div>
            </div>
         </div>
      </section>
</x-frontend::layouts.master>

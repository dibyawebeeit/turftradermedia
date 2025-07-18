<x-frontend::layouts.master :title="'View Enquiry'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

               <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                  <div class="section-content dashboard-right">
                     <h2>View Enquiry</h2>
                     <p><b>Equipment : </b> {{ $enquiry->equipment->name ?? '' }}
                        <a href="{{ route('product_details',$enquiry->equipment->slug ?? '') }}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>
                    </p>
                     <p><b>First Name : </b> {{ $enquiry->first_name }}</p>
                     <p><b>Last Name : </b> {{ $enquiry->last_name }}</p>
                     <p><b>Email : </b> {{ $enquiry->email }}</p>
                     <p><b>Phone No : </b> {{ $enquiry->phone }}</p>
                     <p><b>Postal Code : </b> {{ $enquiry->postal_code }}</p>
                     <p><b>Message : </b> {{ $enquiry->message }}</p>
                  </div>
               </div>
            </div>
         </div>
      </section>
</x-frontend::layouts.master>

<x-frontend::layouts.master :title="'Oops'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

               <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                  <div class="section-content dashboard-right">
                     <h4>Oops!</h4>
                     <p>{{ $msg }}</p>
                     
                    
                  </div>
               </div>
            </div>
         </div>
      </section>



</x-frontend::layouts.master>

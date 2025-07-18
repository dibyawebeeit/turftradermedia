<x-frontend::layouts.master :title="'Subscription'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

               <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                  <div class="section-content dashboard-right">
                     <h2>Subscription Plan</h2>
                     @if ($activeSubscription !=null)
                        <div>
                            <p>Your Active Plan : {{ $activeSubscription->plan->name }}</p>
                            {!! $activeSubscription->plan->description !!}
                            <span>Expairy : {{ $activeSubscription->end_date }}</span>
                        </div>
                     @else
                         <p>You have no active plan!</p>
                     @endif

                    <h2>Renew Subscription Plan</h2>
                    <div class="container6">    
                        @foreach ($subscriptionplan as $item)
                        <div class="offers">
                            <h2>{{ $item['name'] }}</h2>
                            <h3 class="price monthly_price">${{ $item['monthly_price'] }} 
                            <small>Monthly</small>
                            </h3>
                            <h3 class="price annual_price" style="display:none;">${{ $item['annual_price'] }} 
                            <small>Annually</small>
                            {{-- <span class="offer">{{ $item['offer'] }}</span> --}}
                            </h3>
                            
                            <div class="content">
                                {!! $item['description'] !!}
                            </div>
                            
                            <button class="btn1 subscribe-btn" data-id="{{ $item['id'] }}">
                                Proceed
                            </button>
                        </div>
                        @endforeach
                    </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
</x-frontend::layouts.master>

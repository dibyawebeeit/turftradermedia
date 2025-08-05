<x-frontend::layouts.master :title="'Subscription'">
    <hr>
    <section class="productlist-row-list p-t-60 p-b-60">
         <div class="container">
            <div class="row col-middle-gap">
               
                <x-customerpanel::layouts.sidebar :activemenu="$activemenu" />

               <div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
                  <div class="section-content dashboard-right">
                     <h2>Subscription Plan</h2>
                     @if ($status == "free")
                         <p class="free-subscription-msg">You have a free subscription plan. Enjoy your listing!</p>
                     @elseif($status == "expired")
                        <p class="expired-subscription-msg">Your active plan has expired!</p>
                        @if ($activeSubscription !=null)
                            <div class="active_plan">
                                <p class="plan-title">Your Plan: <strong>{{ $activeSubscription->plan->name }}</strong></p>
                                <div class="plan-description">
                                    {!! $activeSubscription->plan->description !!}
                                </div>
                                <span class="plan-expiry">Expiry: {{ $activeSubscription->end_date }}</span>
                            </div>
                        @endif
                     @else
                        @if ($activeSubscription !=null)
                            <div class="active_plan">
                                <p class="plan-title">Current Listing Plan: <strong>{{ $activeSubscription->plan->name }}</strong></p>
                                <div class="plan-description">
                                    {!! $activeSubscription->plan->description !!}
                                </div>
                                <span class="plan-expiry">Expiry: {{ $activeSubscription->end_date }}</span>
                            </div>
                        @endif
                     @endif

                     @if (count($upcomingSubscription) > 0)
                         @foreach ($upcomingSubscription as $item)
                             <p class="free-subscription-msg">Upcoming Plan : {{ $item->plan->name ?? '' }}</p>
                         @endforeach
                     @endif
                     
                     

                    @if ($status !="free")
                        <h2>Upgrade Plan</h2>
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
                    @endif
                    
                  </div>
               </div>
            </div>
         </div>
      </section>


@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll(".subscribe-btn").forEach(function (btn) {
            btn.addEventListener("click", function () {
                const subscriptionId = this.getAttribute("data-id");
                const subscriptionType = 'monthly';

                const url = "{{ route('customer.renewstartPayment') }}" + `?id=${subscriptionId}&type=${subscriptionType}`;
                window.location.href = url;
            });
        });
    });
</script>
@endsection
</x-frontend::layouts.master>

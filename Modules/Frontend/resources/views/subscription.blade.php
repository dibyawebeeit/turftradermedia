<x-frontend::layouts.master :title="'Subscription Plan'">
    <hr>
<section class="productlist-row-list p-t-60 p-b-60">
    <section class="pachege-panel">
        <div class="container clearfix">
            
            <div class="container-subcrip" id="subscription">
                <h1 class="title">Subscription Plans</h1>
                {{-- <label class="switch">
                    <input type="checkbox" id="togBtn">
                    <div class="slider round"><!--ADDED HTML -->
                        <span class="on">Yearly</span>
                        <span class="off">Monthly</span><!--END-->
                    </div>
                </label>  --}}
                <div class="container6 register-page6">    
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
                        
                        @if (Cache::get('cached_customer_data'))
                            <button class="btn1 subscribe-btn" data-id="{{ $item['id'] }}">
                                Proceed
                            </button>
                        @else
                            <a href="{{ route('register') }}" class="btn1">
                                Proceed
                            </a>
                        @endif
                        
                    </div>
                @endforeach
                                
                    
                    {{-- <button class="btn" id="backBtn">Back</button> --}}
                </div>
            </div>

        </div>
    </section>
</section>

@section('script')
<script>
    

//    document.getElementById('togBtn').addEventListener('change', function () {
//       const monthly = document.querySelectorAll('.monthly_price');
//       const annual = document.querySelectorAll('.annual_price');

//       if (this.checked) {
//          // Show yearly, hide monthly
//          monthly.forEach(el => el.style.display = 'none');
//          annual.forEach(el => el.style.display = 'block');
//       } else {
//          // Show monthly, hide yearly
//          monthly.forEach(el => el.style.display = 'block');
//          annual.forEach(el => el.style.display = 'none');
//       }
//    });

    document.addEventListener("DOMContentLoaded", function () {
        // const planToggle = document.getElementById('togBtn');

        document.querySelectorAll(".subscribe-btn").forEach(function (btn) {
            btn.addEventListener("click", function () {
                const subscriptionId = this.getAttribute("data-id");
                // const subscriptionType = planToggle.checked ? 'annual' : 'monthly';
                const subscriptionType = 'monthly';

                const url = "{{ route('startPayment') }}" + `?id=${subscriptionId}&type=${subscriptionType}`;
                window.location.href = url;
            });
        });
    });
</script>
@endsection
</x-frontend::layouts.master>
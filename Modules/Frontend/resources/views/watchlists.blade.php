<x-frontend::layouts.master :title="'Watchlist'" :description="'Watchlist'" :keywords="'Watchlist'">
<hr>

<section class="productlist-row-list p-t-60 p-b-60">
    <div class="container">  
    	<div class="row col-middle-gap">                
        	<div class="col-cmn col-lg-12 col-md-12 col-sm-12 two">
            	<div class="section-content">
                    <h2>Watchlist</h2>
                    <div class="productlistShop productlistShopwatch">
                      @if (count($allEquipments)>0)
                        @foreach ($allEquipments as $equipment)
                          <div class="productlistShopCol" id="item_{{ $equipment->id }}">
                              <div class="productBox">
                                  <div class="productBoxImg">
                                      <a href="{{ route('product_details',$equipment->slug) }}">
                                        <img src="{{ asset('uploads/equipmentImage/'.$equipment->thumbnail) }}"></a>
                                        <span class="watchlist-close" onclick="removeWatchlist({{ $equipment->id }})"><i class="fa-solid fa-xmark"></i></span>
                                    </div>
                                  <div class="productBoxCont">
                                      <div class="productBoxTitle"><a href="{{ route('product_details',$equipment->slug) }}">{{ strlen($equipment->name)>17 ? substr($equipment->name,0,17):$equipment->name }}</a></div>
                                      <div class="productBoxText"><p>{{ $equipment->category->name ?? '-' }}</p></div>
                                      <div class="productBoxPrice">{{ $equipment->currency->sign ?? '' }} {{ $equipment->price }}</div>
                                      <div class="productBoxBtn"><a href="{{ route('product_details',$equipment->slug) }}" class="btn">View Details</a></div>
                                    </div>
                                </div>
                          </div>
                        @endforeach
                      @else
                          <h5>No data found!</h5>
                      @endif
                    </div>
                    
                    
                    @if (!empty($allEquipments))
                    <div class="pagination">
                      {{ $allEquipments->links('pagination::default') }}
                    </div>
                    @endif
                    
                    
                    
                
                </div>
            </div>                     
       </div>
        
    </div>
</section>

@section('script')
<script>
    function removeWatchlist(id)
    {
        fetch("{{ route('frontend.watchlist_item_remove') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ equipment_id: id })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'unauthenticated') {
                    // alert("Please login to add to watchlist.");
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "error",
                        text: "Please login to add to watchlist."
                    });
                } else if (data.status === 'error') {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "error",
                        text: "Something went wrong!"
                    });
                } else if (data.status === 'removed') {
                    document.getElementById("item_"+id).remove();
                }
            })
            .catch(err => {
                console.error("Error:", err);
            });
    }
 
</script>
@endsection

</x-frontend::layouts.master>
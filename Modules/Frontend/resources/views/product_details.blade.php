<x-frontend::layouts.master :title="$equipment->meta_title" :keywords="$equipment->meta_keyword" :description="$equipment->meta_desc">
<hr>
<style>

    #popup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.6);
      z-index: 9999;
      justify-content: center;
      align-items: center;
    }

    .popup-content {
      background-color: #fff;
      padding: 25px;
      border-radius: 8px;
      max-width: 750px;
      width: 95%;
      position: relative;
    }

    .popup-content h2 {
      margin-top: 0;
      text-align: center;
    }

    .popup-grid {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    .left-column,
    .right-column {
      flex: 1;
      min-width: 250px;
    }

    label {
      display: block;
      font-weight: bold;
      margin: 10px 0 5px;
    }

    input, textarea {
      width: 100%;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    textarea {
      height: 100%;
      min-height: 215px;
      resize: vertical;
    }

    .checkbox-section {
      margin-top: 20px;
    }

    .checkbox-section label {
      font-weight: normal;
      display: flex;
      align-items: flex-start;
      gap: 10px;
      font-size: 14px;
      line-height: 1.4;
    }

    .checkbox-section input[type="checkbox"] {
      margin-top: 3px;
    }

    .close-btn {
      position: absolute;
      right: 15px;
      top: 10px;
      font-size: 20px;
      color: #888;
      cursor: pointer;
    }

    .close-btn:hover {
      color: red;
    }

    .submit-container {
      text-align: center;
      margin-top: 20px;
    }

    .submit-container .btn {
      background-color: #28a745;
    }
  </style>
<section class="productDetails-row-tow p-t-60 p-b-60">
    <div class="container">           
           <div class="row productGal-row col-middle-gap">              	
                <div class="col-cmn col-lg-6 col-md-6 col-sm-12 one pro-detls-gal">   
                
                    <div class="main-pro-gal">
                      <!-- Main Image Slider -->
                      
                      <div class="slider-for">
                        @foreach ($equipment->images as $galleryimage)
                          <a data-fancybox="gallery" href="{{ asset('uploads/equipmentImage/'.$galleryimage->file) }}"><img src="{{ asset('uploads/equipmentImage/'.$galleryimage->file) }}" alt="Gallery Image"></a>
                        @endforeach
                        
                      </div>
                    
                      <!-- Thumbnail Navigation -->
                      <div class="slider-nav">
                        @foreach ($equipment->images as $galleryimage)
                        <div>
                            <img src="{{ asset('uploads/equipmentImage/'.$galleryimage->file) }}" alt="Thumb 1">
                        </div>
                        @endforeach
                      </div>
                    </div>
                        
                </div>               	
                <div class="col-cmn col-lg-6 col-md-6 col-sm-12 two pro-detls-contnt">     
                
                	<div class="pro-detls-title">{{ $equipment->name }}</div>
                       
                    <p>{{ $equipment->category->name }}</p>
                    
                    <div class="pro-detls-watchlist">
                        
                        <p>
                            <a href="javascript:void(0)" id="favoriteBtn" data-business-id="{{ $equipment->id }}">
                                <i id="favoriteIcon" class="fa{{ $isFavorite ? 's' : 'r' }} fa-heart"></i> 
                            </a>
                             View My Watch List <a href="{{ route('frontend.watchlist') }}">
                            <i class="fa fa-external-link" aria-hidden="true"></i> </a>
                        </p>
                    </div>
                    <div class="pro-detls-price">{{ $equipment->currency->name ?? '' }} {{ $equipment->currency->sign ?? '' }}{{ $equipment->price }}</div>
                    <div class="pro-detls-location">
                        <a href="javascript:void(0)" class="btn" onclick="document.getElementById('popup').style.display='flex'">Send Enquiry</a>
                        <p><b>Machine Location:</b> {{ $equipment->machine_location }}</p></div>
                    
                    
                    <div class="pro-detls-itemdetails">
                    	<h2>Item Details</h2>
                    	<div class="proItemdetailsTbl">
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Serial No</div>
                                <div class="proItemdetailsTbl-td">{{ $equipment->vin }}</div>
                            </div>
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Year</div>
                                <div class="proItemdetailsTbl-td">{{ $equipment->year }}</div>
                            </div>
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Manufacturer</div>
                                <div class="proItemdetailsTbl-td">{{ $equipment->manufacturer->name ?? 'NA' }}</div>
                            </div>
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Model</div>
                                <div class="proItemdetailsTbl-td">{{ $equipment->manufacture_model->name ?? 'NA' }}</div>
                            </div>
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Stock Number</div>
                                <div class="proItemdetailsTbl-td">{{ $equipment->stock_no ?? 'NA' }}</div>
                            </div>
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Hours</div>
                                <div class="proItemdetailsTbl-td">{{ $equipment->hours }}</div>
                            </div>
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Condition</div>
                                <div class="proItemdetailsTbl-td">{{ $equipment->condition }}</div>
                            </div>
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Description</div>
                                <div class="proItemdetailsTbl-td">
                                    {!! $equipment->description !!}
                                </div>
                            </div>
                        </div>                    	
                    </div>
                    <div class="pro-detls-otherList"><p><b>View Sellers Other Listings</b></p></div>                    
                    <div class="pro-detls-sellerInform">
                    	<h2>Seller Information</h2>
                        
                    	<div class="proItemdetailsTbl">
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Company Name</div>
                                <div class="proItemdetailsTbl-td">{{ $equipment->company_name ?? 'NA' }}</div>
                            </div>
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Contact Name</div>
                                <div class="proItemdetailsTbl-td">{{ $equipment->contact_name ?? 'NA' }}</div>
                            </div>
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Email</div>
                                <div class="proItemdetailsTbl-td"><a href="mailto:{{ $equipment->contact_email }}">{{ $equipment->contact_email }}</a></div>
                            </div>
                            <div class="proItemdetailsTbl-tr">
                                <div class="proItemdetailsTbl-td">Phone</div>
                                <div class="proItemdetailsTbl-td"><a href="tel:{{ $equipment->contact_no }}">{{ $equipment->contact_no }}</a></div>
                            </div>
                        </div>
                    </div>                
                </div>  
            </div> 
            
            
           <div class="row productDetails-row p-t-60 p-b-60">              	
                <div class="col-cmn col-lg-12 col-md-12 col-sm-12 one"> 
                	<div class="section-content">
                    
                    	<h2>Details</h2>
                        {!! $equipment->details !!}
                        
                    </div> 
                </div>
           </div>
            
           <div class="row productReated-row"> 
                <div class="col-cmn col-lg-12 col-md-12 col-sm-12 productReatedHead"> 
                	<div class="section-content">                    
                    	<h2>Recommended For You</h2>                        
                    </div> 
                </div>
                <div class="col-cmn col-lg-12 col-md-12 col-sm-12 productReatedList"> 
                	<div class="section-content">    
                        <div class="proReatedSlider">
                            @foreach ($recommendedList as $item)
                                <div class="saleSliderCol">
                                    <div class="productBox">
                                        <div class="productBoxImg">
                                            <a href="{{ route('product_details',$item->slug) }}"><img src="{{ asset('uploads/equipmentImage/'.$item->thumbnail) }}"></a>
                                        </div>
                                        <div class="productBoxCont">
                                            <div class="productBoxTitle"><a href="{{ route('product_details',$item->slug) }}">{{ strlen($item->name)>20 ? substr($item->name,0,20):$item->name }}</a></div>
                                            <div class="productBoxText"><p>{{ $item->category->name ?? '-' }}</p></div>
                                            <div class="productBoxPrice">{{ $item->currency->sign ?? '' }} {{ $item->price }}</div>
                                            <div class="productBoxBtn"><a href="{{ route('product_details',$item->slug) }}" class="btn">View Details</a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach                                     	
                        </div>                         
                    </div> 
                </div>
           </div>           
    </div>
</section>

<!-- Popup Modal -->
<div id="popup">
  <div class="popup-content">
    <span class="close-btn" onclick="document.getElementById('popup').style.display='none'">&times;</span>
    <h2>Send Your Enquiry</h2>
    <form method="post" action="{{ route('frontend.submit_equipment_enquiry') }}">
        @csrf
      <div class="popup-grid">
        <div class="left-column">
          <input type="hidden" name="equipment_id" value="{{ $equipment->id }}">
          <label for="first_name">First Name <sup>*</sup></label>
          <input type="text" name="first_name" placeholder="Enter your first name" value="{{ old('first_name') }}" required>
            @error('first_name')
            <div class="errmsg">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
            </div>
            @enderror

          <label for="last_name">Last Name <sup>*</sup></label>
          <input type="text" name="last_name" placeholder="Enter your last name" value="{{ old('last_name') }}" required>
            @error('last_name')
            <div class="errmsg">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
            </div>
            @enderror

          <label for="email">Email <sup>*</sup></label>
          <input type="email" name="email" placeholder="Enter your email address" value="{{ old('email') }}" required>
          @error('email')
        <div class="errmsg">
            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
        </div>
        @enderror

          <label for="phone">Phone <sup>*</sup></label>
          <input type="tel" name="phone" placeholder="Enter your phone no" value="{{ old('phone') }}" required>
          @error('phone')
            <div class="errmsg">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
            </div>
            @enderror

          <label for="postal_code">Postal Code <sup>*</sup></label>
          <input type="text" name="postal_code" placeholder="Enter your postal code" value="{{ old('postal_code') }}" required>
          @error('postal_code')
            <div class="errmsg">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
            </div>
            @enderror
        </div>

        <div class="right-column">
          <label for="message">Message <sup>*</sup></label>
          <textarea name="message" placeholder="Enter your enquiry" required>{{ old('message') }}</textarea>
          @error('message')
            <div class="errmsg">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
            </div>
            @enderror
            <div class="checkbox-section">
        <label>
          <input type="checkbox" name="marketing_opt_in">
          I would like to receive reoccurring weekly updates, product, and promotional emails from Sandhills Global, Inc., NeedTurfEquipment, our Affiliates, Currency and our Brands (“Sandhills”).
        </label>
      </div>

      <div class="submit-container">
        <button type="submit" class="btn">Submit</button>
      </div>

        </div>
      </div>

      
    </form>
  </div>
</div>

@section('script')
<script>
    document.querySelector("#favoriteBtn").addEventListener("click", function () {
            const equipmentId = this.getAttribute("data-business-id");
            const icon = document.querySelector("#favoriteIcon");

            fetch("{{ route('frontend.watchlist_toggle') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ equipment_id: equipmentId })
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
                } else if (data.status === 'added') {
                    icon.classList.remove("far"); // outline
                    icon.classList.add("fas");    // solid
                } else if (data.status === 'removed') {
                    icon.classList.remove("fas");
                    icon.classList.add("far");
                }
            })
            .catch(err => {
                console.error("Error:", err);
            });
        });
</script>
@endsection
</x-frontend::layouts.master>
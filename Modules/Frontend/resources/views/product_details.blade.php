<x-frontend::layouts.master>
<hr>
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
                    
                    <div class="pro-detls-watchlist"><p>View My Watch List</p></div>
                    <div class="pro-detls-price">{{ $equipment->currency->name ?? '' }} {{ $equipment->currency->sign ?? '' }}{{ $equipment->price }}</div>
                    <div class="pro-detls-location"><p><b>Machine Location:</b> {{ $equipment->machine_location }}</p></div>
                    
                    
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
                                    {{ $equipment->description }}
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
                        {{ $equipment->details }}
                        
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
</x-frontend::layouts.master>
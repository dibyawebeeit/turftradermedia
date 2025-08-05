<x-frontend::layouts.master>

@if (isset($banner))
	<section class="home-row-bnr p-b-60">
		<div class="container">    
			<div class="row">    
				<div class="col-cmn col-lg-12 col-md-12 col-sm-12 one text-center">
					<div class="homeSlider">
						@foreach ($banner as $item)
							<div class="homeSliderCol" style="background-image: url({{ asset('uploads/bannerImage/'.$item->image) }});">
								<h2>{{ $item->title }}</h2>
								<h1>{{ $item->subtitle }}</h1>
								<p>{{ $item->desc }}</p>
							</div>
						@endforeach
					</div>
				</div>                      
			</div>
		</div>
	</section>
@endif



<section class="home-row-proSearch p-b-60">
    <div class="container">    
        @php
			$categoryListing = allcategories();
			$parentIds = parentCategoryIds();
		@endphp
    	<div class="row">    
        	<div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">
            	<div class="section-content">
                	<div class="proSearchtab">
                    	<button class="tablinks active" onClick="proSearchtabFunc(event, 'Equipment')">Equipment</button>
  						<button class="tablinks" onClick="proSearchtabFunc(event, 'Keywords')">Keywords</button>
                    </div>
                	<div id="Equipment"  class="proSearchtabCont" style="display:block;">
                    	<div class="tabCont tabCol4">
                        	<form method="get" action="{{ route('products') }}">
                        	<div class="proSearchtabFrm">
                            	<div class="proSearchtabFrmCol">
                                	<select class="searchCat" name="category">
										<option value="">All Categories</option>
										@foreach ($categoryListing as $key => $value)
											<option value="{{ $key }}"
												{{ in_array($key, $parentIds) ? 'disabled' : '' }}>
												{{ $value }}
											</option>
										@endforeach
									</select>
                                </div>
                            	<div class="proSearchtabFrmCol">
                                	<select class="searchManufact" name="manufacturer_id" id="manufacturer">
                                        <option value="">All Manufacturers</option> 
										@foreach ($manufacturerListing as $manufactureritem)
											<option value="{{ $manufactureritem->id }}">{{ $manufactureritem->name }}</option> 
										@endforeach
                                    </select>
                                </div>
                            	<div class="proSearchtabFrmCol">
                                	<select class="searchManufact" name="equipment_model_id" id="equipment_model">
                                        <option value="">All Models</option> 
                                    </select>
                                </div>
                            	<div class="proSearchtabFrmCol">
                                	<input type="submit" value="Search" class="submit">
                                </div>
                            </div>
                           </form> 
                        </div>
                    </div>
                    <div id="Keywords"  class="proSearchtabCont">
                    	<div class="tabCont tabCol4">
                        	<form method="get" action="{{ route('products') }}">
                        	<div class="proSearchtabFrm">
								<div class="proSearchtabFrmCol">
                                	<input type="text" class="productsearch" name="name" placeholder="Search Products">
                                </div>
                            	<div class="proSearchtabFrmCol">
                                	<select class="searchCat" name="category">
										<option value="">All Categories</option>
										@foreach ($categoryListing as $key => $value)
											<option value="{{ $key }}"
												{{ in_array($key, $parentIds) ? 'disabled' : '' }}>
												{{ $value }}
											</option>
										@endforeach
									</select>
                                </div>
                            	
                            	<div class="proSearchtabFrmCol">
                                	<input type="submit" value="Search" class="submit">
                                </div>
                            </div>
                           </form> 
                        </div>
                    </div>
                </div>
            </div>                      
       </div>
        
    </div>
</section>


<section class="home-row-three p-b-60">
    <div class="container">    
    
    	<div class="row col-middle-gap">    
        	<div class="col-cmn col-lg-9 col-md-9 col-sm-12 one">
            
                <div class="section-content">
					@if (isset($categoryList))
						<h2>{{ $home->title1 }}</h2>
						<div class="homeSlider2">
							@foreach ($categoryList as $category)
								<div class="homeSlider2Col">
									<div class="homeSlider2Img">
										<a href="{{ route('products') }}?category={{ $category->id }}"><img src="{{ asset('uploads/categoryImage/'.$category->image) }}"></a>
									</div>
									<div class="homeSlider2Cont">
										<a href="#"><p>{{ $category->name }}</p></a>
									</div>
								</div>
							@endforeach
						</div>
					@endif
                    
                    <div class="section-botmImg">
						<img src="{{ asset('uploads/cmsImage/'.$home->banner) }}"></div>
                </div>  
                
            </div>   
        	<div class="col-cmn col-lg-3 col-md-3 col-sm-12 two">            
                <div class="section-img">
                	<!--<img src="image/home-img-1.jpg">-->
                    
                	<div class="curve-container">
                      <div class="content">
                        <h2>{{ $home->section1_title }}</h2>
                        <p>{{ $home->section1_title2 }}</p>
                      </div>
                      <div class="image-curve">
                        <img src="{{ asset('frontendassets/image/curve-img2.png') }}" class="curveImg">
                        <img src="{{ asset('uploads/cmsImage/'.$home->section1_image) }}" class="curveMainImg">
                      </div>
                    </div>

                
                </div>
            </div>
                               
       </div>
        
    </div>
</section>



<section class="home-row-sale p-b-60">
    <div class="container">    
    
    	<div class="row rowOne">    
        	<div class="col-cmn col-lg-9 col-md-9 col-sm-12 one">
            	<div class="section-content">
            		<h2>{{ $home->title2 }}</h2>
                </div>
            </div>   
        	<div class="col-cmn col-lg-3 col-md-3 col-sm-12 two text-right">
            	<div class="section-content">
            		<a href="{{ route('products') }}" class="btn">View All</a>
                </div>
            </div>                     
       </div>
       
       
    	<div class="row rowTwo">    
        	<div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">
                <div class="section-content">
                
                	<div class="saleSlider">

						@foreach ($allEquipments as $equipment)
							
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="{{ route('product_details',$equipment->slug) }}"><img src="{{ asset('uploads/equipmentImage/'.$equipment->thumbnail) }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="{{ route('product_details',$equipment->slug) }}">{{ strlen($equipment->name)>16 ? substr($equipment->name,0,16):$equipment->name }}</a></div>
                                	<div class="productBoxText"><p>{{ $equipment->category->name ?? '-' }}</p></div>
                                	<div class="productBoxPrice">{{ $equipment->currency->sign ?? '' }}{{ new_format_price($equipment->price) }}</div>
                                	<div class="productBoxBtn"><a href="{{ route('product_details',$equipment->slug) }}" class="btn">View Details</a></div>
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




<section class="home-row-saleGolf p-b-98">
    <div class="container">    
    
    	<div class="row">    
        	<div class="col-cmn col-lg-5 col-md-5 col-sm-12 one">
            	<div class="section-content">
            		<h3>{{ $home->section2_title }}</h3>
                    <h2>{{ $home->section2_title2 }}</h2>
                    <p>{{ $home->section2_title3 }}</p>
                </div>
            </div>   
        	<div class="col-cmn col-lg-7 col-md-7 col-sm-12 two">
            	<div class="section-img">
            		<img src="{{ asset('uploads/cmsImage/'.$home->section2_image) }}">
                </div>
            </div>                     
       </div>


    </div>
</section>

@section('script')
	<script>
	let manufacturer = document.querySelector("#manufacturer");
	let equipmentModelSelect = document.querySelector("#equipment_model");

	manufacturer.addEventListener("change",function(e){
		let manufacturerId = e.target.value;
		if(manufacturerId != '')
		{
			fetch("{{ route('frontend.getEquipmentModel') }}", {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				},
				body: JSON.stringify({
					manufacturerId: manufacturerId,         // example data
				})
			})
			.then(response => response.json())
			.then(data => {
				if(data.status==true)
				{
					let result = data.data;
					populateEquipmentModels(result);
					
					// console.log('Success:', data.data);
				}
			})
			.catch(error => {
				console.error('Error:', error);
			});
		}
		else
		{
			equipmentModelSelect.innerHTML = '<option value="">All Models</option>';
		}
	});
	function populateEquipmentModels(data) {
		equipmentModelSelect.innerHTML = '<option value="">All Models</option>';

		for (let id in data) {
			let option = document.createElement("option");
			option.value = id;
			option.textContent = data[id];
			equipmentModelSelect.appendChild(option);
		}
	}
	</script>
@endsection
</x-frontend::layouts.master>

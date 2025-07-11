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
    
    	<div class="row">    
        	<div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">
            	<div class="section-content">
                	<div class="proSearchtab">
                    	<button class="tablinks active" onClick="proSearchtabFunc(event, 'Equipment')">Equipment</button>
  						<button class="tablinks" onClick="proSearchtabFunc(event, 'Keywords')">Keywords</button>
                    </div>
                	<div id="Equipment"  class="proSearchtabCont" style="display:block;">
                    	<div class="tabCont tabCol4">
                        	<form action="">
                        	<div class="proSearchtabFrm">
                            	<div class="proSearchtabFrmCol">
                                	<select class="searchCat">
                                        <option value="">All Categories</option> 
                                        @if (categories())
											@foreach (categories() as $item)
												<option value="{{ $item->id }}">{{ $item->name }}</option> 
											@endforeach
										@endif
                                    </select>
                                </div>
                            	<div class="proSearchtabFrmCol">
                                	<select class="searchManufact">
                                        <option value="">All Manufacturers</option> 
                                        <option value="Manufacturers 1">Manufacturers 1</option> 
                                        <option value="Manufacturers 2">Manufacturers 2</option> 
                                        <option value="Manufacturers 3">Manufacturers 3</option> 
                                    </select>
                                </div>
                            	<div class="proSearchtabFrmCol">
                                	<select class="searchManufact">
                                        <option value="">All Models</option> 
                                        <option value="Models 1">Models 1</option> 
                                        <option value="Models 2">Models 2</option> 
                                        <option value="Models 3">Models 3</option> 
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
                        	<form action="">
                        	<div class="proSearchtabFrm">
                            	<div class="proSearchtabFrmCol">
                                	<select class="searchCat">
                                        <option value="">All Categories</option> 
                                        @if (categories())
											@foreach (categories() as $item)
												<option value="{{ $item->id }}">{{ $item->name }}</option> 
											@endforeach
										@endif
                                    </select>
                                </div>
                            	<div class="proSearchtabFrmCol">
                                	<select class="searchManufact">
                                        <option value="">All Manufacturers</option> 
                                        <option value="Manufacturers 1">Manufacturers 1</option> 
                                        <option value="Manufacturers 2">Manufacturers 2</option> 
                                        <option value="Manufacturers 3">Manufacturers 3</option> 
                                    </select>
                                </div>
                            	<div class="proSearchtabFrmCol">
                                	<select class="searchManufact">
                                        <option value="">All Models</option> 
                                        <option value="Models 1">Models 1</option> 
                                        <option value="Models 2">Models 2</option> 
                                        <option value="Models 3">Models 3</option> 
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
						<h2>New & Used Lawn, Turf, And Golf Course Equipment For Sale</h2>
						<div class="homeSlider2">
							@foreach ($categoryList as $category)
								<div class="homeSlider2Col">
									<div class="homeSlider2Img">
										<a href="#"><img src="{{ asset('uploads/categoryImage/'.$category->image) }}"></a>
									</div>
									<div class="homeSlider2Cont">
										<a href="#"><p>{{ $category->name }}</p></a>
									</div>
								</div>
							@endforeach
						</div>
					@endif
                    
                    <div class="section-botmImg"><img src="{{ asset('frontendassets/image/home-bnr-img.png') }}"></div>
                </div>  
                
            </div>   
        	<div class="col-cmn col-lg-3 col-md-3 col-sm-12 two">            
                <div class="section-img">
                	<!--<img src="image/home-img-1.jpg">-->
                    
                	<div class="curve-container">
                      <div class="content">
                        <h2><span>Sell Golf</span> <br>EQUIPMENT</h2>
                        <p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p>
                      </div>
                      <div class="image-curve">
                        <img src="{{ asset('frontendassets/image/curve-img2.png') }}" class="curveImg">
                        <img src="{{ asset('frontendassets/image/home-golf-img.jpg') }}" class="curveMainImg">
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
            		<h2>Latest Added Listings For Sale</h2>
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
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-1.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur </p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-2.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-3.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-4.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-5.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-6.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-7.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-8.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-1.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-10.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-11.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-12.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>                        
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-5.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-14.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-15.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-16.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div> 
                        
                        
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-8.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-1.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-10.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-11.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-12.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>                        
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-5.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-14.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                    	<div class="saleSliderCol">
                        	<div class="productBox">
                            	<div class="productBoxImg">
                                	<a href="product-details.html"><img src="{{ asset('frontendassets/image/product/product-15.jpg') }}"></a>
                                </div>
                            	<div class="productBoxCont">
                                	<div class="productBoxTitle"><a href="product-details.html">Gravely Axis 200DT</a></div>
                                	<div class="productBoxText"><p>Duis cursus placerat magna, ut posuere ante auctor consectetur</p></div>
                                	<div class="productBoxPrice">$ 19,700</div>
                                	<div class="productBoxBtn"><a href="product-details.html" class="btn">View Details</a></div>
                                </div>
                            </div>
                        </div>
                                           	
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
            		<h3>Sell Golf</h3>
                    <h2>EQUIPMENT</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin interdum venenatis nibh, id pretium diam euismod id.</p>
                </div>
            </div>   
        	<div class="col-cmn col-lg-7 col-md-7 col-sm-12 two">
            	<div class="section-img">
            		<img src="{{ asset('frontendassets/image/home-bnr2.jpg') }}">
                </div>
            </div>                     
       </div>


    </div>
</section>
</x-frontend::layouts.master>

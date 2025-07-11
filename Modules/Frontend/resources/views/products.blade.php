<x-frontend::layouts.master :title="'Products'" :description="'Products'" :keywords="'Products'">
<hr>

<section class="productlist-row-list p-t-60 p-b-60">
    <div class="container">    
    	<div class="row col-middle-gap">    
        	<div class="col-cmn col-lg-4 col-md-4 col-sm-12 one">
            	<div class="section-content">
                <div class="category-sidebar">
                  <h2>Shop By Category</h2>
                  <div class="category-menu">
                    <ul>
                      @if ($allCategory != null)
                          @foreach ($allCategory as $key => $item)
                            <li class="{{ $key==0?'open':'' }}">
                              <a href="#" class="active">{{ $item['name'] }}</a>
                              @if ($item['subcategory'] != null)
                                <ul>
                                  @foreach ($item['subcategory'] as $subitem)
                                      <li><a href="#">{{ $subitem['name'] }}</a></li>
                                  @endforeach
                                </ul>
                              @endif
                            </li>
                          @endforeach
                      @endif
                    </ul>
                  </div>         
                </div>
              </div>
            </div>             
        	<div class="col-cmn col-lg-8 col-md-8 col-sm-12 two">
            	<div class="section-content">
                    <div class="productlist-filter">
                          <div class="proListFilter-toggle-container">
                            <label for="closestToggle">Show Closest First</label>
                            <label class="proListFilter-switch">
                              <input type="checkbox" id="closestToggle">
                              <span class="proListFilter-slider"></span>
                            </label>
                          </div>
                          <div class="proListFilter-sort-button">
                            <span class="proListFilter-sort-icon"></span>
                            Sort
                          </div>
                    </div>
                    
                    <div class="productlistShop">
                    	<div class="productlistShopCol">
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
                    	<div class="productlistShopCol">
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
                    	<div class="productlistShopCol">
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
                    	<div class="productlistShopCol">
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
                    	<div class="productlistShopCol">
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
                    	<div class="productlistShopCol">
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
                    	<div class="productlistShopCol">
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
                    	<div class="productlistShopCol">
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
                    	<div class="productlistShopCol">
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
                    
                    
                    </div>
                    
                    
                    
                    <div class="pagination">
                      <a href="#" title="Previous Page">&laquo;</a>
                      <a href="#">1</a>
                      <a href="#" class="active">2</a>
                      <a href="#">3</a>
                      <a href="#">4</a>
                      <a href="#" title="Next Page">&raquo;</a>
                    </div>
                    
                    
                
                </div>
            </div>                     
       </div>
        
    </div>
</section>
</x-frontend::layouts.master>
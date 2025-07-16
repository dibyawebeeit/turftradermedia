<x-frontend::layouts.master :title="'Products'" :description="'Products'" :keywords="'Products'">
<hr>

<section class="productlist-row-list p-t-60 p-b-60">
    <div class="container">    
      @if (isset($search_keyword))
          <p>Search Keyword : {{ $search_keyword }}</p>
      @endif
    	<div class="row col-middle-gap">    
        	<div class="col-cmn col-lg-4 col-md-4 col-sm-12 one">
            	<div class="section-content">
                <div class="category-sidebar">
                  <h2>Shop By Category</h2>
                  <div class="category-menu">
                    <ul>
                        @if ($allCategory != null)
                            @foreach ($allCategory as $key => $item)
                                @php
                                    // Check if this parent or any of its subcategories is active
                                    $isOpen = request('category') == $item['id'] ||
                                              (isset($item['subcategory']) && collect($item['subcategory'])->pluck('id')->contains(request('category')));
                                @endphp

                                <li class="{{ $isOpen ? 'open' : '' }}">
                                    <a href="{{ route('products', ['category' => $item['id']]) }}" 
                                      class="{{ request('category') == $item['id'] ? 'active' : '' }}">
                                        {{ $item['name'] }}
                                    </a>

                                    @if (!empty($item['subcategory']))
                                        <ul>
                                            @foreach ($item['subcategory'] as $subitem)
                                                <li>
                                                    <a href="{{ route('products', ['category' => $subitem['id']]) }}" 
                                                      class="{{ request('category') == $subitem['id'] ? 'active' : '' }}">
                                                        {{ $subitem['name'] }}
                                                    </a>
                                                </li>
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
                      @if (count($allEquipments)>0)
                        @foreach ($allEquipments as $equipment)
                          <div class="productlistShopCol">
                              <div class="productBox">
                                  <div class="productBoxImg">
                                      <a href="{{ route('product_details',$equipment->slug) }}"><img src="{{ asset('uploads/equipmentImage/'.$equipment->thumbnail) }}"></a>
                                    </div>
                                  <div class="productBoxCont">
                                      <div class="productBoxTitle"><a href="{{ route('product_details',$equipment->slug) }}">{{ strlen($equipment->name)>20 ? substr($equipment->name,0,20):$equipment->name }}</a></div>
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
</x-frontend::layouts.master>
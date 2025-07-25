<header class="header"> 
<div class="header-topbar">
    <div class="container">
      <div class="row">
      
        <div class="col-cmn col-lg-4 col-md-4 col-sm-4 one">
            <div class="header-top-left">
              @if (Auth::guard('customer')->check())
                  <a href="{{ route('customer.dashboard') }}">Dashboard</a>
                  <a href="{{ route('frontend.watchlist') }}">
                      <i class="far fa-heart"></i> Watchlist
                  </a>
              @else
                  <a href="{{ route('signin') }}">Sign-In</a>
            	    <a href="{{ route('register') }}">Register</a>
              @endif
            	
            </div>        
        </div>
        
        <div class="col-cmn col-lg-8 col-md-8 col-sm-8 two text-right"> 
        		<div class="header-top-right">  
                
                
                    <ul class="headerRightLink">
                        <li><a href="{{ route('advertising') }}">Advertising</a></li>
                        <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                    </ul>      	
                    {{-- <div class="languageDropdown">
                        <div class="custom-select-wrapper">
                          <div class="custom-select">
                            <div class="selected-option" id="selected-option">
                              <img src="{{ asset('frontendassets/image/en.jpg') }}" alt="EN"> English
                            </div>
                            <div class="options" id="options-list">
                              <div class="option" data-value="en|en">
                                <img src="{{ asset('frontendassets/image/en.jpg') }}" alt="EN"> English
                              </div>
                              <div class="option" data-value="en|fr">
                                <img src="{{ asset('frontendassets/image/fr.jpg') }}" alt="FR"> French
                              </div>
                            </div>
                          </div>
                          <input type="hidden" id="language-select" name="language">
                        </div>
                    </div> --}}

                    <!-- add this to your header -->
                   <div class="languageDropdown">
                        <div class="custom-select-wrapper"> <div id="google_translate_element"></div> </div></div>

                    <!-- to your js part -->
                    <script type="text/javascript">
                      function googleTranslateElementInit() {
                          new google.translate.TranslateElement(
                              {pageLanguage: 'en'},
                              'google_translate_element'
                          );
                      } 
                    </script>
                    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

                    
                <div class="mobile_nav">
                    <ul>
                        <li><a href="{{ route('advertising') }}">Advertising</a></li>
                        <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                        <li>
                          @if (Auth::guard('customer')->check())
                              @if (Auth::guard('customer')->user()->role =='seller')
                                  <a href="{{ route('customer.equipment.create') }}">Sell Your Equipment</a>
                              @else
                                  <a href="javascript:void(0);" onclick="alert('Please login as a seller!')">Sell Your Equipment</a>
                              @endif
                          @else
                              <a href="{{ route('signin') }}">Sell Your Equipment</a>
                          @endif

                          
                        </li>
                    </ul>
                </div>
                
					<div class="burger">
			            <div class="strip burger-strip">
			                <div></div>
			                <div></div>
			                <div></div>
			            </div>
			        </div>
                    
                    
                </div>                
        </div>
                
      </div>
    </div>
  </div>
    
  <div class="topbar-menu">
    <div class="container">
    
      <div class="row middle-content-row">
      
        <div class="col-cmn col-lg-3 col-md-3 col-sm-3 one">
            <div class="sitelogo"><a href="{{ route('home') }}"><img src="{{ asset('frontendassets/image/logo.png') }}"></a></div>        
        </div>
        <div class="col-cmn col-lg-9 col-md-9 col-sm-9 two text-right">
            <div class="header-searchMain">
            	<div class="header-search">
                	<form method="get" action="{{ route('products') }}">
                	<div class="header-searchTbl">
                    	<div class="header-searchTblTr">
                            <div class="header-searchTblTd">
                            	<div class="header-searchTblTdMain">
                            	<input type="text" class="productsearch" name="name" placeholder="Search Products">
                                @php
                                    $categoryListing = allcategories();
                                    $parentIds = parentCategoryIds();
                                @endphp

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
                            </div>
                            <div class="header-searchTblTd"><input type="submit" value="Search" class="submit"></div>
                        </div>
                    </div>
                    </form>
                </div>
            	<div class="header-searchLink">
                  @if (Auth::guard('customer')->check())
                      @if (Auth::guard('customer')->user()->role =='seller')
                          <a href="{{ route('customer.equipment.create') }}" class="btn">Sell Your Equipment</a>
                      @else
                          <a class="btn" href="javascript:void(0);" onclick="alert('Please login as a seller!')">Sell Your Equipment</a>
                      @endif
                  @else
                      <a class="btn" href="{{ route('signin') }}">Sell Your Equipment</a>
                  @endif

             
                </div>
            </div>        
        </div>
                
      </div>
    </div>
  </div>
  
</header>
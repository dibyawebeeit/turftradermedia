<x-frontend::layouts.master :title="$aboutus->meta_title" :description="$aboutus->meta_keyword" :keywords="$aboutus->meta_desc">
    
<section class="innr-row-bnr p-b-60">
    <div class="container">    
    
    	<div class="row">    
        	<div class="col-cmn col-lg-12 col-md-12 col-sm-12 one text-center">
            	<div class="section-content">
                    <div class="content">
                        <h2>{{ $aboutus->title }}</h2>
                        <h1>{{ $aboutus->subtitle }}</h1>
                    </div>
                </div>
            </div>                      
       </div>
        
    </div>
</section>


<section class="about-row-one p-b-60">
    <div class="container">    
    
    	<div class="row">    
        	<div class="col-cmn col-lg-9 col-md-9 col-sm-12 one">
            	<div class="section-content">
                	{!! $aboutus->desc !!}
                </div>
            </div> 
               
        	<div class="col-cmn col-lg-3 col-md-3 col-sm-12 two">
            	<div class="section-content">
                
                @if (count($smallAds)>0)
                    <div class="section-img section-img1">
                        @foreach ($smallAds as $item)
                            <div>
                                <a target="_blank" href="{{ $item->external_link }}"><img src="{{ asset('uploads/adsImage/'.$item->image) }}"></a>
                            </div> 
                        @endforeach
                    </div>
				@endif   
                  
                  
                  
                </div>
            </div>                  
       </div>
    </div>
</section>

 
 



@if (count($largeAds)>0)

<section class="home-row-saleGolf p-b-98">
   <div class="container">
      <div class="row">
         <div class="col-cmn col-lg-12">
            <div class="foot-banr1">
				@foreach ($largeAds as $item)
					<div>
						<a target="_blank" href="{{ $item->external_link }}"><img src="{{ asset('uploads/adsImage/'.$item->image) }}">
						</a>
					</div>
				@endforeach
                
				{{-- <div><a target="_blank" href="#"><img src="https://turftradermedia.viewourprojects.com/uploads/adsImage/ad_ZSslV3wwnW1756382120.jpg"></a></div> --}}
            </div>
         </div>
      </div>
   </div>
</section>
@endif


</x-frontend::layouts.master>
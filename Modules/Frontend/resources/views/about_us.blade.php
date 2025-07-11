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
                
                	<div class="curve-container">
                      <div class="content">
                        <h2>{{ $aboutus->section1_title }}</h2>
                        <p>{{ $aboutus->section1_title2 }}</p>
                        <p><a href="{{ url($aboutus->section1_button_url) }}" class="btn2">{{ $aboutus->section1_button_text }}</a></p>
                      </div>
                      <div class="image-curve">
                        <img src="{{ asset('frontendassets/image/curve-img2.png') }}" class="curveImg">
                        <img src="{{ asset('uploads/cmsImage/'.$aboutus->section1_image) }}" class="curveMainImg">
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
            		<h3>{{ $aboutus->section2_title }}</h3>
                    <h2>{{ $aboutus->section2_title2 }}</h2>
                    <p>{{ $aboutus->section2_title3 }}</p>
                </div>
            </div>   
        	<div class="col-cmn col-lg-7 col-md-7 col-sm-12 two">
            	<div class="section-img">
            		<img src="{{ asset('uploads/cmsImage/'.$aboutus->section2_image) }}">
                </div>
            </div>                     
       </div>
    </div>
</section>
</x-frontend::layouts.master>
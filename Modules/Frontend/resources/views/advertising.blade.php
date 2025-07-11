<x-frontend::layouts.master :title="$advertising->meta_title" :description="$advertising->meta_keyword" :keywords="$advertising->meta_desc">
<hr>
<section class="default-content-row p-t-60 p-b-60">
    <div class="container">    
    	<div class="row">    
        	<div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">
            	<div class="section-content">
                	{!! $advertising->desc !!}
                </div>
            </div>                      
       </div>
    </div>
</section>

<section class="advertising-row-bottom p-b-30">
    <div class="container">    
    
    	<div class="row">    
        	<div class="col-cmn col-lg-12 col-md-12 col-sm-12 advertisingBg text-center">
            	<div class="section-content">
                    <p>{{ $advertising->title }} </p>            		
                    <h2>{{ $advertising->title2 }}</h2>
                    <p><a href="{{ url($advertising->button_url) }}" class="btn">{{ $advertising->button_text }}</a></p>
                </div>
            </div>                   
       </div>
    </div>
</section>
</x-frontend::layouts.master>
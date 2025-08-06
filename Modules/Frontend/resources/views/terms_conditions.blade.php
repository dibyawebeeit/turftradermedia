<x-frontend::layouts.master :title="$termsconditions->meta_title" :description="$termsconditions->meta_keyword" :keywords="$termsconditions->meta_desc">
<hr>
<section class="default-content-row p-t-60 p-b-60">
    <div class="container">    
    	<div class="row">    
        	<div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">
            	<div class="section-content">
                	{!! $termsconditions->desc !!}
                </div>
            </div>                      
       </div>
    </div>
</section>


</x-frontend::layouts.master>
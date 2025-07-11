<x-frontend::layouts.master :title="$contactus->meta_title" :description="$contactus->meta_keyword" :keywords="$contactus->meta_desc">
    <hr>


<section class="contact-row p-t-60 p-b-60">
    <div class="container">    
    
    	<div class="row">    
        	<div class="col-cmn col-lg-5 col-md-5 col-sm-12 one">
            	<div class="section-content">
                
                	{!! $contactus->desc !!}
                    <table width="100%" border="0" class="contactTable">
                      <tr>
                        <td align="left" valign="top"><i class="fas fa-envelope"></i></td>
                        <td>
                        	<h6>Email</h6>
                            <p><a href="mailto:{{ sitesetting()->contact_email }}">{{ sitesetting()->contact_email }}</a></p>
                        </td>
                      </tr>
                    </table>


                </div>
            </div>  
        	<div class="col-cmn col-lg-7 col-md-7 col-sm-12 two">
            	<div class="section-content">
                
                <div class="contactUsBg">
                    <div class="contactUsBg-content">      		
                        <h2>{{ $contactus->title }}</h2>
                        <p>{{ $contactus->title2 }}</p>      
                        <p><a href="{{ url($contactus->button_url) }}" class="btn">{{ $contactus->button_text }}</a></p>
                    </div>
                </div>
                 
                </div>
            </div>  
            
            
                                
       </div>
        
    </div>
</section>
</x-frontend::layouts.master>
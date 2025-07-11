<x-frontend::layouts.master>
<hr>


<section class="register-row p-t-60 p-b-60">
    <div class="container">   
     
    	<div class="row row-col-center headingRow">    
        	<div class="col-cmn col-lg-8 col-md-8 col-sm-12 one text-center">
            	<div class="section-content">
                	<h2>Register Account</h2>
                </div>
             </div>
        </div>
    
    	<div class="row row-col-center">    
        	<div class="col-cmn col-lg-8 col-md-8 col-sm-12 one">
            	<div class="section-content">
                	
                    <div class="register-block">
                        <h3>New Customer Application Form</h3>
                        <p>Required Documents:</p>
                        <ol>
                        <li>Company registration Certificate (Company House registration letter, UTR letter from HMRC or VAT registration certificate)</li>
                        <li>Proof of your business address (lease agreement, bank statement, utility bill)</li>
                        <li>Copy of owner's ID (passport or driver's license)</li>
                        <li>Copy of representative's ID</li>
                        </ol>
                        <form action="" method="post" enctype="multipart/form-data">
                        
                          <div class="form-group form-groupFile">
                            <label class="control-label">Upload Documents*</label>
                            <input type="file" required="" name="upload_documents" size="30" multiple="">
                          </div>
                          
                          <div class="form-heading">
                          	<h3>Your Details</h3>
                          </div>
                          
                          <div class="frm-col2">
                              <div class="form-group">
                                <label class="control-label">First Name</label>
                                <input type="text" name="fname" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <input type="text" name="lname" value="" class="form-control">
                              </div>
                          </div>
                          <div class="frm-col2">
                              <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="email" name="eamil" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="control-label">Phone</label>
                                <input type="tel" name="phone" value="" class="form-control">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Address</label>
                            <input type="text" name="address" value="" class="form-control">
                          </div>                          
                          <div class="frm-col2">
                              <div class="form-group">
                                <label class="control-label">City</label>
                                <input type="text" name="city" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="control-label">State/Region</label>
                                <input type="text" name="state" value="" class="form-control">
                              </div>
                          </div>                        
                          <div class="frm-col2">
                              <div class="form-group">
                                <label class="control-label">Country/Region</label>
                                <input type="text" name="country" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="control-label">Postal code</label>
                                <input type="text" name="post" value="" class="form-control">
                              </div>
                          </div>                      
                          <div class="frm-col2">
                              <div class="form-group">
                                <label class="control-label">Password</label>
                                <input type="password" name="password" value="" class="form-control">
                              </div>
                              <div class="form-group">
                                <label class="control-label">Re-Password</label>
                                <input type="password" name="repassword" value="" class="form-control">
                              </div>
                          </div>
                        
                          <div class="form-group">
                          <input type="submit" value="Submit" class="">
                          </div>
                         </form>
                        <span class="block-sep"></span>
                     </div>
                
                </div>
            </div>  
                        
       </div>
        
    </div>
</section>
</x-frontend::layouts.master>
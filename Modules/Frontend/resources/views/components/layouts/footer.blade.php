<footer>

<div class="footer-top">
    <div class="container">
		<div class="row">
        
        <div class="col-cmn col-lg-3 col-md-6 col-sm-12 one">                
                
            <div class="cipi">
                <div class="footer-logo"><img src="{{ asset('frontendassets/image/footer-logo.png') }}" class="autosize"></div>
                <p>Bringing together buyers and sellers of turf equipment.</p>                
            </div>
                    
          </div>
        
        <div class="col-cmn col-lg-3 col-md-6 col-sm-12 two">                
                
            <div class="cipi">
            	<h2>Quick <span>Links</span></h2>
                <ul id="menu-footer-menu" class="listo">
                <li><a href="{{ route('signin') }}">Sign-In</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                <li><a href="{{ route('advertising') }}">Advertising</a></li>
                <li><a href="{{ route('about_us') }}">About Us</a></li>
                <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                </ul>                    
            </div>
                    
          </div>
       

        <div class="col-cmn col-lg-3 col-md-6 col-sm-12 three">                
                
            <div class="cipi">
            	<h2>Get <span>In Touch</span></h2>
                <ul>
                    <li><span><i class="fas fa-envelope"></i></span><span>Email: <a href="mailto:{{ sitesetting()->contact_email }}">{{ sitesetting()->contact_email }}</a></span></li>
                 </ul>                   
            </div>
                    
          </div>
          
        <div class="col-cmn col-lg-3 col-md-6 col-sm-12 four">                
                
            <div class="cipi">
            	<h2>Follow <span>Us On</span></h2>
                
                <div class="social-link">
                    <ul>
                        <li><a href="{{sitesetting()->facebook_link==''?'#':sitesetting()->facebook_link}}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="{{sitesetting()->instagram_link==''?'#':sitesetting()->instagram_link}}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="{{sitesetting()->twitter_link==''?'#':sitesetting()->twitter_link}}" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                    </ul>
                </div>
                                   
            </div>
                    
          </div>
                
                        
        </div>
     </div>
</div>

<div class="footer-bottom">
    <div class="container">
		<div class="row">
        
        <div class="col-cmn col-lg-12 col-md-12 col-sm-12 one">                
                
            <div class="copyright">                    
                <div class="footer-copyright">
                	<p>Copyright © 2025 Turf Trader Media. All rights reserved.</p>
                </div>           
            </div>
                    
          </div>
                
                        
        </div>
     </div>
</div>
</footer>
@if (session()->has('success'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
    });
    Toast.fire({
    icon: "success",
    text: "{{ session('success') }}"
    });
</script>
@endif
@if (session()->has('error'))
<script>
    const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
    });
    Toast.fire({
    icon: "error",
    text: "{{ session('error') }}"
    });
</script>
@endif
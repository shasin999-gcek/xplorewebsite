<footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
              <img src="assets/img/Xplore.svg" class="img-fluid img-responsive" width="200" height="200">
              <img src="assets/img/logo.svg" class="img-fluid img-responsive" width="200" height="100">
          </div>
          <div class="col-md-3">
            <ul class="nav">
              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  Home
                </a>
              </li>
              <li class="nav-item">
                <a href="./examples/landing-page.html" class="nav-link">
                  Technical
                </a>
              </li>
              <li class="nav-item">
                <a href="./examples/register-page.html" class="nav-link">
                  Management
                </a>
              </li>
              <li class="nav-item">
                <a href="./examples/profile-page.html" class="nav-link">
                  Cultural
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <ul class="nav">
              <li class="nav-item">
                <a href="https://creative-tim.com/contact-us" class="nav-link">
                  Contact Us
                </a>
              </li>
              <li class="nav-item">
                <a href="https://creative-tim.com/about-us" class="nav-link">
                  About Us
                </a>
              </li>
              <li class="nav-item">
                <a href="https://creative-tim.com/blog" class="nav-link">
                  Sponsors
                </a>
              </li>
              <li class="nav-item">
                <a href="https://opensource.org/licenses/MIT" class="nav-link">
                  Register/Login
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3 class="title">Follow us:</h3>
            <div class="btn-wrapper profile">
              <a target="_blank" href="https://twitter.com/creativetim" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                <i class="fab fa-twitter"></i>
              </a>
              <a target="_blank" href="https://www.facebook.com/creativetim" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Like us">
                <i class="fab fa-facebook-square"></i>
              </a>
              <a target="_blank" href="https://dribbble.com/creativetim" class="btn btn-icon btn-neutral  btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                <i class="fab fa-dribbble"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ URL::asset('js/core/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{ URL::asset('js/core/popper.min.js')}}" type="text/javascript"></script>
  <script src="{{ URL::asset('js/core/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{ URL::asset('js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="{{ URL::asset('js/plugins/bootstrap-switch.js')}}"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ URL::asset('js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
  <!-- Chart JS -->
  <script src="{{ URL::asset('js/plugins/chartjs.min.js')}}"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="{{ URL::asset('js/plugins/moment.min.js')}}"></script>
  <script src="{{ URL::asset('js/plugins/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
  <!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <!-- Control Center for Black UI Kit: parallax effects, scripts for the example pages etc -->
  <script src="{{ URL::asset('js/main.min.js?v=1.0.0')}}" type="text/javascript"></script>
  <script src="{{ URL::asset('js/plugins/rellax.min.js')}}" type="text/javascript"></script>
  <script src="{{ URL::asset('js/cursor.js')}}" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  
  <script>
    $(document).ready(function() {
      blackKit.initDatePicker();
      blackKit.initSliders();
    });

    
  </script>
  <script>
        var rellax = new Rellax('.rellax', {
    center: true
  }); 
  </script>
  <script>
    $(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    loop:true,
    margin:20,
    autoplay:true,
    slideTransition: 'linear',
    autoplayTimeout:3000,
    autoplaySpeed: 3000,
    autoplayHoverPause:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:3,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:4,
            nav:true,
            loop:true
        }
    }
  });
  });
  </script>
  
</body>

</html>
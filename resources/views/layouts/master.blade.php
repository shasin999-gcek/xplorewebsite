<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">

  <meta name="robots" content="index,archive,follow">

  <title>
    Xplore'19
  </title>

  @yield('metatags')

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="{{ URL::asset('css/nucleo-icons.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{ URL::asset('css/main.css?v=1.0.0') }}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
</head>

<body class="{{ $bodyclass }}">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg {{ $navbar }}  bg-default" color-on-scroll="600">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="{{ url('/') }}"  target="_blank">
          <span>Xplore'19</span> 
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="{{ URL::to('/') }}">
                Xplore'19
              </a>
            </div>
            <div class="col-6 collapse-close text-right">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>

        <ul class="navbar-nav">
          <li class="nav-item @if($active_menu == 'technical') active @endif">
              <a class="nav-link" href="{{URL::to('/technical')}}">
                <p>Technical</p>
              </a>
          </li>
          
          <li class="nav-item @if($active_menu == 'cultural') active @endif">
            <a class="nav-link" href="{{URL::to('/cultural')}}">
              <p>Cultural</p>
            </a>
          </li>
          <li class="nav-item @if($active_menu == 'management') active @endif">
            <a class="nav-link" href="{{URL::to('/management')}}">
              <p>Management</p>
            </a>
          </li>
          <li class="nav-item @if($active_menu == 'about') active @endif">
              <a class="nav-link" href="{{URL::to('/about')}}">
                <p>About</p>
              </a>
          </li>
          <li class="nav-item @if($active_menu == 'contact') active @endif">
              <a class="nav-link" href="{{URL::to('/contact')}}">
                <p>Contact</p>
              </a>
          </li>  
          <li class="nav-item">
            @if (Route::has('login'))
                @auth
                
                    <div class="dropdown">
                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Hello {{ Auth::user()->name }}
                        </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ url('/home') }}">View Profile</a>
                        <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        
                      </div>
                    </div>
                   
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                @else
                      
                <a href="{{ route('login') }}" class=" btn btn-sm btn-warning"  >
                <i class="tim-icons icon-cloud-download-93"></i> Register/Login </a>
                @endauth  
            @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <footer class="footer {{$bodyclass}} @isset($nofooter) {{ $nofooter }} @endisset">

      <div class="container">
        <div class="row">
          <div class="col-md-3">
              <img src="{{ asset('img/Xplore.svg') }}" class="img-fluid img-responsive" width="200" height="200">
              <img src="{{ asset('img/logo.svg') }}" class="img-fluid img-responsive" width="200" height="100">
          </div>
          <div class="col-md-3">
            <ul class="nav">
              <li class="nav-item">
                <a href="{{URL::to('/')}}" class="nav-link">
                  Home
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/technical')}}" class="nav-link">
                  Technical
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/management')}}" class="nav-link">
                  Management
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/cultural')}}" class="nav-link">
                  Cultural
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <ul class="nav">
              <li class="nav-item">
                <a href="{{URL::to('/contact')}}" class="nav-link">
                  Contact Us
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/about')}}" class="nav-link">
                  About Us
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/sponsors')}}" class="nav-link">
                  Sponsors
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/register')}}" class="nav-link">
                  Register/Login
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-3">
            <h3 class="title">Follow us:</h3>
            <div class="btn-wrapper profile">
              <a target="_blank" href="" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                <i class="fab fa-twitter"></i>
              </a>
              <a target="_blank" href="" class="btn btn-icon btn-neutral btn-round btn-simple" data-toggle="tooltip" data-original-title="Like us">
                <i class="fab fa-facebook-square"></i>
              </a>
              <a target="_blank" href="" class="btn btn-icon btn-neutral  btn-round btn-simple" data-toggle="tooltip" data-original-title="Follow us">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>
        
      </div>
    </footer>
    <div class="container @isset($nofooter) {{ $nofooter }} @endisset">
          <h5 class="text-center">Designed and Developed with <i class="tim-icons icon-heart-2"></i> By Mohammed Shazin</h5>
    </div>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script type="text/javascript">if(typeof wabtn4fg==="undefined"){wabtn4fg=1;h=document.head||document.getElementsByTagName("head")[0],s=document.createElement("script");s.type="text/javascript";s.src="{{ asset('js/whatsapp-button.js') }}";h.appendChild(s);}</script>

  
  <script>
    $(document).ready(function() {
      blackKit.initDatePicker();
      blackKit.initSliders();
    });

    
  </script>
  
  @if($active_menu == 'dashboard')
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
  @endif
  @if($active_menu == 'management')
  <script>
    $(document).ready(function(){
       
$(".owl-carousel").on("initialized.owl.carousel", function () {
  setTimeout(function () {
    $(".owl-item.active .owl-slide-animated").addClass("is-transitioned");
    $("section").show();
  }, 200);
});

var $owlCarousel = $(".owl-carousel").owlCarousel({
  items: 1,
  loop: true,
  autoplay:true,
  autoplaySpeed: 3000,
  nav: true,
  navText: [
  '<svg width="50" height="50" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>',
  '<svg width="50" height="50" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg>' /* icons from https://iconmonstr.com */] });



$owlCarousel.on("changed.owl.carousel", function (e) {
  $(".owl-slide-animated").removeClass("is-transitioned");

  var $currentOwlItem = $(".owl-item").eq(e.item.index);
  $currentOwlItem.find(".owl-slide-animated").addClass("is-transitioned");

  var $target = $currentOwlItem.find(".owl-slide-text");
  doDotsCalculations($target);
});

$owlCarousel.on("resize.owl.carousel", function () {
  setTimeout(function () {
    setOwlDotsPosition();
  }, 50);
});

/*if there isn't content underneath the carousel*/
//$owlCarousel.trigger("refresh.owl.carousel");

setOwlDotsPosition();

function setOwlDotsPosition() {
  var $target = $(".owl-item.active .owl-slide-text");
  doDotsCalculations($target);
}

function doDotsCalculations(el) {
  var height = el.height();var _el$position =
  el.position(),top = _el$position.top,left = _el$position.left;
  var res = height + top + 20;

  $(".owl-carousel .owl-dots").css({
    top: res + "px",
    left: left + "px" });

}

  });

 
  </script>
  @endif
  <script>

        function copyRefToClipboard(url) {
            if('clipboard' in navigator) {
                navigator.clipboard.writeText(url)
                    .then(() => {
                        var copyIcon = document.getElementById('refid');
                        $('#refid').tooltip('hide');
                        copyIcon.setAttribute('data-original-title', 'Copied')
                        $('#refid').tooltip('show');
                    });
            }
        }
      
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            
        });
    </script>
</body>

</html>
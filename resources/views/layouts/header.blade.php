<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Xplore'19
  </title>
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

<body class="index-page">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent fixed-top bg-default" color-on-scroll="600">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="#" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
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
              <a>
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
                <a class="nav-link" href="">
                  <p>Technical</p>
                </a>
          </li>
          
            <li class="nav-item @if($active_menu == 'cultural') active @endif">
                <a class="nav-link" href="">
                  <p>Cultural</p>
                </a>
          </li>
          <li class="nav-item @if($active_menu == 'management') active @endif">
              <a class="nav-link" href="">
                <p>Management</p>
              </a>
        </li>
          <li class="nav-item @if($active_menu == 'about') active @endif">
                <a class="nav-link" href="">
                  <p>About</p>
                </a>
          </li>
          <li class="nav-item @if($active_menu == 'contact') active @endif">
              <a class="nav-link" href="">
                <p>Contact</p>
              </a>
        </li>  
          <li class="nav-item">
          @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/login') }}" class="nav-link btn btn-default d-none d-lg-block" href="javascript:void(0)" >
              <i class="tim-icons icon-cloud-download-93"></i> Register/Login
                    @else
                    <a href="{{ url('/logout') }}" class="nav-link btn btn-default d-none d-lg-block" href="javascript:void(0)" >
              <i class="tim-icons icon-cloud-download-93"></i> Logout
                    @endauth
                </div>
            @endif
            
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
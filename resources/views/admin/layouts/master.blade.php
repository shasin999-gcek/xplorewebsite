
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Admin panel for Xplore 19">
    <meta name="author" content="Muhammed Shasin P">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Xplore 19 Administration</title>

    <!--  Core CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <! --Admin css -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    <!-- select2 stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    

</head>

<body>

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>


<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Xplore19 Admin</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>

        </ul>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="@if($active_menu == 'dashboard') active @endif">
                    <a href="{{ route('admin.dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                @if(Auth::user()->email != 'moderator@xplore19.in')
                    <li class="@if($active_menu == 'events') active @endif">
                        <a href="{{ route('admin.events.index') }}"><i class="fa fa-fw fa-calendar"></i> Events</a>
                    </li>
                    <li class="@if($active_menu == 'workshops') active @endif">
                        <a href="{{ route('admin.workshops.index') }}"><i class="fa fa-fw fa-cogs"></i> Workshops</a>
                    </li>
                    <li class="@if($active_menu == 'event_regs') active @endif">
                        <a href="{{ route('admin.event_regs.index') }}"><i class="fa fa-fw fa-list"></i> Event Registrations</a>
                    </li>
                    <li class="@if($active_menu == 'workshop_regs') active @endif">
                        <a href="{{ route('admin.workshop_regs.index') }}"><i class="fa fa-fw fa-list"></i> Workshop Registrations</a>
                    </li>
                @endif    
                <li class="@if($active_menu == 'offline-regs') active @endif">
                    <a href="{{ route('admin.offline-regs.index') }}"><i class="fa fa-fw fa-user-plus"></i> Offline Registrations</a>
                </li>

                @if(Auth::user()->email != 'moderator@xplore19.in')
                    <li class="@if($active_menu == 'payments-paytm') active @endif">
                        <a href="{{ route('admin.payments.paytm') }}"><i class="fa fa-fw fa-credit-card-alt" aria-hidden="true"></i> Paytm Payments</a>
                    </li>
                    <li class="@if($active_menu == 'payments-instamojo') active @endif">
                        <a href="{{ route('admin.payments.instamojo') }}"><i class="fa fa-fw fa-credit-card-alt" aria-hidden="true"></i> Instamojo Payments</a>
                    </li>
                    <li class="@if($active_menu == 'banners') active @endif">
                        <a href="{{ route('admin.banners.index') }}"><i class="fa fa-fw fa-android" aria-hidden="true"></i>App Banners</a>
                    </li>
                    <li class="@if($active_menu == 'report') active @endif">
                        <a href="{{ route('admin.report.show') }}"><i class="fa fa-fw fa-file-archive-o" aria-hidden="true"></i>Reports</a>
                    </li>
                    <li class="@if($active_menu == 'logs') active @endif">
                        <a href="{{ route('admin.logs') }}"><i class="fa fa-fw fa-bug" aria-hidden="true"></i>Server Logs</a>
                    </li>
                @endif    
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            @yield('content')

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@yield('scripts')

</body>

</html>



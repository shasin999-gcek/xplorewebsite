<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Xplore'19</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
    @media screen and (max-width: 768px) {
    .page-header .content-center.brand {
      width: 90%;
    }
  }
    </style>
</head>
<body class="profile-page">
    <div class="wrapper">
        <div class="page-header">
        <div class="container ">
            <div class="content-center brand">
            <div class="card card-coin card-plain">
              <div class="card-header">
                <img src="{{ asset('img/fail.png') }}" class="img-center img-fluid rounded-circle">
                <h2>Transaction Failed</h2>
              </div>
              <div class="card-body">
                <h5>Transaction Id: {{ $transId }}</h5>
                <h5>Order Id: {{ $orderId }}</h5>
                <p>
                {{ $respMsg }}
                </p>
                <h4 class="text-danger">For further assisstance contact: 9645100464</h4>
              </div>
              <div class="card-footer">
                  <a href="/" class="btn btn-danger">Cancel</a>
                  <a href="/" class="btn btn-success">Try Again</a>
              </div>
            </div>
            </div>
        </div>
        </div>
        
    </div>

</body>
</html>
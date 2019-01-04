<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    div.center {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 500px;
    }
  </style>
</head>
<body>
  <div class="center">
    <i class="fa fa-spinner fa-pulse fa-5x fa-fw text-primary"></i>
    <span class="sr-only">Loading...</span> 
    <h3>Redirecting to PayTm</h3> 
    <h4>Please dont refresh or close the page</h4>
  </div>
</body>
</html>
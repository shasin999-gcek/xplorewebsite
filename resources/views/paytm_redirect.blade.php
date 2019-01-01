<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Redirecting to Pay Tm....</title>
</head>
<body>
    <h1 style="text-align: center;">Please do not refresh this page...</h1>
    <form id="paytm_post" method="post" action="{{ $PAYTM_TXN_URL }}" style="display: none;">
        @foreach($PAYTM_POST_PARAMS as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
        @endforeach
    </form>
    <script>
        document.getElementById('paytm_post').submit();
    </script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Xplore'19</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        html,
body {
  background-color: #eaeaea;
}

.transition {
  transition: .3s cubic-bezier(.3, 0, 0, 1.3)
}

.card {
  background-color: #fff;
  height: 400px;
  width: 300px;
  position: absolute;
  margin: auto;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
  overflow: hidden;
}

.card:hover {
  box-shadow: 0px 30px 30px rgba(0,0,0,0.2);
  height: 430px;
  width: 330px;
}

.card_circle {
  height: 400px;
  width: 450px;
  background: url("{{ asset('img/fail.png') }}") no-repeat;
  background-size: cover;
  position: absolute;
  border-radius: 50%;
  margin-left: -75px;
  margin-top: -270px;
}

.card:hover .card_circle {
  border-radius: 0;
  margin-top: -130px;
}

h2 {
  text-align: center;
  margin-top: 190px;
  position: absolute;
  z-index: 9999;
  font-size: 26px;
  color: #F32137;
  width: 100%;
  font-family: 'Noto Sans', serif;
}

h2 small {
  font-weight: normal;
  font-size: 65%;
  color: rgba(0,0,0,0.5);
}



.cta-container {
  text-align: center;
  margin-top: 290px;
  position: absolute;
  z-index: 9999;
  width: 100%;
  font-family: 'Noto Sans', serif;
}

.cta {
  color: #fff;
  border: 2px solid #F32137;
  background-color: #F32137;
  padding: 10px 25px;
  border-radius: 50px;
  font-size: 17px;
  text-decoration: none;
  font-weight: bold;
}

.card:hover .cta-container {
  margin-top: 320px;

}
    </style>
</head>
<body>
<div class="card transition">
  <h2 class="transition">Failure<br><small>Transaction Failed</small></h2>
  <div class="cta-container transition"><a href="#" class="cta">Go Back</a></div>
  <div class="card_circle transition"></div>
</div>
</body>
</html>
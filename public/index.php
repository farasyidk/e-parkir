<?php
//echo json_encode("{'port1':1,'port2':2,'port3':3}");
//{"parkir1":"up","parkir2":"calm","parkir3":"calm"} down keep up keep down
include 'services/data.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>parkir &mdash; Yuks</title>
    <meta name="description" content="Free Bootstrap Theme by uicookies.com">
    <meta name="keywords" content="Free website templates, Free bootstrap themes, Free template, Free bootstrap, Free website template">

    <link rel="stylesheet" href="css/styles-merged.css">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default probootstrap-navbar">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html" title="uiCookies:Frame">parkirYuks</a>
        </div>

        <div id="navbar-collapse" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#" data-nav-section="home">Home</a></li>
            <li><a href="#" data-nav-section="pricing">Parkir</a></li>
            <li><a href="#" data-nav-section="reviews">Reviews</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="probootstrap-hero prohttp://localhost/parkir/#featuresbootstrap-slant" style="background-image: url(img/image_1.jpg);" data-section="home" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row intro-text">
          <div class="col-md-8 col-md-offset-2 text-center">
            <h1 class="probootstrap-heading probootstrap-animate">Parkir sekarang <em>GRATIS</em></h1>
            <div class="probootstrap-subheading center">
              <p class="probootstrap-animate"><a href="#" role="button" class="btn btn-primary">Login</a><a href="#pricing" class="btn btn-default smoothscroll">Pilih parkir</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="probootstrap-section" data-section="pricing" id="pricing" style="padding-top:10px">
      <div class="container">
        <div class="row text-center mb100" style="margin-bottom:0">
          <div class="col-md-8 col-md-offset-2 probootstrap-section-heading" style="padding-bottom:15px">
            <h2 class="mb30 text-black probootstrap-heading">Pilih lokasi parkirmu </h2>
          </div>
        </div>
        <!-- END row -->
        <div class="row">
          <div class="col-md-4">
            <div class="probootstrap-pricing">
              <h2>Parkir1</h2>
              <p class="probootstrap-price"><strong>Terisi</strong></p>
              <p><a href="#" id="prk1" disabled class="btn btn-black">Masuk</a></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="probootstrap-pricing probootstrap-popular probootstrap-shadow">
              <h2>parkir2</h2>
              <p class="probootstrap-price"><strong>Kosong</strong></p>
              <p><a href="#" id="prk2" class="btn btn-primary">Masuk</a></p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="probootstrap-pricing">
              <h2>Parkir3</h2>
              <p class="probootstrap-price"><strong>Terisi</strong></p>

              <p><a href="#" id="prk3" disabled class="btn btn-black">Masuk</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <footer class="probootstrap-footer">
      <div class="container text-center">
            <p class="probootstrap-social"><a href="#"><i class="icon-twitter"></i></a> <a href="#"><i class="icon-facebook2"></i></a> <a href="#"><i class="icon-instagram2"></i></a><a href="#"><i class="icon-linkedin"></i></a></p>
      </div>
    </footer>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/scripts.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
    $(document).ready(function(){
        var ip;
        $.getJSON("http://jsonip.com?callback=?", function (data) {
          ip = data.ip;
        });
        function kirim(prk) {
          $.post("services/set_data.php",
          {
            ip: ip,
            prk: prk
          },
          function(data,status){
              $("a").prop("disabled", true);
              //alert("Data: " + data + "\nStatus: " + status);
          });
        }
        $("#prk1").click(function(){
          kirim("parkir1");
        });
        $("#prk2").click(function(){
          kirim("parkir2");
        });
        $("#prk3").click(function(){
          kirim("parkir3");
        });
    });
    </script>
  </body>
</html>

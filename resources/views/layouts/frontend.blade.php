<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dede Travel</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend') }}/img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/themify-icons.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/nice-select.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/gijgo.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/animate.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/slick.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/slicknav.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/css/style.css">

    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    @include('includes.frontend.header')
    <!-- header-end -->

    <!-- slider_area_start -->
   @yield('content')



    <footer class="footer">

        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | <a href="{{ url('/') }}">{{ url('/') }}</a></i>

<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


  <!-- Modal -->
  <div class="modal fade custom_search_pop" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="serch_form">
            <input type="text" placeholder="Search" >
            <button type="submit">search</button>
        </div>
      </div>
    </div>
  </div>
    <!-- link that opens popup -->
<!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> </script> -->
    <!-- JS here -->
    <script src="{{ asset('/frontend') }}/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/popper.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/ajax-form.js"></script>
    <script src="{{ asset('/frontend') }}/js/waypoints.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/scrollIt.js"></script>
    <script src="{{ asset('/frontend') }}/js/jquery.scrollUp.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/wow.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/nice-select.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/jquery.slicknav.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/plugins.js"></script>
    <script src="{{ asset('/frontend') }}/js/gijgo.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/slick.min.js"></script>



    <!--contact js-->
    <script src="{{ asset('/frontend') }}/js/contact.js"></script>
    <script src="{{ asset('/frontend') }}/js/jquery.ajaxchimp.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/jquery.form.js"></script>
    <script src="{{ asset('/frontend') }}/js/jquery.validate.min.js"></script>
    <script src="{{ asset('/frontend') }}/js/mail-script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('frontend') }}/js/main.js"></script>
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }
        });
    </script>
    @include('sweetalert::alert')
</body>

</html>

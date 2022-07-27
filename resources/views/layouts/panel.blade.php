<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('backend/assets') }}/img/favicon.png" rel="icon">
  <link href="{{ asset('backend/assets') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

 @stack('up-style')
 @include('includes.backend.style')
 @stack('down-style')

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  @include('includes.backend.navbar')

  @include('includes.backend.sidebar')

  @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="position: relative; top: 30vh">
    <div class="copyright">
      &copy; Copyright {{ date('Y') }} <strong><span>{{ url('/') }}</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @stack('up-script')
  @include('includes.backend.script')
  @stack('down-script')
  @include('sweetalert::alert')
</body>

</html>

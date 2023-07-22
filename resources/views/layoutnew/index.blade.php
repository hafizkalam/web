<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Coffee</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('/') }}assets/img/favicon.png" rel="icon">
    <link href="{{ asset('/') }}assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('/') }}assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('/') }}assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Yummy
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="#" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>{{ $judulheader }}<span>.</span></h1>
            </a>

            <li>
                <a href="{{ route('login') }}"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>
            </li>

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center section-bg">
        <div class="container">
            <div class="row justify-content-between gy-5">
                <div
                    class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                    <h2 data-aos="fade-up">{{ $judulutama }}</h2>
                </div>
                <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
                    <img src="assets/img/hero-img.png" class="img-fluid" alt="" data-aos="zoom-out"
                        data-aos-delay="300">
                </div>
            </div>
        </div>
    </section><!-- End Hero Section -->

    <main id="main">
        <!-- ======= Chefs Section ======= -->
        <section id="chefs" class="chefs section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Outlet</h2>
                    <p>Our Stands</p>
                </div>
                <div class="row gy-4">
                    <?php foreach ($user as $value) {?>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100"
                        data-toggle="modal" data-target="#modal-tambah">
                        <div class="chef-member">
                            <div class="member-img">
                                <img width="100px" src="{{ url('/profile_users/' . $value->profile) }}">
                            </div>
                            <div class="member-info">
                                <h4>{{ $value->name }}</h4>
                                <p>{{ $value->desc }}</p>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </section><!-- End Chefs Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Contact</h2>
                    <p>Need Help? <span>Contact Us</span></p>
                </div>

                <div class="mb-3">
                    <iframe style="border:0; width: 100%; height: 350px;" src="{{ $alamatgoogle }}" frameborder="0"
                        allowfullscreen></iframe>
                </div><!-- End Google Maps -->

                <div class="row gy-4">

                    <div class="col-md-6">
                        <div class="info-item  d-flex align-items-center">
                            <i class="icon bi bi-map flex-shrink-0"></i>
                            <div>
                                <h3>{{ $judulalamat }}</h3>
                                <p>{{ $alamat }}</p>
                            </div>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item d-flex align-items-center">
                            <i class="icon bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>{{ $judulemail }}</h3>
                                <p>{{ $email }}</p>
                            </div>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item  d-flex align-items-center">
                            <i class="icon bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>{{ $judulkontak }}</h3>
                                <p>{{ $kontak }}</p>
                            </div>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-md-6">
                        <div class="info-item  d-flex align-items-center">
                            <i class="icon bi bi-share flex-shrink-0"></i>
                            <div>
                                <h3>{{ $juduljamoperasional }}</h3>
                                <div>
                                    <p>{{ $jamoperasional }}</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Info Item -->
                </div>
            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div>
                        <h4>{{ $judulalamat }}</h4>
                        <p>
                            {{ $alamat }} <br>
                        </p>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>{{ $judulkontak }}</h4>
                        <p>
                            <strong>Phone:</strong> {{ $kontak }}<br>
                            <strong>Email:</strong> {{ $email }}<br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>{{ $juduljamoperasional }}</h4>
                        <p>
                            <strong>{{ $jamoperasional }}</strong><br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Follow Us</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Glory Tech.</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
                Designed by <a href="https://bootstrapmade.com/">Glory Tech.</a>
            </div>
        </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/') }}assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('/') }}assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="{{ asset('/') }}assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('/') }}assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('/') }}assets/js/main.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $judulheader }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/dist/jquery-confirm.min.css">



    <!-- Template Main CSS File -->
    <link href="{{ asset('/') }}assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- =======================================================
  * Template Name: Yummy
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SET_YOUR_CLIENT_KEY_HERE"></script>
    <style>
        #loading-indicator {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
        }



        .btn-number {
            padding: 0.375rem 0.75rem;
        }

        .badge {
            padding-left: 9px;
            padding-right: 9px;
            -webkit-border-radius: 9px;
            -moz-border-radius: 9px;
            border-radius: 9px;
        }

        .label-warning[href],
        .badge-warning[href] {
            background-color: #c3ff00;
        }

        #lblCartCount {
            font-size: 12px;
            background: #0069d9;
            color: #fff;
            padding: 0 5px;
            vertical-align: top;
            margin-left: -10px;
        }

        .container {
            padding: 2rem 0rem;
        }

        .table-image {

            thead {

                td,
                th {
                    border: 0;
                    color: #666;
                    font-size: 0.8rem;
                }
            }

            td,
            th {
                vertical-align: middle;
                text-align: center;

                &.qty {
                    max-width: 2rem;
                }
            }
        }

        .price {
            margin-left: 1rem;
        }

        .modal-footer {
            padding-top: 0rem;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
        }

        .spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .toast-success {
            background-color: #28a745 !important;
            color: #fff !important;
        }

        .toast-error {
            background-color: #dc3545;
            /* Red color for danger */
            color: #fff;
            /* Text color */
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>{{ $judulheader }}<span>.</span></h1>
            </a>



            <button id="tombolCheckout" class="btn btn-warning" style="background-color:#ec2727; color: white;"
                onclick="Checkout()"><i class="fa fa-shopping-cart"></i>
                <span class='badge badge-warning' id='lblCartCount'> </span>
                Checkout
            </button>




            <a class="btn-book-a-table" href="#book-a-table">Table: {{ $no_meja }}</a>

        </div>
    </header><!-- End Header -->

    <main id="main">
        @section('content')
        @show
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
                &copy; Copyright <strong><span>Glory Tech</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
                Designed by <strong>Glory Tech.</strong>
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

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/dist/jquery-confirm.min.js"></script>

    @section('script')
    @show
</body>

</html>

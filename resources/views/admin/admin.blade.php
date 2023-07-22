<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <div class="nav-link">Sistem Informasi Pemesanan Njenggrik Coffee</div>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown" id="notif">

                </li>
                <!-- Navbar Search -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <p class="brand-link">
                <img src="{{ asset('/') }}dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Menu</span>
            </p>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/') }}dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            {{ Auth::user()->name }}
                        </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @include('admin.sidebar')
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @section('content')
            @show
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <div id="app">
        <ul>
            <li v-for="message in messages">

            </li>
        </ul>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script type="text/javascript" src="{{ asset('/') }}dist/js/demo.js"></script> --}}
    <script type="text/javascript" src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('/') }}plugins/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
    </script>

    <script src="{{ asset('/') }}plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

    <script src="{{ asset('/') }}plugins/chart.js/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>

    @section('script')
    @show

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('100cecee071edab08292', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            playNotificationSound();
            // app.messages.push(JSON.stringify(data));
        });
    </script>

    <script>
        //  $("#notif").load("{{ url('notif') }}");
        // Enable pusher logging - don't include this in production
        setInterval(function() {
            cekStatus();
        }, 3000);

        function cekStatus() {
            $("#notif").load("{{ url('notif') }}");

        }

        function playNotificationSound() {
            var sound = new Howl({
                src: [
                    "{{ url('storage/notif/notif.mp3') }}"
                ], // Replace this URL with the online path of your notification sound file
                volume: 0.5, // Adjust the volume level (0.0 to 1.0)
            });
            sound.play();
        }
    </script>
    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? ',' : '';
                rupiah += separator + ribuan.join(',');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        @if (isset($jsTambahan))
            <?php echo $jsTambahan; ?>
        @endif
    </script>

</body>

</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Todo</title>
    <link rel="shortcut icon" href="{{asset('favicon.png')}}"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('vendor/Ionicons/css/ionicons.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('vendor/toastr/toastr.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">

    <style type="text/css">
        .modal {
            overflow: auto !important;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    @yield('css')
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="/" class="navbar-brand"><b>Todo</b>&nbsp;App</a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/home">Home</a></li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#change-password-modal">
                                Change Password
                            </a>
                        </li>
                        <li>
                            <a href="#" class="logout-button visible-xs">
                                Sign Out
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu hidden-xs">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle logout-button">
                                <!-- The user image in the navbar-->
                                <img src="{{asset('vector/avatar.svg')}}" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span>{{ Session::get('name') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('title')
                    <small>@yield('subtitle')</small>
                    <div class="pull-right">
                        @yield('top-button')
                    </div>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->

    {{-- Change Password Modal --}}
    <div class="modal fade" id="change-password-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/" method="post" id="change-password-modal-form">
                    <div class="modal-header">
                        <h4 class="modal-title">Change Password</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" placeholder="Insert your new password"
                                   id="change-password-modal-form-field-password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Please confirm new password"
                                   id="change-password-modal-form-field-password-confirm">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-spinner fa-spin" id="change-password-modal-save-loading-indicator"></i>
                            <span id="change-password-modal-save-button-label">Save</span>
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <footer class="main-footer">
        <div class="container">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.4
            </div>
            <strong>Copyright &copy; @php echo date('Y'); @endphp <b>Todo</b>&nbsp;<i>App</i>.</strong>
            All rights
            reserved.
        </div>
        <!-- /.container -->
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('vendor/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('vendor/fastclick/lib/fastclick.js')}}"></script>
<!-- Sweet Alert -->
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('vendor/toastr/toastr.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>

<script type="application/javascript">
    $(document).ready(function () {
        $("#change-password-modal-save-loading-indicator").hide();
        $(".logout-button").on('click', function () {
            swal({
                title: "Do you want to sign out ?",
                buttons: ["No", "Yes"],
                dangerMode: true,
            }).then((logout) => {
                if (logout) {
                    location.href = "/web/logout";
                }
            });
        });
        $("#change-password-modal-form").on("submit", function (e) {
            e.preventDefault();

            const password = $("#change-password-modal-form-field-password");
            const passwordConfirm = $("#change-password-modal-form-field-password-confirm");

            $.ajax({
                type: "POST",
                url: "/web/change/password",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: JSON.stringify({
                    "email": "{{ Session::get('email') }}",
                    "password": password.val(),
                    "password_confirm": passwordConfirm.val(),
                }),
                contentType: "application/json",
                dataType: "json",
                async: true,
                beforeSend: function () {
                    $("#change-password-modal-save-loading-indicator").show();
                    $("#change-password-modal-save-button-label").hide();
                },
                success: function (result) {
                    $("#change-password-modal-save-loading-indicator").hide();
                    $("#change-password-modal-save-button-label").show();

                    password.val(null);
                    passwordConfirm.val(null);

                    toastr.success(result.message);

                    $("#change-password-modal").modal('hide');
                },
                error: function (result) {
                    $("#change-password-modal-save-loading-indicator").hide();
                    $("#change-password-modal-save-button-label").show();

                    toastr.error(result.responseJSON.message);
                }
            });
        });
    });
</script>

@yield('js')

</body>
</html>

<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.9.4
*
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>APPINA Dashboard</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Plugin -->
    <link href="{{ asset('assets/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"> 
    <link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('plugin/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" /> -->
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">

    <link href="{{ asset('css/alert.css') }}" rel="stylesheet"> 
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> 
    <script>
        var base_url = '{{ url("/") }}';
    </script>
</head>

<body class="fixed-sidebar pace-done skin-1">
    <div id="wrapper">
        
        @include('template.backend.sidebar')

        <div id="page-wrapper" class="gray-bg dashbard-1">

            @include('template.backend.header')

            @yield('content')

            <div class="footer">
                <div> <strong>Copyright</strong> APPINA &copy; {{ date('Y') }} </div>
            </div>
        </div>

        @include('template.backend.right-sidebar')
    </div>


    <!-- Mainly scripts -->
    <script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <!-- Peity -->
    <script src="{{ asset('assets/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/peity-demo.js') }}"></script>
    <!-- Custom and plugin javascript -->
    <script src="{{ asset('assets/js/inspinia.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('assets/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- GITTER -->
    <script src="{{ asset('assets/js/plugins/gritter/jquery.gritter.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- Sparkline demo data  -->
    <script src="{{ asset('assets/js/demo/sparkline-demo.js') }}"></script>
    <!-- ChartJS-->
    <script src="{{ asset('assets/js/plugins/chartJs/Chart.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('assets/js/plugins/toastr/toastr.min.js') }}"></script>
     <!-- MorrisJS-->
    <script src="{{ asset('assets/js/plugins/morris/raphael-2.1.0.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/morris/morris.js') }}"></script>

    <!-- CUSTOM -->
    <script src="{{ asset('assets/js/plugins/dataTables/datatables.min.js') }}"></script>
    <!-- <script src="{{ asset('plugin/dropify/dropify.min.js') }}"></script> -->
    <script src="{{ asset('plugin/filestyle/src/bootstrap-filestyle.min.js') }}"> </script>
    <script src="{{ asset('assets/js/plugins/bs-custom-file/bs-custom-file-input.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2/select2.full.min.js')}}"></script>

    <!-- Global JS -->
    <script src="{{ asset('js/alert.js') }}"></script>
    <script src="{{ asset('js/customs.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <!-- Ladda -->
    <script src="{{ asset('assets/js/plugins/ladda/spin.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ladda/ladda.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/ladda/ladda.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/iCheck/icheck.min.js')}}"></script>

    <script>
        
        $(window).bind("scroll", function() {
            let toast = $('.toast');
            toast.css("top", window.pageYOffset + 20);
        });

        // Upgrade button class name
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function(){
            $('.datatables').DataTable({
                pageLength: 10,
                responsive: true,
                sort: false,
            });

            bsCustomFileInput.init();

            $(".select2").select2({
                theme: 'bootstrap4',
            });

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

            var mem = $('.datepicker').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                dateFormat: 'dd-mm-yyyy',
                autoclose: true
            });
            
            @if(Session::has('message'))
                @php
                    $flashmsg = explode('|', Session::get("message"));
                    $type = $flashmsg[0];
                    $msg = $flashmsg[1];
                    if ($errors->any())
                        $error_msg = '<br>'.implode('<br>', $errors->all());
                    else
                        $error_msg = '';
                @endphp

                var type = '@php echo $type @endphp';
                var msg = '@php echo $msg . $error_msg @endphp';
                
                setTimeout(function() {
                    showFlashAlert(type, msg);
                }, 1000);

            @endif

        });

        $(".filestyle").filestyle();

        $(document).ready(function () {
            auto_logout();
        });

        function auto_logout(){
            let log_off = new Date();
            log_off.setSeconds(log_off.getSeconds() + 5);
            log_off = new Date(log_off);

            let int_logoff = setInterval(function(){
                let now = new Date();
                if (now > log_off){

                    var url = base_url + '/check-session';
                    $.get(url, function(res){
                        swal({
                          title: 'Session Timeout',
                          text: 'Please try to login again!',
                          type: 'info',
                          showCancelButton: false,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: 'Login'
                        }).then((result) => {
                            if (result.value) {  
                                window.location.href = base_url + '/login';
                            }
                        });

                        clearInterval(int_logoff);
                    });
                }
            }, 1800000);
            

            $("body" ).on('click', function(){
                log_off = new Date();
                log_off.setSeconds(log_off .getSeconds() + 5);
                log_off = new Date(log_off);
            });
        }
    </script>



    <div id="flash_msg" style="display: none;">
        <div class="alert alert-dismissible alert-success" role="alert">
            <button type="button" class="close" aria-label="Close" onclick="closeFlashAlert()">
                <span aria-hidden="true">×</span>
            </button>
            <span class="alert-inner--text">
                <strong id="alert-title">Success</strong><br>
                <span id="alert-message">Data Berhasil Disimpan</span>
            </span>
        </div>
    </div>
    <img src="{{ url('/loader/facebook.gif') }}" style="display: none;">
    <img src="{{ url('/loader/facebook2.gif') }}" style="display: none;">
    @stack('script')
</body>

</html>
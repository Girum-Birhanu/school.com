<!DOCTYPE html>
<html lang="en">       
    <head>
        <!-- META SECTION -->
        <title>{{ !empty($meta_title) ? $meta_title : '' }} - school</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="{{ url('public/css/theme-default.css') }}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/all.css">
        <!-- EOF CSS INCLUDE -->   
        
        <style type="text/css">

            .required {
                color:red;
            }
            
        </style>
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            <!-- START PAGE SIDEBAR -->
            @include('backend.layouts._sidebar')
            <!-- END PAGE SIDEBAR -->
            <div class="page-content">
                <!-- START X-NAVIGATION -->
                @include('backend.layouts._header')
                <!-- END X-NAVIGATION VERTICAL -->     
                @yield('content')
            </div>
            <!-- END PAGE CONTAINER -->    
        </div>
        <!-- END PAGE CONTAINER -->    

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if you want to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{ url('logout') }}" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{{ url('public/audio/alert.mp3') }}" preload="auto"></audio>
        <audio id="audio-fail" src="{{ url('public/audio/fail.mp3') }}" preload="auto"></audio>
        <!-- END PRELOADS -->                      

        <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{ url('public/js/plugins/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('public/js/plugins/jquery/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('public/js/plugins/bootstrap/bootstrap.min.js') }}"></script>        
        <!-- END PLUGINS -->
        
        <!-- START THIS PAGE PLUGINS-->        
        <script type="text/javascript" src="{{ url('public/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
        <!-- END THIS PAGE PLUGINS-->  
        
        <!-- START TEMPLATE -->
        {{-- <script type="text/javascript" src="{{ url('public/js/settings.js') }}"></script> --}}
        <script type="text/javascript" src="{{ url('public/js/plugins.js') }}"></script>        
        <script type="text/javascript" src="{{ url('public/js/actions.js') }}"></script>        
        <!-- END TEMPLATE -->
        @yield('script')              

        <!-- Initialize iCheck Plugin -->
        <script>
            $(document).ready(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale()== 'ar' ? 'rtl' : 'ltr'}}" >
<head>
    @includeif('base_layouts.header.meta_header')
    @yield('style')
</head>
    <!-- END HEAD -->
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
                @includeif('base_layouts.header.header')
            <!-- END HEADER -->
            
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                    @includeif('base_layouts.sidebar.sidebar')
                <!-- END SIDEBAR -->

                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                       <div class="col clo-md-12">
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @elseif(session('success'))  
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                       </div>
                       @yield('content')
                        <!-- BEGIN THEME PANEL -->
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                
            </div>
            <!-- END CONTAINER -->


            <!-- BEGIN FOOTER -->
                @includeif('base_layouts.footer.footer')
                <!-- END FOOTER -->
                
            </div>
            
            
            <!-- BEGIN QUICK NAV -->
            @includeif('base_layouts.footer.meta_footer')
            @yield('script')
        
    </body>
</html>


@include('layouts.admin-partials._header')


<div id="app">

        <!-- Page Wrapper -->
    <div id="wrapper">

          <!-- Sidebar -->

            @include('layouts.admin-partials._sidebar')
            
        <!-- End of Sidebar -->
        
        <!-- Content Wrapper -->

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                @include('layouts.admin-partials._topbar')

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <main>
                        @yield('content')
                    </main>
            
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            @include('layouts.admin-partials._footer-block')

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

              <!--logout modal -->
                  
        @include('layouts.admin-partials._logout-modal')

            <!--Scripts -->
         @include('layouts.admin-partials._scripts')


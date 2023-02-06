{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Video Downloader -  Admin Panel">
    <meta name="author" content="Spruko Technologies Private Limited">
    {{-- <meta name="keywords"
        content="sales dashboard, admin dashboard, bootstrap 4 admin template, html admin template, admin panel design, admin panel design, bootstrap 4 dashboard, admin panel template, html dashboard template, bootstrap admin panel, sales dashboard design, best sales dashboards, sales performance dashboard, html5 template, dashboard template"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- css file -->
    @include('components.cssfile')
    <!-- end css file -->

</head>

<body>

    <!-- Loader -->
    <div id="global-loader">
        <img src="{{ asset('assets/img/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- End Loader -->

    <!-- Page -->
    <div class="page">

        <!-- Sidemenu -->
        @include('components.sidebar')
        <!-- End Sidemenu -->

        <!-- Main Content-->
        <div class="main-content side-content pt-0">

            <!-- Main Header-->
            @include('components.header')
            <!-- End Main Header-->

            <div class="container-fluid">
                <!-- Page Header -->
                <div class="page-header">
                    <h1>Video Data</h1>
                </div>
                <!-- End Page Header -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card custom-card">
                            <div class="card-header-divider">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table data-table table-striped table-hover table-fw-widget"
                                            id="table_list_data" width="100%">
                                            <!-- data-filter_data is static as there are different tabs for filtering that are already defined -->
                                            <thead>
                                                <tr>
                                                    <th class="wd-5p">Id</th>
                                                    {{-- <th class="wd-15p">Button Name</th> --}}
                                                    <th class="wd-15p">Date</th>
                                                    <th class="wd-15p">Source</th>
                                                    <th class="wd-15p">Thumbnail</th>
                                                    <th class="wd-15p">Media</th>
                                                    <th class="wd-15p">Client IP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->
            </div>

        </div>
        <!-- End Main Content-->

        <!-- Footer-->
        @include('components.footer')
        <!-- End Footer-->

    </div>
    <!-- End Page -->

    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

    <!-- scrip file -->
    @include('components.jsfile')
    <!-- end scrip file -->
    <script src="{{ asset('assets/plugins/sweet-alert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweet-alert/jquery.sweet-alert.js') }}"></script>

    <!-- Ajex Call -->
    <script type='text/javascript'>
        // CREATE CSRF TOKEN
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // FETCH APP DATA CALL
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                // "order": [
                //     [0, "desc"]
                // ],
                ajax: "{{ route('Get_VideoData') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    // {
                    //     data: 'button_id',
                    //     name: 'button_id'
                    // },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'download_source',
                        name: 'download_source'
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail'
                    },
                    {
                        data: 'viedo_url',
                        name: 'viedo_url'
                    },
                    {
                        data: 'client_ip',
                        name: 'client_ip'
                    }
                ]
            });
        });
    </script>

</body>

</html>
{{-- @endsections --}}

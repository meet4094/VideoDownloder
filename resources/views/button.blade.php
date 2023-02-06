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
                    <h1>Button Data</h1>
                    <div class="">
                        <a class="btn ripple btn-primary" style="border-radius:3px" data-target="#add_edit_buttondata"
                            id="add_data" data-toggle="modal" href=""><i class="fe fe-plus-circle mr-2"></i>Add
                            Button</a>
                        <a href="#" class="btn ripple btn-secondary navresponsive-toggler mb-0"
                            data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fe fe-filter mr-1"></i> Filter <i class="fas fa-caret-down ml-1"></i>
                        </a>
                    </div>
                </div>
                <!-- End Page Header -->
                <!--Navbar-->
                <div class="responsive-background">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="advanced-search">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-3">
                                    <div class="form-group mb-lg-0">
                                        <label class="">Status :</label>
                                        <select id="statusvalue" class="form-control select2-flag-search">
                                            <option value="" disabled selected>Select..</option>
                                            <option value="0">Enable</option>
                                            <option value="1">Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a href="#" id="statusApply" class="btn btn-primary">Apply</a>
                                    <a href="#" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Navbar -->
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
                                                        <th class="wd-15p">Button Name</th>
                                                        <th class="wd-15p">Button Slug</th>
                                                        <th class="wd-15p">Status</th>
                                                        <th class="wd-10p">Action</th>
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

            <!-- Form Modal -->
            <div class="modal fade" id="add_edit_buttondata">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="border-radius:7px">
                        <div class="modal-body pd-20 pd-sm-40">
                            <button aria-label="Close" class="close pos-absolute t-15 r-20 tx-26" data-dismiss="modal"
                                type="button"><span aria-hidden="true">&times;</span></button>
                            <h5 class="modal-title mb-4 text-center"></h5>
                            <form id="buttondata" action="Add_Edit_ButtonData" method="post" enctype="text/plain">
                                @csrf
                                <input id="button_id" name="id" value="" type="hidden">
                                <div class="form-group">
                                    <label for="">Button Name :</label>
                                    <input id="button_name" name="button_name" class="form-control"
                                        placeholder="Enter button name" type="text">
                                    <span class="text-danger button_name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Button Slug :</label>
                                    <input id="button_slug" name="button_slug" class="form-control"
                                        placeholder="Enter button slug" type="text">
                                    <span class="text-danger button_slug_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Status :</label>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label class="rdiobox"><input id="enable" checked=""
                                                    value="0" name="is_del" type="radio">
                                                <span>Enable</span></label>
                                        </div>
                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                            <label class="rdiobox"><input id="disable" value="1"
                                                    name="is_del" type="radio">
                                                <span>Disable</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: flex; justify-content: center; margin: auto">
                                    <button value="submit" type="submit" class="btn ripple btn-info add_edit_data"
                                        style="border-radius:3px">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Form Modal -->

            <!-- Success popup -->
            <div class="sweet-alert showSweetAlert visible" data-custom-class="" data-has-cancel-button="false"
                data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false"
                data-animation="pop" data-timer="null" style="display: none; margin-top: -169px;">
                <div class="sa-icon sa-success animate" style="display: block;">
                    <span class="sa-line sa-tip animateSuccessTip"></span>
                    <span class="sa-line sa-long animateSuccessLong"></span>

                    <div class="sa-placeholder"></div>
                    <div class="sa-fix"></div>
                </div>
                <h2>Success!</h2>
                <p style="display: block;" id="message"></p>
                <div class="sa-icon sa-custom"
                    style="display: none; background-image: url(&quot;{{ asset('assets/img/brand/logo.png&quot') }};); width: 80px; height: 80px;">
                </div>
                <div class="sa-button-container">
                    <div class="sa-confirm-button-container">
                        <button class="confirm" onclick="
                    closepopup()" tabindex="1"
                            style="display: inline-block; background-color: rgb(87, 169, 79); box-shadow: rgba(87, 169, 79, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">OK</button>
                        <div class="la-ball-fall">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Success popup -->


        </div>

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

    <!-- Ajex Call -->
    <script type='text/javascript'>
        // CREATE CSRF TOKEN
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // FETCH APP DATA CALL
        $(document).ready(function() {
            load_datatable('');
        });

        function load_datatable(status_id = '') {
            $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                // "order": [
                //     [0, "desc"]
                // ],
                ajax: {
                    url: 'Get_ButtonData',
                    data: {
                        'status_id': status_id
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'button_name',
                        name: 'button_name'
                    },
                    {
                        data: 'button_slug',
                        name: 'button_slug'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            $('#statusApply').on('submit', function(e) {
                oTable.draw();
                e.preventDefault();
            });
        };

        // ADD EDIT APP DATA CALL
        $(document).on('click', '#add_data', function() {
            $('.modal-title').html('Add Button Data');
            document.getElementById('buttondata').reset();
        })

        $(document).on('click', '.add_edit_data', function() {
            $("#buttondata").submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var actionUrl = form.attr("action");

                $.ajax({
                    type: "POST",
                    url: "Add_Edit_ButtonData",
                    data: form.serialize(),
                    success: function(data) {
                        if (data.success) {
                            $('#add_edit_buttondata').modal('hide');
                            $('#message').html(data.success);
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.success,
                            }).then(() => {
                                location.reload()
                            });
                        } else {
                            $.each(data.error, function(key, value) {
                                $("span." + key + "_error").text(value).show().delay(
                                        5000)
                                    .fadeOut();
                            });
                        }
                    },
                });
            });
        })

        // GET EDIT DATA CALL ID BAY
        function edit_buttondata(editButtonData) {

            var button_id = $(editButtonData).data('val');
            $('#add_edit_buttondata').modal('show');
            $('.modal-title').html('Edit Button Data');

            $.ajax({
                type: "GET",
                url: "Edit_ButtonData/" + button_id,
                success: function(response) {
                    if (response.edit_data) {
                        $('#button_name').val(response.edit_data.button_name);
                        $('#button_slug').val(response.edit_data.button_slug);
                        if (response.edit_data.is_del == 0) {
                            $('#enable').prop("checked", "true");
                        } else if (response.edit_data.is_del == 1) {
                            $('#disable').prop("checked", "true");
                        }
                        $('#button_id').val(button_id);
                    }
                },
            });
        }

        // DELETE DATA CALL ID BAY
        function delete_buttondata(deleteButtonData) {
            var button_id = $(deleteButtonData).data('val');

            $.ajax({
                type: "POST",
                url: "Delete_ButtonData",
                data: {
                    'id': button_id
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.success,
                    }).then(() => {
                        location.reload()
                    });
                },
            });
        }

        // Filtter by Status ID BAY
        $('#statusApply').click(function() {
            var status_id = $('#statusvalue').val();
            if (status_id != '') {
                $('#table_list_data').DataTable().destroy();
                load_datatable(status_id);
            }
        });
    </script>

</body>

</html>
{{-- @endsections --}}

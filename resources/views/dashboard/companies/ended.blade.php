@extends('dashboard.layout.master')

@section('style')

    <link href="{{ asset('dashboardAssets') }}/vendors/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet"
          type="text/css"/>

@endsection


@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">


        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <h3 class="kt-portlet__head-title">
                        جميع الشركات
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('company.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                اضافة شركة
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable text-center"
                       id="kt_table_1">

                </table>

                <!--end: Datatable -->
            </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection

@section('js')

    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ asset('dashboardAssets') }}/vendors/custom/datatables/datatables.bundle.js"
            type="text/javascript"></script>

    <!--end::Page Vendors -->

    <script>
        "use strict";
        var KTDatatablesDataSourceAjaxServer = function () {

            var initTable1 = function () {
                var table = $('#kt_table_1');

                // begin first table
                table.DataTable({
                    responsive: true,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    // "stateSave": true,

                    ajax: {
                        url: 'companies/datatable/ended',
                        method: "post",
                    },
                    columns: [
                        {
                            data: 'id',
                            title: "id",
                            visible: false,
                            textAlign: 'center',
                        },
                        {
                            data: 'logo',
                            title: "الشعار",
                            textAlign: 'center',
                        },
                        {
                            data: 'name_ar',
                            title: "الأسم باللغة العربية",
                            textAlign: 'center',
                        },
                        {
                            data: 'name_en',
                            title: "الأسم باللغة الإنجليزية",
                            textAlign: 'center',
                        }, {
                            data: 'Actions',
                            responsivePriority: -1,
                            textAlign: 'center',
                        },
                    ],
                    columnDefs: [
                        {
                            targets: -1,
                            title: 'Actions',
                            orderable: false,
                            render: function (data, type, full, meta) {

                                let y = full.endSubscription ? "رفع الحظر" : "حظر";
                                return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="fa fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                            	<input type="hidden" class="id_hidden" value="` + full.id + `">
                                <a class="dropdown-item" href="admin/company/` + full.id + `/edit"><i class="la la-edit"></i> تعديل بيانات الشركة</a>
                                <a class="dropdown-item delete"  href="javascript:;" ><i class="la la-leaf"></i> `+ y  +` </a>

                            </div>
                        </span>`;
                            },
                        },
                        {
                            targets: 1,
                            title: 'الشعار',

                            render: function (data, type, full, meta) {
                                return `<img src= "` + window.location.origin + "/" + full.logo + `" width="100px"
                                            height="100px" alt="logo">`;
                            },
                        },
                    ],
                });
            };

            return {

                //main function to initiate the module
                init: function () {
                    initTable1();
                },

            };

        }();

        jQuery(document).ready(function () {
            KTDatatablesDataSourceAjaxServer.init();
        });
    </script>


    <script>
        $('body').on('click', '.dropdown-menu .delete', function () {

            var id_hidden = $(this).parents('.dropdown-menu').find('.id_hidden').val();
            var this_row = $(this).parents('tr');
            swal.fire({
                title: 'هل انت متاكد من العملية',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'لا',
                confirmButtonText: 'نعم'
            }).then(function (result) {
                if (result.value) {

                    $.ajax({
                        url: "{{route('company.deactivate')}}",
                        method: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id_hidden
                        },
                        success: function (e) {
                            if (e == 1) {
                                swal.fire(
                                    'تمت العملية بنجاح',
                                );
                                swal.fire({
                                    title: 'تمت العملية بنجاح',
                                    type: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'موافق',
                                    dismiss: false
                                }).then(function (result) {
                                    if (result.value) {
                                        location.reload();
                                    } else {
                                        location.reload();
                                    }
                                });


                            } else {
                                swal.fire(
                                    'لقد حدث خطأ ما',
                                );
                            }

                        }
                    });

                }
            });


        });
    </script>
@endsection
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
                        إعلانات شركة {{ $company->name_ar  }}
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">
                            <a href="{{ route('company-ad.create' , $company->id) }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                اضافة إعلانات
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
                    "searching": false,
                    ajax: {
                        url: "{{ url('company-ad/datatable') }}",
                        method: "post",
                        data: {
                            'company_id': "{{ $company->id }}"
                        }
                    },
                    columns: [
                        {
                            data: 'id',
                            title: "id",
                            visible: false,
                            textAlign: 'center',
                        },
                        {
                            data: 'Link',
                            title: "الرابط",
                            textAlign: 'center',
                        },


                        {
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
                                return `<input type="hidden" class="id_hidden" value="`+ full.id + `">
                                        <a href="`+ window.location.origin + "/admin/company-ad/"+ full.id +`/edit" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="تعديل الإعلان">
                                            <i class="la la-edit"></i>
                                        </a>
                                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md delete" title="Delete">
                                            <i class="la la-times"></i>
                                        </a>
                                        `;
                            },
                        },
                        {
                            targets: 1,
                            title: 'الرابط',
                            orderable: false,
                            render: function (data, type, full, meta) {
                                if (full.path)
                                    return `<a class="dropdown-item" href="`+ window.location.origin + "/admin/company-ad/" + full.id + `"><i class="far fa-building"></i> عرض  إعلانات الشركة</a>`;
                                else
                                    return `<a class="dropdown-item" href="javascript:;"><i class="far fa-building"></i> لا يوجد اعلان</a>`;

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
        $('body').on('click', ' .delete', function () {

            var id_hidden = $(this).parent().find('.id_hidden').val();
            var this_row = $(this).parents('tr');
            swal.fire({
                title: 'هل انت متاكد من عملية الحذف ',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'لا',
                confirmButtonText: 'نعم'
            }).then(function (result) {
                if (result.value) {

                    $.ajax({
                        url: "{{ route('company-ad.destroy') }}",
                        method: "post",

                        data: {
                            id: id_hidden
                        },
                        success: function (e) {
                            if (e == 1) {
                                swal.fire(
                                    'تمت عملية الحذف بنجاح',
                                );
                                swal.fire({
                                    title: 'تمت علمية الحذف بنجاح  ',
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
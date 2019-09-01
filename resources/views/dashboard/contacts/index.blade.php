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
                        جميع الرسائل
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">

                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable text-center"
                       id="kt_table_1">

                </table>

                <!--end: Datatable -->

                <!--begin::Modal-->
                <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                    It has survived not only five centuries, but also the leap into electronic
                                    typesetting, remaining essentially unchanged. It was popularised in the 1960s with
                                    the release of Letraset sheets containing Lorem Ipsum passages, and more recently
                                    with desktop publishing software like Aldus PageMaker including versions of Lorem
                                    Ipsum.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Modal-->
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
                    "stateSave": true,

                    ajax: {
                        url: 'contacts/datatable',
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
                            data: 'name',
                            title: "الأسم",
                            textAlign: 'center',
                        },
                        {
                            data: 'email',
                            title: "البريد الإلكتروني",
                            textAlign: 'center',
                        },
                        {
                            data: 'title',
                            title: "العنوان",
                            textAlign: 'center',
                        },
                        {
                            data: 'message',
                            title: "الرسالة",
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
                                return `
                                        <span class="dropdown">
                                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                                              <i class="fa fa-cog"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <input type="hidden" class="id_hidden" value="` + full.id + `">
                                                <a class="dropdown-item" href="admin/contacts/` + full.id + `/replay"><i class="la la-edit"></i> الرد على المرسل</a>
                                                <a class="dropdown-item delete" href="javascript:;" ><i class="la la-leaf"></i> حذف الرسالة </a>
                                            </div>
                                        </span>`;
                            },
                        },
                        {
                            targets: -2,
                            title: "الرسالة",
                            orderable: false,
                            render: function (data, type, full, meta) {
                                return '<button type="button" class="btn btn-bold btn-label-brand btn-sm" data-toggle="modal"' +
                                    'title ="' + full.title + ' " message="'+ full.message + ' " data-target="#kt_modal_1"> عرض الرسالة</button>';
                            }
                        }
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
                title: 'هل انت متاكد من عملية الحذف ',
                type: 'warning',
                showCancelButton: true,
                cancelButtonText: 'لا',
                confirmButtonText: 'نعم'
            }).then(function (result) {
                if (result.value) {

                    $.ajax({
                        url: "admin/contacts/" + id_hidden,
                        method: "Delete",
                        data: {
                            '_token': "{{ csrf_token() }}",
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


        $("#kt_modal_1").on('show.bs.modal', function (e) {

            var opener =  e.relatedTarget ; //this holds the element who called the modal


            var title = opener.attributes.title.value;
            var message = opener.attributes.message.value;


            $(this).find("h5.modal-title")[0].textContent = title;
            $(this).find(".modal-body p")[0].textContent = message;

        });
    </script>
@endsection
@extends('dashboard.layout.master')

@section('css')

    <style>

        .dropzone .dz-preview .dz-error-message {
            top: 150px !important;
        }

        .dropzone.dz-clickable .dz-remove {
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2;
            font-size: 1.75rem;
            font-size: 1.75rem;
            bottom: 50px;

        }

        .dropzone.dz-clickable .dz-remove:hover {
            color: red;
        }
    </style>
@endsection

@section('content')

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        رفع اعلان جديد
                    </h3>
                </div>
            </div>


            <!--begin::Form-->
            <form class="kt-form kt-form--label-right">
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div action="{{ route('company-ad.upload') }}" class="kt-dropzone dropzone"
                                 id="dropzone">
                                <div class="kt-dropzone__msg dz-message needsclick">
                                    <h3 class="kt-dropzone__msg-title">إسقاط الملفات هنا أو انقر لتحميل.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->
    </div>

    <!-- end:: Content -->

@endsection

@section('js')

    <!--begin::Page Scripts(used by this page) -->
    {{--    <script src="{{ asset('dashboardAssets') }}/js/demo1/pages/crud/forms/widgets/dropzone.js" type="text/javascript"></script>--}}

    <script>
        "use strict";
        // Class definition

        var KTDropzoneDemo = function () {
            // Private functions
            var demos = function () {
                // single file upload
                Dropzone.options.dropzone = {
                    paramName: "company_ad", // The name that will be used to transfer the file
                    maxFiles: 1,
                    maxFilesize: 100, // MB
                    addRemoveLinks: true,
                    acceptedFiles: ".mp4,.mov,.avi,.mpeg4,.flv,.3gpp",
                    dictCancelUpload: "cancel",
                    dictRemoveFile: "<i class=\"fa fa-trash\"></i>",
                    accept: function (file, done) {
                        if (file.name == "justinbieber.jpg") {
                            done("Naha, you don't.");
                        } else {
                            done();
                        }

                    },
                    success: function (file, response) {

                        $.ajax({
                            type: 'PUT',
                            url: '{{ route('company-ad.update' , $id) }}',
                            data: {
                                '_token': "{{  csrf_token() }}",
                                'path': response
                            },
                            success: function (res) {
                                if (res == 1) {

                                    swal.fire({
                                        title: 'تمت علمية التعديل بنجاح  ',
                                        type: 'success',
                                        showCancelButton: false,
                                        confirmButtonText: 'موافق',
                                        dismiss: false
                                    });
                                } else {
                                    swal.fire({
                                        title: 'لقد حدث خطأ ما',
                                        type: 'error',
                                        showCancelButton: false,
                                        confirmButtonText: 'موافق',
                                        dismiss: false
                                    }).then(function (result) {
                                        if (result.value) {

                                            $.ajax({
                                                type: 'POST',
                                                url: '{{ route('company-ad.delete') }}',
                                                data: {
                                                    'path': response
                                                },
                                            });
                                            var _ref;
                                            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;

                                            location.reload();


                                        }
                                    });

                                }

                            }

                        });

                        file.fullPath = response;
                    },
                    removedfile: function (file) {
                        // var name = file.file.previewElement.children[1].children[1].textContent;
                        // alert(name);
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('company-ad.delete') }}',
                            data: {
                                'path': file.fullPath
                            },
                            success: function (res) {
                                $.ajax({
                                    type: 'PUT',
                                    url: '{{ route('company-ad.update' , $id) }}',
                                    data: {
                                        '_token': "{{  csrf_token() }}",
                                    },
                                    success: function (res) {
                                        if (res == 1) {

                                            swal.fire({
                                                title: 'تمت علمية الحذف بنجاح  ',
                                                type: 'success',
                                                showCancelButton: false,
                                                confirmButtonText: 'موافق',
                                                dismiss: false
                                            });
                                        } else {
                                            swal.fire({
                                                title: 'لقد حدث خطأ ما',
                                                type: 'error',
                                                showCancelButton: false,
                                                confirmButtonText: 'موافق',
                                                dismiss: false
                                            });

                                        }

                                    }

                                });
                            }

                        });
                        var _ref;
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                    }
                };

            }

            return {

                init: function () {
                    demos();
                }
            };
        }();

        KTDropzoneDemo.init();
    </script>


@endsection

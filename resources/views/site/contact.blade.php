@extends('site.layout.master')

@section('title')
    {{ __('site.contact') }}
@endsection
@section('content')

    <section class="s_2">
        <div class="container">
            <div class="header_divs">
                <h2>{{ __('site.contact') }}</h2>
                <p>{{ __('site.contactMsg') }}</p>
            </div>


            <div class="item_s2 abouts">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

                    <div class="alert alert-success custom-alert successAlert" role="alert">
                        تم ارسال الرسالة بنجاح و سوف نقوم بالرد عليك باقرب وقت
                    </div>

                    <div class="item_email">
                        <input type="text" name="name" placeholder="{{ __('site.name') }}" id="name">
                        <div class="alert alert-danger custom-alert nameAlert" role="alert">
                            {{ __('site.nameErrorMsg') }}
                        </div>
                        <input type="email" name="email" placeholder="{{ __('site.email') }}" id="email">
                        <div class="alert alert-danger custom-alert emailAlert" role="alert">
                            {{ __('site.emailErrorMsg') }}
                        </div>
                        <input type="text" name="title" placeholder="{{ __('site.title') }}" id="title">
                        <div class="alert alert-danger custom-alert titleAlert" role="alert">
                            {{ __('site.titleErrorMsg') }}
                        </div>
                        <textarea rows="6" placeholder="{{ __('site.message') }}" name="message" id="message"></textarea>

                        <div class="alert alert-danger custom-alert messageAlert" role="alert">
                            {{ __('site.messageErrorMsg') }}
                        </div>
                        <button type="submit" id="send">{{ __('site.send') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('js')

    <script type="text/javascript">

        let userError, emailError, titleError, msgError = true;

        function checkErrors() {
            if (userError || emailError || titleError || msgError) {
                return true;
            }
            return false;
        }

        $('input#name').blur(function () {

            if ($(this).val() != '') {
                $(this).css('border', 'green 1px solid');
                $(this).parent().find('.nameAlert').fadeOut(300);
                userError = false;
            } else {
                $(this).css('border', 'red 1px solid');
                $(this).parent().find('.nameAlert').fadeIn(300);
                userError = true;
            }
        });

        $('input#email').blur(function () {

            var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
            if (testEmail.test($(this).val())) {
                $(this).css('border', 'green 1px solid');
                $(this).parent().find('.emailAlert').fadeOut(300);
                emailError = false;

            } else {
                $(this).css('border', 'red 1px solid');
                $(this).parent().find('.emailAlert').fadeIn(300);
                emailError = true;

            }
        });

        $('input#title').blur(function () {

            if ($(this).val() != '') {
                $(this).css('border', 'green 1px solid');
                $(this).parent().find('.titleAlert').fadeOut(300);
                titleError = false;

            } else {
                $(this).css('border', 'red 1px solid');
                $(this).parent().find('.titleAlert').fadeIn(300);
                titleError = true;

            }
        });

        $('textarea#message').blur(function () {

            if ($(this).val() != '') {
                $(this).css('border', 'green 1px solid');
                $(this).parent().find('.messageAlert').fadeOut(300);
                msgError = false;

            } else {
                $(this).css('border', 'red 1px solid');
                $(this).parent().find('.messageAlert').fadeIn(300);
                msgError = true;

            }
        });

        $('button#send').on('click', function () {
            let name = $('input#name').val();
            let mail = $('input#email').val();
            let title = $('input#title').val();
            let message = $('textarea#message').val();

            if (checkErrors()) {
                alert('error');
            } else {

                $.ajax({
                    url: "{{ route('contact.store') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": name,
                        "email": mail,
                        "title": title,
                        "message": message
                    },
                    success: function (response) {

                        if (response == 'true') {
                            $('button#send').parent().parent().find('.successAlert').fadeIn(300);
                        }
                    }
                });
            }
        });

    </script>
@endsection
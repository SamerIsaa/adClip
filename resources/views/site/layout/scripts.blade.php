<script src="{{ asset('siteAssets') }}/js/jquery.min.js"></script>
<script src="{{ asset('siteAssets') }}/js/bootstrap.min.js"></script>
<script src='{{ asset('siteAssets') }}/js/bootstrap-select.js'></script>
<script src='{{ asset('siteAssets') }}/js/i18n/defaults-ar_AR.js'></script>
<script src="{{ asset('siteAssets') }}/js/function.js"></script>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.selectpicker').selectpicker({});
    });
</script>

<script type="text/javascript">


    $('button#subscribe').click(function () {
        let mail = $('input#email').val();

        var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (testEmail.test(mail)) {
            $.ajax({
                url: "{{ route('mail.store') }}",
                method: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'email': mail
                },
                success: function () {
                    alert('تمت علمية الإضافة بنجاح');
                },
                error: function (error) {
                    let json = JSON.parse(error.responseText);
                    alert(json.error)
                }
            })

        } else {
            alert('please inter a valid mail');
        }

    });

</script>

@yield('js')

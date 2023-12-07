{{-- <script src="{{ secure_asset('') }}"></script>
<script src="{{ secure_asset('plugins/toastr/toastr.min.css') }}"></script> --}}
<script src="{{ secure_asset('js/app.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript">
</script>

<script>
    $(document).ready(function (){
        $('.currency').on('change',function (){
            var currency_code = $(this).val();

            $.ajax({
                type: 'POST',
                url: "{{ route('currency.load') }}",
                data: {
                    currency_code: currency_code,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response){
                    if(response['status']){
                        location.reload();
                    }else{
                        console.log(response);
                        alert('server error');
                    }
                }
            })
        });

        $('.subscriber-submit').on('click',function (){
            var email = $('.subscriber-email').val();
            $.ajax({
                type: 'POST',
                url: "{{ route('store.subscriber') }}",
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response){
                    if(response['success']){
                        $('#subscribeModal').modal('hide');
                    }
                }
            })
        });

        if({{ Route::is('home') }}){
            setTimeout(function() {
                $('#subscribeModal').modal('show');
            }, 10000);
        }
    })
</script>
<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.error("oh snap! {{ $error }}");
        @endforeach
    @endif
    @if (Session::has('success'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if (Session::has('error'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>

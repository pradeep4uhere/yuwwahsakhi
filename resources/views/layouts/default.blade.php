<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Yuwaah Sakhi') }}</title>
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
         <!----======== CSS ======== -->
        <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
        <!----===== Iconscout CSS ===== -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    </head>
    <body class="font-sans antialiased">
    @yield('content')
    @include('admin.menu')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{asset('asset/js/script.js')}}"></script>
    <script>
      function deleteConfirm(id, route) {
            // Display confirmation alert
            var confirmDelete = confirm("Are you sure you want to delete this data?");
            if (confirmDelete) {
                window.location.href = route.replace('__ID__', id);
            }
        }
        </script>
        <script>
            $(document).ready(function () {
                $('#partner').change(function () {
                    var partnerId = $(this).val();
                    $('#partner_center').html('<option value="">Loading...</option>');

                    if (partnerId) {
                        $.ajax({
                            url: "{{route('admin.get_partner_centers')}}", // Update with your actual API route
                            type: 'GET',
                            data: { partner_id: partnerId },
                            success: function (response) {
                                $('#partner_center').html('<option value="">Choose Partner Center</option>');
                                $.each(response, function (key, value) {
                                    $('#partner_center').append('<option value="' + value.id + '">' + value.center_name + '</option>');
                                });
                            },
                            error: function () {
                                $('#partner_center').html('<option value="">No Data Found</option>');
                            }
                        });
                    } else {
                        $('#partner_center').html('<option value="">Choose Partner Center</option>');
                    }
                });
            });
        </script>
       <script>
    $(document).on("click", ".delete-banner", function () {
        let button = $(this);
        let bannerPath = button.data("path");

        if (confirm("Are you sure you want to delete this banner?")) {
            $.ajax({
                url: "{{ route('admin.yuwaahsakhi.setting.deleteBanner') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    banner: bannerPath
                },
                success: function (response) {
                    if (response.success) {
                        button.closest("td").remove(); // Remove the image from the table

                        // Show success message
                        $("#success-message").text(response.message).fadeIn().delay(3000).fadeOut();
                    } else {
                        alert("Failed to delete the banner.");
                    }
                },
                error: function () {
                    alert("Something went wrong.");
                }
            });
        }
    });
</script>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'YuthHub') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
         <!----======== CSS ======== -->
        <link rel="stylesheet" href="{{asset('asset/css/style.css')}}">
        <!----===== Iconscout CSS ===== -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
        <style>
            .table.table-striped.table-bordered {
                font-size: 14px;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
    @yield('content')
    @include('admin.menu')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
   const isDevelopment = window.location.hostname === "localhost" || window.location.hostname === "127.0.0.1";
   const socket = io(isDevelopment ? "http://127.0.0.1:4000" : "http://65.0.175.155:4000");
    // Listen for progress updates
    socket.on('progress', (data) => {
        const progress = Math.round((data.processedRows / data.totalRows) * 100);
        document.getElementById('progress-bar').value = progress;
        document.getElementById('loadingSpinner').style.display = 'block';
    });

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
    
    function loadDistricts(stateId) {
        if (stateId) {
            $.ajax({
                url: "{{ route('getdistricts', ['state_id' => 'REPLACE_ID']) }}".replace('REPLACE_ID', stateId),
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let districtSelect = $('#responseDistrict');
                    districtSelect.html(data.html)
                },
                error: function () {
                    alert('Failed to load districts.');
                }
            });
        } else {
            $('#district_id').empty().append('<option value="">Select District</option>');
        }
    }
$(document).ready(function() {
    // When district dropdown changes, load blocks
    $(document).on('change', '#district_id', function () {
        var districtId = $(this).val();

        if (districtId) {
            $.ajax({
                url: "{{route('getblock')}}",
                type: 'GET',
                data: { district_id: districtId },
                success: function (response) {
                    $('#blockWrapper').html(response.html);
                },
                error: function () {
                    alert('Error fetching blocks');
                }
            });
        } else {
            $('#blockWrapper').html("<select name='block_id' class='form-control' id='block_id'><option value=''>Select District First</option></select>");
        }
    });
});
</script>

<script>
    document.getElementById('discardBtn').addEventListener('click', function () {
        window.history.back();
    });
</script>
    </body>
</html>
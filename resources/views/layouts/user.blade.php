<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>User</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- for date -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!-- password icon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('asset/css/user_style.css')}}">
  <!-- <script src="index.js" defer></script> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="font-Montserrat">
 @yield('content')
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    function loadDistricts(stateId) {
        if (stateId) {
            $.ajax({
                url: '/get-districts/' + stateId,
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
</script>
<script>
$(document).ready(function() {
    // When district dropdown changes, load blocks
    $(document).on('change', '#district_id', function () {
        var districtId = $(this).val();

        if (districtId) {
            $.ajax({
                url: '/get-blocks',
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
<script src="{{asset('asset/js/index.js')}}" defer></script>
</body>
</html>
@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > Import Field Agent</span> <br />
            </div>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Please type and search">
            </div>

        </div>
        </div>
        <div id="content-container">
        </div>
        <!-- <section class="dashboard-partners"> -->
        <div class="dash-content">
            <span class="texttitle">Import Field Agent</span>
            <div class="activity">
               
                <div class="activity-data">
                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        <small>{{ session('success') }}</small>
                    </div>
                @endif

                {{-- Duplicate Countdown --}}
                @if(session()->has('duplicate_file'))
                    <div id="countdown" class="alert alert-info mt-2">
                        Download will start in 50 seconds...
                    </div>

                    <script>
                        let seconds = 05;
                        let countdown = document.getElementById("countdown");

                        let interval = setInterval(function() {
                            seconds--;
                            countdown.innerHTML = "Download will start in " + seconds + " seconds...";

                            if (seconds <= 0) {
                                clearInterval(interval);
                                window.location.href = "{{ route('download.duplicate', session('duplicate_file')) }}";
                            }
                        }, 1000);
                    </script>
                @endif
                    </div>
                    <div style="width=100%;overflow-x: auto;">
                    <form action="{{ route('admin.import.vle.action') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="table table-striped table-bordered" style="font-size:12px;">
                        <tr>
                        <td> <label for="field1"><strong>Choose Partner</strong></label></td>
                        <td>
                        <select id="partner" name="partner_id" class="form-control">
                            <option value="">Choose Partner</option>
                            <?php foreach($partnerList as $item111){ ?>
                                <option value="{{$item111['id']}}">{{$item111['name']}}</option>
                            <?php } ?>
                        </select>
                        </td>
                        </tr>
                        <tr>
                        <td> <label for="field1"><strong>Choose Partner Center</strong></label></td>
                        <td>
                            <select id="partner_center" class="form-control" name="partner_center_id">
                            <option value="">Choose Partner Center</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <td> <label for="field1"><strong>Status</strong></label></td>
                        <td>
                            <select id="field5" class="form-control" name="status">
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </td>
                        </tr>
                        <tr>
                        <td>  <label for="field4">Choose VLE CSV File</label>
                        <input type="file" name="file" id="fileInput"></td>
                        <td>
                        <button type="submit" id="saveBtn" name="submit">Import Data</button>
                        </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
   
   $(document).ready(function() {
    var progressBar = $('#progress-bar');
    var loadingSpinner = $('#loadingSpinner');
    
    // Submit form
    $('#importForm').submit(function(e) {
        e.preventDefault(); // Prevent the default form submit
        loadingSpinner.show(); // Show loading spinner
        var formData = new FormData(this);

        // Send form data to backend
        sendAjaxRequest("{{ route('admin.import.learner.action') }}", formData, function(response) {
            loadingSpinner.hide(); // Hide loading spinner when done
            console.log(response.data);
            if (response.success) {
                callNodeProcess(response.filepath);
            } else {
                console.error('Import failed');
            }
        }, function(error) {
            console.error('Error during form submission:', error);
        }, true);
    });

    // Function to send AJAX requests
    function sendAjaxRequest(url, data, successCallback, errorCallback, isProgress = false) {
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: successCallback,
            error: errorCallback,
            xhr: function() {
                if (!isProgress) return; // Skip progress tracking unless needed
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(event) {
                    if (event.lengthComputable) {
                        var percent = (event.loaded / event.total) * 100;
                        progressBar.val(percent);
                        console.log(percent);
                    }
                }, false);
                return xhr;
            }
        });
    }
    function callNodeProcess(filepath) {
        $.ajax({
            url: "http://127.0.0.1:4000/process",   // Node.js endpoint
            method: "POST",                         // POST method
            data: JSON.stringify({ filepath: filepath }), // POST body
            contentType: "application/json",        // Sending JSON
            success: function(response) {
                console.log('✅ Node.js process started successfully.');
                console.log(response); // Output the response if needed
            },
            error: function(xhr, status, error) {
                console.error('❌ Error calling Node.js process:');
                console.error('Status:', status);
                console.error('Error:', error);
                if (xhr.responseText) {
                    console.error('Response Text:', xhr.responseText);
                }
            }
        });
    }
});

</script>

@endsection

    
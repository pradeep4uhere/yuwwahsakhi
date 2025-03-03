<!-- resources/views/components/alert.blade.php -->
@if(session('success'))
    <div class="alert alert-success">
        <small>{{ session('success') }}</small>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <small>{{ session('error') }}</small>
    </div>
@endif

@extends('layouts.default')

@section('title', 'Import Learner')

@section('content')

<section class="dashboard">

    <div class="top">

        <div class="title">
            <span>Dashboard > Import Learner</span>
            <br />
        </div>

        <div class="search-box">
            <i class="uil uil-search"></i>
            <input type="text" placeholder="Please type and search">
        </div>

    </div>

    <div class="dash-content">

        <span class="texttitle">
            Import Learner
        </span>

        <div class="activity">

            <div class="activity-data">

                @if ($errors->any())

                    <div class="alert alert-danger">

                        <ul>

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif

            </div>

            <div style="width:100%; overflow-x:auto;">

                <form
                    id="importForm"
                    action="{{ route('admin.import.learner.action') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    target="_blank"
                >

                    @csrf

                    <div class="popup-grid">

                        <div class="input-container">

                            <label for="fileInput">
                                Choose Learner File
                            </label>

                            <input
                                type="file"
                                name="file"
                                id="fileInput"
                                required
                            >

                        </div>

                        <div class="formbuttons">

                            <button
                                type="reset"
                                id="discardBtn"
                            >
                                Discard
                            </button>

                            <button
                                type="submit"
                                id="saveBtn"
                                name="submit"
                            >
                                Start Import
                            </button>

                        </div>

                    </div>

                </form>

            </div>

            <div
                style="
                    margin-top:20px;
                    padding:15px;
                    background:#fff3cd;
                    border:1px solid #ffeeba;
                    border-radius:5px;
                "
            >

                <strong>Instructions:</strong>

                <ul style="margin-top:10px;">

                    <li>
                        Upload CSV file
                    </li>

                    <li>
                        Import logs will open in NEW TAB
                    </li>

                    <li>
                        You will see LIVE update/insert logs
                    </li>

                    <li>
                        Do not close import tab while processing
                    </li>

                </ul>

            </div>

        </div>

    </div>

</section>

@endsection
@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > Partner</span> <br />
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
            <span class="texttitle">All Learners</span>
            <div class="activity">
                <div class="activitybutton">
                    <a href="{{route('admin.learner.export')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">Export Learner</button>
                    </a>
                </div>
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
                @if(isset($success) && ($success!=null))
                <div class="alert alert-success">
                    <small>{{$success}}</small>
                </div>
                @endif
                    </div>
                    <div style="width=100%;overflow-x: auto;">
                    <form action="{{ route('admin.import.learner.action') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="popup-grid">
                            <div class="input-container">
                            <label for="field4">Choose Learner File</label>
                            <input type="file" name="file" >
                            </div>
                            <div class="formbuttons">
                                <button type="button" id="discardBtn">Discard</button>
                                <button type="submit" id="saveBtn" name="submit">Save Details</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
         
        </div>
    </section>

@endsection

    
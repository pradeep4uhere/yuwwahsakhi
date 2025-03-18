@extends('layouts.default')
@section('title', $title)
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > {{$title}}</span> <br />
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
        <div class="dash-content" >
            <span class="texttitle">{{$title}}</span>
            <div class="activity">
              <div class="activitybutton">
                  <a href="{{route('admin.eventmaster.list')}}">
                  <button class="add-partner-btn" id="addPartnerBtn">All {{$title}}</button>
                  </a>
              </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="yuwaahForm" method="post" style="width:70%" action="{{route('admin.eventmaster.edit',['id'=>encryptString($eventDetails['id'])])}}" enctype="multipart/form-data" >
            @csrf
            <div class="popup-grid">
              <div class="input-container">
                <label for="event_type">Name</label>
                <select name="event_type" class="form-control">
                    <option value="">Select an option</option>
                    <option value="Course" {{ $eventDetails['event_type'] == 'Course' ? 'selected' : '' }}>Course</option>
                    <option value="Social Protection" {{ $eventDetails['event_type'] == 'Social Protection' ? 'selected' : '' }}>Social Protection</option>
                    <option value="Jobs" {{ $eventDetails['event_type'] == 'Jobs' ? 'selected' : '' }}>Jobs</option>
                    <option value="Self Empl / Entrepreneurship" {{ $eventDetails['event_type'] == 'Self Empl / Entrepreneurship' ? 'selected' : '' }}>Self Employment / Entrepreneurship</option>
                </select>
              </div>
            <div class="input-container">
              <label for="event_category">Event Category</label>
              <input type="text" name="event_category" class="form-control" value="{{ $eventDetails['event_category'] }}">
            </div>
            <div class="input-container">
              <label for="description">Brief Description</label>
              <textarea name="description" class="form-control">{{ $eventDetails['description'] }}</textarea>
            </div>
            <div class="input-container">
              <label for="eligibility">Eligibility</label>
              <input type="text" name="eligibility" class="form-control" value="{{ $eventDetails['eligibility'] }}">
            </div>
            <div class="input-container">
              <label for="fee_per_completed_transaction">Fee Per Completed Transaction</label>
              <input type="number" step="1" name="fee_per_completed_transaction" class="form-control" value="{{ $eventDetails['fee_per_completed_transaction'] }}">
            </div>
            <div class="input-container">
              <label for="date_event_created_in_master">Event Date</label>
              <input type="date" name="date_event_created_in_master" class="form-control" value="{{ $eventDetails['date_event_created_in_master'] }}">
            </div>
            <div class="input-container">
              <label for="field4">Choose Document-1</label>
              <input type="file" name="document_1" placeholder="Please Choose Event Document 1">
            </div>
            <div class="input-container">
              <label for="field4">Event Date</label>
              <input type="file" name="document_2" placeholder="Please Choose Event Document 2">
            </div>
            <div class="input-container">
              <label for="field4">Event Date</label>
              <input type="file" name="document_3" placeholder="Please Choose Event Document 3">
            </div>
            <div class="input-container">
              <label for="field5">Status</label>
              <select id="field5" name="status">
                <option value="1" {{ $eventDetails['status'] == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $eventDetails['status'] == '0' ? 'selected' : '' }}>InActive</option>
              </select>
            </div>
           
            
          </div>
          <div class="popup-buttons">
            <div class="blank"></div>
            <div class="formbuttons">
              <button type="button" id="discardBtn">Discard</button>
              <button type="submit" id="saveBtn" name="submit">Save Details</button>
            </div>
          </div>
        </form>
            
        </div>
    </section>

@endsection

    
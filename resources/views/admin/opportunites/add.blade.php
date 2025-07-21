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
                    <a href="{{route('admin.opportunities.list')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">All Opportunities</button>
                    </a>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

            <form id="yuwaahForm" method="post" style="width:70%" action="{{ route('admin.opportunities.add') }}" enctype="multipart/form-data">
              @csrf
                <div class="popup-grid">
            <div class="input-container">
              <label for="field1">Opportunities Title</label>
              <input type="text" name="opportunities_title" placeholder="Please enter opportunities title" value="{{old('opportunities_title')}}" >
            </div>
            <div class="input-container">
              <label for="field2">Description</label>
              <textarea  name="description" placeholder="Please enter description" row="5" cpl="20">{{old('description')}}</textarea>
            </div>
            <div class="input-container">
              <label for="field3">Payout Monthly</label>
              <input type="number" name="payout_monthly" placeholder="Please enter payout monthly" value="{{old('payout_monthly')}}" >
            </div>
            <div class="input-container">
              <label for="field4">Number of Openings</label>
              <input type="number" name="number_of_openings" placeholder="Please Enter Number Of Oppenning" value="{{old('number_of_openings')}}">
            </div>
            <div class="input-container">
              <label for="field4">Start Date</label>
              <input type="date" name="start_date" placeholder="Please choose start Date" value="{{old('start_date')}}">
            </div>
            <div class="input-container">
              <label for="field4">End Date</label>
              <input type="date" name="end_date" placeholder="Please choose end date" value="{{old('end_date')}}">
            </div>
            <div class="input-container">
              <label for="field4">Provider Name</label>
              <input type="text" name="provider_name" placeholder="Please Enter Provider Name " value="{{old('provider_name')}}">
            </div>
            <div class="input-container">
              <label for="field4">Incentive</label>
              <input type="text" name="incentive" placeholder="Please Enter incentive " value="{{old('incentive')}}">
            </div>
            
            <div class="input-container">
              <label for="field4">Document</label>
              <input type="file" name="document" placeholder="Please Choose Document ">
            </div>
            
            <div class="input-container">
              <label for="field5">Status</label>
              <select id="field5" name="status">
                <option value="1">Active</option>
                <option value="0">InActive</option>
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

    
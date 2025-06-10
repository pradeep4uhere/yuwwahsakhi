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

            <div class="table-containers">
          <table class="table table-striped table-bordered">
          <form id="yuwaahForm" method="post" style="width:70%" action="{{route('admin.eventtype.edit',['id'=>encryptString($eventDetails['id'])])}}" enctype="multipart/form-data" >
            @csrf
            <tr>
              <td><label for="event_type">Name</label></td>
              <td><input type="text" name="name" class="form-control" value="{{ $eventDetails['name'] }}"></td>
            </tr>
            <tr>
            <td><label for="description">Brief Description</label></td>
            <td><input type="text" name="description" class="form-control" value="{{ $eventDetails['description'] }}"/></td>
            </tr>
            <tr>
            <td><label for="field5">Status</label></td>
            <td>
            <div class="input-container">
            <select id="field5" name="status">
                <option value="1" {{ $eventDetails['status'] == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $eventDetails['status'] == '0' ? 'selected' : '' }}>InActive</option>
              </select>
            </div>
            </td>
          </tr>
          <tr>
           <td></td>
           <td>
           <div class="popup-buttons">
            <div class="blank"></div>
            <div class="formbuttons">
              <button type="button" id="discardBtn">Discard</button>
              <button type="submit" id="saveBtn" name="submit">Save Details</button>
            </div>
            </div>
          </td>
          </tr>
        </form>
        </table>
        </div>

            
        </div>
    </section>

@endsection

    
@extends('layouts.default')
@section('title', 'Partner List')
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
                    <a href="{{route('admin.partnercenter')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">All Partner Center</button>
                    </a>
                </div>
                @if(isset($errors) && ($errors!=null))
                <div class="alert alert-danger">
                    @foreach ($errors as $field => $fieldErrors)
                            @foreach ($fieldErrors as $error)
                                <small>{{ ucfirst($field) }}: {{ $error }}</small><br/>
                            @endforeach
                    @endforeach
                </div>
                @endif
                @if(isset($success) && ($success!=null))
                <div class="alert alert-success">
                    <small>{{$success}}</small>
                </div>
                @endif



          <form id="yuwaahForm" method="post" style="width:70%" action="{{route('admin.partnercenter.edit',['id'=>encryptString($partnerDetails['id'])])}}">
          @csrf
          <div class="popup-grid">
            <div class="input-container">
              <label for="field1">Center Name</label>
              <input type="text" name="center_name" placeholder="Please enter Partner Center Name" value="{{$partnerDetails['center_name']}}">
            </div>
            <div class="input-container">
              <label for="field2">Email Address</label>
              <input type="email" name="email" placeholder="Please enter Email Address" value="{{$partnerDetails['email']}}">
            </div>
            <div class="input-container">
              <label for="field3">Contact Number</label>
              <input type="text" name="contact_number" placeholder="Please Contact Number" value="{{$partnerDetails['contact_number']}}">
            </div>
            <div class="input-container">
              <label for="field4">Address</label>
              <input type="text" name="address" placeholder="Please address" value="{{$partnerDetails['address']}}">
            </div>
            <div class="input-container">
              <label for="field5">choose Partner</label>
              <select id="field5" name="partner_id">
                <?php foreach($partnerList as $item){ ?>
                  <option value="{{$item['id']}}" <?php if($item['id']==$partnerDetails['partner_id']){ ?> selected="selected" <?php } ?>>{{$item['name']}}</option>
                <?php } ?>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">Status</label>
              <select id="field5" name="status">
                <option value="1" <?php if($partnerDetails['status']==1){ ?> selected="selected" <?php } ?>>Active</option>
                <option value="0" <?php if($partnerDetails['status']==0){ ?> selected="selected" <?php } ?>>InActive</option>
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

    
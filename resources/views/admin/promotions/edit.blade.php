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
                    <a href="{{route('admin.promotions.list')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">All {{$page_title}}</button>
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



          <form id="yuwaahForm" method="post" style="width:70%" action="{{route('admin.promotions.update',['id'=>encryptString($details['id'])])}}" enctype="multipart/form-data">
          @csrf
          <div class="popup-grid">
            <div class="input-container">
              <label for="field1">Promotional Descriptions</label>
              <textarea name="promotional_descriptions" placeholder="Please enter Promotional Descriptions" row="10" cols="50">{{$details['promotional_descriptions']}}</textarea>
            </div>
            <div class="input-container">
              <label for="field4">Material File</label>
              <input type="file" name="material_file">
            </div>
            <div class="input-container">
              <label for="field4">Thumbnail File</label>
              <input type="file" name="thumbnail">
            </div>
            <div class="input-container">
              <label for="field4">Banner File</label>
              <input type="file" name="banner">
            </div>
            <div class="input-container">
              <label for="field5">Status</label>
              <select id="field5" name="status">
                <option value="1" <?php if($details['status']==1){ ?>  selected="selected" <?php } ?>> Active </option>
                <option value="0" <?php if($details['status']==0){ ?>  selected="selected" <?php } ?>>InActive</option>
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

    
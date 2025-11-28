@extends('layouts.default')
@section('title', 'Placement Partner Edit')
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
                    <a href="{{route('admin.pppartner')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">All Placment Partner Center</button>
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

          <div class="table-containers">
          <form id="yuwaahForm" method="post" style="width:99%" action="{{route('admin.pppartner.edit',['id'=>encryptString($partnerDetails['id'])])}}">
          @csrf
          <table class="table table-striped table-bordered" style="font-size:12px;">
          <tr>
            <td> <label for="field1"><strong>Placement Partner Name</strong></label></td>
            <td> <label for="field1"><strong>PP Code</strong></label></td>
          </tr>
          <tr>
            <td>
                  <input type="text" class="form-control" name="name" placeholder="Please enter Name" value="{{$partnerDetails['name']}}">
              </td> 
              <td>
                  <input type="text" class="form-control" name="pp_code" placeholder="Please enter Code" value="{{$partnerDetails['pp_code']}}">
              </td> 
            </tr>
            <tr>
            <td> <label for="field3"><strong>Contact Number</strong></label></td>
            <td>  <label for="field5"><strong>Status</strong></label></td>
            </tr>
            <tr>
            <td> 
            <div class="input-container">
              <input type="text" name="phone" placeholder="Please Contact Number" value="{{$partnerDetails['phone']}}"  minlength="10" maxlength="10" 
       pattern="\d{10}" 
       title="Please enter exactly 10 digits" >
            </div>
            </td>
            <td> 
             
              <select id="field5" name="status" class="form-control">
                <option value="1" <?php if($partnerDetails['status']==1){ ?> selected="selected" <?php } ?>>Active</option>
                <option value="0" <?php if($partnerDetails['status']==0){ ?> selected="selected" <?php } ?>>InActive</option>
              </select>
            </td>
            </tr>
            <tr>
            <td> <label for="field3"><strong>Login Email</strong></label></td>
            <td>  <label for="field5"><strong>Password</strong></label></td>
            </tr>
            <tr>
            <td>
              <div class="input-container">
                <input type="email" name="email" placeholder="Please enter Email Address" value="{{$partnerDetails['email']}}">
              </div>
            </td>
            <td><input type="text" name="password" class="form-control" placeholder="Please enter password" value="password@123"></td>
            </tr>
          </div>
          <tr>
            <td colspan="2">  <div class="popup-buttons">
            <div class="blank"></div>
            <div class="formbuttons">
              <button type="button" id="discardBtn">Discard</button>
              <button type="submit" id="saveBtn" name="submit">Save Details</button>
            </div>
          </div></td>
            </tr>
         
        </table>
        </form>
        </div>     
        </div>
    </section>

@endsection

    
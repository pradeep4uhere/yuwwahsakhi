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
                    <a href="{{route('admin.partner')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">All Partner</button>
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
          <form id="yuwaahForm" method="post" style="width:70%" action="{{route('admin.partner.add')}}">
          @csrf
          <div class="popup-grid">
            <div class="input-container">
              <label for="field1">Name</label>
              <input type="text" name="name" placeholder="Please enter Partner Name" value="{{$inputs['name']}}">
            </div>
            <div class="input-container">
              <label for="field1">Partner ID</label>
              <input type="text" name="partner_id" placeholder="Please enter Partner Id" value="{{$inputs['partner_id']}}">
            </div>
            <div class="input-container">
              <label for="field2">Email Address</label>
              <input type="email" name="email" placeholder="Please enter Email Address" value="{{$inputs['email']}}">
            </div>
            <div class="input-container">
              <label for="field3">Contact Number</label>
              <input type="text" name="contact_number" placeholder="Please Contact Number" value="{{$inputs['contact_number']}}">
            </div>
            <div class="input-container">
              <label for="field3">Choose State</label>
              {!! getStateList('state_id', $inputs['state_id'], '', "loadDistricts(this.value)") !!}
            </div>
          <div class="input-container">
            <label for="district" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">District</label>
            <?php $class = "w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500";?>
            <div id="responseDistrict">{!!getDistrict($inputs['state_id'], 'district_id',$inputs['district_id'],$class)!!}</div>
          </div>

          <div class="input-container">
            <label for="block" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Block/City</label>
            <?php $class = "w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500";?>
            <div id="blockWrapper">{!!getBlock($inputs['district_id'], 'block_id',$inputs['block_id'],$class)!!}</div>
          </div>
          
            <div class="input-container">
              <label for="field4">Address</label>
              <input type="text" name="address" placeholder="Please address">
            </div>
            <div class="input-container">
              <label for="field4">Pincode</label>
              <input type="text" name="pincode" placeholder="Please pincode">
            </div>
            <div class="input-container">
              <label for="field5">Status</label>
              <select id="field5" name="status" style="padding:12px">
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

    
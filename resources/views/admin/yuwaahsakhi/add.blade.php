@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<style>
  select {
  padding: 10px !important;
}

select option {
  padding: 10px !important;
}
</style>
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
            <a href="{{route('admin.yuwaahsakhi.list')}}">
              <button class="add-partner-btn" id="addPartnerBtn">All {{$title}}</button>
              </a>
          </div>
    <form id="yuwaahForm" method="post" action="{{ route('admin.yuwaahsakhi.add') }}" enctype="multipart/form-data" >
          @csrf
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <div class="popup-grid">
            <div class="input-container">
              <label for="field1">{{__('Name')}}</label>
              <input type="text" name="name" placeholder="Please enter Yuwaah sakhi name"  value="{{ old('name') }}">
            </div>
            <div class="input-container">
              <label for="field1">{{__('messages.contact_number')}}</label>
              <input type="number" name="contact_number" placeholder="Please enter contact number" value="{{ old('contact_number') }}">
            </div>
            <div class="input-container">
              <label for="field1">{{__('email')}}</label>
              <input type="email" name="email" placeholder="Please enter Email" value="{{ old('email') }}">
            </div>
            <div class="input-container">
              <label for="field3">Choose State</label>
              <?php $class = "w-[330px] h-[50px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[500] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500 p-[20px]";?>
              {!! getStateList('state_id', '', $class, "loadDistricts(this.value)") !!}
            </div>

            <div class="input-container">
              <label for="district" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">District</label>
              <?php $class = "w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500 p-[20px]";?>
              <div id="responseDistrict">{!!getDistrict('','district_id','',$class)!!}</div>
            </div>
            <div class="input-container">
            <label for="block" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Block/City</label>
            <?php $class = "w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500 p-[20px]";?>
            <div id="blockWrapper">{!!getBlock('','block_id','',$class)!!}</div>
            
          </div>
            <div class="input-container">
              <label for="field1">{{__('address')}}</label>
              <input type="text" name="address" placeholder="Please enter address" value="{{ old('address') }}">
            </div>
            <div class="input-container">
              <label for="field1">{{__('Pincode')}}</label>
              <input type="text" name="pincode" placeholder="Please enter pincode"  value="{{ old('pincode') }}">
            </div>


            
            <div class="input-container">
              <label for="field4">{{__('Knowledge of English')}}</label>
              <select name="english_proficiency">
                <option value="No" {{ old('english_proficiency') == 'No' ? 'selected' : '' }}>No</option>
                <option value="Yes" {{ old('english_proficiency') == 'Yes' ? 'selected' : '' }}>Yes</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field4">Date Of Birth</label>
              <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
            </div>
            <div class="input-container">
              <label for="field4">Gender</label>
              <select name="gender">
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">Education Level</label>
              <?php $educationOptions = getGlobalList('EducationLevel');  //dd($options21);?>
              <select name="education_level">
                @foreach($educationOptions as $id => $education)
                    <option value="{{ $id }}" {{ old('education_level') == $id ? 'selected' : '' }}>{{ $education }}</option>
                @endforeach
            </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Specific Qualification')}}</label>
              <select id="field5" name="specific_qualification">
                <option value="1">Active</option>
                <option value="0">InActive</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Loan Taken')}}</label>
              <select id="field5" name="loan_taken">
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Type of loan')}}</label>
              <select id="field5" name="type_of_loan">
              <?php $options3 = getGlobalList('LoanType'); ?>
                <?php foreach($options3 as $ll=>$item3){ ?>
                <option value="{{$ll}}">{{$item3}}</option>
                <?php } ?>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Loan Amount')}}</label>
              <input type="number" name="loan_amount" value="{{ old('loan_amount') }}">
            </div>
            <div class="input-container">
              <label for="field5">{{__('Loan Balance')}}</label>
              <input type="number" name="loan_balance" value="{{ old('loan_balance') }}">
            </div>
            <div class="input-container">
              <label for="field5">{{__('English Proficiency')}}</label>
              <select id="field5" name="english_proficiency">
                <option value="Basic">Basic</option>
                <option value="Conversational">Conversational</option>
                <option value="Fluent">Fluent</option>
                <option value="Native">Native</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Years of work exp')}}</label>
              <input type="text" name="years_of_work_exp" value="{{ old('years_of_work_exp') }}">
            </div>
            <div class="input-container">
              <label for="field5">{{__('Work hour per day')}}</label>
              <input type="text" name="work_hour_per_day" value="{{ old('work_hour_per_day') }}">
            </div>
            <div class="input-container">
              <label for="field5">{{__('Infrastructure available')}}</label>
              <select id="field5" name="infrastructure_available">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Service Offered')}}</label>
              <select id="field5" name="service_offered">
              <?php $options1 = getGlobalList('ServicesOffered'); ?>
                <?php foreach($options1 as  $gg=>$item){ ?>
                <option value="{{$gg}}">{{$item}}</option>
                <?php } ?>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Course Completed')}}</label>
              <select id="field5" name="course_completed">
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="input-container">
             
              <label for="field5">{{__('Digital Proficiency')}}</label>
              <select id="field5" name="digital_proficiency">
              <?php $options111 = getGlobalList('DigitalProficiencyLevel'); ?>
                <?php foreach($options111 as  $dp=>$item111){ ?>
                <option value="{{$dp}}">{{$item111}}</option>
                <?php } ?>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Center Photo')}}</label>
              <input type="file" name="center_photo"/>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Profile Photo')}}</label>
              <input type="file" name="profile_photo"/>
            </div>
            <div class="input-container">
            <label for="partner">{{__('messages.choose_partner')}}</label>
            <select id="partner" name="partner_id">
                <option value="">Choose Partner</option>
                <?php foreach($partnerList as $item111){ ?>
                    <option value="{{$item111['id']}}">{{$item111['name']}}</option>
                <?php } ?>
            </select>
        </div>

        <div class="input-container">
            <label for="partner_center">{{__('messages.choose_partner_center')}}</label>
            <select id="partner_center" name="partner_center_id">
                <option value="">Choose Partner Center</option>
            </select>
        </div>
            <div class="input-container">
              <label for="field5">{{__('status')}}</label>
              <select id="field5" name="status">
               <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
               <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
              </select>
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

    
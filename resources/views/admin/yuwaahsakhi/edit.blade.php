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
                  <a href="{{route('admin.yuwaahsakhi.list')}}">
                    <button class="add-partner-btn" id="addPartnerBtn">All {{$page_title}}</button>
                    </a>
                </div>
              @if(!empty($errors) && ($errors!=null))
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

          <?php //dd($yuwaahsakhi);?>
          <form id="yuwaahForm" method="post" action="{{ route('admin.yuwaahsakhi.update', ['id'=>encryptString($yuwaahsakhi->id)])}}" enctype="multipart/form-data" >
          @csrf
          @method('PUT')
        
          <div class="popup-grid">
            <div class="input-container">
              <label for="field1">{{__('Name')}}</label>
              <input type="text" name="name" placeholder="Please enter Yuwaah sakhi name"  value="{{ $yuwaahsakhi['name'] }}">
            </div>
            <div class="input-container">
              <label for="field1">{{__('contact_number')}}</label>
              <input type="number" name="contact_number" placeholder="Please enter contact number" value="{{ $yuwaahsakhi['contact_number'] }}">
            </div>
            <div class="input-container">
              <label for="field1">{{__('email')}}</label>
              <input type="email" name="email" placeholder="Please enter Email" value="{{ $yuwaahsakhi['email'] }}">
            </div>
            <div class="input-container">
              <label for="field1">{{__('state')}}</label>
              <input type="text" name="state" placeholder="Please enter state" value="{{ $yuwaahsakhi['state'] }}">
            </div>

            <div class="input-container">
              <label for="field1">{{__('distict')}}</label>
              <input type="text" name="distict" placeholder="Please enter distict" value="{{ $yuwaahsakhi['distict'] }}">
            </div>
            <div class="input-container">
              <label for="field1">{{__('address')}}</label>
              <input type="text" name="address" placeholder="Please enter address"  value="{{ $yuwaahsakhi['address'] }}">
            </div>

            
            <div class="input-container">
              <label for="field4">{{__('Knowledge of English')}}</label>
              <select name="english_proficiency">
                <option value="No" {{ $yuwaahsakhi['english_proficiency'] == 'No' ? 'selected' : '' }}>No</option>
                <option value="Yes" {{ $yuwaahsakhi['english_proficiency'] == 'Yes' ? 'selected' : '' }}>Yes</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field4">Date Of Birth</label>
              <input type="date" name="date_of_birth" value="{{ $yuwaahsakhi['dob'] }}">
            </div>
            <div class="input-container">
              <label for="field4">Gender</label>
              <select name="gender">
                <option value="Male" {{ $yuwaahsakhi['gender'] == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $yuwaahsakhi['gender'] == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">Education Level</label>
              <?php $educationOptions = getGlobalList('EducationLevel');  //dd($options21);?>
              <select name="education_level">
                @foreach($educationOptions as $id => $education)
                    <option value="{{ $id }}" {{  $yuwaahsakhi['education_level'] == $id ? 'selected' : '' }}>{{ $education }}</option>
                @endforeach
            </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Specific Qualification')}}</label>
              <select id="field5" name="specific_qualification">
                <option value="1" {{  $yuwaahsakhi['specific_qualification'] == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{  $yuwaahsakhi['specific_qualification'] == 0 ? 'selected' : '' }}>InActive</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('Loan Taken')}}</label>
              <select id="field5" name="loan_taken">
                <option value="Yes" {{  $yuwaahsakhi['loan_taken'] == 'Yes' ? 'selected' : '' }}>Yes</option>
                <option value="No" {{  $yuwaahsakhi['loan_taken'] == 'No' ? 'selected' : '' }}>No</option>
                
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('type_of_loan')}}</label>
              <select id="field5" name="type_of_loan">
              <?php $options3 = getGlobalList('LoanType'); ?>
                <?php foreach($options3 as $ll=>$item3){ ?>
                <option value="{{$ll}}" {{  $yuwaahsakhi['type_of_loan'] == $ll ? 'selected' : '' }}>{{$item3}}</option>
                <?php } ?>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('loan_amount')}}</label>
              <input type="number" name="loan_amount" value="{{ $yuwaahsakhi['loan_amount'] }}">
            </div>
            <div class="input-container">
              <label for="field5">{{__('loan_balance')}}</label>
              <input type="number" name="loan_balance" value="{{ $yuwaahsakhi['loan_balance'] }}">
            </div>
            <div class="input-container">
              <label for="field5">{{__('english_proficiency')}}</label>
              <select id="field5" name="english_proficiency">
                <option value="Basic" {{  $yuwaahsakhi['english_proficiency'] == $ll ? 'selected' : '' }}>Basic</option>
                <option value="Conversational" {{  $yuwaahsakhi['english_proficiency'] == $ll ? 'selected' : '' }}>Conversational</option>
                <option value="Fluent" {{  $yuwaahsakhi['english_proficiency'] == $ll ? 'selected' : '' }}>Fluent</option>
                <option value="Native" {{  $yuwaahsakhi['english_proficiency'] == $ll ? 'selected' : '' }}>Native</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('years_of_work_exp')}}</label>
              <input type="text" name="years_of_work_exp" value="{{ $yuwaahsakhi['year_of_exp'] }}">
            </div>
            <div class="input-container">
              <label for="field5">{{__('work_hour_per_day')}}</label>
              <input type="text" name="work_hour_per_day" value="{{ $yuwaahsakhi['work_hour_in_day'] }}">
            </div>
            <div class="input-container">
              <label for="field5">{{__('infrastructure_available')}}</label>
              <select id="field5" name="infrastructure_available">
                <option value="1" {{  $yuwaahsakhi['infrastructure_available'] == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{  $yuwaahsakhi['infrastructure_available'] == 0 ? 'selected' : '' }}>No</option>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('service_offered')}}</label>
              <select id="field5" name="service_offered">
              <?php $options1 = getGlobalList('ServicesOffered'); ?>
                <?php foreach($options1 as  $gg=>$item){ ?>
                <option value="{{$gg}}" {{  $yuwaahsakhi['service_offered'] == $gg ? 'selected' : '' }}>{{$item}}</option>
                <?php } ?>
              </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('course_completed')}}</label>
              <select id="field5" name="course_completed">
                <option value="1" {{  $yuwaahsakhi['course_completed'] == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{  $yuwaahsakhi['course_completed'] == '0' ? 'selected' : '' }}>No</option>
              </select>
            </div>
            <div class="input-container">
             
              <label for="field5">{{__('digital_proficiency')}}</label>
              <select id="field5" name="digital_proficiency">
              <?php $options111 = getGlobalList('DigitalProficiencyLevel'); ?>
                <?php foreach($options111 as  $dp=>$item111){ ?>
                <option value="{{$dp}}" {{  $yuwaahsakhi['digital_proficiency'] == $dp ? 'selected' : '' }}>{{$item111}}</option>
                <?php } ?>
              </select>
            </div>
            <div class="input-container">
                <label for="partner">{{__('messages.choose_partner')}}</label>
                <select id="partner" name="partner_id">
                    <option value="">Choose Partner</option>
                    <?php foreach($partnerList as $item111){ ?>
                        <option value="{{$item111['id']}}" <?php if($item111['id'] == $yuwaahsakhi['partner_id']){  ?> selected <?php } ?>>{{$item111['name']}}</option>
                    <?php } ?>
                </select>
            </div>

            <div class="input-container">
                <label for="partner_center">{{__('messages.choose_partner_center')}}</label>
                <select id="partner_center" name="partner_center_id">
                    <option value="">Choose Partner Center</option>
                    <option value="{{ $yuwaahsakhi['partner_center_id'] ?? '' }}" selected="selected">
                      {{ optional($yuwaahsakhi['PartnerCenter'])->center_name ?? 'N/A' }}
                  </option>
                </select>
            </div>
            <div class="input-container">
              <label for="field5">{{__('center_photo')}}</label>
              <input type="file" name="center_photo"/>
            </div>
            <div class="input-container">
              <label for="field5">{{__('profile_photo')}}</label>
              <input type="file" name="profile_photo"/>
            </div>
            <div class="input-container">
              <label for="field5">{{__('status')}}</label>
              <select id="field5" name="status">
               <option value="1" {{ $yuwaahsakhi['status'] == 1 ? 'selected' : '' }}>Active</option>
               <option value="0" {{ $yuwaahsakhi['status'] == 0 ? 'selected' : '' }}>Inactive</option>
              </select>
            </div>
          <div class="popup-buttons">
            <div class="blank"></div>
            <div class="formbuttons">
              <button type="button" id="discardBtn">Discard</button>
              <input type="hidden" name="id" value="{{$yuwaahsakhi['id']}}">
              <button type="submit" id="saveBtn" name="submit">Save Details</button>
            </div>
          </div>
          
        </form>
        </div>
        </div>
    </section>

@endsection

    
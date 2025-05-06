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
        <div class="title" >
            <span class="">Dashboard > {{$title}}</span> <br />
        </div>
    </div>
    </div>
   
    <!-- <section class="dashboard-partners"> -->
    <div class="dash-content" style="margin-top:10px;">
      <span class="texttitle" >{{$title}}</span>
      <div class="activity">
          <div class="activitybutton">
            <a href="{{route('admin.yuwaahsakhi.list')}}">
              <button class="add-partner-btn" id="addPartnerBtn">All {{$title}}</button>
              </a>
          </div>
    </div>
    </div>
  <div id="screen8" class="max-w-md mx-auto p-6  ">
  <div class="flex justify-center">
    <?php if($userDetails['ProfilePicture']){ ?>
      <img src="{{$userDetails['ProfilePicture']}}" alt="Profile Logo" class="h-16 w-16 rounded-full border border-gray-300">
      <?php }else{ ?>
    <img src="{{ asset('asset/images/Profilelogo.png') }}" alt="Profile Logo" class="h-16 w-16 rounded-full border border-gray-300">
    <?php } ?>
  </div>
  @php
      $profileFields = [
        'Date of Birth' => 'DateOfBirth',
        'Gender' => 'Gender',
        'Email Address' => 'Email',
        'Mobile Number' => 'ContactNumber',
        'Address' => 'Address',
        'District' => 'District',
        'State' => 'State',
        'Block' => 'Block',
        'Pin Code' => 'Pincode',
        'YS ID' => 'sakhiId',
        'Education Level' => 'EducationLevel',
        'Digital Proficiency' => 'DigitalProficiency',
        'English Knowledge' => 'EnglishProficiency',
        'Year of Experience' => 'YearOfExp',
        'No. of Hours I can work/Day' => 'WorkHourInDay',
        'Infrastructure Available' => 'InfrastructureAvailable',
        'Service Offered' => 'ServiceOffered',
        'Course Completed' => 'CoursesCompleted',
        'Loan Taken' => 'LoanTaken',
        'Loan Type' => 'TypeOfLoan',
        'Loan Amount' => 'LoanAmount',
        'Loan Balance' => 'LoanBalance',
      ];
    @endphp
  <h2 class="text-center text-lg font-semibold text-gray-800 mb-2">{{ $userDetails['Name'] }}</h2>
  <div class="space-y-4 text-sm text-gray-700">
    <div class="table-containers">
    <table class="table table-striped table-bordered">
    @foreach ($profileFields as $label => $field)
    <tr>
      <td>
        <span class="text-gray-300 w-1/2 font-medium">{{ $label }}</span>
      </td>
          <td>
        <span class="w-1 text-right text-gray-400">
          {{ in_array($field, ['LoanAmount', 'LoanBalance']) ? ($userDetails[$field] . ' INR') : $userDetails[$field] }}
        </span>
      </td>
    </tr>
    @endforeach
   
    </table>
    </div>
  </div>
</div>

    </section>
@endsection

    
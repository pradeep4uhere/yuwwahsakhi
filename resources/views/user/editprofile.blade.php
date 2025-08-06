@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    <div id="screen8s" class=" max-w-sm mx-auto p-4 bg-white rounded-lg">
      @include('user.header')
      <div class="flex justify-between items-center mt-14">
        <h1>My Profile</h1>
      </div>
      @if (session('error'))
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
      @endif
      @if (session('success'))
      <div class="bg-green-100 text-green-700 p-4 rounded mb-4 mt-5">
        {{ session('success') }}
      </div>
      @endif

      @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="flex justify-center mt-4">
        @if($userDetails['ProfilePicture']!='')
        <img src="{{asset($userDetails['ProfilePicture'])}}" alt="profileLogo" class="h-14">
        @else
        <img src="{{asset('asset/images/Profilelogo.png')}}" alt="profileLogo" class="h-14">
        @endif
        <!-- <div class="rounded-full bg-blue-600 w-20 h-20">
          </div> -->
      </div>
      <p class="text-center">{{$userDetails['Name']}}</p>
        <div class="mt-4 text-xs">
        <div class="flex gap-4 ">
          <p class="w-1/2 font-semibold">{{__('messages.name')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="text" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="name" value="{{$userDetails['Name']}}"/>
        </div>
          <div class="flex gap-4 ">
          <p class="w-1/2 font-semibold">{{__('messages.date_of_birth')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="date" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="date_of_birth" value="{{$userDetails['DateOfBirth']}}"/>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.gender')}}</p>
        </div>

        <div class="flex gap-4">
          <select name="gender" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]">
            <option value="Male" @if($userDetails['Gender'] == 'Male') selected @endif>Male</option>
            <option value="Female" @if($userDetails['Gender'] == 'Female') selected @endif>Female</option>
            <option value="Other" @if($userDetails['Gender'] == 'Other') selected @endif>Other</option>
          </select>
      </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.email')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="email" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="email" value="{{$userDetails['Email']}}"/>
        </div>


       
        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.Address')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="text" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="address" value="{{$userDetails['Address']}}"/>
        </div>
        

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.State')}}</p>
        </div>
        <div class="flex gap-4 ">
          <?php $class = "mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]";?>
          {!! getStateList('state_id', $userDetails['State'], $class, "loadDistricts(this.value)") !!}

        </div>
        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.District')}}</p>
        </div>
        <div class="flex gap-4" id="responseDistrict">
        <?php $class = "mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]";?>
          {!!getDistrict($userDetails['State'], 'district_id',$userDetails['District'],$class)!!}
        </div>
        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.Block')}}</p>
        </div>
        <div class="flex gap-4" id="blockWrapper">
        <?php $class = "mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]";?>
          {!!getBlock($userDetails['District'],'block_id',$userDetails['Block'],$class)!!}
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.pincode')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="text" pattern="^\d{6}$" maxlength="6" inputmode="numeric" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="pincode" value="{{$userDetails['Pincode']}}"/>
        </div>
        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.education_level')}}</p>
        </div>
        <div class="flex gap-4 ">
       
        <select name="education_level" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]">
            @foreach(getGlobalList('EducationLevel') as $k=>$item)
             <option value="{{$k}}" @if($userDetails['EducationLevel'] == $k) selected @endif>{{$item}}</option>
            @endforeach
          </select>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.digital_profiency')}}</p>
        </div>
        <div class="flex gap-4 ">
         
        <select name="digita_proficiency" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]">
            @foreach(getGlobalList('DigitalProficiencyLevel') as $k=>$items)
             <option value="{{$k}}" @if($userDetails['DigitalProficiency'] == $k) selected @endif>{{$items}}</option>
            @endforeach
          </select>
        </div>


        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.education_level')}}</p>
        </div>
        <div class="flex gap-4 ">
        <select name="englis_proficiency" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]">
          <option value="Basic" {{ $userDetails['EnglishProficiency'] == 'Basic' ? 'selected' : '' }}>Basic</option>
          <option value="Conversational" {{ $userDetails['EnglishProficiency'] == 'Conversational' ? 'selected' : '' }}>Conversational</option>
          <option value="Fluent" {{ $userDetails['EnglishProficiency'] == 'Fluent' ? 'selected' : '' }}>Fluent</option>
          <option value="Native" {{ $userDetails['EnglishProficiency'] == 'Native' ? 'selected' : '' }}>Native</option>
          </select>
        </div>
        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.Year_of_Experience')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="text" pattern="^\d{2}$" maxlength="2" inputmode="numeric" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="year_of_exp" value="{{$userDetails['YearOfExp']}}"/>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.No_of_Hours')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input oninput="validateWorkHours(this)" type="text"  pattern="^\d{1,2}$"  maxlength="2" inputmode="numeric" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="WorkHourInDay" value="{{$userDetails['WorkHourInDay']}}"/>
        </div>
        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.Infrastructure_Available')}}</p>
        </div>
        <div class="flex gap-4 ">
        <select name="InfrastructureAvailable" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]">
          <option value="Basic" {{ $userDetails['InfrastructureAvailable'] == 'Yes' ? 'selected' : '' }}>Yes</option>
          <option value="Conversational" {{ $userDetails['InfrastructureAvailable'] == 'No' ? 'selected' : '' }}>No</option>
          </select>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.Service_Offered')}}</p>
        </div>
        <div class="flex gap-4 ">
        <select name="ServiceOffered" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]">
            @foreach(getGlobalList('ServicesOffered') as $k=>$items)
             <option value="{{$k}}" @if($userDetails['ServiceOffered'] == $k) selected @endif>{{$items}}</option>
            @endforeach
          </select>
        </div>
        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.Specific_Qualifications')}}</p>
        </div>
        <div class="flex gap-4 ">
        <select name="specific_qualification" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]">
            @foreach(getGlobalList('SpecificationQualification') as $k=>$items)
             <option value="{{$k}}" @if($userDetails['SpecificQualification'] == $items) selected @endif>{{$items}}</option>
            @endforeach
          </select>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.Course_Completed')}}</p>
        </div>
        <div class="flex gap-4 ">
        <select name="CoursesCompleted" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]">
          <option value="Yes" {{ $userDetails['CoursesCompleted'] == 'Yes' ? 'selected' : '' }}>Yes</option>
          <option value="No" {{ $userDetails['CoursesCompleted'] == 'No' ? 'selected' : '' }}>No</option>
          </select>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.Loan_Taken')}}</p>
        </div>
        <div class="flex gap-4 ">
        <select name="LoanTaken" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]">
          <option value="Yes" {{ $userDetails['LoanTaken'] == 'Yes' ? 'selected' : '' }}>Yes</option>
          <option value="No" {{ $userDetails['LoanTaken'] == 'No' ? 'selected' : '' }}>No</option>
          </select>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.loan_type')}}</p>
        </div>
        <div class="flex gap-4 ">
        <select name="loantype" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]">
            @foreach(getGlobalList('LoanType') as $k=>$items)
             <option value="{{$k}}" @if($userDetails['TypeOfLoan'] == $items) selected @endif>{{$items}}</option>
            @endforeach
          </select>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.loan_amount')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="number" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="LoanAmount" value="{{$userDetails['LoanAmount']}}"/>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.loan_balance')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="number" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="LoanBalance" value="{{$userDetails['LoanBalance']}}"/>
        </div>
        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.profile_picture')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="file" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="profile_picture"/>
        </div>
      </div>
      <div class="flex justify-center ">
          <button class="w-[250px] h-[40px] rounded-[8px] mt-[1rem] mb-[8rem] bg-[#28388F] text-[#FFFFFF]  py-1 pb-[6px] text-[14px] font-[600]">
            Save 
          </button>
        </div>
    </div>
  </div>
  <script>
  function validateWorkHours(input) {
    let value = parseInt(input.value, 10);

    if (value > 24) {
      input.value = 24;
    } else if (value < 0 || isNaN(value)) {
      input.value = '';
    }
  }
</script>
@include('user.bottom_menu')
@endsection

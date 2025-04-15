@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    <div id="screen8" class=" max-w-sm mx-auto p-4 bg-white rounded-lg">
      @include('user.header')
      <div class="flex justify-between items-center">
        <h1>My Profile</h1>
        <a href="{{route('profile.profiledit')}}"
          class="cursor-pointer px-3 py-2 bg-[#28388F1A] text-[11px] rounded-[10px] text-[#28388F] font-Montserrat">
          Edit Profile
        </a>
      </div>


    

      <div class="flex justify-center mt-4">
        <img src="{{asset('asset/images/Profilelogo.png')}}" alt="profileLogo" class="h-14">
        <!-- <div class="rounded-full bg-blue-600 w-20 h-20">
          </div> -->
      </div>
      <p class="text-center">{{$userDetails['Name']}}</p>
      <div class="mt-4 text-xs">
        <div class="flex gap-4 ">
          <p class="w-1/2 font-semibold">Date of Birth</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['DateOfBirth']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">gender</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['Gender']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Email Address</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['Email']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Mobile Number</p>
          <span class="flex items-center gap-2   w-1/2 text-gray-600">
            <p>+91-{{$userDetails['ContactNumber']}}</p>
            <img src="Images/Profile-star.png" alt="" class="h-[12px] w-[12px]">
            <p class="text-[#05A7D1]">verified</p>
          </span>
        </div>


        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Address</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['Address']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">District</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['District']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">State</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['State']}}</p>
        </div>
        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">District</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['District']}}</p>
        </div>
        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Block</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['Block']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Pin Code</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['Pincode']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">YS ID</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['sakhiId']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Education level</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['EducationLevel']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Digital Profiency</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['DigitalProficiency']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">English Knowledge</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['EnglishProficiency']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Year of Experience</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['YearOfExp']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">No. of Hours I can work/Day</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['WorkHourInDay']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Infrastructure Available</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['InfrastructureAvailable']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Service Offered</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['ServiceOffered']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Course Completed</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['CoursesCompleted']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Loan Taken</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['LoanTaken']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Loan Type</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['TypeOfLoan']}}</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Loan Amount</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['LoanAmount']}} INR</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Loan Balance</p>
          <p class="w-1/2 text-gray-600">{{$userDetails['LoanBalance']}} INR</p>
        </div>
      </div>

     

    </div>
     

  </div>
@include('user.bottom_menu')
<script src="{{asset('asset/js/index.js')}}" defer></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
      const dropdownBtn = document.getElementById("dropdownBtn");
      const dropdownMenu = document.getElementById("dropdownMenu");

      dropdownBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Prevent default action (if inside a form)
          event.stopPropagation(); // Prevent click from propagating to document
          dropdownMenu.classList.toggle("hidden");
      });

      // Close dropdown if clicked outside
      document.addEventListener("click", function (event) {
          if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
              dropdownMenu.classList.add("hidden");
          }
      });
  });
</script>
@endsection

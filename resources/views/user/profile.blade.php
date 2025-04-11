@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    <div id="screen8" class=" max-w-sm mx-auto p-4 bg-white rounded-lg">
      @include('user.header')
      <div class="flex justify-between items-center">
        <h1>My Profile</h1>
        <button"
          class="cursor-pointer px-3 py-2 bg-[#28388F1A] text-[11px] rounded-[10px] text-[#28388F] font-Montserrat  "
          onclick="toggleEditProfileForm()">
          Edit Profile
          </button>
      </div>


     <!-- Language Form (Initially Hidden) -->
     <div id="EditProfileForm" class="hidden fixed inset-0 flex items-center justify-center z-50 mt-[-70px]">
      <!-- bg-black bg-opacity-50 -->
      <div class="w-[310px] h-[280px] bg-[#FFFFFF]  bg-white  p-6 w-80"
        style="box-shadow: 0px 3px 10px 3px #00000026;">
        <div class="flex justify-between items-center mb-4">
          <h1 class="w-[38px] h-[17px] font-Montserrat font-[600] text-[14px] leading-[17.07px] text-[#000000]">Filter
          </h1>
          <button class="w-[20px] h-[20px] text-[#1F2937] mt-[-14px] text-4xl" onclick="toggleEditProfileForm()">
            &times;
          </button>
        </div>
        <form>
          <div class="space-y-4">
            <div>
              <label
                class="mb-1 w-[39px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]"
                for="language" class="block text-xs"> Learner</label>
              <!-- <select id="language"
                class="w-[270px] h-[40px]  border-[1px] rounded-[10px] mt-1 text-[10px] text-[#A7A7A7] leading-[12.19px]">
                <option value=""
                  class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black"
                  disabled selected>Please Select Learner</option>
                <option value="en"
                  class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black">
                  English</option>
                <option value="hi"
                  class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black">Hindi
                </option>
                <option value="es"
                  class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black">
                  Spanish</option>
                <option value="fr"
                  class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black">
                  French</option>
              </select> -->
              
              <div class="relative">
        
                <!-- Dropdown Button -->
                <button id="dropdownBtn" class="w-full h-[40px] px-3 text-left bg-white border border-gray-300 rounded-[10px] flex justify-between items-center">
                    <span id="selectedText" class="text-gray-500 text-[10px]">Please select learner</span>
                    <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
        
                <!-- Dropdown Menu -->
                <div id="dropdownMenu"
                  class="absolute w-full bg-white border border-gray-300 rounded-md shadow-lg mt-1 hidden">
                  <!-- <div class="p-2">
                    <input type="text" id="searchInput" placeholder="Search..."
                      class="w-full p-2 text-sm border border-gray-300 rounded-md">
                  </div> -->
                  <ul class="max-h-40 overflow-y-auto">
                    <li class="p-2 flex items-center">
                      <input type="checkbox" class="mr-2 " value="Aditya Joshi"> <p class="font-Montserrat font-[400] text-[12px] leading-[12.19px] text-black">Aditya Joshi</p>
                    </li>
                    <li class="p-2 flex items-center">
                      <input type="checkbox" class="mr-2 font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black" value="Anjali Gupta"> <p class="font-Montserrat font-[400] text-[12px] leading-[12.19px] text-black">Anjali Gupta</p>
                    </li>
                    <li class="p-2 flex items-center">
                      <input type="checkbox" class="mr-2 font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black" value="Barkha Pandey"> <p class="font-Montserrat font-[400] text-[12px] leading-[12.19px] text-black">Barkha Pandey</p>
                    </li>
                    <li class="p-2 flex items-center">
                      <input type="checkbox" class="mr-2" value="Chandan Mehta"> <p class="font-Montserrat font-[400] text-[12px] leading-[12.19px] text-black">Chandan Mehta</p>
                    </li>
                    <li class="p-2 flex items-center">
                      <input type="checkbox" class="mr-2" value="Charvi Gulati"> <p class="font-Montserrat font-[400] text-[12px] leading-[12.19px] text-black">Charvi Gulati</p>
                    </li>
                    <li class="p-2 flex items-center">
                      <input type="checkbox" class="mr-2" value="Deepak Singh"> <p class="font-Montserrat font-[400] text-[12px] leading-[12.19px] text-black">Deepak Singh</p>
                    </li>
                    <li class="p-2 flex items-center">
                      <input type="checkbox" class="mr-2" value="Harshita Sharma"> <p class="font-Montserrat font-[400] text-[12px] leading-[12.19px] text-black">Harshita Sharma</p>
                    </li>
                  </ul>
                </div>
              </div>
        
            </div>
            <div class="">
              <label for="language"
                class="block font-Montserrat font-[600] text-[14px] leading-[17.07px] text-left text-[#000000]">Sort
                By</label>
              <p class="mt-4 font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">
                Newest to Oldest
              </p>
              <p class="mt-1 font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">
                Oldest to Newest
              </p>
            </div>
            <div class="">
              <button type="submit" onclick="showScreen13()"
                class="ml-[2px] rounded-[10px] w-[260px] text-center bg-[#28388F] text-white py-3 text-[14px] leading-[17.07px] font-[600] font-Montserrat">
                Apply
              </button>
            </div>
          </div>
        </form>
      </div>
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

      <div class="flex justify-between items-center mt-8 mb-2">
        <h1>Team Members</h1>
        <button"
          class="cursor-pointer px-3 py-1 bg-[#28388F1A]  text-[#28388F] text-[11px] rounded-[10px] font-Montserrat ">
          Add Members
          </button>
      </div>
      @include('user.teammemberitem')
      @include('user.teammemberitem')
      @include('user.teammemberitem')
      

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

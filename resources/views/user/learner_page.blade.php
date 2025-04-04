@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto bg-white shadow-md min-h-[140vh] h-auto">
    @include('user.header')
    <!-- Language Form Pop up -->
    <div id="screen11" class="max-w-sm mx-auto p-4 bg-white rounded-lg absolute left-[6px] top-[-1px]">


      <div class="mt-2 flex justify-between items-center">
        <h1
          class="w-[62px] h-[17px] absolute top-[106px] left-[32px] font-[500] text-[14px] leading-[17.07px] text-[#000000]">
          Learners
        </h1>
        <button class="w-[60px] h-[30px] absolute top-[100px] left-[310px] rounded-[10px] bg-[#28388F1A]"
          onclick="toggleFilterForm()">
          <p
            class="w-[27px] h-[12px] absolute top-[10px] left-[17px] font-Montserrat font-[500]  text-[10px] leading-[12.19px] text-[#28388F]">
            Filter</p>
        </button>
      </div>

      <div id="toggleSortPopUp()" class="mt-6 hidden fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-5 w-[310px] h-[629px] absolute top-[80px] border-[1px]"
          style="box-shadow: 0px 3px 10px 3px #00000026;">
          <div class="flex justify-between items-center mb-4">
            <h1
              class="w-[38px] h-[17px] font-Montserrat font-[600] text-[14px] leading-[17.07px] text-center text-[#000000]">
              Filter</h1>
            <button class="w-[20px] h-[20px] text-[#1F2937] hover:text-gray-700 text-4xl mt-[-16px]"
              onclick="toggleFilterForm()">
              &times;
            </button>
          </div>

          <form class="space-y-[2px]">
            <div>
              <label
                class="w-[20px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Age</label>
              <div class="flex justify-between gap-2 items-center text-xs">
                <select
                  class="w-[131px] h-[40px] rounded-[10px] border-[1px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500 ">
                  <option value="" disabled selected
                    class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Start Age
                  </option>
                  <option value="18" class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">
                    18</option>
                  <option value="25" class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                    25</option>
                </select>
                <select
                  class="w-[131px] h-[40px] rounded-[10px] border-[1px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                  <option value="" disabled selected
                    class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">End Age</option>
                  <option value="30" class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                    30</option>
                  <option value="50" class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                    50</option>
                </select>
              </div>
            </div>

            <div class="">
              <label
                class="w-[38px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Gender</label>
              <select
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                  Gender</option>
                <option value="male"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Male</option>
                <option value="female"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Female</option>
              </select>
            </div>

            <div class="">
              <label
                class="w-[80px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Education
                Level</label>
              <select
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                  education level</option>
                <option value="highschool"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">High School
                </option>
                <option value="graduate"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Graduate</option>
              </select>
            </div>

            <div class="">
              <label
                class="w-[91px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Digital
                Proficiency</label>
              <select
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                  digital proficiency</option>
                <option value="basic"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Basic</option>
                <option value="advanced"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Advanced</option>
              </select>
            </div>

            <div class="">
              <label
                class="w-[97px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">English
                Knowledge</label>
              <select
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                  English Knowledge</option>
                <option value="beginner"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Beginner</option>
                <option value="fluent"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Fluent</option>
              </select>
            </div>

            <div class="">
              <label
                class="w-[41px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Mobility</label>
              <select
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                  mobility level</option>
                <option value="low" class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                  Low</option>
                <option value="high"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">High</option>
              </select>
            </div>

            <div class="">
              <label
                class="w-[148px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Currently
                Engaged in Earning</label>
              <select
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                </option>
                <option value="yes" class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                  Yes</option>
                <option value="no" class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                  No</option>
              </select>
            </div>

            <div class="flex justify-center">
              <button class="w-[250px] h-[40px] bg-[#28388F] rounded-[10px] mt-[25px]">
                <p class="text-center font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF]">Apply</p>
              </button>
            </div>
          </form>
        </div>
      </div>
      @foreach($leanerList as $item)
      @php
        $top = 140 + ($loop->index * 80);
      @endphp
      <!-- <div class="mt-6 flex gap-2 items-center justify-between"> -->
      <a href="{{route('learner.details',['id'=>encryptString($item['id'])])}}"
        class="w-[340px] h-[70px] absolute top-[{{$top}}px]  left-[30px] rounded-[10px] bg-[#FFFFFF] flex gap-2 items-center justify-between cursor-pointer"
        style="box-shadow: 0px 4px 10px 0px #00000026;">
        <div class="flex justify-center gap-2 items-center">
          <div class="w-[40px] h-[40px] ml-2">
            <!-- <i class='fas fa-address-book'></i> -->
            <img src="{{asset('asset/images/user.jpg')}}" alt="">
          </div>

          <div class="flex flex-col items-center gap-1.5">
            <div
              class="w-[86px] h-[17px] ml-[5px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-[#000000]">
             {{$item['first_name']}}&nbsp;
            </div>
            <div class="flex gap-1.5">
              <span>
                <!-- <i class="material-icons text-sm">date_range</i> -->
                <img src="{{asset('asset/images/Learner calendar.png')}}" class="w-[10px] h-[10px] " alt="">
              </span>
              <span class="w-[64px] h-[12px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              {{getdateformate($item['date_of_birth'])}}
              </span>
            </div>
          </div>

        </div>
        <div class="flex justify-center gap-5 items-center mr-2.5">
          <div>
            <!-- <i class="material-icons text-xl
            ">mail_outline</i> -->
            <img src="{{asset('asset/images/Learner mail.png')}}" class="w-[20px] h-[20px] " alt="">
          </div>
          <div>
            <!-- <i class="material-icons text-xl
            ">call</i> -->
            <img src="{{asset('asset/images/Learner phone.png')}}" class="w-[20px] h-[20px] " alt="">
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
  @include('user.bottom_menu')
@endsection

@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto bg-white shadow-md min-h-[140vh] h-auto">
    @include('user.header')
    <!-- Language Form Pop up -->
    <div id="screen11" class="max-w-sm mx-auto p-3 bg-white  rounded-lg mt-[50px]">
      <div class="">
        <h1 class="2-[108px] h-[17px] font-[500] text-[14px] leading-[17.07px] text-[#000000]">
          Learner Details
        </h1>
      </div>

      <div class="mt-6 flex gap-2 items-center justify-between">
        <div class="flex justify-center gap-2 items-center">
          <div class="w-[40px] h-[40px]">
            <!-- <i class='fas fa-address-book'></i> -->
            <img src="{{asset('asset/images/user.jpg')}}" alt="">
          </div>

          <div class="flex flex-col items-center gap-1.5">
            <div
              class="w-[86px] h-[17px] ml-[5px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-[#000000]">
             {{$learnerDetails['first_name']}}&nbsp;{{$learnerDetails['last_name']}}
            </div>
            <div class="flex gap-1.5">
              <span>
                <img src="{{asset('asset/images/Learner calendar.png')}}" class="w-[10px] h-[10px] " alt="">
              </span>
              <span class="w-[64px] h-[12px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              {{getdateformate($learnerDetails['date_of_birth'])}}
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
      </div>

      <div class="">
        <div class="mt-4 text-xs">


          <div class="flex gap-[90px]">
            <p class="w-[76px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Learner Status</p>
            <div class="flex gap-2 items-center w-1/2">
              <span class="">
                <!-- <i class='fas fa-toggle-off'></i> -->
                <img src="{{asset('asset/images/Learner-toggle-left.png')}}" class="w-[20px] h-[20px] mt-[-2px]" alt="">
              </span>
              <p class="w-[32px] h-[12px] font-[500] text-[10px]  leading-[12.19px] text-[#000000] mt-[-2px]">{{$learnerDetails['status']}}</p>
            </div>
          </div>

          <div class="flex gap-[100px] mt-1">
            <p class="w-[67px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000] ">Date of Birth</p>
            <p class="w-[48px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]"> {{getdateformate($learnerDetails['date_of_birth'])}}</p>
          </div>

          <div class="flex gap-[128px] mt-1.5">
            <p class="w-[39px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">gender</p>
            <p class="w-[25px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]"> {{$learnerDetails['gender']}}</p>
          </div>

          <div class="flex gap-[93px] mt-1.5">
            <p class="w-[74px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Email Address</p>
            <p class="w-[95px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['email']}}</p>
          </div>

          <div class="flex gap-[113px] mt-1.5">
            <p class="w-[54px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Institution</p>
            <p class="w-[31px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['institution']}}</p>
          </div>

          <div class="flex gap-[84px] mt-1.5">
            <p class="w-[83px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Education level</p>
            <p class="w-[79px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['education_level']}}</p>
          </div>

          <div class="flex gap-[72px] mt-1.5">
            <p class="w-[95px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Digital Proficiency</p>
            <p class="w-[86px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['digital_proficiency']}}</p>
          </div>

          <div class="flex gap-[67px] mt-1.5">
            <p class="w-[100px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">English Knowledge</p>
            <p class="w-[95px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['english_knowledge']}}</p>
          </div>

          <div class="flex gap-[16px] mt-1.5">
            <p class="w-[158px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Interested In
              Opportunities</p>
            <p class="w-[169px] h-[24px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['interested_in_opportunities']}}
              own time, Run a business</p>
          </div>

          <div class="flex  mt-2">
            <p class="w-[59px] h-[15px] font-[600] text-[12px] leading-[14.63px] text-[#000000]">Get a Job</p>
            <!-- <p class="w-1/2 text-gray-600">445566</p> -->
          </div>

          <div class="flex gap-[125px] mt-2">
            <p class="w-[42px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Mobility</p>
            <p class="w-[58px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['job_mobility']}}</p>
          </div>

          <div class="flex gap-[121px] mt-1.5">
            <p class="w-[46px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Job Kind</p>
            <p class="w-[89px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['job_kind']}}</p>
          </div>

          <div class="flex gap-[47px] mt-1.5">
            <p class="w-[126px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Specific
              Qualifications</p>
            <p class="w-[169px] h-[24px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['job_kind']}},
              Low-code No code</p>
          </div>

          <div class="flex gap-[81px] mt-1.5">
            <p class="w-[86px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">When I want job</p>
            <p class="w-[64px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['job_timing']}}</p>
          </div>

          <div class="flex gap-[66px] mt-1.5">
            <p class="w-[101px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Years of experience
            </p>
            <p class="w-[35px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['experience_years']}}</p>
          </div>

          <div class="flex mt-3">
            <p class="w-[130px] h-[15px] font-[600] text-[12px] leading-[14.63px] text-[#000000]">Earn at my own time
            </p>
            <!-- <p class="w-1/2 text-gray-600">Laptop, Internet, Power Backup, Wifi</p> -->
          </div>

          <div class="flex gap-[23px] mt-1.5">
            <p class="w-[144px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">No. of Hours I can
              work/Day</p>
            <p class="w-[39px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['work_hours_per_day']}}</p>
          </div>

          <div class="flex gap-[79px] mt-1.5">
            <p class="w-[88px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Kind of work I do</p>
            <p class="w-[155px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['work_kind']}}
              based</p>
          </div>

          <div class="flex gap-[48px] mt-1.5">
            <p class="w-[126px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Specific
              Qualifications</p>
            <p class="w-[169px] h-[24px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['work_kind']}}
              Low-code No code</p>
          </div>

          <div class="flex mt-3">
            <p class="w-[95px] h-[15px] font-[600] text-[12px] leading-[14.63px] text-[#000000]">Run a Business</p>
            <!-- <p class="w-1/2 text-gray-600">Personal Loan</p> -->
          </div>

          <div class="flex gap-[94px] mt-1.5">
            <p class="w-[74px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Current status</p>
            <p class="w-[65px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['business_status']}}</p>
          </div>

          <div class="flex gap-[23px] mt-1.5">
            <p class="w-[145px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#000000]">Business description
              (if any)</p>
            <p class="w-[74px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">{{$learnerDetails['business_description']}}</p>
          </div>
        </div>
      </div>

      <div class="mt-6">
        <h1 class="w-[87px] h-[15px] font-[600] text-[12px] leading-[14.63px] text-[#000000]">
          Opportunities
        </h1>

        <div class="flex justify-between items-center gap-4">
          <div class="w-[160px] h-[80px] bg-[#FFFFFF] text-center flex justify-center flex-col items-center mt-4"
            style="box-shadow: 0px 3px 10px 0px #0000001A;">
            <div class="w-[128px] h-[29px] font-[600] text-[24px] leading-[29.26px] text-center text-[#05A7D1]">
              {{$openOpportunites}}
            </div>
            <div class="w-[86px] h-[30px] font-[500] text-[12px] leading-[14.63px] text-center text-[#000000] mt-1">
              Ongoing Opportunities
            </div>
          </div>

          <div class="w-[159px] h-[80px] bg-[#F2F2F2] text-center flex justify-center flex-col items-center mt-4"
            style="box-shadow: 0px 3px 10px 0px #0000001A;">
            <div class="w-[128px] h-[29px] font-[600] text-[24px] leading-[29.26px] text-center text-[#28388F]">12</div>
            <div class="w-[128px] h-[30px] font-[500] text-[12px] leading-[14.63px] text-center text-[#000000] mt-1">
              Completed Opportunities
            </div>
          </div>
        </div>
      </div>

      


      <?php if(isset($opportunitesList['data'])){ $count=1; ?>
      <?php foreach($opportunitesList['data'] as $key=>$item){  ?>
     
      <!-- Other Opportunites Start Here-->
       <a href="{{route('opportunities')}}">
      <div class="w-[350px] h-[140px] py-1 bg-[#FFFFFF] mt-6" style="box-shadow: 0px 3px 10px 0px #28388F33;">
        <h1 
          class="w-[310px] h-[15px] ml-[10px] mt-[6px] font-Montserrat font-[500] text-[12px] leading-[14.63px] text-[#000000]">
          {{$item['opportunities_title']}}</h1>
        <div class="flex justify-between">
          <div class="">
            <div class="flex mb-[3px]">
              <img src="{{asset('asset/images/file.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px] mt-[8px] text-[#28388F0D]">
              <a href=""
                class="w-[151px] h-[12px] mt-[9px] ml-[8px] font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#28388F] text-left underline underline-offset-auto decoration-solid decoration-skip-ink-none">View
                Specification Document
              </a>
              <img src="{{asset('asset/images/Group.png')}}" alt="engLogo" class="w-[20px] h-[20px] mt-[6px] ml-[10px] text-[#28388F0D]">
            </div>

            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/Rupee Icon.png')}}" alt="engLogo" class="w-[9px] h-[12px] ml-[12px]  text-[#28388F0D]">
              <p class="w-[61px] h-[12px]  ml-[10px] font-Montserrat font-[500] text-[10px] leading-[12.19px]">
              {{$item['payout_monthly']}}/Month
              </p>
            </div>

            <div class="flex mb-[5px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[95px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              Start - {{getdateformate($item['start_date'])}}
              </p>
            </div>

            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[95px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              End - {{getdateformate($item['end_date'])}}
              </p>
            </div>

            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/user.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p
                class="h-[12px] ml-[6px] mt-[1px]  font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#000000]">
                {{$item['number_of_openings']}} Job Opening
              </p>
            </div>

          </div>
          <div class="">
            <p
              class="w-[43px] h-[22px] font-Montserrat font-[500] text-[9px] leading-[10.97px] text-center text-[#000000]  mt-[-10px] ml-[9px]">
              Ys Incentive
            </p>
            <div
              class="w-[60px] h-[50px] bg-[#FAFAFA] mt-1 mr-[20px] flex items-center justify-center">
              <p
                class="w-[60px] h-[30px] font-Montserrat font-[700] text-[12px] leading-[14.63px] text-center text-[#000000]">
                50/ Learner
                <img src="{{asset('asset/images/rupeeIcon.png')}}" alt="engLogo" class="w-[8px] h-[12px] mt-[-30px] ml-[10px]">
              </p>

            </div>

            <div class="flex mt-[16px] ml-[-54px] gap-2.5">
              <img src="{{asset('asset/images/briefcase.png')}}" alt="engLogo" class="w-[14px] h-[14px]">
              <p class="w-[120px] h-[12px] font-[500] text-[10px] leading-[12.19px] text-[#000000] mt-[1.5px] ">
              {{$item['provider_name']}}
              </p>
            </div>


          </div>
        </div>
      </div>
      </a>
      <?php } ?>
      <?php } ?>

     


    </div>
  </div>
  @include('user.bottom_menu')
@endsection

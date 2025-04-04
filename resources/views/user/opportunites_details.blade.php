@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    @include('user.header')

    <div id="screen9" class=" max-w-[26rem] mx-auto p-4 bg-white mt-9 rounded-lg">
      <div class="mt-2 text-sm flex justify-between items-center">
        <h1 class="w-[100px] h-[17px] font-[500] text-[14px] leading-[17.07px] text-[#000000]">
        {{__('messages.opportunities')}}
        </h1>

        <div class="flex items-center gap-2">
          <div class="w-[110px] h-[30px] rounded-[10px] bg-[#28388F] flex items-center justify-center">
            <a href="OpportunityAdd.html"
              class="w-[88px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#FFFFFF] cursor-pointer">
              {{__('messages.add_opportunities')}}</a>
          </div>

          <div class="w-[60px] h-[30px] rounded-[10px] bg-[#28388F1A] flex items-center justify-center">
            <button" class="w-[37px] h-[12px] font-[500] text-[10px] leading-[12.19px] text-[#28388F] cursor-pointer"
              onclick="toggleSortPopUp()">Sort
              By</button>
          </div>
        </div>
      </div>

      <!-- visible only click on sort by button -->
      <div id="togglePopUp" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-4 w-[310px] h-[220px]" style="box-shadow: 0px 3px 10px 3px #00000026;">
          <div class="flex justify-between items-center mb-3">
            <h1 class="w-[53px] h-[17px] font-[600]  text-[14px] leading-[17.07px] text-center">Sort By</h1>
            <button class="text-gray-500 hover:text-gray-700 text-4xl" onclick="toggleSortPopUp()">
              &times;
            </button>
          </div>
          <form>
            <div class="space-y-4">
              <div class="font-[400] text-[12px] leading-[14.63px] flex flex-col gap-2">
                <p>New Opportunities</p>
                <p>Earliest Ending Opportunity</p>
                <p>Newest to Oldest</p>
                <p>Oldest to Newest</p>
              </div>
              <div class="w-[250px] h-[40px] rounded-[10px] bg-[#28388F] flex justify-center items-center mx-auto">
                <button type="submit" class="w-[42px] h-[17px] font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF]">
                  Apply
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <?php if(isset($opportunitesList['data'])){ $count=1; ?>
      <?php foreach($opportunitesList['data'] as $key=>$item){  ?>
     
      <!-- Other Opportunites Start Here-->
      <div class="min-w-[330px] w-auto min-h-[140px] h-auto py-1 bg-[#FFFFFF] mt-6" style="box-shadow: 0px 3px 10px 0px #28388F33;">
        <h1
          class="w-[310px] h-[15px] ml-[10px] mt-[6px] font-Montserrat font-[500] text-[12px] leading-[14.63px] text-[#000000]">
          Data Entry Operator Job</h1>
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
      <?php } ?>
      <?php } ?>



     

     

      

    </div>
  </div>
@include('user.bottom_menu')
@endsection

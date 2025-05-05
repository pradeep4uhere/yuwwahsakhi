@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[95vh] h-auto">
    @include('user.header')
    <div class="">
      <img src="{{asset('asset/images/file-textcopy.png')}}" alt="engLogo" class="w-[20px] h-[20px] absolute top-[104px] left-[34px]">
      <p class="w-[85px] h-[17px] absolute top-[106px] left-[65px] font-Montserrat font-[500] text-[14px] leading-[17.07px]">
        {{__('messages.event')}}
      </p>
      <div class="w-[340px] h-[50px] absolute top-[140px] left-[37px] bg-[#FFFFFF]" 
      style="box-shadow: 0px 3px 10px 0px #0000001A;"
      >
        <div class="flex justify-between items-center">
          <a href="{{route('user.allevents')}}">
            <div class="w-[104px] h-[17px] absolute top-[18px] left-[17px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-center text-[#000000]"> {{__('messages.all_events')}}</div>
            <div class="w-[27px] h-[34px] absolute top-[10px] left-[285px] font-Montserrat font-[600] text-[28px] leading-[34.13px] text-center text-[#05A7D1]">{{$allEventCount}}</div>
          </a>
        </div>
      </div>
    </div>
    <div class="">
      <img src="{{asset('asset/images/star-textcopy.png')}}" alt="engLogo" class="w-[20px] h-[20px] absolute top-[214px] left-[34px]">
      <p class="w-[100px] h-[17px] absolute top-[216px] left-[65px] font-Montserrat font-[500] text-[14px] leading-[17.07px]">
          {{__('messages.opportunities')}}
        
      </p>
      <div class="w-[340px] h-[50px] absolute top-[250px] left-[37px] bg-[#FFFFFF]"
        style="box-shadow: 0px 3px 10px 0px #0000001A;"
      > <a href="{{ route('opportunities', ['filter' => 'desc', 'order_by' => 'id']) }}">
        <div class="flex justify-between items-center mt-2">
          <div class="w-[163px] h-[266px] absolute top-[18px] left-[1px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-center text-[#000000] px-2">{{__('messages.open_opportunities')}}</div>
          <div class="w-[36px] h-[34px] absolute top-[10px] left-[280px] font-Montserrat font-[600] text-[28px] leading-[34.13px] text-center text-[#05A7D1]">{{$totalOpportunites}}</div>
        </div>
      </a>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-4 ">
      <p class="w-[106px] h-[12px] absolute top-[320px] left-[34px] font-Montserrat font-[500] text-[14px] leading-[12.19px] text-[#000000]">
         {{__('messages.opportunities')}}
      </p>
      @if($opportunites['data']->count()==0)
      <div class="w-[340px] h-[40px] absolute top-[340px] left-[37px] bg-red-100 text-red-700 p-3 rounded mb-4 text-[12px]">No Opportunity Found</div>
      @else
      <?php if(isset($opportunites['data'])){ $count=1; ?>
      @foreach($opportunites['data'] as $key=>$item)
      @php
        $top = 340 + ($loop->index * 150);
      @endphp
      @if($count<=2)
      <div class="w-[340px] h-[140px] absolute top-[{{$top}}px] left-[37px] bg-[#FFFFFF] cursor-pointer"
        style="box-shadow: 0px 3px 10px 0px #28388F33;"
        onclick="window.location.href='{{route('opportunitiesLearner',['id'=>encryptString($item['id'])])}}';"
        >
          <h1 class="w-[310px] h-[15px] ml-[10px] mt-[6px] font-Montserrat font-[500] text-[12px] leading-[14.63px] text-[#000000]">{{$item['opportunities_title']}}</h1>
          <div class="flex justify-between">
            <div class="">
              <div class="flex mb-[3px]">
                <img src="{{asset('asset/images/file.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px] mt-[8px] text-[#28388F0D]">
                <a href="" class="w-[151px] h-[12px] mt-[9px] ml-[8px] font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#28388F] text-left underline underline-offset-auto decoration-solid decoration-skip-ink-none">View Specification Document
                </a>
                <img src="{{asset('asset/images/Group.png')}}" alt="engLogo" class="w-[20px] h-[20px] mt-[6px] ml-[10px] text-[#28388F0D]">
              </div>
                
              <div class="flex mb-[6px]">
                <img src="{{asset('asset/images/Rupee Icon.png')}}" alt="engLogo" class="w-[9px] h-[12px] ml-[12px]  text-[#28388F0D]">
                <p class="w-[61px] h-[12px]  ml-[10px] font-Montserrat font-[600] text-[10px] leading-[12.19px] text-[#28388F]">
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
                <p class="min-w-[63px] w-auto h-[12px] ml-[6px] mt-[1px]  font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#000000]">
                {{$item['number_of_openings']}} Job Opening
                </p>
              </div>
              
            </div>
            <div>
              <p class="w-[43px] h-[22px] mt-[22px] mr-[20px]  font-Montserrat font-[500] text-[9px] leading-[10.97px] text-center text-[#000000]">
                YS Incentive
              </p>
              <div class="w-[60px] h-[50px] absolute top-[70px] left-[260px] bg-[#28388F] ">
                <p class="w-[60px] h-[30px] mt-[14px] font-Montserrat font-[700] text-[12px] leading-[14.63px] text-center text-[#FFFFFF]">            
                  50/ Learner 
                  <img src="{{asset('asset/images/rupeeIcon.png')}}" alt="engLogo" class="w-[8px] h-[14px] mt-[-30px] ml-[8px]">
                </p>
              </div>
              <!-- <p>
                AGAN Enterprices
              </p> -->
            </div>
          </div>
      </div>
      @endif
      <?php $count++; ?>
      @endforeach
      <?php }else{ ?>
      <?php } ?>
      @endif
    </div>
    <div class="">
      <img src="{{asset('asset/images/usersCopy.png')}}" alt="engLogo" class="w-[20px] h-[20px] absolute top-[652px] left-[34px]">
      <p class="w-[62px] h-[17px] absolute top-[655px] left-[65px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-[#000000]">
      {{__('messages.learners')}}
      </p>
      <div class="w-[350px] h-[50px] absolute top-[690px] left-[37px] bg-[#FFFFFF]" 
      style="box-shadow: 0px 3px 10px 0px #0000001A;"
      >
        <div class="flex justify-between items-center mt-2">
          <a href="{{route('learner')}}">
           <div class="w-[104px] h-[17px] absolute top-[18px] left-[17px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-center text-[#000000]">  {{__('messages.total_learners')}}</div>
           <div class="w-[27px] h-[34px] absolute top-[10px] left-[245px] font-Montserrat font-[600] text-[28px] leading-[34.13px] text-center text-[#05A7D1]">{{$learnerCount}}</div>
          </a>
        </div>
      </div>
    </div>
    

     

  </div>
@include('user.bottom_menu')
@endsection

@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto p-4 bg-[#FFFFFF] shadow-md" style="min-height:1024px">

    @include('user.header')
    <!-- Language Form Pop up -->
    <div id="screen11" class="max-w-sm mx-auto p-4 bg-white rounded-lg absolute left-[6px] top-[-1px]">
      <div class="mt-2 flex justify-between items-center">
        <h1
          class="w-[262px] h-[17px] absolute top-[106px] left-[32px] font-[500] text-[14px] leading-[17.07px] text-[#000000]">
          {{__('messages.Learner_Search_Filter')}} [{{$leanerList->total()}}]
        </h1>
        <button class="w-[60px] h-[30px] absolute top-[100px] left-[310px] rounded-[10px] bg-[#28388F1A]"
          onclick="toggleFilterForm()">
          <p
            class="w-[27px] h-[12px] absolute top-[10px] left-[17px] font-Montserrat font-[500]  text-[10px] leading-[12.19px] text-[#28388F]">
            {{__('messages.filters')}}</p>
        </button>
      </div>

      <div id="toggleSortPopUp()" class="mt-6 hidden fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-5 w-[340px] h-[429px] absolute top-[240px] border-[1px]"
          style="box-shadow: 0px 3px 10px 3px #00000026;">
          <div class="flex justify-between items-center mb-4">
            <h1
              class="w-[160px] h-[17px] font-Montserrat font-[600] text-[14px] leading-[17.07px] text-center text-[#000000]">
              {{__('messages.Learner_Search_Filter')}}</h1>
            <button class="w-[20px] h-[20px] text-[#1F2937] hover:text-gray-700 text-4xl mt-[-16px]"
              onclick="toggleFilterForm()">
              &times;
            </button>
          </div>

          <form class="space-y-[2px]" action="{{route('user.search.learner')}}" method="post">
            @csrf
            <div class="">
              <label
                class="w-[38px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]"> {{__('messages.Enter_Learner_Name')}}</label>
              <input type="text" name="name"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
            </div>
           
            <div class="">
              <label
                class="w-[38px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">{{__('messages.Primary_Phone_Number')}}</label>
              <input type="text" name="phone"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
            </div>
            <div class="">
              <label
                class="w-[38px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">{{__('messages.email')}}</label>
              <input type="text" name="email"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
            </div>
           

            

           

          

          


            <div class="">
              <label
                class="w-[148px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Gender</label>
              <select name="gender"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please choose Gender
                </option>
                <option value="yes" class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                  Male</option>
                <option value="no" class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                  Female</option>
              </select>
            </div>


           

            <div class="flex justify-center">
              <button class="w-[250px] h-[40px] bg-[#28388F] rounded-[10px] mt-[25px]" type="submit">
                <p class="text-center font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF]">Apply</p>
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-4 px-6">
      <div class="w-[375px] h-30px] absolute top-[150px] mb-2 p-2  left-[14px] bg-[#fff5f5] flex gap-2 items-center justify-between " style="box-shadow: 0px 4px 10px 0px #00000026;">
      <span class="text-[10px] text-gray-500">No Action</span>
      <div class="w-3 h-3 rounded-full bg-gray-500"></div>

      <span class="text-[10px] text-green-700">Skilling Completed</span>
      <div class="w-3 h-3 rounded-full bg-green-500"></div>

      <span class="text-[10px] text-blue-500">Event Submitted</span>
      <div class="w-3 h-3 rounded-full bg-blue-500"></div>

      

      

      </div>
      <div class="w-[375px] h-[30px] absolute top-[190px] mb-2 p-2  left-[14px] bg-[#fff5f5] flex gap-2 items-center justify-between " style="box-shadow: 0px 4px 10px 0px #00000026;">

      <span class="text-[10px] text-orange-700">Action Required</span>
      <div class="w-3 h-3 rounded-full bg-orange-500"></div>

      <span class="text-[10px] text-green-700">Event Accepted</span>
      <div class="w-3 h-3 rounded-full bg-green-500"></div>

      <span class="text-[10px] text-red-700">Event Rejected</span>
      <div class="w-3 h-3 rounded-full bg-red-500"></div>

      </div>
      @foreach($leanerList as $item)
      @php
        $top =230 + ($loop->index * 80);
      @endphp
      <!-- <div class="mt-6 flex gap-2 items-center justify-between"> -->
      <a href="{{route('learner.details',['id'=>encryptString($item['id'])])}}"
        class="w-[375px] h-[70px] absolute top-[{{$top}}px]  left-[14px] rounded-[10px] bg-[#FFFFFF] flex gap-2 items-center justify-between cursor-pointer"
        style="box-shadow: 0px 4px 10px 0px #00000026;">
        <div class="flex justify-center gap-2 items-center">
          <div class="w-[40px] h-[40px] ml-2">
            <!-- <i class='fas fa-address-book'></i> -->
            <img src="{{asset('asset/images/user.jpg')}}" alt="">
            
          </div>

          <div class="flex flex-col items-center gap-1.5">
            <div
              class="w-[200px] h-[17px] ml-[5px] font-Montserrat font-[500] text-[12px] leading-[17.07px] text-[#000000]">
             {{ \Illuminate\Support\Str::limit($item['first_name'], 20) }}<br/>
             <div class="flex gap-1.5 ">
              <span>
                <img src="{{asset('asset/images/phone.png')}}" class="w-[10px] h-[10px]" alt="">
              </span>
              <span class="min-w-[64px] min-h-[12px] w-auto h-auto font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              {{$item['primary_phone_number']}}
              </span>
            </div>
            </div>
          </div>
          <!-- <div class="flex gap-1.5">
           
            
          </div> -->
          <div class="flex gap-2.5">
            <!--  -->
            @if($item['completion_status']==1)
            <div class="w-5 h-5 rounded-full bg-green-500"></div>
            @else
            <div class="w-5 h-5 rounded-full bg-gray-500"></div>
            @endif
            @php
                $transactions = $item['eventTransactions'];
                //dd($transactions)
                $count = $transactions->count();
                $allAccepted = $transactions->every(fn($t) => $t->review_status === 'Accepted');

                // This is your additional condition
                  $hasAcceptedJob = $transactions->contains(function ($t) use ($jobEventId) {
                  return $t->event_type == $jobEventId && $t->review_status === 'Accepted';
               });
            @endphp
            @if($count == 0)
            <div class="w-5 h-5 rounded-full bg-gray-500"></div>
            <div class="w-5 h-5 rounded-full bg-gray-500"></div>
            @else
            @if($hasAcceptedJob)
                <div class="w-5 h-5 rounded-full bg-blue-500"></div>
            @elseif($count > 0)
                <div class="w-5 h-5 rounded-full bg-orange-500"></div>
            @endif
            @if($allAccepted)
                <div class="w-5 h-5 rounded-full bg-green-500"></div>
            @elseif($count > 0)
                <div class="w-5 h-5 rounded-full bg-orange-500"></div>
            @endif
            @endif
          </div>
        </div>
          <!-- Event Transactions: Only if present -->
       

        
      </a>
      @endforeach
      
    </div>
    </div>
  </div>
  @include('user.bottom_menu')
 
@endsection

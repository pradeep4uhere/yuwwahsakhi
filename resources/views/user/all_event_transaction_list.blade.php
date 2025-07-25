@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    @include('user.header')
    <div id="screen9" class=" max-w-[26rem] mx-auto p-4 bg-white mt-1 rounded-lg">
      <div class="mt-2 text-sm flex justify-between items-center">
        <h1 class="w-[100px] h-[17px] font-[500] text-[14px] leading-[17.07px] text-[#000000]">
        {{__('messages.all_events')}}
        </h1>
        <div class="flex items-center gap-2">
          <div class="w-[69px] h-[30px] rounded-[10px] bg-[#28388F] flex items-center justify-center">
            <a href="{{route('upload')}}"
              class="font-[600] text-[10px] leading-[12.19px] text-[#FFFFFF] cursor-pointer">{{__('messages.add_event')}}</a>
          </div>
          <div class="w-[60px] h-[30px] rounded-[10px] bg-[#28388F1A] flex items-center justify-center">
          <a href="#" class="font-[600] text-[10px] leading-[12.19px] text-[#28388F] cursor-pointer"
          onclick="toggleFilterForm()">{{__('messages.filters')}}</a>
        </div>
          <div class="w-[60px] h-[30px] rounded-[10px] bg-[#28388F1A] flex items-center justify-center">
            <button" class="w-[37px] h-[12px] font-[500] text-[10px] leading-[12.19px] text-[#28388F] cursor-pointer"
              onclick="toggleSortPopUp()">{{__('messages.sort_by')}}
              </button>
          </div>
        </div>
      </div>
      @include('user.event_filter')
      <!-- visible only click on sort by button -->
      <div id="togglePopUp" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-4 w-[310px] h-[250px]" style="box-shadow: 0px 3px 10px 3px #00000026;">
          <div class="flex justify-between items-center mb-3">
            <h1 class="w-[53px] h-[17px] font-[600]  text-[14px] leading-[17.07px] text-center">{{__('messages.sort_by')}}</h1>
            <button class="text-gray-500 hover:text-gray-700 text-4xl" onclick="toggleSortPopUp()">
              &times;
            </button>
          </div>
          <form>
            <div class="space-y-4">
              <div class="font-[400] text-[12px] leading-[14.63px] flex flex-col gap-2">
              <a href="{{ route('user.allevents', ['filter' => 'desc', 'order_by' => 'id']) }}">
              {{__('messages.new_event')}}</a>
              <a href="{{ route('user.allevents', ['filter' => 'desc', 'order_by' => 'event_date_submitted']) }}">
              {{__('messages.all_submitted_event')}}</a>
              <a href="{{ route('user.allevents', ['filter' => 'asc', 'order_by' => 'event_date_created']) }}">
              {{__('messages.earliest_ending_event')}}</a>
              <a href="{{ route('user.allevents', ['filter' => 'desc', 'order_by' => 'event_date_created']) }}">
              {{__('messages.newest_to_oldest')}}</a>
              <a href="{{ route('user.allevents', ['filter' => 'asc', 'order_by' => 'event_date_created']) }}">
              {{__('messages.oldest_to_newest')}}</a>
              </div>
              <div class="w-[250px] h-[40px] rounded-[10px] bg-[#28388F] flex justify-center items-center mx-auto">
                <button type="submit" class="w-[142px] h-[17px] font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF]">
                {{__('messages.apply')}}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php if($eventList->count()>0){ $count=1; ?>
      <?php foreach($eventList as $key=>$item){  ?>
        
      <!-- Other Opportunites Start Here-->
        @if($item['review_status']=='Accepted' && $item['event_date_submitted']!='')
         <div class="min-w-[330px] min-h-[260px] w-auto min-h-[50px] h-auto bg-[#FFFFFF] px-3 py-3 mt-3 overflow-auto cursor-pointer" style="box-shadow: 0px 3px 10px 0px #cccccc; border: solid 2px green;" >  
         @else
        <div class="min-w-[330px] min-h-[260px] w-auto min-h-[50px] h-auto bg-[#FFFFFF] px-3 py-3 mt-3 overflow-auto cursor-pointer" style="box-shadow: 0px 3px 10px 0px #cccccc; border: solid 2px red;" onclick="toggleButtons(event)" >
          @endif
          
        <p
          class="w-[310px] h-[15px] ml-[10px] mt-[6px] font-Montserrat font-[500] text-[12px] leading-[14.63px] text-[#000000]" >
          {{__('messages.beneficiary')}} : {{$item['beneficiary_name']}}&nbsp;|&nbsp;{{$item['beneficiary_phone_number']}}</p>

        <div class="flex justify-between">
          <div class="">
          <div class="flex mb-[1px]">
              <i class="fa-regular fa-clock text-[#000000] text-[14px] ml-[10px] mt-[5px]"></i>
              <p class="w-[295px] h-[12px]  ml-[5px] mt-[5px] font-Montserrat font-[500] text-[10px] leading-[12.19px]">
              {{__('messages.event_name')}}: {{($item['event_name']!=null)?$item['event_name']:''}}
              </p>
            </div>
            <!-- <div class="flex mb-[3px]">
              <img src="{{asset('asset/images/file.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px] mt-[8px] text-[#28388F0D]">
              <a href="{{ asset('storage/' . $item['uploaded_doc_links']) }}" target="_blank"
                class="w-[151px] h-[12px] mt-[9px] ml-[8px] font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#28388F] text-left underline underline-offset-auto decoration-solid decoration-skip-ink-none">View
                Uploaded Document
              </a>
              <img src="{{asset('asset/images/Group.png')}}" alt="engLogo" class="w-[20px] h-[20px] mt-[6px] ml-[10px] text-[#28388F0D]">
            </div> -->

            <div class="flex mb-[6px]">
            <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] mt-[5px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[295px] h-[12px]  ml-[5px] mt-[5px] font-Montserrat font-[500] text-[10px] leading-[12.19px]">
              {{__('messages.event_type')}}: {{($item['EventType']!=null)?$item['EventType']['name']:''}}&nbsp;|&nbsp;{{($item['Event']!=null)?$item['Event']['event_category']:''}}
              </p>
            </div>
            <div class="flex mb-[6px]">
              <i class="fa-regular fa-calendar-days text-[#000000] text-[14px] ml-[10px]"></i>
              <p class="w-[295px] h-[12px]  ml-[5px]  font-Montserrat font-[500] text-[10px] leading-[12.19px]">
              {{__('messages.event_value')}} : {{($item['event_value']!=null)?$item['event_value']:''}}
              </p>
            </div>

            <!-- <div class="flex mb-[5px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[195px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              Event Category: {{($item['Event']!=null)?$item['Event']['event_category']:''}} 
              </p>
            </div> -->
            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[395px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              {{__('messages.created_date')}} - {{getdateformate($item['event_date_created'])}}&nbsp;|&nbsp;
              @if($item['event_date_submitted']!='')
              {{__('messages.submitted_date')}}  - {{getdateformate($item['event_date_submitted'])}}
              @endif
              </p>
            </div>

             <div class="flex mb-[5px]">
              <i class="fa-regular fa-comment-dots text-[#000000] text-[14px] ml-[10px]"></i>
              <p class="w-[395px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              {{__('messages.comment')}}: {!! optional(getEventComment($item['id'], true))->comment ?? 'N/A' !!}
              </p>
            </div> 
          

          </div>
        </div>
        <div  class="buttonsContainer flex mt-4 gap-2 hidden">
            <div class="w-auto h-auto min-w-[100%] min-h-[40px] rounded-[10px] border-[1px] bg-[#28388F1A] border-[#28388F] flex justify-center items-center gap-2">
                <a href="{{route('viewevent',['id'=>encryptString($item['id'])])}}" class="font-[600] text-[10px] leading-[12.19px] text-[#28388F] cursor-pointer">{{__('messages.submit_event')}}</a>
            </div>
        </div>
      </div>
      <?php } ?>
      <?php }else{ ?>
        <div class="w-[340px] h-[40px]  bg-red-100 text-red-700 p-3 rounded mt-5 text-[12px]">{{__('messages.no_event_found')}}</div>  
      <?php } ?>
    </div>
  </div>
  <script>
    function toggleButtons(event) {
        // Prevent toggling if clicking inside the buttons container
        if (event.target.closest(".buttonsContainer")) return;
        const card = event.currentTarget;
        const buttonsContainer = card.querySelector(".buttonsContainer");
        const isVisible = !buttonsContainer.classList.contains("hidden");
        // Hide all other buttonsContainers
        document.querySelectorAll(".buttonsContainer").forEach(el => el.classList.add("hidden"));
        // Toggle only if it was previously hidden
        if (!isVisible) {
          buttonsContainer.classList.remove("hidden");
        }
        event.stopPropagation(); // Stop bubbling to document click
      }
      // Close when clicking outside all cards
      document.addEventListener("click", function (event) {
        if (!event.target.closest(".min-w-[330px]")) {
          document.querySelectorAll(".buttonsContainer").forEach(el => el.classList.add("hidden"));
        }
      });
</script>
@include('user.bottom_menu')
@endsection

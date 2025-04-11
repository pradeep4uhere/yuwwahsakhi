@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    @include('user.header')
    <div id="screen9" class=" max-w-[26rem] mx-auto p-4 bg-white mt-14 rounded-lg">
      <div class="mt-2 text-sm flex justify-between items-center">
        <h1 class="w-[100px] h-[17px] font-[500] text-[14px] leading-[17.07px] text-[#000000]">
        {{__('messages.all_events')}}
        </h1>

        <div class="flex items-center gap-2">
          <div class="w-[120px] h-[30px] rounded-[10px] bg-[#28388F] flex items-center justify-center">
            <a href="{{route('upload')}}"
              class="w-[100px] h-[12px] font-[600] text-[10px] leading-[12.19px] text-[#FFFFFF] cursor-pointer">{{__('messages.add_event')}}</a>
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
        <div class="bg-white p-4 w-[310px] h-[250px]" style="box-shadow: 0px 3px 10px 3px #00000026;">
          <div class="flex justify-between items-center mb-3">
            <h1 class="w-[53px] h-[17px] font-[600]  text-[14px] leading-[17.07px] text-center">Sort By</h1>
            <button class="text-gray-500 hover:text-gray-700 text-4xl" onclick="toggleSortPopUp()">
              &times;
            </button>
          </div>
          <form>
            <div class="space-y-4">
              <div class="font-[400] text-[12px] leading-[14.63px] flex flex-col gap-2">
              <a href="{{ route('user.allevents', ['filter' => 'desc', 'order_by' => 'id']) }}">
              New Event</a>
              <a href="{{ route('user.allevents', ['filter' => 'desc', 'order_by' => 'event_date_submitted']) }}">
              All Submitted Event</a>
              <a href="{{ route('user.allevents', ['filter' => 'asc', 'order_by' => 'event_date_created']) }}">
              Earliest Ending Event</a>
              <a href="{{ route('user.allevents', ['filter' => 'desc', 'order_by' => 'event_date_created']) }}">
              Newest to Oldest</a>
              <a href="{{ route('user.allevents', ['filter' => 'asc', 'order_by' => 'event_date_created']) }}">
              Oldest to Newest</a>
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

      <?php if(isset($eventList)){ $count=1; ?>
      <?php foreach($eventList as $key=>$item){  ?>
     
      <!-- Other Opportunites Start Here-->
      <div class="min-w-[330px] min-h-[260px] w-auto min-h-[50px] h-auto bg-[#FFFFFF] px-3 py-3 mt-3 overflow-auto cursor-pointer" style="box-shadow: 0px 3px 10px 0px #28388F33;" onclick="toggleButtons(event)">
        <h1
          class="w-[310px] h-[15px] ml-[10px] mt-[6px] font-Montserrat font-[500] text-[12px] leading-[14.63px] text-[#000000]" >
          Beneficiary Phone : {{$item['beneficiary_phone_number']}}</h1>
          <h1
          class="w-[310px] h-[15px] ml-[10px] mt-[6px] font-Montserrat font-[500] text-[12px] leading-[14.63px] text-[#000000]" >
          Beneficiary Name : {{$item['beneficiary_name']}}</h1>

        <div class="flex justify-between">
          <div class="">
            <div class="flex mb-[3px]">
              <img src="{{asset('asset/images/file.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px] mt-[8px] text-[#28388F0D]">
              <a href=""
                class="w-[151px] h-[12px] mt-[9px] ml-[8px] font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#28388F] text-left underline underline-offset-auto decoration-solid decoration-skip-ink-none">View
                Uploaded Document
              </a>
              <img src="{{asset('asset/images/Group.png')}}" alt="engLogo" class="w-[20px] h-[20px] mt-[6px] ml-[10px] text-[#28388F0D]">
            </div>

            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/Rupee Icon.png')}}" alt="engLogo" class="w-[9px] h-[12px] ml-[12px]  text-[#28388F0D]">
              <p class="w-[195px] h-[12px]  ml-[10px] font-Montserrat font-[500] text-[10px] leading-[12.19px]">
              Event Type: {{$item['Event']['event_type']}}
              </p>
            </div>

            <div class="flex mb-[5px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[195px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              Event Category: {{$item['Event']['event_category']}}
              </p>
            </div>

            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[195px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              Created Date - {{getdateformate($item['event_date_created'])}}
              </p>
            </div>
            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[195px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              Submitted Date - {{getdateformate($item['event_date_submitted'])}}
              </p>
            </div>


          </div>
          <div class="">
            <p
              class="w-[43px] h-[22px] font-Montserrat font-[500] text-[9px] leading-[10.97px] text-center text-[#000000]  mt-[-10px] ml-[9px]">
              Event Value
            </p>
            <div
              class="w-[60px] h-[50px] bg-[#FAFAFA] mt-1 mr-[20px] flex items-center justify-center">
              <p
                class="w-[60px] h-[30px] font-Montserrat font-[700] text-[12px] leading-[14.63px] text-center text-[#000000]">
                {{$item['event_value']}} 
             </p>

            </div>

           

          </div>
        </div>
        <div  class="buttonsContainer flex mt-4 gap-2 hidden">
            <div class="w-auto h-auto min-w-[100%] min-h-[40px] rounded-[10px] border-[1px] bg-[#F2F2F2] border-[#28388F] flex justify-center items-center gap-2">
              <img src="{{asset('asset/images/AssignLearners Icon.png')}}" alt="Fill_Form" class="w-auto h-auto max-w-[14px] max-h-[14px]">
              <a href="{{route('opportunitiesLearner',['id'=>encryptString($item['id'])])}}" class="w-auto h-auto font-[500] text-[12px] leading-[14.63px] text-[#28388F] cursor-pointer">Assign Learners</a>
            </div>
        </div>
      </div>
      <?php } ?>
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

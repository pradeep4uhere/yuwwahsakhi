@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen10" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    @include('user.header')
    <div id="screen9" class=" max-w-[26rem] mx-auto p-4 bg-white  rounded-lg mt-10">
      <div class="mt-2 text-sm flex justify-between items-center">
        <h1 class="w-[152px] h-[17px] font-[500] text-[14px] leading-[17.07px] text-[#000000] mb-4">
        {{__('messages.assign_learners')}}
        </h1>

        <div class="flex items-center gap-2">
         
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
              <a href="{{ route('opportunities', ['filter' => 'desc', 'order_by' => 'id']) }}">
              New Event</a>
              <a href="{{ route('opportunities', ['filter' => 'desc', 'order_by' => 'end_date']) }}">
              Earliest Ending Event</a>
              <a href="{{ route('opportunities', ['filter' => 'asc', 'order_by' => 'start_date']) }}">
              Newest to Oldest</a>
              <a href="{{ route('opportunities', ['filter' => 'asc', 'order_by' => 'start_date']) }}">
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
              <a href="{{ asset('storage/' . $item['uploaded_doc_links']) }}"
                target="_blank"
                class="w-[151px] h-[12px] mt-[9px] ml-[8px] font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#28388F] text-left underline">
                  View Uploaded Document
              </a>
              <img src="{{asset('asset/images/Group.png')}}" alt="engLogo" class="w-[20px] h-[20px] mt-[6px] ml-[10px] text-[#28388F0D]">
            </div>

            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[195px] h-[12px]  ml-[10px] font-Montserrat font-[500] text-[10px] leading-[12.19px]">
              Event Type: {{($item['Event']!=null)?$item['Event']['event_type']:''}}
              </p>
            </div>

            <div class="flex mb-[5px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[195px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              Event Category: {{($item['Event']!=null)?$item['Event']['event_category']:''}} 
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
    </div>
    <div class="flex justify-between items-center mt-4">
        <div>
          <h1 class="w-[72px] h-[15px] font-[500] text-[12px] leading-[14.63px] text-[#000000]">
            {{__('messages.learner_list')}}
          </h1>
          <!-- Success message container -->
          <div id="successMsg" class="hidden text-green-600 text-sm mt-2">Learners assigned successfully!</div>

        </div>
        <div class="w-[150px] h-[30px] rounded-[10px] bg-[#28388F0D] flex justify-center items-center">
          <button onclick="assignLearner(event)" class="w-[191px] h-[12px] font-[500] text-[10px] leading-[12.19px] text-[#28388F] cursor-pointer">
            {{__('messages.update_learner')}}
          </button>
        </div>
      </div>
      <form id="learnerForm">
        @foreach($leanerList as $item)
        @php
          $top = 140 + ($loop->index * 80);
        @endphp

        <div class="min-w-[320px] min-h-[70px] w-auto h-auto rounded-[10px] bg-[#FFFFFF] mt-6 flex gap-2 items-center justify-between cursor-pointer" onclick="showScreen11()" style="box-shadow: 0px 4px 10px 0px #00000026;">
        <div class="flex justify-center gap-2 items-center">
          <div class="w-[40px] h-[40px] ml-2">
            <img src="{{asset('asset/images/user.jpg')}}" alt="">
          </div>
          <div class="flex flex-col items-center gap-1.5">
            <div class="min-w-[86px] min-h-[17px] h-auto w-auto ml-[5px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-[#000000]">
            {{$item['first_name']}}
            </div>
            <div class="flex gap-1.5 ">
              <span>
                <img src="{{asset('asset/images/Learner calendar.png')}}" class="w-[10px] h-[10px]" alt="">
              </span>
              <span class="min-w-[64px] min-h-[12px] w-auto h-auto font-[500] text-[10px] leading-[12.19px] text-[#000000]">
              {{getdateformate($item['date_of_birth'])}}
              </span>
            </div>
          </div>
        </div>
        <div class="mr-4 self-center">
          <input type="checkbox" name="learner[]" value="{{ encryptString($item['id']) }}" class="w-[20px] h-[20px]" 
          @if(in_array($item['id'], $learnerIdArr->toArray())) checked="checked" @endif>

        </div>
      </div>
      @endforeach
      <input type="hidden" value="{{$ysid}}" name="ysid"/>
      <input type="hidden" value="{{$opid}}" name="opid"/>
      <input type="hidden" value="{{$type}}" name="type"/>
      
  </form>
  </div>

  <script>
  function assignLearner(event) {
    event.preventDefault(); // Stop form submission

    let form = document.getElementById('learnerForm');
    let formData = new FormData(form);

    // Send AJAX request
    fetch("{{ route('event.save.assignLearner') }}", {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": '{{ csrf_token() }}'
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        document.getElementById('successMsg').classList.remove('hidden');
        document.getElementById('successMsg').textContent = "Learners assigned successfully!";
        
        // Optionally reset form
        // form.reset();
      } else {
        alert("Something went wrong.");
      }
    })
    .catch(err => {
      console.error("Error:", err);
      alert("Failed to assign learners.");
    });
  }
</script>

  @include('user.bottom_menu')
@endsection

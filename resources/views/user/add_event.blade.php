@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    @include('user.header')
    <div id="screen12" class="max-w-sm mx-auto p-4 bg-white  rounded-lg">
      <div class="mt-2 text-sm">
        <h1 class="font-[500] text-[14px] leading-[17.07px] text-[#000000] ml-8 mt-3">
           Event
        </h1>
      </div>
    <div class="mt-10">
    {{-- To show success or failure --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4 mt-5">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
      @if ($errors->any())
              <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                  <ul class="list-disc list-inside text-sm">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
    </div>
      <form class="space-y-4 mt-6" action="{{route('storeeventtransaction')}}" method="post" enctype='multipart/form-data'>
        @csrf
        <div class="space-y-1">
          <label for="opportunity" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Beneficiary Phone Number</label>
          <input id="beneficiary_phone_number" type="text" name="beneficiary_phone_number" placeholder="Please Enter  phone number" class="text-xs w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]"  value="{{ old('beneficiary_phone_number') }}">
        </div>
        <div class="space-y-1">
          <label for="opportunity" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Beneficiary Name</label>
          <input id="Description" type="text" name="beneficiary_name" placeholder="Please Enter beneficiary name" class="text-xs w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]" value="{{ old('beneficiary_name') }}">
        </div>
        <div class="space-y-1">
          <label for="opportunity" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Event Type</label>
         
        </div>
        <div class="space-y-1">
          <select name="event_type" id="event_type" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]" style="width:100%; padding:10px; border:solid 1px #ccc">
            <option value="">Choose Event Type</option>
            @foreach($eventList as $item)
            <option value="{{$item['id']}}">{{$item['event_type']}}</option>
            @endforeach
          </select>
        </div>
        <div class="space-y-1">
          <label for="event_category" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Event Category</label>
          <input id="event_category" type="text" name="event_category" placeholder="Please Enter event_category" readonly="readonly" class="text-xs w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]"  value="{{ old('event_category') }}">
        </div>
       
        <div class="space-y-1 mt-2">
          <label for="potential" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Event Value</label>
          <input id="event_value" name="event_value" type="text" placeholder="Please enter event value" class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]"  value="{{ old('event_value') }}">
        </div>
        <div class="space-y-1 mt-2">
          <label for="potential" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">YS ID</label>
          <input id="sakhi_id" name="sakhi_id" type="text"  class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]" value="{{getSakhiID()}}" readonly="readonly">
        </div>
        <div class="space-y-1 mt-2">
          <label for="potential" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Comment</label>
          <input id="comment" name="comment" type="text"  class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]"   value="{{ old('comment') }}">
        </div>
        <div class="space-y-1 mt-2">
          <label for="potential" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Uploaded Doc Link(s)</label>
          <input id="uploaded_doc_links" name="uploaded_doc_links" type="file"  class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]">
        </div>
      
      
        </div>
        <div class="flex justify-center ">
          <button class="w-[250px] h-[40px] rounded-[8px] mt-[1rem] mb-[8rem] bg-[#28388F] text-[#FFFFFF]  py-1 pb-[6px] text-[14px] font-[600]">
            Save Event
          </button>
        </div>
      </form>

    </div>
</div>

<script>
  $('#event_type').on('change', function () {
    var eventTypeId = $(this).val();
    $('#event_category').html('<option>Loading...</option>');
    $.ajax({
      url: "{{ route('fetch.event.categories') }}",
      method: 'POST',
      data: {
        _token: "{{ csrf_token() }}",
        event_type: eventTypeId
      },
      success: function (data) {
        $('#event_category').val(data.category_name);
      },
      error: function () {
        alert('Error fetching categories');
      }
    });
  });
</script>
<script>
function handleFileUploadFile(event) {
    const file = event.target.files[0];
    if (file) {
        const wrapper = event.target.closest('.flex');
        const fileNameSpan = wrapper.querySelector('.file-name-display');
        if (fileNameSpan) {
        fileNameSpan.textContent = file.name;
        fileNameSpan.classList.remove('text-[#A7A7A7]');
        fileNameSpan.classList.add('text-black');
        }
    }
}

function addNewUploadFile() {
  const container = document.getElementById('file-upload-container');

  // First, change the last button (if any) to become a remove button
  const allBlocks = container.querySelectorAll(".space-y-2");
  allBlocks.forEach(block => {
    const button = block.querySelector("a");
    if (button) {
      button.setAttribute("onclick", "removefile(this)");
      button.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      `;
    }
  });

  // Now create new block with the "add" button
  const newUpload = document.createElement('div');
  newUpload.className = "space-y-1";
  newUpload.innerHTML = `<div class="space-y-2" style="margin-bottom:10px;">
          <div class="flex items-center space-x-2">
            <div class="flex items-center border border-gray-300 rounded-[10px] px-2 py-3 w-full">
              <span id="file-name[]" class="font-[400] text-[12px] leading-[12.19px] text-[#A7A7A7]  flex-grow ">Upload Document</span>
              <label class="hover:text-blue-500 cursor-pointer">
                <input type="file" name=document[] id="file-upload[]" class="hidden" onchange="handleFileUploadFile(event)">
                <img src="{{asset('asset/images/paperclip.png')}}" alt="" class="w-[16px] h-[16px]">
              </label>
            </div>
            <a class="text-gray-500 hover:text-red-500 border border-gray-300 rounded-full p-1" onclick="addNewUploadFile()">
               <img src="{{asset('asset/images/Add-plus-circle.png')}}" alt="add file" class=" h[20px] w-[20px]">
               
            </a>
          </div>
        </div>`;

  container.appendChild(newUpload);
}

function removefile(el) {
  const block = el.closest(".space-y-1");
  if (block) block.remove();
}
</script>
@include('user.bottom_menu')
@endsection

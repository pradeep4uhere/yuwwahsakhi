@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    @include('user.header')
    <div id="screen12" class="max-w-sm mx-auto p-4 bg-white  rounded-lg">
      <div class="mt-2 text-sm">
        <h1 class="font-[500] text-[14px] leading-[17.07px] text-[#000000]">
          Add Opportunity
        </h1>
      </div>
     

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
      <form class="space-y-4 mt-6" action="{{route('saveopportunites')}}" method="post" enctype='multipart/form-data'>
        @csrf
        <div class="space-y-1">
          <label for="opportunity" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Opportunity
            Name</label>
          <input id="opportunity" type="text" name="opportunity_name" placeholder="Please Enter Opportunity Name" class="text-xs w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]">
        </div>
        <div class="space-y-1">
          <label for="opportunity" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Opportunity
            Description</label>
          <input id="Description" type="text" name="description" placeholder="Please Enter Description" class="text-xs w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]">
        </div>
        <div class="space-y-1 mt-1">
          <label for="opportunity" name="opportunity_type" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Opportunity
            Type</label>
          <div class="space-y-2 mt-4">
            <label class="flex items-center space-x-2">
              <input type="radio" name="opportunity_type" value="job" class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500">
              <span class="font-[400] text-[14px] leading-[17.07px] text-[#000000] ">Job</span>
            </label>
            <label class="flex items-center space-x-2">
              <input type="radio" name="opportunity_type" value="entrepreneurship" class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500" checked="">
              <span class="font-[400] text-[14px] leading-[17.07px] text-[#000000]">Entrepreneurship</span>
            </label>
          </div>
        </div>
        <div class="space-y-1 mt-2">
          <label for="potential" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Earning Potential (Per
            Month)</label>
          <input id="opportunity" name="payout_monthly" type="text" placeholder="Please enter how much can be earned in a month" class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]">
        </div>
        <div class="space-y-1 mt-2">
          <label for="potential" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Start Date</label>
          <input id="start_date" name="start_date" type="date" placeholder="Please enter how much can be earned in a month" class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]">
        </div>
        <div class="space-y-1 mt-2">
          <label for="potential" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">End Date</label>
          <input id="end_date" name="end_date" type="date" placeholder="Please enter how much can be earned in a month" class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]">
        </div>
        <div class="space-y-1 mt-2">
          <label for="potential" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Number Of Openings</label>
          <input id="number_of_openings" name="number_of_openings" type="number"  class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]">
        </div>
        <div class="space-y-1">
          <label class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Attach Documents</label>
          <div class="flex items-center space-x-2">
            <div class="flex items-center border border-gray-300 rounded-[10px] px-2 py-3 w-full">
              <span id="file-name[]" class="font-[400] text-[12px] leading-[12.19px] text-[#A7A7A7]  flex-grow ">Upload Document</span>
              <label class="hover:text-blue-500 cursor-pointer">
                <input type="file" id="file-upload[]" name=document[] class="hidden" onchange="handleFileUploadFile(event)">
                <img src="{{asset('asset/images/paperclip.png')}}" alt="" class="w-[16px] h-[16px]">
              </label>
            </div>
            <a class="text-gray-500 hover:text-red-500 border border-gray-300 rounded-full p-1" onclick="addNewUploadFile()">
                <img src="{{asset('asset/images/Add-plus-circle.png')}}" alt="add file" class=" h[20px] w-[20px]">
            </a>
          </div>
        </div>
       
        <!-- Container where new upload blocks will be added -->
        <div id="file-upload-container">
        </div>
        <!-- Initial upload block (your existing one) will be here -->
        </div>

        <div class="flex justify-center ">
          <button class="w-[250px] h-[40px] rounded-[8px] mt-[1rem] mb-[8rem] bg-[#28388F] text-[#FFFFFF]  py-1 pb-[6px] text-[14px] font-[600]">
            Save Opportunity
          </button>
        </div>
      </form>

    </div>
</div>
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

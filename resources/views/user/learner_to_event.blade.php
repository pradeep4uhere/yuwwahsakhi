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
          <label for="opportunity" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Event Name</label>
          <input value="{{$item['event_name']}}" id="event_name" type="text" name="event_name" placeholder="Please Enter Event Name" class="text-xs w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]">
          <input value="{{$item['id']}}" type="hidden" name="id"  >
        </div>
        
        <div class="space-y-1 relative">
        <label for="opportunity" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Beneficiary Name</label>
        <input value="{{$item['beneficiary_name']}}" id="beneficiary_name" type="text" name="beneficiary_name"
          placeholder="Please Enter beneficiary name"
          class="text-xs w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]"
          autocomplete="off">

        <!-- Suggestions container -->
        <div id="suggestions" class="absolute z-10 bg-white border w-full mt-1 rounded shadow-md hidden"></div>
      </div>
        <div class="space-y-1">
          <label for="opportunity" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Beneficiary Phone Number</label>
          <input value="{{$item['beneficiary_phone_number']}}" id="beneficiary_number" type="text" name="beneficiary_phone_number" placeholder="Please Enter  phone number" class="text-xs w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]" >
        </div>
        <div class="space-y-1">
          <label for="opportunity" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Event Type</label>
        <div class="space-y-1">
          <select name="event_type" id="event_type" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]" style="width:100%; padding:10px; border:solid 1px #ccc" onchange="fetchEventDocuments()">
            <option value="">Choose Event Type</option>
            @foreach($eventList as $itemsVal)
            <option value="{{$itemsVal['id']}}" <?php if($item['event_id']==$itemsVal['id']){ ?> selected="selected" <?php } ?> >{{$itemsVal['event_type']}}</option>
            @endforeach
          </select>
        </div>
        <div class="space-y-1">
          <label for="event_category" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Event Category</label>
          <select name="event_category" id="event_category" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]" style="width:100%; padding:10px; border:solid 1px #ccc">
              <option value="{{$item['event_category']}}">{{$item['event_category']}}</option>
          </select>
        </div>
       
        <div class="space-y-1 mt-2">
          <label for="potential" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Event Value</label>
          <input value="{{$item['event_value']}}" id="event_value" name="event_value" type="text" placeholder="Please enter event value" class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]"  value="{{ old('event_value') }}">
        </div>
        
        <div class="space-y-1 mt-2">
          <label for="potential" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">Comment</label>
          <input value="{{$item['comment']}}" id="comment" name="comment" type="text"  class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]" >
        </div>
       
        <div id="documentInputsContainer" class="space-y-1 mt-2">
          
          @foreach($documentArr as $key=>$itemVal)
          <div class="space-y-1 mt-2">
              <label for="document_${index+1}" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">
                Upload Document {{$itemVal['doc_name']}}
              </label>
            <?php $extension = strtolower(pathinfo($itemVal['document'], PATHINFO_EXTENSION)); 
              if (in_array($extension, ['jpg', 'jpeg', 'png'])) { ?>
                <img src="{{asset('storage/'.$itemVal['document'])}}" height="100" width="100">
               <?php }else{ ?>
                <a href="">View File</a>
               <?php } ?>
              
              <input id="{{$key}}" name="document_doc_{{$key+1}}" type="file"
                class="text-xs w-full border rounded px-3 py-2 text-sm placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]">
            </div>
          @endforeach
          <!-- Dynamic input fields will be appended here -->
        </div>
        </div>
        <div>
          <hr/>
        <div class="space-y-1 mt-2">
        <label for="document_${index+1}" class="font-[800] text-[12px] leading-[14.63px] text-[#000000]">
          Comments By Reviwer
        </label>
        @php
            $comments = getEventComment($item['id'], false);
        @endphp
        @if ($comments->isNotEmpty())
        <table class="table table-striped table-bordered" style="width:100%">
            <tbody>
            <tr style="font-size:13px">
                <td nowrap="nowrap"><strong>Date</strong></td>
                <td nowrap="nowrap"><strong>All Comment</strong></td>
            </tr>
            @foreach ($comments as $comment)
            <tr>
              <td><div class="font-[400] text-[12px] leading-[14.63px] text-[#000000] mb-1">{{getdateformate($comment->created_at)}}</div></td>
              <td><div class="font-[400] text-[12px] leading-[14.63px] text-[#000000] mb-1">
                    {{ $comment->comment ?? 'N/A' }}
                </div>
              </td>
              </tr>
            @endforeach
            <tr>
              <td colspan="2">
              <div class="space-y-1 mt-2">
                <input placeholder="Enter New comment"  id="external_comment" name="external_comment" type="text"  class="text-xs w-full border rounded px-3 py-2 text-sm  placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]" >
              </div>
       
              </td>
            </tr>
            </tbody>
            </table>
        @else
            <div class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">
                N/A
            </div>
        @endif
        </div>
        </div>
        <div class="flex justify-center ">
          <button name="action" type="submit" value="save" class="w-[250px] h-[40px] rounded-[1px] mt-[1rem] mr-[1rem] mb-[8rem] bg-[#1677ff] text-[#FFFFFF]  py-1 pb-[6px] text-[14px] font-[600]">
            Save Event
          </button>
          <button name="action" type="submit" value="submit" class="w-[250px] h-[40px] rounded-[1px] mt-[1rem] mb-[8rem] bg-[#28388F] text-[#FFFFFF]  py-1 pb-[6px] text-[14px] font-[600]">
            Submit Event
          </button>
        </div>
      </form>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
<script>
$('#event_type').on('change', function () {
        let eventTypeId = $(this).val();

        if (eventTypeId) {
            $.ajax({
                url: "{{route('user.event.document')}}",
                method: 'GET',
                data: { event_type_id: eventTypeId },
                success: function (response) {
                  console.log(response);
                  // Clear previous document inputs
                  $('#documentInputsContainer').empty();

                  // Dynamically create input fields
                  $.each(response.document, function (index, value) {
                      let inputHTML = `
                      <div class="space-y-1 mt-2">
                        <label for="document_${index+1}" class="font-[400] text-[12px] leading-[14.63px] text-[#000000]">
                          Upload Document ${value}
                        </label>
                        <input id="document_${index+1}" name="document_${index+1}" type="file"
                          class="text-xs w-full border rounded px-3 py-2 text-sm placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7] rounded-[10px] placeholder:border-[1px]">
                      </div>`;
                      
                      $('#documentInputsContainer').append(inputHTML);
                  });

                    $('#event_category').empty().append('<option value="">Choose Event Category</option>');
                    $.each(response.category, function (key, value) {
                        $('#event_category').append('<option value="'+ value+'">'+ value+'</option>');
                    });
                },
                error: function (xhr) {
                    alert('Could not fetch document types.');
                    console.log(xhr.responseText);
                }
            });
        } else {
            $('#document_type').empty().append('<option value="">Choose Document Type</option>');
        }
    });
</script>
<script>
  $(document).ready(function () {
    $('#beneficiary_name').on('keyup', function () {
        let query = $(this).val();
        if (query.length > 1) {
            $.ajax({
                url: "{{ route('get.beneficiaries') }}", // You need to define this route
                type: "GET",
                data: { name: query },
                success: function (data) {
                    let suggestions = $('#suggestions');
                    suggestions.empty().removeClass('hidden');
                    
                    if (data.length === 0) {
                        suggestions.html('<div class="px-3 py-1 text-sm text-gray-500">No results found</div>');
                    } else {
                        $.each(data, function (i, item) {
                            suggestions.append(
                                `<div class="px-3 py-2 cursor-pointer hover:bg-blue-100 text-sm" data-name="${item.first_name}" data-number="${item.primary_phone_number}">
                                    ${item.first_name} | ${item.primary_phone_number}
                                </div>`
                            );
                        });
                    }
                }
            });
        } else {
            $('#suggestions').addClass('hidden').empty();
        }
    });

    // Handle click on suggestion
    $(document).on('click', '#suggestions div', function () {
        let name = $(this).data('name');
        let primary_phone_number = $(this).data('number');
        //alert(primary_phone_number);
        $('#beneficiary_name').val(name);
        $('#beneficiary_number').val(primary_phone_number);
        $('#suggestions').addClass('hidden').empty();
    });

    // Optional: hide suggestions when clicking outside
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#beneficiary_name, #suggestions').length) {
            $('#suggestions').addClass('hidden').empty();
        }
    });
});
</script>

@include('user.bottom_menu')
@endsection

@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<style>
  .mobile-app-shell {
    width: 100%;
    max-width: 430px;
    margin: 0 auto;
    min-height: 100vh;
    background: linear-gradient(180deg, #f8fbff 0%, #edf3fa 100%);
    box-shadow: 0 12px 40px rgba(15, 23, 42, 0.10);
    position: relative;
    overflow: visible;
}

.app-body {
    padding: 16px 14px 110px;
}

.page-section {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.page-heading-card {
    background: linear-gradient(135deg, #ffffff 0%, #eef4ff 100%);
    border: 1px solid #dbe7ff;
    border-radius: 22px;
    padding: 18px 16px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
}

.page-heading-card h1 {
    margin: 0 0 6px;
    font-size: 18px;
    font-weight: 800;
    color: #111827;
}

.page-heading-card p {
    margin: 0;
    font-size: 12px;
    line-height: 1.6;
    color: #667085;
}

.premium-form-card {
    background: #ffffff;
    border-radius: 24px;
    padding: 18px 16px;
    box-shadow: 0 14px 34px rgba(15, 23, 42, 0.08);
    border: 1px solid #e8eef8;
}

.form-grid {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.form-group label {
    font-size: 13px;
    font-weight: 700;
    color: #1f2937;
}

.form-group-relative {
    position: relative;
}

.app-input,
.app-select {
    width: 100%;
    min-height: 48px;
    border: 1px solid #dbe4f0;
    border-radius: 14px;
    padding: 12px 14px;
    font-size: 13px;
    color: #111827;
    background: #f9fbff;
    outline: none;
    transition: 0.2s ease;
}

.app-input:focus,
.app-select:focus {
    border-color: #2563eb;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
}

.app-input::placeholder {
    color: #9ca3af;
}

.dynamic-documents-wrap {
    margin-top: 14px;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.document-upload-card {
    background: #f8fbff;
    border: 1px solid #dbe7ff;
    border-radius: 16px;
    padding: 14px;
}

.document-upload-card label {
    display: block;
    margin-bottom: 8px;
    font-size: 13px;
    font-weight: 700;
    color: #1f2937;
}

.document-upload-card input[type="file"] {
    width: 100%;
    border: 1px dashed #b8c8e8;
    border-radius: 14px;
    padding: 12px;
    background: #fff;
    font-size: 12px;
}

.form-action-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 20px;
}

.primary-solid-btn,
.primary-outline-btn {
    border: none;
    min-height: 48px;
    border-radius: 16px;
    font-size: 13px;
    font-weight: 800;
    cursor: pointer;
    transition: 0.25s ease;
    padding: 12px 10px;
}

.primary-solid-btn {
    background: linear-gradient(135deg, #28388f 0%, #3b82f6 100%);
    color: #fff;
    box-shadow: 0 12px 24px rgba(40, 56, 143, 0.22);
}

.primary-outline-btn {
    background: #eef4ff;
    color: #28388f;
    border: 1px solid #c9d8ff;
}

.primary-solid-btn:hover,
.primary-outline-btn:hover {
    transform: translateY(-1px);
}

.app-alert {
    border-radius: 16px;
    padding: 14px 15px;
    font-size: 13px;
    font-weight: 600;
    line-height: 1.6;
}

.alert-success {
    background: #ecfdf3;
    color: #027a48;
    border: 1px solid #abefc6;
}

.alert-info {
    background: #eff8ff;
    color: #175cd3;
    border: 1px solid #b2ddff;
}

.alert-default {
    background: #f8fafc;
    color: #334155;
    border: 1px solid #e2e8f0;
}

.alert-error {
    background: #fff1f2;
    color: #be123c;
    border: 1px solid #fecdd3;
}

.error-list {
    margin: 0;
    padding-left: 18px;
}

.beneficiary-suggestions {
    position: absolute;
    top: calc(100% + 6px);
    left: 0;
    width: 100%;
    background: #ffffff;
    border: 1px solid #dbe4f0;
    border-radius: 16px;
    box-shadow: 0 16px 40px rgba(15, 23, 42, 0.10);
    z-index: 80;
    overflow: hidden;
}

.beneficiary-suggestions.hidden {
    display: none;
}

.beneficiary-suggestions div {
    padding: 12px 14px;
    font-size: 13px;
    cursor: pointer;
    border-bottom: 1px solid #eef2f7;
}

.beneficiary-suggestions div:last-child {
    border-bottom: 0;
}

.beneficiary-suggestions div:hover {
    background: #eef4ff;
}

@media (max-width: 380px) {
    .app-body {
        padding: 14px 12px 110px;
    }

    .premium-form-card {
        padding: 16px 14px;
    }

    .form-action-row {
        grid-template-columns: 1fr;
    }
}
</style>
<div id="screen7" class="mobile-app-shell">
    @include('user.header')

    <div class="app-body">
        <section class="page-section">
            <div class="page-heading-card">
                <h1>{{ __('messages.event') }}</h1>
                <p>Create and submit a new event with beneficiary details and documents.</p>
            </div>

            {{-- Alerts --}}
            @if (session('success'))
                @php
                    $type = session('type');
                    $classes = match ($type) {
                        'success' => 'alert-success',
                        'info'    => 'alert-info',
                        default   => 'alert-default',
                    };
                @endphp

                <div class="app-alert {{ $classes }}">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="app-alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="app-alert alert-error">
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="premium-form-card" action="{{ route('storeeventtransaction') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="event_type">{{ __('messages.event_type') }}</label>
                        <select name="event_type" id="event_type" class="app-input app-select">
                            <option value="">{{ __('messages.choose_event_type') }}</option>
                            @foreach($eventList as $item)
                                <option value="{{ $item['id'] }}" {{ old('event_type') == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="event_category">{{ __('messages.choose_event_category') }}</label>
                        <select name="event_category" id="event_category" class="app-input app-select">
                            <option value="">{{ __('messages.choose_event_category') }}</option>
                            @foreach($eventCategoryList as $category)
                                <option value="{{ $category['id'] }}"
                                    {{ old('event_category', $model->event_category ?? '') == $category['id'] ? 'selected' : '' }}>
                                    {{ $category['event_category'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group form-group-relative">
                        <label for="beneficiary_name">{{ __('messages.choose_beneficiary_name') }}</label>
                        <input id="beneficiary_name"
                               type="text"
                               name="beneficiary_name"
                               placeholder="Please type beneficiary name and choose"
                               class="app-input"
                               autocomplete="off"
                               value="{{ old('beneficiary_name') }}">

                        <div id="suggestions" class="beneficiary-suggestions hidden"></div>
                        <input id="learner_id" type="hidden" name="learner_id">
                    </div>

                    <div class="form-group">
                        <label for="beneficiary_number">{{ __('messages.beneficiary_phone_number') }}</label>
                        <input id="beneficiary_number"
                               type="text"
                               name="beneficiary_phone_number"
                               placeholder="Please enter phone number"
                               class="app-input"
                               value="{{ old('beneficiary_phone_number') }}"
                               readonly>
                    </div>

                    <div class="form-group">
                        <label for="event_value">{{ __('messages.monthly_salary') }}</label>
                        <input id="event_value"
                               name="event_value"
                               type="text"
                               placeholder="Please enter income value"
                               class="app-input"
                               value="{{ old('event_value') }}">
                    </div>

                    <div class="form-group">
                        <label for="comment">{{ __('messages.comment') }}</label>
                        <input id="comment"
                               name="comment"
                               type="text"
                               placeholder="Write a short comment"
                               class="app-input"
                               value="{{ old('comment') }}">
                    </div>
                </div>

                <div id="documentInputsContainer" class="dynamic-documents-wrap">
                    <!-- dynamic input fields -->
                </div>

                <div class="form-action-row">
                    <button name="action" type="submit" value="save" class="primary-outline-btn">
                        {{ __('messages.save') }} {{ __('messages.event') }}
                    </button>

                    <button name="action" type="submit" value="submit" class="primary-solid-btn">
                        {{ __('messages.submit') }} {{ __('messages.event') }}
                    </button>
                </div>
            </form>
        </section>
    </div>

    @include('user.bottom_menu')
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
function resetBeneficiaryFields() {
    $('#beneficiary_name, #beneficiary_number, #learner_id').val('');
}
$('#event_type').on('change', function () {
        let eventTypeId = $(this).val();
        resetBeneficiaryFields();
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
                      <div class="document-upload-card">
                          <label for="document_${index+1}">Upload Document ${value}</label>
                          <input id="document_${index+1}" name="document_${index+1}" type="file">
                      </div>`;
                        
                      $('#documentInputsContainer').append(inputHTML);
                  });

                    $('#event_category').empty().append('<option value="">Choose Event Category</option>');
                    $.each(response.category, function (key, value) {
                        $('#event_category').append('<option value="'+ key +'">'+ value+'</option>');
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
$('#event_category').on('change', function () {
        let eventTypeId = $(this).val();
        resetBeneficiaryFields();
        if (eventTypeId) {
            $.ajax({
                url: "{{route('user.eventcategory.document')}}",
                method: 'GET',
                data: { event_type_id: eventTypeId },
                success: function (response) {
                  console.log(response);
                  // Clear previous document inputs
                  $('#documentInputsContainer').empty();

                  // Dynamically create input fields
                  $.each(response.document, function (index, value) {
                    if (value) {
                      let inputHTML = `
                      <div class="document-upload-card">
                          <label for="document_${index+1}">Upload Document ${value}</label>
                          <input type="hidden" name="document_fields[]" value="document_${index+1}"/>
                          <input id="document_${index+1}" name="document_${index+1}" type="file">
                      </div>`;
                      
                      $('#documentInputsContainer').append(inputHTML);
                    }
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
      // ✅ Auto trigger if old data exists
      @if(old('event_category', isset($model) ? $model->event_category : false))
        $('#event_category').trigger('change');
    @endif
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
                  console.log(data);
                  if(data.status===false){
                    let suggestions = $('#suggestions');
                    suggestions.empty().removeClass('hidden');
                    suggestions.html('<div class="px-3 py-1 text-sm text-red-500"> Opps, '+data.message+'</div>');
                  }else{
                    let suggestions = $('#suggestions');
                    suggestions.empty().removeClass('hidden');
                    if (data.dataSet.length === 0) {
                        suggestions.html('<div class="px-3 py-1 text-sm text-red-500">No results found</div>');
                    } else {
                        $.each(data.dataSet, function (i, item) {
                          console.log(item)
                            suggestions.append(
                                `<div class="px-3 py-2 cursor-pointer hover:bg-blue-100 text-sm" data-name="${item.first_name}" data-learner_id="${item.id}" data-number="${item.primary_phone_number}">
                                    ${item.first_name} | ${item.primary_phone_number}
                                </div>`
                            );
                        });
                    }
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
        let learner_id = $(this).data('learner_id');
        let event_type = $("#event_type").val();
        if(event_type==3){
           // Optional: show loader
          Swal.fire({
              title: 'Validating learner...',
              text: 'Please wait',
              allowOutsideClick: false,
              didOpen: () => {
                  Swal.showLoading();
              }
          });
            $.ajax({
              url: "{{ route('get.check-event-transaction') }}",
              type: 'POST',
              data: {
                  event_type: event_type,
                  learner_id: learner_id,
                  _token: $('meta[name="csrf-token"]').attr('content')
              },
              success: function (response) {
                  Swal.close();
                  if (response.status === true) {
                      // ✅ Assign values only if API allows
                      $('#beneficiary_name').val(name);
                      $('#learner_id').val(learner_id);
                      $('#beneficiary_number').val(primary_phone_number);

                      $('#suggestions').addClass('hidden').empty();

                      Swal.fire({
                        icon: 'success',
                        title: 'Validated',
                        text: 'Learner selected successfully',
                        timer: 1500,
                        showConfirmButton: false
                    });
                  } else {
                      // ❌ Block and show message
                       // ❌ Blocked
                      Swal.fire({
                          icon: 'error',
                          title: 'Not Allowed',
                          text: response.message || 'Event already exists for this learner.',
                          width: 380,
                          showClass: {
                              popup: 'swal2-noanimation'
                          },
                          confirmButtonText: 'OK',
                      });
                      //alert(response.message || 'Event already exists for this learner.');
                  }
              },
              error: function () {
                  Swal.close();
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: 'Something went wrong while validating the learner.'
                  });
                  //alert('Something went wrong while validating the learner.');
              }
          });
       }else{
          $('#beneficiary_name').val(name);
          $('#learner_id').val(learner_id);
          $('#beneficiary_number').val(primary_phone_number);
          $('#suggestions').addClass('hidden').empty();
        }
    });

    // Optional: hide suggestions when clicking outside
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#beneficiary_name, #suggestions').length) {
            $('#suggestions').addClass('hidden').empty();
        }
    });
});
</script>

@endsection

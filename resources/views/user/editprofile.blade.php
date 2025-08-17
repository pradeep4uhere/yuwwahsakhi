@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    <div id="screen8s" class=" max-w-sm mx-auto p-4 bg-white rounded-lg">
      @include('user.header')
      <div class="flex justify-between items-center mt-14">
        <h1>My Profile</h1>
      </div>
      @if (session('error'))
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
      @endif
      @if (session('success'))
      <div class="bg-green-100 text-green-700 p-4 rounded mb-4 mt-5">
        {{ session('success') }}
      </div>
      @endif

      @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="flex justify-center mt-4">
        @if($userDetails['ProfilePicture']!='')
        <img src="{{asset($userDetails['ProfilePicture'])}}" alt="profileLogo" class="h-14">
        @else
        <img src="{{asset('asset/images/Profilelogo.png')}}" alt="profileLogo" class="h-14">
        @endif
        <!-- <div class="rounded-full bg-blue-600 w-20 h-20">
          </div> -->
      </div>
      <p class="text-center">{{$userDetails['Name']}}</p>
        <div class="mt-4 text-xs">
        <div class="flex gap-4 ">
          <p class="w-1/2 font-semibold">{{__('messages.name')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="text" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="name" value="{{$userDetails['Name']}}"/>
        </div>
       

        

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.email')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="email" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="email" value="{{$userDetails['Email']}}"/>
        </div>


     
      
       
       
      



        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">{{__('messages.profile_picture')}}</p>
        </div>
        <div class="flex gap-4 ">
          <input type="file" class="mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]" name="profile_picture"/>
        </div>
      </div>
      <div class="flex justify-center ">
          <button class="w-[250px] h-[40px] rounded-[8px] mt-[1rem] mb-[8rem] bg-[#28388F] text-[#FFFFFF]  py-1 pb-[6px] text-[14px] font-[600]">
            Save 
          </button>
        </div>
    </div>
  </div>
  <script>
  function validateWorkHours(input) {
    let value = parseInt(input.value, 10);

    if (value > 24) {
      input.value = 24;
    } else if (value < 0 || isNaN(value)) {
      input.value = '';
    }
  }
</script>
@include('user.bottom_menu')
@endsection

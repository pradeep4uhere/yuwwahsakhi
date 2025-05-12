<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YuWaah Sakhi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- for date -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <!-- password icon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="style.css">
  <script src="index.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
</head>

<body class="font-Montserrat ">
  <div id="screen3" class=" mx-auto max-w-[26rem] p-10 bg-white shadow-md">
    <!-- <a href="apply.html" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </a> -->
    <a href="{{route('login')}}" class="">
      <!-- &larr; -->
      <img src="{{asset('asset/images/arrow-left.png')}}" alt="arrow-Left" class="w-[20px] h-[20px] relative top-10  hover:text-blue-600">
    </a>
    <div class="flex justify-center mb-4">
    <a href="{{route('welcome')}}">
      <img src="{{asset('asset/images/Yuwaahlogo.png')}}" alt="YuWaah Logo" class="w-[150px] h-[86px] ">
    </a>
    </div>
    @if(isset($error))
        <div class="mb-4 text-red-600">
            {{$error}}
        </div>
    @endif
    <form id="registrationForm" action="{{route('auth.register.complete')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Register Form -->
    <h1 class="w-[221px] h-[34px] font-[600] text-[28px] leading-[34.13px] text-[#000000] mb-6">Create Password</h1>
    <div class="space-y-1">
      <div class="space-y-1">
        <label for="mobile" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Email Address</label>
        <input type="email" id="email" name="email" value="{{old('email')}}" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>
      <div class="space-y-1">
        <label for="password" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Password</label>
        <input type="password" name="password"  placeholder="Enter password" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>
      <div class="space-y-1 mb-4">
        <label for="password_confirmation" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Confirm Password</label>
        <input type="password" name="password_confirmation" required  placeholder="Confirm password" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        <input type="hidden" name="mobile" value="{{$mobile}}"/>
      </div>
      </div>
      <div class="mt-10 flex justify-center items-center bg-[#28388F] w-[250px] h-[40px] rounded-[10px] relative left-12">
        <button type="submit"
          class="w-[171px] h-[17px] font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF] text-center">
         Submit
        </button>
      </div>
    </div>
    </form>
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  document.getElementById('registrationForm').addEventListener('submit', function (e) {
    const checkbox = document.getElementById('agreeCheckbox');
    if (!checkbox.checked) {
      e.preventDefault(); // stop form submission
      alert('Please agree to the Terms & Conditions to complete registration.');
    }
  });
</script>
</body>
</html>
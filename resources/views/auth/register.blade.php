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
      <img src="{{asset('asset/images/Yuwaahlogo.png')}}" alt="YuWaah Logo" class="w-[82px] h-[86px] ">
    </a>
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

     
    <form id="registrationForm" action="{{route('register')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Register Form -->
    <h1 class="w-[121px] h-[34px] font-[600] text-[28px] leading-[34.13px] text-[#000000] mb-6">Register</h1>
    <div class="space-y-1">
     <div class="space-y-1">
        <label for="YSID" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">YS ID</label>
        <input type="text" id="ysid" name="ysid" value="{{old('sakhi_id')}}" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
      

      <div class="space-y-1">
        <label for="mobile" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Mobile</label>
        <input type="text" id="mobile" name="mobile" value="{{old('mobile')}}" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>
      </div>
      <div class="flex gap-2 items-center pt-2 pb-2">
        <input type="checkbox" name="agree" id="agreeCheckbox" class="w-[15px] h-[15px] border-[1.25px] text-[#05A7D1]">
        <div class="w-[300px] h-[45px] font-[400] text-[12px] leading-[14.63px]  text-[#000000]">
          By complete the registration you are agreeing Terms and Conditions
          <a href="{{route('page.termsandconditions')}}" class="font-[700] text-[12px] leading-[14.63px] text-[#28388F] hover:underline">Terms & Conditions</a>
        </div>
      </div>

      <div class="flex justify-center items-center bg-[#28388F] w-[250px] h-[40px] rounded-[10px] relative left-12">
        <button type="submit"
          class="w-[171px] h-[17px] font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF] text-center">
         Procced
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
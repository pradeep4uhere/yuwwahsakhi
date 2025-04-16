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
</head>

<body class=" font-sans ">
  <div id="screen5" class="mx-auto max-w-[26rem] p-10 bg-white shadow-md min-h-[100vh] h-auto">
    <a href="{{route('login')}}" class="hover:text-blue-600 mb-4 text-lg">
        <img src="{{asset('asset/images/arrow-left.png')}}" alt="arrow-Left" class="w-[20px] h-[20px] mt-5 hover:text-blue-600">
    </a>

    <div class="w-[150px] h-[86px] flex justify-center mb-4 relative left-[90px]">
      <img src="{{asset('asset/images/Yuwaahlogo.png')}}" alt="YuWaah Logo" class="h-14">
    </div>
    <h1 class="w-[258px] h-[34px] font-[600] text-[28px] leading-[34.13px] mb-4">Forgot Password </h1>
   
      @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
    <form class="space-y-4" action="{{route('verifymobile')}}" method="post">
        @csrf
      <div class="space-y-1 text-xs">
        <label for="mobilenumber" class="w-[63px] h-[15px] font-[400] text-[12px] leading-[14.63px] text-[#000000]">Mobile Number</label>
        <input id="mobilenumber" name="mobilenumber" type="number" placeholder="Enter Mobile Number"
          class="w-[330px] h-[40px] rounded-[10px] border-[1px] bg-[#FFFFFF] placeholder:text-[10px] placeholder:font-[400] placeholder:font-Montserrat placeholder:leading-[12.19px] placeholder:pl-3">
      </div>
      <div class="flex justify-center items-center w-[250px] h-[40px] rounded-[10px] bg-[#28388F] relative left-11">
        <button type="submit"
          class=" w-[158px] h-[17px] font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF] text-center">
          Verify Mobile Number </button>
      </div>
    </form>
    <div class="mt-2 ">
      <p class="text-center font-[400] text-[12px] leading-[14.63px] text-[#000000]">
        Now to YuWaah? <a href="{{route('register')}}" class="font-[600] text-[12px] leading-[14.63px] text-[#05A7D1] hover:underline">Register</a>
      </p>
    </div>
    <div class="h-48"></div>
  </div>
</body>

</html>
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
  <div id="screen4" class="mx-auto max-w-[26rem] p-10 bg-white shadow-md min-h-[100vh] h-auto">

    <!-- <a href="register.html" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </a> -->
    <a href="{{route('welcome')}}"
    class="relative top-6">
    <!-- &larr; -->
    <img src="{{asset('asset/images/arrow-left.png')}}" alt="arrow-Left" class="w-[20px] h-[20px]">
  </a>

    <div class="flex justify-center mb-4">
    <a href="{{route('welcome')}}">
      <img src="{{asset('asset/images/Yuwaahlogo.png')}}" alt="YuWaah Logo" class="w-[150px] h-[86px]">
    </a>
    </div>
    <h1 class="w-[82px] h-[34px] font-[600] text-[28px] leading-[34.13px] text-[#000000]  mb-4">Login</h1>

    <form class="space-y-4 text-xs" action="{{route('user.login')}}" method="post">
      @csrf
      <div class="space-y-1">
        <label for="username" class="w-[63px] h-[15px] font-[400] text-[12px] leading-[14.63px] text-[#000000]">YS ID</label>
        <input id="username" type="text" placeholder="Enter username" name="email"
          class="w-[330px] h-[40px] rounded-[10px] border-[1px] bg-[#FFFFFF] placeholder:text-[10px] placeholder:font-[400] placeholder:font-Montserrat placeholder:leading-[12.19px] placeholder:pl-3">
          <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="password" class="w-[63px] h-[15px] font-[400] text-[12px] leading-[14.63px] text-[#000000]">Password</label>
        <div class="relative">
          <input id="password" type="password" placeholder="Enter Password" name="password"
            class="w-[330px] h-[40px] rounded-[10px] border-[1px] bg-[#FFFFFF] placeholder:text-[10px] placeholder:font-[400] placeholder:font-Montserrat placeholder:leading-[12.19px] placeholder:pl-3">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          <button type="button" id="togglePassword" class="absolute -right-[-30px] top-3 focus:outline-none">
            <i id="eyeIcon" class="fas fa-eye text-[#05A7D1] w-[16px] h-[16px]"></i>
          </button>
        </div>
      </div>

      <div class="flex justify-between">
        <span></span>
        <a href="{{route('recoverpassword')}}" class="relative right-2 w-[120px] h-[15px] font-[500] text-[12px] leading-[14.63px] text-[#05A7D1] hover:underline cursor-pointer ">Forgot
          Password</a>
      </div>

      <!-- <div class="flex justify-center items-center">
        <a href="todo.html"
          class="w-3/5 h-[40px] bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 pb-[6px] rounded-lg text-center">
          Login </a>
      </div> -->
      <div class="flex justify-center items-center w-[250px] h-[40px] rounded-[10px] bg-[#28388F] relative left-11">
        <button type="submit"
          class=" w-[41px] h-[17px] font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF]">
          Login </button>
      </div>
    </form>


    <div class="mt-2 ">
      <!-- <p class="text-center font-[400] text-[12px] leading-[14.63px] text-[#000000]">
        Now to YuWaah? <a href="register.html" class="font-[600] text-[12px] leading-[14.63px] text-[#05A7D1] hover:underline">Register</a>
      </p> -->
    </div>
  </div>
  <script>
    //  logic for show passeord
    document
      .getElementById("togglePassword")
      .addEventListener("click", function () {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");

        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          eyeIcon.classList.remove("fa-eye");
          eyeIcon.classList.add("fa-eye-slash");
        } else {
          passwordInput.type = "password";
          eyeIcon.classList.remove("fa-eye-slash");
          eyeIcon.classList.add("fa-eye");
        }
      });
  </script>


</body>

</html>
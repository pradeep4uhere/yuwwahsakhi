<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YuWaah Sakhi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="fast2sms" content="s2p0Ya8eRcLPPJV4vw5tVm1IlkP1e90N">
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
  <script src="https://kit.fontawesome.com/150e97665c.js" crossorigin="anonymous"></script>
</head>

<body class="">
  <!-- 1.................... Screen 1: About YuWaah ......-->
  <div id="screen1" class="mx-auto max-w-[26rem] h-screen bg-white shadow-md relative">
    <div class="absolute top-[44px] left-[160px]">
    <img src="{{asset('asset/images/Yuwaahlogo.png')}}" alt="YuWaah Logo" class="h-24" width="90px" height="90px">
    </div>

    <div class="">
      <h2
        class="w-[202px] h-[20px] absolute top-[184px] left-[100px] font-Montserrat font-[500] text-[16px] leading-[19.5px] text-center text-[#000000]">
        {{$YuwaahSakhiSetting['home_page_title']}}</h2>
        <div class="absolute top-[214px] left-[46px] w-[330px] text-[12px] leading-[1.3] font-Montserrat text-[#000000] prose prose-sm max-w-none">
          {!! $YuwaahSakhiSetting['description'] !!}
        </div>
    </div>

    <a href="{{route('login')}}"
    class="font-Montserrat font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF] ">
    <div
      class="w-[250px] h-[40px] relative top-[650px] left-[82px] rounded-[10px] bg-[#28388F] text-center pt-2.5 font-Montserrat">
      <div>
    @if(Auth::check())
        Home
    @else
        Login
    @endif
</div>
    </div>
    </a>

    <div class="mt-2 absolute top-[690px] left-[122px] font-Montserrat">
    @if(!Auth::check())
      <p class="text-center text-xs text-gray-600 font-Montserrat">
      <a href="{{route('recoverpassword')}}" class="text-[#28388F] font-semibold hover:underline text-sm">Generate New Password</a>
      </p>
      @else
      <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a href="route('admin.logout')" type="button"
                              onclick="event.preventDefault();
                                          this.closest('form').submit();" class="text-[#28388F] font-semibold hover:underline text-sm">
      
       This is not you ? Log Out
      
      </a>
              </form>
      @endif
    </div>
    <div class="h-48"></div>
  </div>

</body>

</html>
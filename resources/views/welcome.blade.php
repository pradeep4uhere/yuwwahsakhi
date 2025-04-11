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
  <script src="https://kit.fontawesome.com/150e97665c.js" crossorigin="anonymous"></script>
</head>

<body class="">
  <!-- 1.................... Screen 1: About YuWaah ......-->
  <div id="screen1" class="mx-auto max-w-[26rem] h-screen bg-white shadow-md relative">
    <div class="absolute top-[44px] left-[145px]">
    <img src="{{asset('asset/images/Yuwaahlogo.png')}}" alt="YuWaah Logo" class="h-14" width="100px" height="57px">
    </div>

    

    <div class="mx-auto relative left-[px]">
      <div class="absolute top-[120px] left-[20px]">
        <?php if($YuwaahSakhiSetting['home_page_banner_type']==2){ ?>
        <?php $youtubeEmbedUrl = getYouTubeVideoId($YuwaahSakhiSetting['youtube_url']);?>
        <iframe width="380" height="200" src="{{$youtubeEmbedUrl}}">
        </iframe>
        <?php }else{ ?>
          <!-- Left Arrow -->
        <button class="absolute top-[195px] left-[16px] w-[20px] h-[20px]  text-gray-700 hover:text-black">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
          <img src="{{asset('asset/images/Banner.png')}}" alt=" Logo" width="330px" height="184.33px">
        <!-- Right Arrow -->
        <button class="absolute top-[195px] left-[378px] w-[20px] h-[20px]">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
        <?php } ?>
      </div>
    </div>

    <div class="">
      <h2
        class="w-[202px] h-[20px] absolute top-[334px] left-[100px] font-Montserrat font-[500] text-[16px] leading-[19.5px] text-center text-[#000000]">
        {{$YuwaahSakhiSetting['home_page_title']}}</h2>
      <p
        class="w-[330px] h-[75px] absolute top-[364px] left-[46px] font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">
         {!!$YuwaahSakhiSetting['description']!!}
      </p>
    </div>

    <div
      class="w-[250px] h-[40px] relative top-[461px] left-[82px] rounded-[10px] bg-[#28388F] text-center pt-1.5 font-Montserrat">
      <a href="apply.html"
        class="w-[79px] h-[17px] font-Montserrat font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF] ">
        Apply Now
      </a>
    </div>

    <div class="mt-2 absolute top-[500px] left-[122px] font-Montserrat">
      <p class="text-center text-xs text-gray-600 font-Montserrat">
        Already Member ? <a href="{{route('login')}}" class="text-[#28388F] font-semibold hover:underline text-sm">Login</a>
      </p>
    </div>
    <div class="h-48"></div>
  </div>

  <!-- 2...............  Screen 2: Apply Now.................................... -->
  <div id="screen2" class="hidden max-w-sm mx-auto p-4 bg-white shadow-md rounded-lg relative">
    <button onclick="showScreen1()" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </button>

    <div class="absolute top-[51px] left-[120px]">
      <img src="Images/image.png" alt="YuWaah Logo" class="h-14" width="150px" height="86px">
    </div>

    <!-- Apply Form -->
    <h1 class="font-medium mb-4">Apply Now</h1>

    <form class="space-y-4" onsubmit="showScreen3(event)">
      <div class="space-y-1 text-xs">
        <label for="ys-id" class="text-gray-700">Enter YS ID</label>
        <input id="ys-id" type="text" placeholder="Please Enter YS ID"
          class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="space-y-1 text-xs">
        <label for="email" class=" text-gray-700">Email ID</label>
        <input id="email" type="email" placeholder="Please Enter Email ID"
          class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="space-y-1 text-xs">
        <label for="full-name" class="text-gray-700">Enter Name</label>
        <input id="full-name" type="text" placeholder="Please Enter Your Full Name"
          class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="space-y-1 text-xs">
        <label for="mobile" class="text-gray-700">Mobile</label>
        <input id="mobile" type="tel" placeholder="Please Enter Your Mobile Number"
          class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="space-y-1 text-xs">
        <label for="address" class="text-gray-700">Address</label>
        <input id="address" type="text" placeholder="Please Enter Your Full Address"
          class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
      </div>

      <!-- District and State -->
      <div class="space-y-1 text-xs">
        <div class="flex space-x-2">
          <div class="w-1/2">
            <label for="district" class=" text-gray-700">District</label>
            <input id="district" type="text" placeholder="Please Enter District"
              class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="w-1/2">
            <label for="state" class="text-gray-700">State</label>
            <input id="state" type="text" placeholder="Please Enter State"
              class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
          </div>
        </div>
      </div>

      <div class="text-xs text-gray-600">
        By signing up, you're agreeing to our
        <a href="#" class="text-blue-500 hover:underline">Terms & Conditions</a> and
        <a href="#" class="text-blue-500 hover:underline">Privacy Policy</a>.
      </div>

      <div class="flex justify-center">
        <button type="submit"
          class="w-3/5 bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 pb-[6px] rounded-lg">
          Continue
        </button>
      </div>
      <p class="text-center text-xs text-gray-600">
        Joined us before? <a href="#" class="text-sm text-blue-500 hover:underline"
          onclick="showScreen4(event)">Login</a>
      </p>
    </form>
  </div>

  <!-- 3. Screen 3:................ Register ..........-->
  <div id="screen3" class="hidden max-w-sm mx-auto p-4 bg-white shadow-md rounded-lg relative h-[225vh]">
    <button onclick="showScreen2()" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </button>

    <div class="">
      <img src="Images/image.png" alt="YuWaah Logo" class="absolute top-[51px] left-[120px]" width="140px"
        height="86px">
    </div>

    <!-- Register Form -->
    <h1
      class="w-[121px] h-[34px] absolute top-[153px] left-[30px] font-Montserrat font-[600] text-[28px] leading-[34.13px] text-[#000000]">
      Register</h1>

    <form class="space-y-4 w-[330px] h-[426px] absolute top-[230px] left-[30px]" onsubmit="showScreen4(event)">
      <div class="space-y-1 text-xs">
        <label for="dob"
          class="w-[80px] h-[15px] font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Date Of
          Birth</label>
        <input type="date" id="dob"
          class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2 focus:ring-2 focus:ring-blue-500" />
      </div>

      <!-- <div class="space-y-2">
        <label for="dob" class="text-sm font-medium text-gray-700">Date Of Birth</label>
        <input type="text" id="dob" class="w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-200"
          placeholder="Select Date" required />
      </div> -->


      <div class="space-y-1 text-xs">
        <label for="gender"
          class="font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Gender</label>
        <select id="gender" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2 ">
          <option value="" disabled selected>Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>

      <div class="space-y-1 text-xs">
        <label for="education" class="font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Education
          Level</label>
        <select id="education" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2">
          <option value="" disabled selected>Select Education Level</option>
          <option value="highschool">High School</option>
          <option value="bachelor">Bachelor's Degree</option>
          <option value="master">Master's Degree</option>
          <option value="phd">Ph.D.</option>
        </select>
      </div>

      <div class="space-y-1 text-xs">
        <label for="qualification"
          class="font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Specific Qualification</label>
        <select id="qualification" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2">
          <option value="" disabled selected>Select Specific Qualification</option>
          <option value="highschool">High School</option>
          <option value="bachelor">Bachelor's Degree</option>
          <option value="master">Master's Degree</option>
          <option value="phd">Ph.D.</option>
        </select>
      </div>

      <div class="space-y-1 text-xs">
        <label for="digital_proficiency"
          class=" font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Digital Proficiency</label>
        <select id="digital_proficiency" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2">
          <option value="" disabled selected>Select Digital Proficiency Level</option>
          <option value="beginner">Beginner</option>
          <option value="intermediate">Intermediate</option>
          <option value="advanced">Advanced</option>
        </select>
      </div>

      <div class="space-y-1 text-xs">
        <label for="english_proficiency"
          class=" font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">English Proficiency</label>
        <select id="english_proficiency" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2">
          <option value="" disabled selected>Select English Proficiency Level</option>
          <option value="beginner">Beginner</option>
          <option value="intermediate">Intermediate</option>
          <option value="advanced">Advanced</option>
        </select>
      </div>

      <div class="space-y-1 text-xs">
        <label for="experience" class=" font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Year of
          Experience</label>
        <select id="experience" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2">
          <option value="" disabled selected>Select Years of Experience</option>
          <option value="0-1">0-1 year</option>
          <option value="2-5">2-5 years</option>
          <option value="6-10">6-10 years</option>
          <option value="10+">10+ years</option>
        </select>
      </div>

      <div class="space-y-1 text-xs">
        <label for="work_hours" class=" font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Number
          of hours I can work in a day</label>
        <select id="work_hours" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2">
          <option value="" disabled selected>Select Work Hours</option>
          <option value="1-4">1-4 hours</option>
          <option value="5-8">5-8 hours</option>
          <option value="8+">8+ hours</option>
        </select>
      </div>

      <div class="space-y-1 text-xs">
        <label for="loan" class=" font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Loan
          Taken</label>
        <select id="infrastructure" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2">
          <option value="" disabled selected>Please Select</option>
          <option value="basic">Basic</option>
          <option value="advanced">Advanced</option>
        </select>
      </div>

      <div class="space-y-1 text-xs">
        <label for="loantype" class=" font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Type of
          Loan</label>
        <select id="loantype" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2">
          <option value="" disabled selected>Please Select Loan Type</option>
          <option value="basic">Basic</option>
          <option value="advanced">Advanced</option>
        </select>
      </div>

      <div class="space-y-1 text-xs">
        <label for="amount" class=" font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Loan
          Amount</label>
        <select id="amount" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2">
          <option value="" disabled selected>Please Enter</option>
          <option value="basic">Basic</option>
          <option value="advanced">Advanced</option>
        </select>
      </div>

      <div class="space-y-1 text-xs">
        <label for="loanbalance" class=" font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Loan
          Balance</label>
        <select id="loanamount" class="w-[330px] h-[40px] border-[1px] rounded-[10px] px-3 py-2">
          <option value="" disabled selected>Please Enter</option>
          <option value="basic">Basic</option>
          <option value="advanced">Advanced</option>
        </select>
      </div>

      <div class="space-y-4 text-xs">
        <div class="flex flex-col gap-2">
          <label for="upload_center_photo"
            class="font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Upload Center Photo</label>
          <div class="flex items-center gap-2 justify-between">
            <label for="upload_center_photo"
              class="w-[210px] h-[40px] flex items-center justify-center gap-2 px-4 py-2 border rounded-[10px] cursor-pointer text-[#A7A7A7] bg-[#FFFFFF] hover:bg-gray-200">
              <span
                class="w-[52px] h-[12px] font-Montserrat w-[400] text-[10px] leading-[12.19px] text-center absolute top-[949px] left-[10px]">Select
                File</span>
              <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg> -->
              <i class="fa-solid fa-paperclip fa-xl absolute top-[955px] left-[184px] text-[#05A7D1]"></i>
            </label>
            <input type="file" id="upload_center_photo" class="hidden" />
            <button type="button"
              class="w-[100px] h-[40px] rounded-[10px] bg-[#28388F1A] text-[#28388F] font-Montserrat text-[14px] font-[600] leading-[17.07px] px-4 py-2 ">
              Upload
            </button>
          </div>
        </div>


        <div class="flex flex-col gap-2 text-xs">
          <label for="upload_profile_photo"
            class="font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Upload Profile Photo</label>

          <div class="flex justify-between items-center gap-2">
            <label for="upload_profile_photo"
              class="w-[210px] h-[40px] flex items-center justify-center gap-2 px-4 py-2 border rounded-[10px] cursor-pointer text-[#A7A7A7] bg-[#FFFFFF] hover:bg-gray-200">
              <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg> -->
              <span
                class="w-[52px] h-[12px] font-Montserrat w-[400] text-[10px] leading-[12.19px] text-center absolute top-[1028px] left-[10px]">Select
                File</span>
              <i class="fa-solid fa-paperclip fa-xl absolute top-[1034px] left-[184px] text-[#05A7D1]"></i>
            </label>
            <input type="file" id="upload_profile_photo" class="hidden" />

            <button type="button"
              class="w-[100px] h-[40px] rounded-[10px] bg-[#28388F1A] text-[#28388F] font-Montserrat text-[14px] font-[600] leading-[17.07px] px-4 py-2 ">
              Upload
            </button>
          </div>
        </div>
      </div>

      <div class="text-sm text-gray-600 text-xs">
        By complete the registration you are agreeing that your profile information can be shared as per our
        <a href="#" class="text-blue-500 hover:underline">Terms & Conditions</a>
      </div>

      <div class="flex justify-center">
        <button onclick="showScreen4(event)"
          class="w-3/5 bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 pb-[6px] rounded-lg">
          Complete Registration
        </button>
      </div>
    </form>
  </div>

  <!-- 4. Screen 4: ............Login form........... -->
  <div id="screen4" class="hidden max-w-sm mx-auto p-4 bg-white shadow-md rounded-lg">

    <button onclick="showScreen3(event)" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </button>

    <div class="flex justify-center mb-4">
      <img src="Images/image.png" alt="YuWaah Logo" class="h-14">
    </div>
    <h1 class="font-medium mb-4">Login</h1>

    <form class="space-y-4 text-xs">
      <div class="space-y-1">
        <label for="username" class=" text-gray-700">Username</label>
        <input id="username" type="text" placeholder="Enter username"
          class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="space-y-1">
        <label for="password" class="text-gray-700">Password</label>
        <div class="relative">
          <input id="password" type="password" placeholder="Enter Password"
            class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
          <button type="button" id="togglePassword" class="absolute right-3 top-2.5 text-gray-500 focus:outline-none">
            <i id="eyeIcon" class="fas fa-eye"></i>
          </button>
        </div>
      </div>

      <div class="flex justify-between">
        <span></span>
        <a onclick="showScreen5(event)" class=" text-blue-500 hover:underline cursor-pointer">Forgot
          Password?</a>
      </div>

      <div class="flex justify-center text-sm">
        <button type="submit"
          class="w-3/5 bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 pb-[6px] rounded-lg">
          Login </button>
      </div>
    </form>


    <div class="mt-2 text-xs">
      <p class="text-center text-gray-600">
        Now to YuWaah? <a href="#" onclick="showScreen3(event)"
          class="text-sm text-blue-500 hover:underline">Register</a>
      </p>
    </div>

  </div>

  <!-- 5. Screen 5: .............mobile number........... -->
  <div id="screen5" class="hidden max-w-sm mx-auto p-4 bg-white shadow-md rounded-lg">

    <button onclick="showScreen4(event)" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </button>

    <div class="flex justify-center mb-4">
      <img src="Images/image.png" alt="YuWaah Logo" class="h-14">
    </div>
    <h1 class="font-medium mb-4">Login</h1>

    <form class="space-y-4" onsubmit="showScreen6(event) ">
      <div class="space-y-1 text-xs">
        <label for="mobilenumber" class=" text-gray-700">Mobile Number</label>
        <input id="mobilenumber" type="text" placeholder="Enter Mobile Number"
          class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
      </div>
      <div class="flex justify-center ">
        <button type="submit"
          class=" w-3/5 bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 pb-[6px] rounded-lg">
          Verify Mobile Number </button>
      </div>
    </form>
    <div class="mt-2">
      <p class="text-center text-xs text-gray-600">
        Now to YuWaah? <a href="#" onclick="showScreen3(event)"
          class="text-sm text-blue-500 hover:underline">Register</a>
      </p>
    </div>
    <div class="h-48"></div>
  </div>

  <!-- 6. Screen 6: otp -->
  <div id="screen6" class="hidden max-w-sm mx-auto p-4 bg-white shadow-md rounded-lg">
    <button onclick="showScreen5(event)" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </button>

    <div class="flex justify-center mb-4">
      <img src="Images/image.png" alt="YuWaah Logo" class="h-14">
    </div>
    <h1 class="font-medium mb-4">Enter OTP</h1>

    <p class="my-6 text-xs">
      A 5-digit code has been sent to +91-8822009988
    </p>

    <form class="">
      <div class="space-y-1 text-xs">
        <label for="otp" class=" text-gray-700">OTP</label>
        <div class="flex justify-between gap-2 text-sm">
          <input type="text" maxlength="1"
            class="w-12 h-12 border rounded text-center focus:ring-2 focus:ring-blue-500 focus:outline-none">
          <input type="text" maxlength="1"
            class="w-12 h-12 border rounded text-center focus:ring-2 focus:ring-blue-500 focus:outline-none">
          <input type="text" maxlength="1"
            class="w-12 h-12 border rounded text-center focus:ring-2 focus:ring-blue-500 focus:outline-none">
          <input type="text" maxlength="1"
            class="w-12 h-12 border rounded text-center focus:ring-2 focus:ring-blue-500 focus:outline-none">
          <input type="text" maxlength="1"
            class="w-12 h-12 border rounded text-center focus:ring-2 focus:ring-blue-500 focus:outline-none">
          <input type="text" maxlength="1"
            class="w-12 h-12 border rounded text-center focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
      </div>
      <div class="flex justify-center my-6">
        <a href="todo.html"
          class="w-3/5 inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 pb-[6px] rounded-lg text-center">
          Submit
        </a>
      </div>
    </form>
    <div class="h-48"></div>
  </div>

  <!-- 7. .............ToDo Design Section ...........-->
  <!-- <div class="fixed bottom-0 left-0 w-full bg-gray-100 h-12 flex items-center justify-around shadow-md bottom-0">
    <a href="todo.html"> <img src="Images/homeicon.png" alt="home" class="h-6 w-6 activelink" /></a>
    <img src="Images/homeicon.png" alt="home" class="h-6 w-6 filter brightness-0" />
    <img src="Images/file-text.png" alt="home" class="h-6 w-6" />
    <img src="Images/star.png" alt="home" class="h-6 w-6" />
    <img src="Images/users.png" alt="home" class="h-6 w-6" />
    <a href="promotion.html"> <img src="Images/Vector.png" alt="home" class="h-6 w-6 activelink" /></a>
  </div> -->

  <!-- 8. .............My Profile ...........-->
  <div id="screen8" class="hidden max-w-sm mx-auto p-4 bg-white shadow-md rounded-lg">
    <button onclick="showScreen7(event)" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </button>

    <div class="flex justify-center mb-4">
      <img src="Images/image.png" alt="YuWaah Logo" class="h-14">
    </div>

    <div class="flex justify-between items-center">
      <h1>My Profile</h1>
      <button" class="cursor-pointer px-5 py-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 pb-[6px]"
        onclick="toggleEditProfileForm()">
        Edit Profile
        </button>
    </div>


    <!-- Language Form (Initially Hidden) -->
    <div id="EditProfileForm" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <div class="flex justify-between items-center mb-4">
          <h1 class="font-medium">Filter</h1>
          <button class=" text-gray-500 hover:text-gray-700 text-2xl" onclick="toggleEditProfileForm()">
            &times;
          </button>
        </div>
        <form>
          <div class="space-y-4">
            <div>
              <label class="mb-1" for="language" class="block text-xs"> Learner</label>
              <select id="language" class="w-full border p-2 mt-1 text-xs">
                <option value="" disabled selected>Please Select Learner</option>
                <option value="en">English</option>
                <option value="hi">Hindi</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option>
              </select>
            </div>

            <div class="text-xs">
              <label class="mb-2" for="language" class="block text-xs">Sort By</label>

              <p class="mt-2">
                newest to oldest
              </p>

              <p class="mb-t">
                oldest to newest
              </p>

            </div>

            <div class="">
              <button type="submit" onclick="showScreen13()"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 text-sm">
                Apply
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="flex justify-center mt-4">
      <img src="Images/Profilelogo.png" alt="profileLogo" class="h-14">
      <!-- <div class="rounded-full bg-blue-600 w-20 h-20">
      </div> -->
    </div>
    <p class="text-center">Samay Singh </p>
    <div class="mt-4 text-xs">
      <div class="flex gap-4 ">
        <p class="w-1/2 font-semibold">Date of Birth</p>
        <p class="w-1/2 text-gray-600">17/12/1996</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">gender</p>
        <p class="w-1/2 text-gray-600">Male</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Email Address</p>
        <p class="w-1/2 text-gray-600">ssingh@gmail.com</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Mobile Number</p>
        <p class="w-1/2 text-gray-600">+91-9474128739 *Verified</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Address</p>
        <p class="w-1/2 text-gray-600">255/67, CH-6,Paschim Vihar</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">District</p>
        <p class="w-1/2 text-gray-600">West Delhi</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">State</p>
        <p class="w-1/2 text-gray-600">Delhi</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Pin Code</p>
        <p class="w-1/2 text-gray-600">445566</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">YS ID</p>
        <p class="w-1/2 text-gray-600">12345</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Education level</p>
        <p class="w-1/2 text-gray-600">General Degree</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Digital Profiency</p>
        <p class="w-1/2 text-gray-600">Excel Knowledge</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">English Knowledge</p>
        <p class="w-1/2 text-gray-600">Can Read And write</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Year of Experience</p>
        <p class="w-1/2 text-gray-600">3 years</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">No. of Hours I can work/Day</p>
        <p class="w-1/2 text-gray-600">7 years</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Infrastructure Available</p>
        <p class="w-1/2 text-gray-600">Laptop, Internet, Power Backup, Wifi</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Service Offered</p>
        <p class="w-1/2 text-gray-600">Data Entry, Excel Book</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Course Completed</p>
        <p class="w-1/2 text-gray-600">Computer Course</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Loan Taken</p>
        <p class="w-1/2 text-gray-600">Yes</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Loan Type</p>
        <p class="w-1/2 text-gray-600">Personal Loan</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Loan Amount</p>
        <p class="w-1/2 text-gray-600">70,000 INR</p>
      </div>

      <div class="flex gap-4 mt-1">
        <p class="w-1/2 font-semibold">Loan Balance</p>
        <p class="w-1/2 text-gray-600">50,000 INR</p>
      </div>
    </div>

    <div class="flex justify-between items-center mt-8 mb-2">
      <h1>Team Members</h1>
      <button" class="cursor-pointer px-5 py-1 bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 pb-[6px]">
        Add Members
        </button>
    </div>

    <div class="p-3 bg-gray-50 shadow rounded-lg text-xs flex justify-between mt-2">
      <div class="space-y-2">
        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Name</div>
          <div class="w-1/2 text-gray-600">Roshni Channa</div>
        </div>
        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Gender</div>
          <div class="w-1/2 text-gray-600">Female</div>
        </div>
        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Email Address</div>
          <div class="w-1/2 text-gray-600">roshni.c@gmail.com</div>
        </div>

        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Mobile Number</div>
          <div class="w-1/2 text-gray-600">+91-8733775522</div>
        </div>
      </div>
      <div class="">
        <p>
          Edit
        </p>
      </div>
    </div>

    <div class="p-3 bg-gray-50 shadow rounded-lg text-xs flex justify-between mt-4">
      <div class="space-y-2">
        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Name</div>
          <div class="w-1/2 text-gray-600">Roshni Channa</div>
        </div>
        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Gender</div>
          <div class="w-1/2 text-gray-600">Female</div>
        </div>
        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Email Address</div>
          <div class="w-1/2 text-gray-600">roshni.c@gmail.com</div>
        </div>

        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Mobile Number</div>
          <div class="w-1/2 text-gray-600">+91-8733775522</div>
        </div>
      </div>
      <div class="">
        <p>
          Edit
        </p>
      </div>
    </div>

    <div class="p-3 bg-gray-50 shadow rounded-lg text-xs flex justify-between mt-4">
      <div class="space-y-2">
        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Name</div>
          <div class="w-1/2 text-gray-600">Roshni Channa</div>
        </div>
        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Gender</div>
          <div class="w-1/2 text-gray-600">Female</div>
        </div>
        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Email Address</div>
          <div class="w-1/2 text-gray-600">roshni.c@gmail.com</div>
        </div>

        <div class="flex gap-4 items-center">
          <div class="w-1/2 font-bold">Mobile Number</div>
          <div class="w-1/2 text-gray-600">+91-8733775522</div>
        </div>
      </div>
      <div class="">
        <p>
          Edit
        </p>
      </div>
    </div>
  </div>

  <!-- 9. .............About YuWaah! ...........-->
  <div id="screen9" class="hidden max-w-sm mx-auto p-4 bg-white shadow-md rounded-lg">
    <button onclick="showScreen7(event)" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </button>

    <div class="flex justify-center mb-4">
      <img src="Images/image.png" alt="YuWaah Logo" class="h-14">
    </div>

    <div class="mt-2 text-sm flex justify-between items-center">
      <h1 class="">
        Opportunities
      </h1>

      <div class="flex items-center gap-2">
        <div>
          <button" class="px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white font-medium pb-[6px] cursor-pointer"
            onclick="showScreen12()">Add
            Opportunity</button>
        </div>

        <div>
          <button" class="px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white font-medium pb-[6px] cursor-pointer"
            onclick="toggleSortPopUp()">Sort
            By</button>
        </div>
      </div>
    </div>

    <!-- visible only click on Add Opportunity button -->
    <!-- <div id="toggleOpportunity"
      class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <div class="flex justify-between items-center mb-4">
          <h1 class="font-medium">Opportunity</h1>
          <button class=" text-gray-500 hover:text-gray-700 text-2xl" onclick="toggleOpportunityPopUp()">
            &times;
          </button>
        </div>
        <form>
          <div class="space-y-4">
            <div class="text-xs flex flex-col gap-1">
              <p>New Opportunities</p>
              <p>Earliest Ending Opportunity</p>
              <p>Newest to Oldest</p>
              <p>Oldest to Newest</p>
            </div>
            <div class="">
              <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 text-sm">
                Apply
              </button>
            </div>
          </div>
        </form>
      </div>
    </div> -->

    <!-- visible only click on sort by button -->
    <div id="togglePopUp" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <div class="flex justify-between items-center mb-4">
          <h1 class="font-medium">Sort By</h1>
          <button class=" text-gray-500 hover:text-gray-700 text-2xl" onclick="toggleSortPopUp()">
            &times;
          </button>
        </div>
        <form>
          <div class="space-y-4">
            <div class="text-xs flex flex-col gap-1">
              <p>New Opportunities</p>
              <p>Earliest Ending Opportunity</p>
              <p>Newest to Oldest</p>
              <p>Oldest to Newest</p>
            </div>
            <div class="">
              <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 text-sm">
                Apply
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class=" mt-6 flex justify-between items-center">
      <h1 class="font-medium text-sm">
        Data Entry Operator Job
      </h1>
      <div class="flex flex-col gap-0 text-center text-xs">
        <span>YS</span>
        <span>
          Incentive
        </span>
      </div>
    </div>

    <div class=" mt-6 flex justify-between items-center gap-6">
      <p class="text-xs w-4/5">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur necessitatibus, exercitationem porro est
        dolorem ex eum fugit recusandae esse quo, aperiam et nulla officiis dolorum temporibus natus provident rem
        deleniti.
      </p>
      <div class=" flex gap-1 bg-gray-200 px-4 py-2 text-sm font-medium">
        <span>
          <i class="fas fa-rupee-sign"></i>
        </span>
        <span>
          650
        </span>
      </div>
    </div>

    <div class="">
      <div class="flex gap-2 items-center my-1">
        <span class="text-xs"><i class='far fa-file'></i></span>
        <a class="text-xs underline underline-offset-1" href="">View Specification Document</a>
        <span class="text-xs cursor-pointer"> <i class='fas fa-share-alt'></i></span>
      </div>

      <div class="flex gap-4 items-center justify-between">
        <div class="flex items-center gap-[6px]">
          <span class="font-thin text-xs">
            <i class="fas fa-rupee-sign"></i>
          </span>
          <span class="text-xs">
            1500/Month
          </span>
        </div>

        <div class="flex items-center gap-2">
          <span class="font-thin text-xs">
            <i class='fas fa-book-open'></i>
          </span>
          <span class="text-xs">
            AGM Enterprices
          </span>
        </div>
      </div>

      <div class="flex items-center gap-[6px]">
        <span class="font-thin text-xs">
          <i class="material-icons text-xs ml-[-2px]">date_range</i>
        </span>

        <span class="text-xs">
          Start Date - 20 Oct 2024
        </span>

      </div>

      <div class="flex items-center gap-[6px] mt-[2px]">
        <span class="font-thin text-xs">
          <i class="material-icons text-xs ml-[-2px]">date_range</i>
        </span>

        <span class="text-xs">
          End Date - 20 Oct 2025
        </span>

      </div>

      <div class="mt-[-1px]">
        <span class="font-thin text-xs">
          <i class='fas fa-address-book'></i>
        </span>

        <span class="text-xs">
          10 Job Openings
        </span>

      </div>
    </div>

    <div class="flex justify-between items-center mt-4">
      <div>
        <button" class="px-4 py-1 bg-blue-500 hover:bg-blue-600 text-white font-medium pb-[6px] cursor-pointer">Fill
          Form</button>
      </div>

      <div>
        <button onclick="showScreen10()"
          class="px-4 py-1 bg-blue-500 hover:bg-blue-600 text-white font-medium pb-[6px] cursor-pointer">Assign
          Learners</button>
      </div>
    </div>

    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6">
      <div class="flex justify-between items-center gap-2">
        <div class="w-full">
          <h1 class="font-medium text-sm my-2">
            Data Entry Operator Job
          </h1>

          <div class="flex gap-2 items-center my-1">
            <span class="text-xs"><i class='far fa-file'></i></span>
            <a class="text-xs underline underline-offset-1" href="">View Specification Document</a>
            <span class="text-xs cursor-pointer"> <i class='fas fa-share-alt'></i></span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="fas fa-rupee-sign"></i>
            </span>
            <span class="text-xs">
              1500/Month
            </span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>

            <span class="text-xs">
              Start Date - 20 Oct 2024
            </span>
          </div>

          <div class="flex items-center gap-[6px] mt-[2px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>
            <span class="text-xs">
              End Date - 20 Oct 2025
            </span>
          </div>

          <div class="mt-[-1px]">
            <span class="font-thin text-xs">
              <i class='fas fa-address-book'></i>
            </span>
            <span class="text-xs">
              10 Job Openings
            </span>
          </div>
        </div>

        <div class="">
          <div class="flex flex-col gap-0 text-center text-xs ">
            <span>YS</span>
            <span>
              Incentive
            </span>
          </div>

          <div class="bg-gray-200 px-3 py-2 text-center mt-2">
            <div class=" flex gap-1 text-sm font-medium text-center justify-center">
              <span class="text-center">
                <i class="fas fa-rupee-sign"></i>
              </span>
              <span class="text-center">
                650/
              </span>
            </div>
            <span>Learner</span>
          </div>


          <div class="flex items-center gap-2 mt-2 text-xs ml-[-34px]">
            <span class="font-thin ">
              <i class='fas fa-book-open'></i>
            </span>
            <span class="">
              AGM Enterprices
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6">
      <div class="flex justify-between items-center gap-2">
        <div class="w-full">
          <h1 class="font-medium text-sm my-2">
            Data Entry Operator Job
          </h1>

          <div class="flex gap-2 items-center my-1">
            <span class="text-xs"><i class='far fa-file'></i></span>
            <a class="text-xs underline underline-offset-1" href="">View Specification Document</a>
            <span class="text-xs cursor-pointer"> <i class='fas fa-share-alt'></i></span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="fas fa-rupee-sign"></i>
            </span>
            <span class="text-xs">
              1500/Month
            </span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>

            <span class="text-xs">
              Start Date - 20 Oct 2024
            </span>
          </div>

          <div class="flex items-center gap-[6px] mt-[2px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>
            <span class="text-xs">
              End Date - 20 Oct 2025
            </span>
          </div>

          <div class="mt-[-1px]">
            <span class="font-thin text-xs">
              <i class='fas fa-address-book'></i>
            </span>
            <span class="text-xs">
              10 Job Openings
            </span>
          </div>
        </div>

        <div class="">
          <div class="flex flex-col gap-0 text-center text-xs ">
            <span>YS</span>
            <span>
              Incentive
            </span>
          </div>

          <div class="bg-gray-200 px-3 py-2 text-center mt-2">
            <div class=" flex gap-1 text-sm font-medium text-center justify-center">
              <span class="text-center">
                <i class="fas fa-rupee-sign"></i>
              </span>
              <span class="text-center">
                650/
              </span>
            </div>
            <span>Learner</span>
          </div>


          <div class="flex items-center gap-2 mt-2 text-xs ml-[-34px]">
            <span class="font-thin ">
              <i class='fas fa-book-open'></i>
            </span>
            <span class="">
              AGM Enterprices
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6">
      <div class="flex justify-between items-center gap-2">
        <div class="w-full">
          <h1 class="font-medium text-sm my-2">
            Data Entry Operator Job
          </h1>

          <div class="flex gap-2 items-center my-1">
            <span class="text-xs"><i class='far fa-file'></i></span>
            <a class="text-xs underline underline-offset-1" href="">View Specification Document</a>
            <span class="text-xs cursor-pointer"> <i class='fas fa-share-alt'></i></span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="fas fa-rupee-sign"></i>
            </span>
            <span class="text-xs">
              1500/Month
            </span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>

            <span class="text-xs">
              Start Date - 20 Oct 2024
            </span>
          </div>

          <div class="flex items-center gap-[6px] mt-[2px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>
            <span class="text-xs">
              End Date - 20 Oct 2025
            </span>
          </div>

          <div class="mt-[-1px]">
            <span class="font-thin text-xs">
              <i class='fas fa-address-book'></i>
            </span>
            <span class="text-xs">
              10 Job Openings
            </span>
          </div>
        </div>

        <div class="">
          <div class="flex flex-col gap-0 text-center text-xs ">
            <span>YS</span>
            <span>
              Incentive
            </span>
          </div>

          <div class="bg-gray-200 px-3 py-2 text-center mt-2">
            <div class=" flex gap-1 text-sm font-medium text-center justify-center">
              <span class="text-center">
                <i class="fas fa-rupee-sign"></i>
              </span>
              <span class="text-center">
                650/
              </span>
            </div>
            <span>Learner</span>
          </div>


          <div class="flex items-center gap-2 mt-2 text-xs ml-[-34px]">
            <span class="font-thin ">
              <i class='fas fa-book-open'></i>
            </span>
            <span class="">
              AGM Enterprices
            </span>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- 10. .............Assign Learners ...........-->
  <div id="screen10" class="hidden max-w-sm mx-auto p-4 bg-white shadow-md rounded-lg">
    <button onclick="showScreen9(event)" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </button>

    <div class="flex justify-center mb-4">
      <img src="Images/image.png" alt="YuWaah Logo" class="h-14">
    </div>

    <div class="mt-2 text-sm">
      <h1 class="">
        Assign Learners
      </h1>
    </div>


    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6">
      <div class=" mt-6 flex justify-between items-center">
        <h1 class="font-medium text-sm">
          Data Entry Operator Job
        </h1>
        <div class="flex flex-col gap-0 text-center text-xs">
          <span>YS</span>
          <span>
            Incentive
          </span>
        </div>
      </div>

      <div class=" mt-2 flex justify-between items-center gap-6">
        <p class="text-xs w-4/5">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur necessitatibus, exercitationem porro est
          dolorem ex eum fugit recusandae esse quo, aperiam et nulla officiis dolorum temporibus natus provident rem
          deleniti.
        </p>
        <div class=" flex gap-1 bg-gray-200 px-4 py-2 text-sm font-medium">
          <span>
            <i class="fas fa-rupee-sign"></i>
          </span>
          <span>
            650
          </span>
        </div>
      </div>

      <div class="">
        <div class="flex gap-2 items-center my-1">
          <span class="text-xs"><i class='far fa-file'></i></span>
          <a class="text-xs underline underline-offset-1" href="">View Specification Document</a>
          <span class="text-xs cursor-pointer"> <i class='fas fa-share-alt'></i></span>
        </div>

        <div class="flex gap-4 items-center justify-between">
          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="fas fa-rupee-sign"></i>
            </span>
            <span class="text-xs">
              1500/Month
            </span>
          </div>

          <div class="flex items-center gap-2">
            <span class="font-thin text-xs">
              <i class='fas fa-book-open'></i>
            </span>
            <span class="text-xs">
              AGM Enterprices
            </span>
          </div>
        </div>

        <div class="flex items-center gap-[6px]">
          <span class="font-thin text-xs">
            <i class="material-icons text-xs ml-[-2px]">date_range</i>
          </span>

          <span class="text-xs">
            Start Date - 20 Oct 2024
          </span>

        </div>

        <div class="flex items-center gap-[6px] mt-[2px]">
          <span class="font-thin text-xs">
            <i class="material-icons text-xs ml-[-2px]">date_range</i>
          </span>

          <span class="text-xs">
            End Date - 20 Oct 2025
          </span>

        </div>

        <div class="mt-[-1px]">
          <span class="font-thin text-xs">
            <i class='fas fa-address-book'></i>
          </span>

          <span class="text-xs">
            10 Job Openings
          </span>
        </div>
      </div>
    </div>

    <div class="flex justify-between items-center mt-4">
      <div>
        <h1 class="text-sm">
          Assign Learners
        </h1>
      </div>
      <div>
        <button onclick="showScreen9()"
          class="px-4 py-1 bg-blue-500 hover:bg-blue-600 text-white font-medium pb-[6px] cursor-pointer">Save
          Learners</button>
      </div>
    </div>

    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6 flex gap-2 items-center justify-between cursor-pointer"
      onclick="showScreen11()">

      <div class="flex justify-center gap-2 items-center">
        <div class="bg-gray-200 rounded-full p-2">
          <i class='fas fa-address-book'></i>
        </div>

        <div class="flex flex-col items-center text-sm">
          <div>
            Aditya Joshi
          </div>

          <div>
            <span>
              <i class="material-icons text-sm">date_range</i>
            </span>
            <span>
              14-Aug 2024
            </span>
          </div>
        </div>

      </div>
      <div class="">
        <input type="checkbox" name="option1" value="Option 1">
      </div>
    </div>

    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6 flex gap-2 items-center justify-between cursor-pointer"
      onclick="showScreen11()">

      <div class="flex justify-center gap-2 items-center">
        <div class="bg-gray-200 rounded-full p-2">
          <i class='fas fa-address-book'></i>
        </div>

        <div class="flex flex-col items-center text-sm">
          <div>
            Aditya Joshi
          </div>

          <div>
            <span>
              <i class="material-icons text-sm">date_range</i>
            </span>
            <span>
              14-Aug 2024
            </span>
          </div>
        </div>

      </div>
      <div class="">
        <input type="checkbox" name="option1" value="Option 1">
      </div>
    </div>

    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6 flex gap-2 items-center justify-between cursor-pointer"
      onclick="showScreen11()">

      <div class="flex justify-center gap-2 items-center">
        <div class="bg-gray-200 rounded-full p-2">
          <i class='fas fa-address-book'></i>
        </div>

        <div class="flex flex-col items-center text-sm">
          <div>
            Aditya Joshi
          </div>

          <div>
            <span>
              <i class="material-icons text-sm">date_range</i>
            </span>
            <span>
              14-Aug 2024
            </span>
          </div>
        </div>

      </div>
      <div class="">
        <input type="checkbox" name="option1" value="Option 1">
      </div>
    </div>

    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6 flex gap-2 items-center justify-between cursor-pointer"
      onclick="showScreen11()">

      <div class="flex justify-center gap-2 items-center">
        <div class="bg-gray-200 rounded-full p-2">
          <i class='fas fa-address-book'></i>
        </div>

        <div class="flex flex-col items-center text-sm">
          <div>
            Aditya Joshi
          </div>

          <div>
            <span>
              <i class="material-icons text-sm">date_range</i>
            </span>
            <span>
              14-Aug 2024
            </span>
          </div>
        </div>

      </div>
      <div class="">
        <input type="checkbox" name="option1" value="Option 1">
      </div>
    </div>
  </div>

  <!-- 11. .............Learner Details ...........-->
  <div id="screen11" class="hidden max-w-sm mx-auto p-4 bg-white shadow-md rounded-lg">
    <button onclick="showScreen9(event)" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </button>

    <div class="flex justify-center mb-4">
      <img src="Images/image.png" alt="YuWaah Logo" class="h-14">
    </div>

    <div class="mt-2 text-sm">
      <h1 class="">
        Learners Details
      </h1>
    </div>


    <div class="mt-6 flex gap-2 items-center justify-between">
      <div class="flex justify-center gap-2 items-center">
        <div class="bg-gray-200 rounded-full p-2">
          <i class='fas fa-address-book'></i>
        </div>

        <div class="flex flex-col items-center text-sm">
          <div>
            Aditya Joshi
          </div>

          <div>
            <span>
              <i class="material-icons text-sm">date_range</i>
            </span>
            <span>
              14-Aug 2024
            </span>
          </div>
        </div>

      </div>
      <div class="flex justify-center gap-3 items-center mt-2 ">
        <div>
          <i class="material-icons text-xl
          ">mail_outline</i>
        </div>
        <div>
          <i class="material-icons text-xl
          ">call</i>
        </div>
      </div>
    </div>

    <div class="">
      <div class="mt-4 text-xs">

        <div class="flex gap-4 ">
          <p class="w-1/2 font-semibold">Date of Birth</p>
          <p class="w-1/2 text-gray-600">17/12/1996</p>
        </div>
        <div class="flex gap-4 ">
          <p class="w-1/2 font-semibold">Learner Status</p>
          <div class="flex gap-2 items-center w-1/2">
            <span class="text-xs">
              <i class='fas fa-toggle-off'></i>
            </span>
            <p class="text-gray-600">active</p>
          </div>

        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">gender</p>
          <p class="w-1/2 text-gray-600">Male</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Email Address</p>
          <p class="w-1/2 text-gray-600">ssingh@gmail.com</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Institution</p>
          <p class="w-1/2 text-gray-600">23456</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Education level</p>
          <p class="w-1/2 text-gray-600">General Degree</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Address</p>
          <p class="w-1/2 text-gray-600">255/67, CH-6,Paschim Vihar</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">District</p>
          <p class="w-1/2 text-gray-600">West Delhi</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">State</p>
          <p class="w-1/2 text-gray-600">Delhi</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Pin Code</p>
          <p class="w-1/2 text-gray-600">445566</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">YS ID</p>
          <p class="w-1/2 text-gray-600">12345</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Digital Profiency</p>
          <p class="w-1/2 text-gray-600">Excel Knowledge</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">English Knowledge</p>
          <p class="w-1/2 text-gray-600">Can Read And write</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Year of Experience</p>
          <p class="w-1/2 text-gray-600">3 years</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">No. of Hours I can work/Day</p>
          <p class="w-1/2 text-gray-600">7 years</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Infrastructure Available</p>
          <p class="w-1/2 text-gray-600">Laptop, Internet, Power Backup, Wifi</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Service Offered</p>
          <p class="w-1/2 text-gray-600">Data Entry, Excel Book</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Course Completed</p>
          <p class="w-1/2 text-gray-600">Computer Course</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Loan Taken</p>
          <p class="w-1/2 text-gray-600">Yes</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Loan Type</p>
          <p class="w-1/2 text-gray-600">Personal Loan</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Loan Amount</p>
          <p class="w-1/2 text-gray-600">70,000 INR</p>
        </div>

        <div class="flex gap-4 mt-1">
          <p class="w-1/2 font-semibold">Loan Balance</p>
          <p class="w-1/2 text-gray-600">50,000 INR</p>
        </div>
      </div>
    </div>

    <div class="mt-6">
      <h1 class="text-sm font-semibold">
        Opportunities
      </h1>

      <div class="flex justify-between items-center gap-4">
        <div class="p-4 text-center bg-gray-100 shadow mt-6 w-1/2">
          <div class="font-medium">
            6
          </div>
          <div class="text-sm ">
            Ongoing Opportunities
          </div>
        </div>

        <div class="p-4 text-center bg-gray-200 shadow mt-6 w-1/2">
          <div class="font-medium">12</div>
          <div class="text-sm">
            Completed Opportunities
          </div>
        </div>
      </div>
    </div>

    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6">
      <div class="flex justify-between items-center gap-2">
        <div class="w-full">
          <h1 class="font-medium text-sm my-2">
            Data Entry Operator Job
          </h1>

          <div class="flex gap-2 items-center my-1">
            <span class="text-xs"><i class='far fa-file'></i></span>
            <a class="text-xs underline underline-offset-1" href="">View Specification Document</a>
            <span class="text-xs cursor-pointer"> <i class='fas fa-share-alt'></i></span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="fas fa-rupee-sign"></i>
            </span>
            <span class="text-xs">
              1500/Month
            </span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>

            <span class="text-xs">
              Start Date - 20 Oct 2024
            </span>
          </div>

          <div class="flex items-center gap-[6px] mt-[2px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>
            <span class="text-xs">
              End Date - 20 Oct 2025
            </span>
          </div>

          <div class="mt-[-1px]">
            <span class="font-thin text-xs">
              <i class='fas fa-address-book'></i>
            </span>
            <span class="text-xs">
              10 Job Openings
            </span>
          </div>
        </div>

        <div class="">
          <div class="flex flex-col gap-0 text-center text-xs ">
            <span>YS</span>
            <span>
              Incentive
            </span>
          </div>

          <div class="bg-gray-200 px-3 py-2 text-center mt-2">
            <div class=" flex gap-1 text-sm font-medium text-center justify-center">
              <span class="text-center">
                <i class="fas fa-rupee-sign"></i>
              </span>
              <span class="text-center">
                650/
              </span>
            </div>
            <span>Learner</span>
          </div>


          <div class="flex items-center gap-2 mt-2 text-xs ml-[-34px]">
            <span class="font-thin ">
              <i class='fas fa-book-open'></i>
            </span>
            <span class="">
              AGM Enterprices
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6">
      <div class="flex justify-between items-center gap-2">
        <div class="w-full">
          <h1 class="font-medium text-sm my-2">
            Data Entry Operator Job
          </h1>

          <div class="flex gap-2 items-center my-1">
            <span class="text-xs"><i class='far fa-file'></i></span>
            <a class="text-xs underline underline-offset-1" href="">View Specification Document</a>
            <span class="text-xs cursor-pointer"> <i class='fas fa-share-alt'></i></span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="fas fa-rupee-sign"></i>
            </span>
            <span class="text-xs">
              1500/Month
            </span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>

            <span class="text-xs">
              Start Date - 20 Oct 2024
            </span>
          </div>

          <div class="flex items-center gap-[6px] mt-[2px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>
            <span class="text-xs">
              End Date - 20 Oct 2025
            </span>
          </div>

          <div class="mt-[-1px]">
            <span class="font-thin text-xs">
              <i class='fas fa-address-book'></i>
            </span>
            <span class="text-xs">
              10 Job Openings
            </span>
          </div>
        </div>

        <div class="">
          <div class="flex flex-col gap-0 text-center text-xs ">
            <span>YS</span>
            <span>
              Incentive
            </span>
          </div>

          <div class="bg-gray-200 px-3 py-2 text-center mt-2">
            <div class=" flex gap-1 text-sm font-medium text-center justify-center">
              <span class="text-center">
                <i class="fas fa-rupee-sign"></i>
              </span>
              <span class="text-center">
                650/
              </span>
            </div>
            <span>Learner</span>
          </div>


          <div class="flex items-center gap-2 mt-2 text-xs ml-[-34px]">
            <span class="font-thin ">
              <i class='fas fa-book-open'></i>
            </span>
            <span class="">
              AGM Enterprices
            </span>
          </div>
        </div>
      </div>
    </div>

    <div class="p-4 bg-gray-50 shadow rounded-lg mt-6">
      <div class="flex justify-between items-center gap-2">
        <div class="w-full">
          <h1 class="font-medium text-sm my-2">
            Data Entry Operator Job
          </h1>

          <div class="flex gap-2 items-center my-1">
            <span class="text-xs"><i class='far fa-file'></i></span>
            <a class="text-xs underline underline-offset-1" href="">View Specification Document</a>
            <span class="text-xs cursor-pointer"> <i class='fas fa-share-alt'></i></span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="fas fa-rupee-sign"></i>
            </span>
            <span class="text-xs">
              1500/Month
            </span>
          </div>

          <div class="flex items-center gap-[6px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>

            <span class="text-xs">
              Start Date - 20 Oct 2024
            </span>
          </div>

          <div class="flex items-center gap-[6px] mt-[2px]">
            <span class="font-thin text-xs">
              <i class="material-icons text-xs ml-[-2px]">date_range</i>
            </span>
            <span class="text-xs">
              End Date - 20 Oct 2025
            </span>
          </div>

          <div class="mt-[-1px]">
            <span class="font-thin text-xs">
              <i class='fas fa-address-book'></i>
            </span>
            <span class="text-xs">
              10 Job Openings
            </span>
          </div>
        </div>

        <div class="">
          <div class="flex flex-col gap-0 text-center text-xs ">
            <span>YS</span>
            <span>
              Incentive
            </span>
          </div>

          <div class="bg-gray-200 px-3 py-2 text-center mt-2">
            <div class=" flex gap-1 text-sm font-medium text-center justify-center">
              <span class="text-center">
                <i class="fas fa-rupee-sign"></i>
              </span>
              <span class="text-center">
                650/
              </span>
            </div>
            <span>Learner</span>
          </div>


          <div class="flex items-center gap-2 mt-2 text-xs ml-[-34px]">
            <span class="font-thin ">
              <i class='fas fa-book-open'></i>
            </span>
            <span class="">
              AGM Enterprices
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- 12. .............Add Opportunity ...........-->
  <div id="screen12" class="hidden max-w-sm mx-auto p-4 bg-white shadow-md rounded-lg">
    <button onclick="showScreen9(event)" class="hover:text-blue-600 mb-4 text-lg">
      &larr;
    </button>

    <div class="flex justify-center mb-4">
      <img src="Images/image.png" alt="YuWaah Logo" class="h-14">
    </div>

    <div class="mt-2 text-sm">
      <h1 class="">
        Add Opportunity
      </h1>
    </div>

    <form class="space-y-4 mt-6">
      <div class="space-y-1">
        <label for="opportunity" class="text-xs text-gray-700">Opportunity Name</label>
        <input id="opportunity" type="text" placeholder="Please Enter Opportunity Name"
          class="text-xs w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
      </div>

      <div class="space-y-1 mt-1">
        <label for="opportunity" class="text-xs text-gray-700">Opportunity Name</label>

        <div class="space-y-2 mt-4">
          <label class="flex items-center space-x-2">
            <input type="radio" name="career" value="job"
              class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500" />
            <span class="text-gray-700 text-xs ">Job</span>
          </label>

          <label class="flex items-center space-x-2">
            <input type="radio" name="career" value="entrepreneurship"
              class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500" checked />
            <span class="text-gray-700 text-xs">Entrepreneurship</span>
          </label>
        </div>
      </div>

      <div class="space-y-1 mt-2">
        <label for="potential" class="text-xs text-gray-700">Earning Potential (Per Month)</label>
        <select id="potential" class="text-xs w-full border rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
          <option value="" disabled selected>Select Potential</option>
          <option value="10000">10000</option>
          <option value="20000">20000</option>
          <option value="30000">30000</option>
          <option value="40000">40000</option>
        </select>
      </div>

      <div class="space-y-1">
        <label class="text-gray-700 text-xs">Attach Documents</label>
        <div class="flex items-center space-x-2">
          <div class="flex items-center border border-gray-300 rounded px-2 py-2 w-full">
            <span id="file-name" class="text-gray-700 text-xs flex-grow">No file chosen</span>
            <label class="hover:text-blue-500 cursor-pointer">
              <input type="file" id="file-upload" class="hidden" onchange="handleFileUpload(event)" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15.172 7l-4.95 4.95a3 3 0 104.243 4.243l4.95-4.95a5 5 0 10-7.071-7.071l-5.657 5.657" />
              </svg>
            </label>
          </div>
          <button class="text-gray-500 hover:text-red-500 border border-gray-300 rounded-full p-1"
            onclick="removeFile()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
              class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
            </svg>
          </button>
        </div>
      </div>

      <div class="flex justify-center ">
        <button class="w-3/5 my-28 bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 pb-[6px]">
          Save Opportunity
        </button>
      </div>
    </form>
  </div>

</body>

</html>
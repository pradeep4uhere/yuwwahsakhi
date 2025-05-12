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
    <div class="flex justify-center mb-14">
    <a href="{{route('welcome')}}">
      <img src="{{asset('asset/images/Yuwaahlogo.png')}}" alt="YuWaah Logo" class="w-[150px] h-[86px] ">
    </a>
    </div>
    <h1 class="w-[147px] h-[34px] font-[600] text-[28px] leading-[34.13px] mb-4">Enter OTP</h1>
    <p class="my-6 w-[222px] h-[37px] font-[400] text-[14px] leading-[17.07px] text-[#000000]">
      A 6-digit code has been sent to +91-{{$mobile}}
    </p>
    @if ($errors->has('error'))
        <div class="text-red-600 bg-red-100 p-2 rounded mb-4">
            {{ $errors->first('error') }}
        </div>
    @endif
  
    <form class="" action="{{route('verify.mobile.otp')}}" method="post" id="formchangepassword">
        @csrf
      <div class="space-y-1 text-xs mb-10" id="otp-container">
        <label for="otp" class="w-[26px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">OTP</label>
        <div class="flex justify-between gap-2 text-sm" id="otp-container">
        <input type="text" name="d1" maxlength="1" class="otp-input w-[40px] h-[40px] border-[1px] rounded-[10px] text-center bg-[#FFFFFF] border-[#28388F0D] focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <input type="text" name="d2" maxlength="1" class="otp-input w-[40px] h-[40px] border-[1px] rounded-[10px] text-center bg-[#FFFFFF] border-[#28388F0D] focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <input type="text" name="d3" maxlength="1" class="otp-input w-[40px] h-[40px] border-[1px] rounded-[10px] text-center bg-[#FFFFFF] border-[#28388F0D] focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <input type="text" name="d4" maxlength="1" class="otp-input w-[40px] h-[40px] border-[1px] rounded-[10px] text-center bg-[#FFFFFF] border-[#28388F0D] focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <input type="text" name="d5" maxlength="1" class="otp-input w-[40px] h-[40px] border-[1px] rounded-[10px] text-center bg-[#FFFFFF] border-[#28388F0D] focus:ring-2 focus:ring-blue-500 focus:outline-none">
        <input type="text" name="d6" maxlength="1" class="otp-input w-[40px] h-[40px] border-[1px] rounded-[10px] text-center bg-[#FFFFFF] border-[#28388F0D] focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
      </div>
      <input type="hidden" name="mobile" value="{{$mobile}}"/>
      <div class="flex justify-center items-center w-[250px] h-[40px] rounded-[10px] bg-[#28388F] relative left-11 top-100">
        <button type="submit"
          class="w-[41px] h-[17px] font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF]">
          Submit
        </button>
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
<script>
  const inputs = document.querySelectorAll('.otp-input');

  inputs.forEach((input, index) => {
    // Move to next input on input
    input.addEventListener('input', () => {
      if (input.value.length === 1 && index < inputs.length - 1) {
        inputs[index + 1].focus();
      }
    });

    // Backspace to previous input
    input.addEventListener('keydown', (e) => {
      if (e.key === 'Backspace' && input.value === '' && index > 0) {
        inputs[index - 1].focus();
      }
    });

    // Handle paste
    input.addEventListener('paste', (e) => {
      e.preventDefault();
      const data = e.clipboardData.getData('text').trim();
      if (/^\d{6}$/.test(data)) {
        data.split('').forEach((char, i) => {
          if (inputs[i]) {
            inputs[i].value = char;
          }
        });
        inputs[5].focus(); // Focus last input
      }
    });
  });
</script>
</body>
</html>
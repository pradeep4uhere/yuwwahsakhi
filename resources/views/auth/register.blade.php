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
    @if (session('error'))
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">{{ session('error') }}</div>
      @endif
      @if (session('success'))
      <div class="bg-green-100 text-green-700 p-4 rounded mb-4 mt-5">
        {{ session('success') }}
      </div>
      @endif
      <!-- @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif -->

     
    <form id="registrationForm" action="{{route('register')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Register Form -->
    <h1 class="w-[121px] h-[34px] font-[600] text-[28px] leading-[34.13px] text-[#000000] mb-6">Register</h1>
    <div class="space-y-1">
     <div class="space-y-1">
        <label for="name" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Full Name</label>
        <input type="text" id="name" name="name" value="{{old('name')}}" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
      <div class="space-y-1">
        <label for="dob" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Date Of Birth</label>
        <input type="date" id="dob" name="dob" value="{{old('dob')}}" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('dob')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="email" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Email</label>
        <input type="email" id="email" name="email" value="{{old('email')}}" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <div class="space-y-1 ">
        <label for="gender" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Gender</label>
        <select id="gender" name="gender" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="education" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Education Level</label>
        <select id="education" name="education" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
        <?php $educationLevel = getGlobalList('EducationLevel'); ?>
        @foreach($educationLevel as $k=>$item)
        <option value="{{$k}}" {{ old('education') == $k ? 'selected' : '' }}>{{$item}}</option>
        @endforeach
        </select>
        <x-input-error :messages="$errors->get('education')" class="mt-2" />
      </div>
      <div class="space-y-1">
        <label for="serviceofferd" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Service Offered</label>
        <select id="serviceofferd" name="serviceofferd" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
        <?php $ServicesOffered = getGlobalList('ServicesOffered'); ?>
        @foreach($ServicesOffered as $k=>$item)
        <option value="{{$k}}" {{ old('serviceofferd') == $k ? 'selected' : '' }}>{{$item}}</option>
        @endforeach
        </select>
        <x-input-error :messages="$errors->get('serviceofferd')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="qualification" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Specific Qualification</label>
        <select id="qualification" name="qualification" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
        <?php $SpecificationQualification = getGlobalList('SpecificationQualification'); ?>  
        <option value="">Select Specific Qualification</option>
            @foreach($SpecificationQualification as $k=>$item)
            <option value="{{$k}}" {{ old('qualification') == $k ? 'selected' : '' }}>{{$item}}</option>
            @endforeach 
        </select>
        <x-input-error :messages="$errors->get('qualification')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="digital_proficiency" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Digital Proficiency</label>
        <select id="digital_proficiency" name="digital_proficiency" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
          <option value="">Select Digital Proficiency Level</option>
          <?php $DigitalProficiencyLevel = getGlobalList('DigitalProficiencyLevel'); ?>  
            @foreach($DigitalProficiencyLevel as $k=>$item)
            <option value="{{$k}}" {{ old('digital_proficiency') == $k ? 'selected' : '' }}>{{$item}}</option>
            @endforeach 
        </select>
        <x-input-error :messages="$errors->get('digital_proficiency')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="english_proficiency" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">English Proficiency</label>
        <select id="english_proficiency"
          class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
          <option value="" name="english_proficiency">Select English Proficiency Level</option>
          <option value="Beginner" {{ old('english_proficiency') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
          <option value="Intermediate" {{ old('english_proficiency') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
          <option value="Advanced" {{ old('english_proficiency') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
        </select>
        <x-input-error :messages="$errors->get('english_proficiency')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="experience" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Year of Experience</label>
        <select id="experience" name="experience" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
          <option value="" selected>Select Years of Experience</option>
          <option value="0-1" {{ old('experience') == '0-1' ? 'selected' : '' }}>0-1 year</option>
          <option value="2-5" {{ old('experience') == '2-5' ? 'selected' : '' }}>2-5 years</option>
          <option value="6-10" {{ old('experience') == '6-11' ? 'selected' : '' }}>6-10 years</option>
          <option value="10+" {{ old('experience') == '10+' ? 'selected' : '' }}>10+ years</option>
        </select>
        <x-input-error :messages="$errors->get('experience')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="work_hours" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Number of hours I can work in a day</label>
        <select id="work_hours" name="work_hours" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
          <option value=""  selected>Select Work Hours</option>
          <option value="1-4" {{ old('work_hours') == '1-4' ? 'selected' : '' }}>1-4 hours</option>
          <option value="5-8" {{ old('work_hours') == '5-8' ? 'selected' : '' }}>5-8 hours</option>
          <option value="8+" {{ old('work_hours') == '8+' ? 'selected' : '' }}>8+ hours</option>
        </select>
        <x-input-error :messages="$errors->get('work_hours')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="loan" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Loan Taken</label>
        <select id="infrastructure" name="infrastructure" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
          <option value=""  selected>Please Select</option>
          <option value="Yes" {{ old('infrastructure') == 'Yes' ? 'selected' : '' }}>Yes</option>
          <option value="No" {{ old('infrastructure') == 'No' ? 'selected' : '' }}>No</option>
        </select>
        <x-input-error :messages="$errors->get('infrastructure')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="loan_type" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Type of Loan</label>
        <select id="loan_type" name="loan_type" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
        <?php $LoanType = getGlobalList('LoanType'); ?>  
            <option value="">Loan Type</option>
            @foreach($LoanType as $k=>$item)
            <option value="{{$k}}" {{ old('loan_type') == $k ? 'selected' : '' }}>{{$item}}</option>
            @endforeach 
        </select>
        <x-input-error :messages="$errors->get('loan_type')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="amount" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Loan Amount</label>
        <input type="number" id="amount" name="amount" value="{{old('amount')}}" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="loanbalance" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Balance Loan Amount</label>
        <input type="number" id="loan_balance" name="loan_balance" value="{{old('loan_balance')}}" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('loan_balance')" class="mt-2" />
      </div>


      <div class="space-y-1">
        <label for="State" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">State</label>
        <?php $class = "w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500";?>
          {!! getStateList('state_id', '', $class, "loadDistricts(this.value)") !!}
        <x-input-error :messages="$errors->get('state_id')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="district" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">District</label>
        <?php $class = "w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500";?>
        <div id="responseDistrict">{!!getDistrict('', 'district_id','',$class)!!}</div>
        <x-input-error :messages="$errors->get('district_id')" class="mt-2" />
      </div>

      <div class="space-y-1">
        <label for="block" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Block/City</label>
        <?php $class = "w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500";?>
        <div id="blockWrapper">{!!getBlock('', 'block_id','',$class)!!}</div>
        <x-input-error :messages="$errors->get('block_id')" class="mt-2" />
      </div>
        
    <div class="space-y-1">
        <label for="pincode" class="w-[80px] h-[15px] font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Pincode</label>
        <input type="pincode" id="pincode" name="pincode" value="{{old('pincode')}}" class="w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500" />
        <x-input-error :messages="$errors->get('pincode')" class="mt-2" />
      </div>




      <div class="space-y-4 text-xs pt-2">
        <div class="flex flex-col gap-2">
          <label for="upload_center_photo" class="font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Upload Center Photo</label>
          <div class="flex items-center gap-2 justify-between">
            <label for="upload_center_photo"
              class="w-[310px] h-[40px] flex items-center justify-between gap-2 px-4 py-2 border rounded-[10px] cursor-pointer text-[#A7A7A7] bg-[#FFFFFF] hover:bg-gray-200">
              <span class="w-[52px] h-[12px] font-Montserrat w-[400] text-[10px] leading-[12.19px] text-center">Select File</span>
              <img src="{{asset('asset/images/paperclip.png')}}" alt="" class="w-[16px] h-[16px]">
              <!-- <i class="fa-solid fa-paperclip fa-xl text-[#05A7D1]"></i> -->
            </label>
            <input type="file" id="upload_center_photo" name="upload_center_photo" class="hidden" />
           
          </div>
        </div>


        <div class="flex flex-col gap-2 text-xs">
          <label for="upload_profile_photo" class="font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">Upload Profile Photo</label>

          <div class="flex justify-between items-center gap-2">
            <label for="upload_profile_photo"
              class="w-[310px] h-[40px] flex items-center justify-between gap-2 px-4 py-2 border rounded-[10px] cursor-pointer text-[#A7A7A7] bg-[#FFFFFF] hover:bg-gray-200">
              <span class="w-[52px] h-[12px] font-Montserrat w-[400] text-[10px] leading-[12.19px] text-center">Select File</span>
              <img src="{{asset('asset/images/paperclip.png')}}" alt="" class="w-[16px] h-[16px]">
            </label>
            <input type="file" id="upload_profile_photo" name="upload_profile_photo" class="hidden" />
            
          </div>  
        </div>
      </div>

      <div class="flex gap-2 items-center pt-2 pb-2">
        <input type="checkbox" name="agree" id="agreeCheckbox" class="w-[15px] h-[15px] border-[1.25px] text-[#05A7D1]">
        <div class="w-[300px] h-[45px] font-[400] text-[12px] leading-[14.63px]  text-[#000000]">
          By complete the registration you are agreeing that your profile information can be shared as per our
          <a href="#" class="font-[700] text-[12px] leading-[14.63px] text-[#28388F] hover:underline">Terms & Conditions</a>
        </div>
      </div>

      <div class="flex justify-center items-center bg-[#28388F] w-[250px] h-[40px] rounded-[10px] relative left-12">
        <button type="submit"
          class="w-[171px] h-[17px] font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF] text-center">
          Complete Registration
        </button>
      </div>
    </div>
    </form>
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    function loadDistricts(stateId) {
        if (stateId) {
            $.ajax({
                url: '/get-districts/' + stateId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    let districtSelect = $('#responseDistrict');
                    districtSelect.html(data.html)
                },
                error: function () {
                    alert('Failed to load districts.');
                }
            });
        } else {
            $('#district_id').empty().append('<option value="">Select District</option>');
        }
    }
</script>
<script>
$(document).ready(function() {
    // When district dropdown changes, load blocks
    $(document).on('change', '#district_id', function () {
        var districtId = $(this).val();

        if (districtId) {
            $.ajax({
                url: '/get-blocks',
                type: 'GET',
                data: { district_id: districtId },
                success: function (response) {
                    $('#blockWrapper').html(response.html);
                },
                error: function () {
                    alert('Error fetching blocks');
                }
            });
        } else {
            $('#blockWrapper').html("<select name='block_id' class='form-control' id='block_id'><option value=''>Select District First</option></select>");
        }
    });
});
</script>
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
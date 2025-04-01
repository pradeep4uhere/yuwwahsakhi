@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[100vh] h-auto">
    <div class="flex justify-between items-center px-5 py-[1rem] mx-auto ">
      <div id="hamburger" class="hamburger text-2xl cursor-pointer z-1000 w-[20.15px] h-[20px] absolute top-[51px] left-[31.23px]" onclick="toggleSidebar()">&#9776;</div>

      <div id="sidebar" class="sidebar shadow-2xl text-xs bg-[#FFFFFF] w-[270px] h-[780px] absolute top-[40px]">
        <div class="max-w-[26rem] flex justify-center mt-4">
          <img src="{{asset('asset/images/Profilelogo.png')}}" alt="profileLogo" class="w-[60.45px] h-[60px] absolute top-[81px] left-[104.78px]">
        </div>

        <div class="my-4 mx-6 space-y-3">
          <div class="flex gap-4">
            <p class="w-[32.24px] h-[15px] absolute top-[168px] left-[31.23px] font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">YS ID</p>
            <p class="w-[37.28px] h-[15px] absolute top-[168px]  left-[111.83px] font-Montserrat font-[600] text-[12px] leading-[14.63px] text-[#000000]">22345</p>
          </div>
          <div class="flex gap-4">
            <p class="w-[59.44px] h-[15px] absolute top-[198px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">YS Center</p>
            <p class="w-[128.96px] h-[15px] absolute top-[198px] left-[111.83px] font-Montserrat font-[600] text-[12px] leading-[14.63px] text-[#000000]">Paschim Puri Village</p>
          </div>
          <div class="flex gap-4">
            <p class="w-[33.25px] h-[15px] absolute top-[228px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Since</p>
            <p class="w-[118.88px] h-[15px] absolute top-[228px] left-[111.83px] font-Montserrat font-[600] text-[12px] leading-[14.63px] text-[#000000]">14th February 2023</p>
          </div>
          <div class="flex gap-4">
            <a href="profile.html" class="w-[60.45px] h-[15px] absolute top-[258px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">My Profile</a>
          </div>
          <div class="flex gap-4">
            <a href="" class="w-[50.37px] h-[15px] absolute top-[288px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Settings</a>
          </div>
          <div>
            <hr class="w-[213.58px] absolute top-[330px] left-[30.22px] border-[1px] text-[#DADADA]">
          </div>
          <div class="flex gap-4">
            <a href="" class="w-[94.7px] h-[15px] absolute top-[348px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">About YuWaah!</a>
          </div>
          <div class="flex gap-4">
            <a href="" class="w-[104.78px] h-[15px] absolute top-[378px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Unicef YouthHub</a>
          </div>
          <div class="flex gap-4">
            <a href="" class="w-[132.99px] h-[15px] absolute top-[408px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Terms and Conditions</a>
          </div>
          <div class="flex gap-4">
            <a href="" class="w-[132.99px] h-[15px] absolute top-[438px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">Get In Touch</a>
          </div>
          <div class="flex gap-4">
            <img src="Images/phone.png" alt="profileLogo" class="w-[10px] h-[10px] absolute top-[471px] left-[30px]">
            <a href="" class="w-[132.99px] h-[15px] absolute top-[468px] left-[51.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">+91-9889990089</a>
          </div>
          <div class="flex gap-4">
            <img src="Images/mail.png" alt="profileLogo" class="w-[10px] h-[10px] absolute top-[501px] left-[30px]">
            <a href="" class="w-[132.99px] h-[15px] absolute top-[498px] left-[51.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">hello@yuwaah.org</a>
          </div>
          <div class="w-[200.49px] h-[40px] absolute top-[530px] left-[30.23px] rounded-[10px] bg-[#28388F]">
            <a href="login.html" type="button"
              class="w-[47.35px] h-[15px] absolute top-[12px] left-[80px] font-Montserrat font-[600] text-[12px] leading-[14.63px] text-[#FFFFFF]">
              Logout
            </a>
          </div>
        </div>
      </div>

      <div class="flex justify-center">
        <a href="index.html"> <img src="{{asset('asset/images/Yuwaahlogo.png')}}" alt="YuWaah Logo" class="w-[91px] h-[56px] absolute top-[34px] left-[158px]"></a>
      </div>

      <div class="flex gap-2 items-center">

        <div class="cursor-pointer" onclick="toggleLanguageForm()">
          <img src="{{asset('asset/images/eng.png')}}" alt="engLogo" class="w-[20px] h-[20px] absolute top-[51px] left-[322px]">
        </div>

        <div class="cursor-pointer flex gap-2 items-center w-[20px] h-[20px] absolute top-[50px] left-[352px]"> <i class="material-icons">notifications_none</i> </div>

      </div>
    </div>
    <!-- Language Pop Up -->
    <div id="languageForm" class="max-w-[26rem] hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 mx-auto "
    style="box-shadow: 0px 3px 10px 3px #00000026;"
    >
      <div class="w-[310px] h-[230px] bg-[#FFFFFF] p-6"
      style="box-shadow: 0px 3px 10px 3px #00000026;">
        <div class="flex justify-between mb-4">
          <h1 class="w-[200px] h-[17px] font-Montserrat font-[600] text-[14px] leading-[17.07px] text-[#000000]">Select Language</h1>
          <button class="w-[20px] h-[20px] text-[#1F2937] hover:text-gray-700 text-4xl mt-[-16px]" onclick="toggleLanguageForm()">
            &times;
          </button>
        </div>
        <form action="{{ route('change.language') }}" method="POST">
        @csrf
          <div class="space-y-4 ">
            <label for="language" class="block w-[51px] h-[12px]  font-Montserrat font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]"> Language</label>
            <div class=" w-[271px] h-[140px] ">
              
              <select name="language" id="language"  class="w-[270px] h-[40px]  border-[1px] rounded-[10px] mt-[-10px] text-[10px] text-[#A7A7A7] leading-[12.19px]">
                <!-- <option value="en" class="w-[119px] h-[12px]  font-[400] text-[10px] leading-[12.19px] text-center text-[#A7A7A7]">English</option>
                <option value="hi">Hindi</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option> -->
                <option value="" class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black" disabled selected>Please Select Language</option>
                  <option value="en" class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black">English</option>
                  <option value="hi" class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black">Hindi</option>
                  <option value="es" class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black">Spanish</option>
                  <option value="fr" class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black">French</option>
              </select>

              <button type="submit" class="mt-[30px] ml-[5px] rounded-[10px] w-[260px] text-center bg-[#28388F] text-white py-3 text-[14px] leading-[17.07px] font-[600] font-Montserrat">
                Apply
              </button>
            </div>
            <!-- <div class="">
            
            </div> -->
          </div>
        </form>
      </div>
    </div>

    <div class="">
      <img src="{{asset('asset/images/file-textcopy.png')}}" alt="engLogo" class="w-[20px] h-[20px] absolute top-[104px] left-[34px]">
      <p class="w-[85px] h-[17px] absolute top-[106px] left-[65px] font-Montserrat font-[500] text-[14px] leading-[17.07px]">
        {{__('messages.to_do_tasks')}}
      </p>
      <div class="w-[340px] h-[50px] absolute top-[140px] left-[37px] bg-[#FFFFFF]" 
      style="box-shadow: 0px 3px 10px 0px #0000001A;"
      >
        <div class="flex justify-between items-center">
          <div class="w-[104px] h-[17px] absolute top-[18px] left-[17px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-center text-[#000000]"> {{__('messages.pending_tasks')}}</div>
          <div class="w-[27px] h-[34px] absolute top-[10px] left-[285px] font-Montserrat font-[600] text-[28px] leading-[34.13px] text-center text-[#05A7D1]">5</div>
        </div>
      </div>
    </div>
    <div class="">
      <img src="{{asset('asset/images/star-textcopy.png')}}" alt="engLogo" class="w-[20px] h-[20px] absolute top-[214px] left-[34px]">
      <p class="w-[100px] h-[17px] absolute top-[216px] left-[65px] font-Montserrat font-[500] text-[14px] leading-[17.07px]">
          {{__('messages.opportunities')}}
        
      </p>
      <div class="w-[340px] h-[50px] absolute top-[250px] left-[37px] bg-[#FFFFFF]"
        style="box-shadow: 0px 3px 10px 0px #0000001A;"
      >
        <div class="flex justify-between items-center mt-2">
          <div class="w-[143px] h-[266px] absolute top-[18px] left-[1px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-center text-[#000000]">{{__('messages.open_opportunities')}}</div>
          <div class="w-[36px] h-[34px] absolute top-[10px] left-[280px] font-Montserrat font-[600] text-[28px] leading-[34.13px] text-center text-[#05A7D1]">5</div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-4 ">
      <p class="w-[106px] h-[12px] absolute top-[320px] left-[34px] font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#000000]">
         {{__('messages.opportunities')}}
      </p>
      <div class="w-[340px] h-[140px] absolute top-[340px] left-[37px] bg-[#FFFFFF] cursor-pointer"
        style="box-shadow: 0px 3px 10px 0px #28388F33;"
        onclick="window.location.href='Opportunities.html';"
        >
          <h1 class="w-[310px] h-[15px] ml-[10px] mt-[6px] font-Montserrat font-[500] text-[12px] leading-[14.63px] text-[#000000]">Data Entry Operator Job (AGAM Enterprises)</h1>
          <div class="flex justify-between">
            <div class="">
              <div class="flex mb-[3px]">
                <img src="{{asset('asset/images/file.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px] mt-[8px] text-[#28388F0D]">
                <a href="" class="w-[151px] h-[12px] mt-[9px] ml-[8px] font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#28388F] text-left underline underline-offset-auto decoration-solid decoration-skip-ink-none">View Specification Document
                </a>
                <img src="{{asset('asset/images/Group.png')}}" alt="engLogo" class="w-[20px] h-[20px] mt-[6px] ml-[10px] text-[#28388F0D]">
              </div>
                
              <div class="flex mb-[6px]">
                <img src="{{asset('asset/images/Rupee Icon.png')}}" alt="engLogo" class="w-[9px] h-[12px] ml-[12px]  text-[#28388F0D]">
                <p class="w-[61px] h-[12px]  ml-[10px] font-Montserrat font-[600] text-[10px] leading-[12.19px] text-[#28388F]">
                  1500/Month
                </p>
              </div>
              
              <div class="flex mb-[5px]">
                <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
                <p class="w-[95px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
                  Start - 20 Oct 2024
                </p>
              </div>
              
              <div class="flex mb-[6px]">
                <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
                <p class="w-[95px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
                  End - 20 Oct 2025
                </p>
              </div>
              
              <div class="flex mb-[6px]">
                <img src="{{asset('asset/images/user.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
                <p class="min-w-[63px] w-auto h-[12px] ml-[6px] mt-[1px]  font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#000000]">
                  10 Job Opening
                </p>
              </div>
              
            </div>
            <div>
              <p class="w-[43px] h-[22px] mt-[22px] mr-[20px]  font-Montserrat font-[500] text-[9px] leading-[10.97px] text-center text-[#000000]">
                YS Incentive
              </p>
              <div class="w-[60px] h-[50px] absolute top-[70px] left-[260px] bg-[#28388F] ">
                <p class="w-[60px] h-[30px] mt-[14px] font-Montserrat font-[700] text-[12px] leading-[14.63px] text-center text-[#FFFFFF]">            
                  50/ Learner 
                  <img src="{{asset('asset/images/rupeeIcon.png')}}" alt="engLogo" class="w-[8px] h-[14px] mt-[-30px] ml-[8px]">
                </p>
              </div>
              

              <!-- <p>
                AGAN Enterprices
              </p> -->

            </div>
          </div>
      </div>
      <div class="w-[340px] h-[140px] absolute top-[490px] left-[37px] bg-[#FFFFFF] cursor-pointer"
      style="box-shadow: 0px 3px 10px 0px #28388F33;"
      onclick="window.location.href='Opportunities.html';"
      >
        <h1 class="w-[310px] h-[15px] ml-[10px] mt-[6px] font-Montserrat font-[500] text-[12px] leading-[14.63px] text-[#000000]">Data Entry Operator Job</h1>
        <div class="flex justify-between">
          <div class="">
            <div class="flex mb-[3px]">
              <img src="{{asset('asset/images/file.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px] mt-[8px] text-[#28388F0D]">
              <a href="" class="w-[151px] h-[12px] mt-[9px] ml-[8px] font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#28388F] text-left underline underline-offset-auto decoration-solid decoration-skip-ink-none">View Specification Document
              </a>
              <img src="{{asset('asset/images/Group.png')}}" alt="engLogo" class="w-[20px] h-[20px] mt-[6px] ml-[10px] text-[#28388F0D]">
            </div>
               
            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/Rupee Icon.png')}}" alt="engLogo" class="w-[9px] h-[12px] ml-[12px]  text-[#28388F0D]">
              <p class="w-[61px] h-[12px]  ml-[10px] font-Montserrat font-[600] text-[10px] leading-[12.19px] text-[#28388F]">
                1500/Month
              </p>
            </div>
            
            <div class="flex mb-[5px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[95px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
                Start - 20 Oct 2024
              </p>
            </div>
            
            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/calendar.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="w-[95px] h-[12px] ml-[6px] mt-[1px] font-[500] text-[10px] leading-[12.19px] text-[#000000]">
                End - 20 Oct 2025
              </p>
            </div>
            
            <div class="flex mb-[6px]">
              <img src="{{asset('asset/images/user.png')}}" alt="engLogo" class="w-[14px] h-[14px] ml-[10px]  text-[#28388F0D]">
              <p class="min-w-[63px] w-auto h-[12px] ml-[6px] mt-[1px]  font-Montserrat font-[500] text-[10px] leading-[12.19px] text-[#000000]">
                10 Job Opening
              </p>
            </div>
            
          </div>
          <div>
            <p class="w-[43px] h-[22px] mt-[22px] mr-[20px]  font-Montserrat font-[500] text-[9px] leading-[10.97px] text-center text-[#000000]">
              YS Incentive
            </p>
            <div class="w-[60px] h-[50px] absolute top-[70px] left-[260px] bg-[#28388F] ">
              <p class="w-[60px] h-[30px] mt-[14px] font-Montserrat font-[700] text-[12px] leading-[14.63px] text-center text-[#FFFFFF]">            
                50/ Learner 
                <img src="{{asset('asset/images/rupeeIcon.png')}}" alt="engLogo" class="w-[8px] h-[14px] mt-[-30px] ml-[8px]">
              </p>
            </div>
            

            <!-- <p>
              AGAN Enterprices
            </p> -->

          </div>
        </div>
      </div>
      
    </div>

    <div class="">
      <img src="{{asset('asset/images/usersCopy.png')}}" alt="engLogo" class="w-[20px] h-[20px] absolute top-[652px] left-[34px]">
      <p class="w-[62px] h-[17px] absolute top-[655px] left-[65px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-[#000000]">
      {{__('messages.learners')}}
      </p>
      <div class="w-[340px] h-[50px] absolute top-[690px] left-[37px] bg-[#FFFFFF]" 
      style="box-shadow: 0px 3px 10px 0px #0000001A;"
      >
        <div class="flex justify-between items-center mt-2">

          <div class="w-[104px] h-[17px] absolute top-[18px] left-[17px] font-Montserrat font-[500] text-[14px] leading-[17.07px] text-center text-[#000000]">  {{__('messages.total_learners')}}</div>
          <div class="w-[27px] h-[34px] absolute top-[10px] left-[285px] font-Montserrat font-[600] text-[28px] leading-[34.13px] text-center text-[#05A7D1]">59</div>

        </div>
      </div>
    </div>
    

     

  </div>
  <div
    class="max-w-[26rem] mx-auto w-full sticky bottom-0 h-[64px] bg-[#28388F] flex items-center justify-around shadow-md">
    <a href="todo.html" class="w-[40px] h-[40px] rounded-[10px] bg-[#FFFFFF]"> 
        <img src="{{asset('asset/images/homeCopy.png')}}" alt="home" class="w-[20px] h-[20.34px] absolute top-[21px] left-[38.50px] filter" /> </a>
    <a href="upload.html"> 
        <img src="{{asset('asset/images/file-textBar.png')}}" alt="file" class="w-[20px] h-[20px]" /></a>
    <a href="Opportunities.html"> 
        <img src="{{asset('asset/images/starCopy.png')}}" alt="star" class="w-[20px] h-[20px]" /></a>
    <a href="user.html"> 
        <img src="{{asset('asset/images/usersBar.png')}}" alt="user" class="w-[20px] h-[20px]" /></a>
    <a href="promotion.html"> 
        <img src="{{asset('asset/images/VectorCopy.png')}}" alt="pro" class="w-[20px] h-[20px] activelink " /></a>
</div>
@endsection

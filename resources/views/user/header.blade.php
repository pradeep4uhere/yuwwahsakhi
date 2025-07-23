<div class="flex justify-between items-center px-5 py-[2rem] mx-auto" style="padding-bottom:0px">
    @if(
      (Route::currentRouteName() == 'profile.edit') || 
      (Route::currentRouteName() == 'addopportunities') ||
      (Route::currentRouteName() == 'opportunitiesLearner') ||
      (Route::currentRouteName() == 'user.allevents'))
        <a href="{{ route('dashboard') }}" class="hover:text-blue-600 mb-4 text-lg">
            <img src="{{ asset('asset/images/arrow-left.png') }}" alt="arrow-Left" class="w-[20px] h-[20px] mt-5 hover:text-blue-600"/>
        </a>
    @else
        <div id="hamburger" class="hamburger text-2xl cursor-pointer z-1000 w-[20.15px] h-[20px] absolute top-[51px] left-[31.23px]" onclick="toggleSidebar()">&#9776;</div>
    @endif
     @if(auth()->check())
       @include('user.sidebar')
     @endif

      <div class="flex justify-center">
        <a href="{{route('dashboard')}}"> <img src="{{asset('asset/images/Yuwaahlogo.png')}}" alt="YuWaah Logo" class="w-[91px] h-[56px] absolute top-[34px] left-[158px]"></a>
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
          <h1 class="w-[200px] h-[17px] font-Montserrat font-[600] text-[14px] leading-[17.07px] text-[#000000]">{{__('messages.select')}} {{__('messages.language')}}</h1>
          <button class="w-[20px] h-[20px] text-[#1F2937] hover:text-gray-700 text-4xl mt-[-16px]" onclick="toggleLanguageForm()">
            &times;
          </button>
        </div>
        <form action="{{ route('change.language') }}" method="POST">
        @csrf
          <div class="space-y-4 ">
            <label for="language" class="block w-[51px] h-[12px]  font-Montserrat font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">{{__('messages.language')}}</label>
            <div class=" w-[271px] h-[140px] ">
              
              <select name="language" id="language"  class="w-[270px] h-[40px]  border-[1px] rounded-[10px] mt-[-10px] text-[10px] text-[#A7A7A7] leading-[12.19px]">
                <!-- <option value="en" class="w-[119px] h-[12px]  font-[400] text-[10px] leading-[12.19px] text-center text-[#A7A7A7]">English</option>
                <option value="hi">Hindi</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option> -->
                <option value="" class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black" disabled selected>{{__('messages.Please_Select_Language')}}</option>
                  <option value="en" class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black">{{__('messages.english')}}</option>
                  <option value="hi" class="w-[103px] h-[12px] font-Montserrat font-[400] text-[10px] leading-[12.19px] text-black">{{__('messages.hindi')}}</option>
              </select>

              <button type="submit" class="mt-[30px] ml-[5px] rounded-[10px] w-[260px] text-center bg-[#28388F] text-white py-3 text-[14px] leading-[17.07px] font-[600] font-Montserrat">
              {{__('messages.apply')}}
              </button>
            </div>
            <!-- <div class="">
            
            </div> -->
          </div>
        </form>
      </div>
    </div>
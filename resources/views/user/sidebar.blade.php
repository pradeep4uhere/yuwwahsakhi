<div id="sidebar" class="sidebar shadow-2xl text-xs bg-[#FFFFFF] w-[370px] h-[780px] absolute top-[40px]">
        <div class="max-w-[26rem] flex justify-center mt-4">
          @if(getYuwaahSakhiAuthProfileImage()!='')
            <img src="{{asset('storage/'.getYuwaahSakhiAuthProfileImage())}}" alt="profileLogo" class="w-[60.45px] h-[60px] absolute top-[81px] left-[104.78px]">
          @else
            <img src="{{asset('asset/images/Profilelogo.png')}}" alt="profileLogo" class="w-[60.45px] h-[60px] absolute top-[81px] left-[104.78px]">
          @endif
        </div>

        <div class="my-4 mx-6 space-y-3">
          <div class="flex gap-4">
            <p class="w-[82.24px] h-[15px] absolute top-[168px] left-[31.23px] font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">{{__('messages.Field_Agent_ID')}}</p>
            <p class="w-[97.28px] h-[15px] absolute top-[168px]  left-[111.83px] font-Montserrat font-[600] text-[12px] leading-[14.63px] text-[#000000]">{{ getYuwaahSakhiAuthID() }}</p>
          </div>
          <div class="flex gap-4">
            <p class="w-[89.44px] h-[15px] absolute top-[198px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">{{__('messages.division')}}</p>
            <p class="w-[128.96px] h-[15px] absolute top-[198px] left-[111.83px] font-Montserrat font-[600] text-[12px] leading-[14.63px] text-[#000000]">{{getYuwaahSakhiAuthCenterName()}}</p>
          </div>
          <div class="flex gap-4">
            <p class="w-[33.25px] h-[15px] absolute top-[228px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">{{__('messages.Since')}}</p>
            <p class="w-[118.88px] h-[15px] absolute top-[228px] left-[111.83px] font-Montserrat font-[600] text-[12px] leading-[14.63px] text-[#000000]">{{getYuwaahSakhiAuthOnBoardedDate()}}</p>
          </div>
          <div class="flex gap-4">
            <a href="{{route('profile.edit')}}" class="w-[60.45px] h-[15px] absolute top-[258px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">{{__('messages.my_profile')}}</a>
          </div>
          <div>
            <hr class="w-[213.58px] absolute top-[330px] left-[30.22px] border-[1px] text-[#DADADA]">
          </div>
          <div class="flex gap-4">
            <a href="{{route('page.about_yuwaah')}}" class="w-[94.7px] h-[15px] absolute top-[348px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">{{__('messages.About_Yuwaah')}}</a>
          </div>
          <div class="flex gap-4">
            <a href="{{route('page.unicefyuthhub')}}" class="w-[104.78px] h-[15px] absolute top-[378px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">{{__('messages.Unicef_YouthHub')}}</a>
          </div>
          <div class="flex gap-4">
            <a href="{{route('page.termsandconditions')}}" class="w-[132.99px] h-[15px] absolute top-[408px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">{{__('messages.Terms_and_Conditions')}}</a>
          </div>
          <div class="flex gap-4">
            <p class="w-[132.99px] h-[15px] absolute top-[438px] left-[31.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">{{__('messages.Get_In_Touch')}}</p>
          </div>
          <div class="flex gap-4">
            <img src="{{asset('asset/images/phone.png')}}" alt="profileLogo" class="w-[10px] h-[10px] absolute top-[471px] left-[30px]">
            <p class="w-[132.99px] h-[15px] absolute top-[468px] left-[51.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">{{env('SUPPORT_NUMBER')}}</p>
          </div>
          <div class="flex gap-4">
            <img src="{{asset('asset/images/mail.png')}}" alt="profileLogo" class="w-[10px] h-[10px] absolute top-[501px] left-[30px]">
            <p class="w-[132.99px] h-[15px] absolute top-[498px] left-[51.23px] font-Montserrat font-[400] text-[12px]  leading-[14.63px] text-[#000000]">{{env('SUPPORT_EMAIL_ADDRESS')}}</p>
          </div>
          <div class="w-[200.49px] h-[40px] absolute top-[530px] left-[30.23px] rounded-[10px] bg-[#28388F]">
          
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a href="route('admin.logout')" type="button"
                              onclick="event.preventDefault();
                                          this.closest('form').submit();" class="w-[47.35px] h-[15px] absolute top-[12px] left-[80px] font-Montserrat font-[600] text-[12px] leading-[14.63px] text-[#FFFFFF]">
              <i class="il uil-megaphone"></i>
              <span class="link-name">SignOut</span>
              </a>
              </form>
          </div>
        </div>
      </div>
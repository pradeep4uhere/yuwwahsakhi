      <div id="toggleSortPopUp()" class="mt-6 hidden fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white  w-[310px] h-[400px] absolute top-[130px] border-[1px]"
          style="box-shadow: 0px 3px 10px 3px #00000026; padding:13px">
          <div class="flex justify-between items-center mb-4">
            <h1
              class="w-[88px] h-[17px] font-Montserrat font-[600] text-[14px] leading-[17.07px] text-center text-[#000000]">
              {{__('messages.event')}} {{__('messages.filters')}}</h1>
            <button class="w-[20px] h-[20px] text-[#1F2937] hover:text-gray-700 text-4xl mt-[-16px]"
              onclick="toggleFilterForm()">
              &times;
            </button>
          </div>

          <form class="space-y-[2px]" action="" method="post">
            @csrf
            <div class="">
              <label
                class="w-[38px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]"> {{__('messages.event_name')}}</label>
              <input type="text" name="name"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                
            </div>
            <div>
              
              <label
                class="w-[20px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">{{__('messages.beneficiary')}} {{__('messages.name')}}</label>
              <div class="flex justify-between gap-2 items-center text-xs">
                <input type="text" name="beneficiary_name"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                
              </div>
            </div>
            <div>
              
              <label
                class="w-[20px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">{{__('messages.beneficiary')}} {{__('messages.number')}}</label>
              <div class="flex justify-between gap-2 items-center text-xs">
                <input type="text" name="beneficiary_number"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                
              </div>
            </div>
            <!-- <div class="">
              <label
                class="w-[80px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">{{__('messages.event_type_level')}}</label>
              <select name="event_type"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                  education level</option>
                <option value="highschool"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">High School
                </option>
                <option value="graduate"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Graduate</option>
              </select>
            </div> -->
            <div class="flex justify-center">
              <button class="w-[250px] h-[40px] bg-[#28388F] rounded-[10px] mt-[25px]" type="submit">
                <p class="text-center font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF]"> {{__('messages.apply')}}</p>
              </button>
            </div>
          </form>
        </div>
      </div>
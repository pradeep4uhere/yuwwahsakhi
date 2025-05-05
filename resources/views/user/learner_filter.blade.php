<div class="flex justify-between items-center">
    <div onclick="toggleFilterForm()" class="w-[100px] h-[20px] rounded-[10px] flex justify-center items-center font-[500] text-[10px] leading-[12.19px] text-[#28388F] cursor-pointer" >
            Search Filter</div>
      </div>
      <div id="toggleSortPopUp()" class="mt-6 hidden fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white  w-[310px] h-[629px] absolute top-[70px] border-[1px]"
          style="box-shadow: 0px 3px 10px 3px #00000026; padding:13px">
          <div class="flex justify-between items-center mb-4">
            <h1
              class="w-[38px] h-[17px] font-Montserrat font-[600] text-[14px] leading-[17.07px] text-center text-[#000000]">
              Filter</h1>
            <button class="w-[20px] h-[20px] text-[#1F2937] hover:text-gray-700 text-4xl mt-[-16px]"
              onclick="toggleFilterForm()">
              &times;
            </button>
          </div>

          <form class="space-y-[2px]" action="{{route('opportunitiesLearner',['id'=>$opid])}}" method="post">
            @csrf
            <div class="">
              <label
                class="w-[38px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Name</label>
              <input type="text" name="name"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                
            </div>
            <div>
              
              <label
                class="w-[20px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Age</label>
              <div class="flex justify-between gap-2 items-center text-xs">
                <select name="age"
                  class="w-[131px] h-[40px] rounded-[10px] border-[1px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500 ">
                  <option value="" disabled selected
                    class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Start Age
                  </option>
                  <option value="18" class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">
                    18</option>
                  <option value="25" class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                    25</option>
                </select>
                <select name="end_age"
                  class="w-[131px] h-[40px] rounded-[10px] border-[1px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                  <option value="" disabled selected
                    class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">End Age</option>
                  <option value="30" class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                    30</option>
                  <option value="50" class="w-[56px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                    50</option>
                </select>
              </div>
            </div>

            <div class="">
              <label
                class="w-[38px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Gender</label>
              <select name="gender"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                  Gender</option>
                <option value="male"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Male</option>
                <option value="female"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Female</option>
              </select>
            </div>

            <div class="">
              <label
                class="w-[80px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Education
                Level</label>
              <select name="education_level"
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
            </div>

            <div class="">
              <label
                class="w-[91px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Digital
                Proficiency</label>
              <select name="digital_proficiency"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                  digital proficiency</option>
                <option value="basic"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Basic</option>
                <option value="advanced"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Advanced</option>
              </select>
            </div>

            <div class="">
              <label
                class="w-[97px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">English
                Knowledge</label>
              <select name="english_knowledge"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                  English Knowledge</option>
                <option value="beginner"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Beginner</option>
                <option value="fluent"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Fluent</option>
              </select>
            </div>

            <div class="">
              <label
                class="w-[41px] h-[12px] font-[400] text-[10px] leading-[12.19px] text-center text-[#000000]">Mobility</label>
              <select name="mobility_level"
                class="w-[270px] h-[40px] border-[1px] rounded-[10px] bg-[#FFFFFF] border-[#28388F0D] text-[10px] text-[#A7A7A7] focus:ring-1 focus:ring-blue-500">
                <option value="" disabled selected
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">Please select
                  mobility level</option>
                <option value="low" class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">
                  Low</option>
                <option value="high"
                  class="w-[106px] h-[12px] font-[400] text-[10px] leading-[12.19px]  text-[#000000]">High</option>
              </select>
            </div>
            <div class="flex justify-center">
              <button class="w-[250px] h-[40px] bg-[#28388F] rounded-[10px] mt-[25px]" type="submit">
                <p class="text-center font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF]">Apply</p>
              </button>
            </div>
          </form>
        </div>
      </div>
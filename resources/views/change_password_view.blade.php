  <form class="" action="#" id="formchangepassword">
    @csrf
    <div class="space-y-1 text-xs" id="otp-container">
      <div class="space-y-1">
        <label for="password" class="w-[63px] h-[15px] font-[400] text-[12px] leading-[14.63px] text-[#000000]">New Password</label>
        <input id="password" type="password" placeholder="Enter password" name="password"
          class="w-[330px] h-[40px] rounded-[10px] border-[1px] bg-[#FFFFFF] placeholder:text-[10px] placeholder:font-[400] placeholder:font-Montserrat placeholder:leading-[12.19px] placeholder:pl-3">
      </div>

      <div class="space-y-1">
        <label for="cpassword" class="w-[63px] h-[15px] font-[400] text-[12px] leading-[14.63px] text-[#000000]">Confirm Password</label>
        <div class="relative">
          <input id="cpassword" type="password" placeholder="Enter Confirm Password" name="cpassword"
            class="w-[330px] h-[40px] rounded-[10px] border-[1px] bg-[#FFFFFF] placeholder:text-[10px] placeholder:font-[400] placeholder:font-Montserrat placeholder:leading-[12.19px] placeholder:pl-3">
        </div>
      </div>
      <input type="hidden" name="mobile" id="mobile" value="{{encryptString($mobile)}}"/>
      <div class="flex justify-center items-center w-[250px] h-[40px] rounded-[10px] bg-[#28388F] relative left-11 top-10">
      <button type="button" id="sbtn"
        class="w-[41px] h-[17px] font-[600] text-[14px] leading-[17.07px] text-[#FFFFFF]">
        Submit
      </button>
      </div>
    </div>
    </form>

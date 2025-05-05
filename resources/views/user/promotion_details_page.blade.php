@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto p-4 bg-[#FFFFFF] shadow-md" style="min-height:1024px">
    @include('user.header')
    <div class="texttitle mt-16 ml-4 mb-1.5 z-[0] w-[84px] h-[17px]  font-[500] text-[14px] leading-[17.07px] text-[#000000]">Promotions</div>
    <section class="dashboard p-4 mb-12">
      <div class="dash-content">
        <div class="activity">
          <div class="activity-data">
            @if($promotion)
            <div class="grid grid-cols-1 gap-4" style="margin-bottom:10px;">
              <!-- Card 1 -->
              <div class="bg-white overflow-hidden relative w-[344px]" style="box-shadow: 0px 3px 10px 8px #0000001A;">
                
                <div class="relative">
                  <img src="{{ asset('storage/promotion/' . $promotion['banner']) }}"
                      alt="Image1"
                      class="w-full h-full object-cover" />

                  <div class="absolute top-2 right-2 bg-gray-50 p-0.5 rounded-full cursor-pointer">
                    <img src="{{ asset('asset/images/share.png') }}" alt="Share" class="w-[16px] h-[16px]" />
                  </div>
                </div>

                <div class="p-2.5">
                  <p class="text-[10px] leading-[12.19px] text-[#000000]">
                    {!! $promotion['promotional_descriptions'] !!}
                  </p>
                </div>

                <div class="flex justify-end gap-4 p-4">
                  <i class="uil uil-edit text-blue-500 cursor-pointer"></i>
                  <i class="uil uil-trash-alt text-red-500 cursor-pointer"></i>
                </div>
              </div>
            </div>
            @endif
      </div>
      </div>
      </div>
    </section>
  </div>
</div>
  @include('user.bottom_menu')
@endsection

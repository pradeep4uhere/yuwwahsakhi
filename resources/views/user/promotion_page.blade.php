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
            @if($promotionList->count()>0)
            @foreach($promotionList as $item)
            <div class="grid grid-cols-1 gap-4">
              <!-- Card 1 -->
              <div class="bg-[#FFFFFF] overflow-hidden relative w-[344px] h-[200px]"
              style="box-shadow: 0px 3px 10px 8px #0000001A; ">
                <img src="{{ asset('storage/promotion/' . $item['banner']) }}" alt="Image1" class="w-[344px] h-[120px] object-cover" />

                <div class="absolute top-2 right-2 bg-gray-50 p-0.5 rounded-full cursor-pointer">
                  <img src="{{asset('asset/images/share.png')}}" alt="Share" class="w-[16px] h-[16px]" />
                </div>
                <div class="p-2.5">
                  <p class="w-[248px] h-[60px] font-[400] text-[10px] leading-[12.19px] text-[#000000]">
                    {!!$item['promotional_descriptions']!!}
                </div>
                <div class="flex justify-end gap-4 p-4">
                  <i class="uil uil-edit text-blue-500 cursor-pointer"></i>
                  <i class="uil uil-trash-alt text-red-500 cursor-pointer"></i>
                </div>
              </div>
            @endforeach
            @else
            <div class="w-[340px] h-[40px]  bg-red-100 text-red-700 p-3 rounded mt-5 text-[12px]">No Promotions Found</div>  
            @endif
      </div>
      </div>
      </div>
    </section>
  </div>
</div>
  @include('user.bottom_menu')
@endsection

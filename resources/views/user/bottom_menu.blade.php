
<?php if(request()->routeIs('dashboard')== 'dashboard'){ ?>
<div
    class="max-w-[26rem] mx-auto w-full sticky bottom-0 h-[64px] bg-[#28388F] flex items-center justify-around shadow-md">
    <a href="{{route('dashboard')}}" class="w-[40px] h-[40px] rounded-[10px] bg-[#FFFFFF]"> 
        <img src="{{asset('asset/images/homeCopy.png')}}" alt="home" class="w-[20px] h-[20.34px] absolute top-[21px] left-[38.50px] filter
          " /> </a>
    <a href="{{route('upload')}}"> 
        <img src="{{asset('asset/images/file-textBar.png')}}" alt="file" class="w-[20px] h-[20px]" /></a>
    <a href="{{route('opportunities')}}"> 
        <img src="{{asset('asset/images/starCopy.png')}}" alt="star" class="w-[20px] h-[20px]" /></a>
    <a href="{{route('learner')}}"> 
        <img src="{{asset('asset/images/usersBar.png')}}" alt="user" class="w-[20px] h-[20px]" /></a>
    <a href="{{route('promotion')}}"> 
        <img src="{{asset('asset/images/VectorCopy.png')}}" alt="pro" class="w-[20px] h-[20px] activelink " /></a>
</div>
<?php }else{ ?>
    <?php
$currentRoute = request()->route()->getName();
$uploadImg = $currentRoute === 'allevents' ? 'colorFile.png' : 'file-text.png';
$uploadImg = $currentRoute === 'upload' ? 'colorFile.png' : 'file-text.png';
$opportunityImg = $currentRoute === 'opportunities' ? 'Colorstar.png' : 'star.png';
$learnerImg = $currentRoute === 'learner' ? 'Colorusers.png' : 'users.png';
$promotionImg = $currentRoute === 'promotion' ? 'ColorVector.png' : 'Vector.png'; // added example for promotion
?>

<div class="max-w-[26rem] mx-auto sticky bottom-0 left-0 w-full bg-gray-100 h-[64px] flex items-center justify-around shadow-md">
    <a href="{{ route('dashboard') }}">
        <img src="{{ asset('asset/images/homeicon.png') }}" alt="home" class="w-[20px] h-[20.34px]" />
    </a>

    <a href="{{ route('upload') }}">
        <img src="{{ asset('asset/images/' . $uploadImg) }}" alt="file" class="w-[20px] h-[20px]" />
    </a>

    <a href="{{ route('opportunities') }}" class="w-[40px] h-[40px] rounded-[10px] bg-[#28388F0D] relative">
        <img src="{{ asset('asset/images/' . $opportunityImg) }}" alt="star" class="w-[20px] h-[20px] absolute top-[10px] left-[10px] filter" />
    </a>

    <a href="{{ route('learner') }}">
        <img src="{{ asset('asset/images/' . $learnerImg) }}" alt="user" class="w-[20px] h-[20px]" />
    </a>

    <a href="{{ route('promotion') }}">
        <img src="{{ asset('asset/images/' . $promotionImg) }}" alt="pro" class="w-[20px] h-[20px] activelink" />
    </a>
</div>
  <?php } ?>

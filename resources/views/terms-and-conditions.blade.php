@extends('layouts.user')
@section('title', 'Dashboard')
@section('content')
<div id="screen7" class="max-w-[26rem] mx-auto  bg-white shadow-md rounded-lg relative min-h-[120vh] h-auto">
    @include('user.header')
    <div class="">
      <h2
        class="w-[202px] h-[20px] relative top-[134px] left-[100px] font-Montserrat font-[500] text-[16px] leading-[19.5px] text-center text-[#000000]">
        {{$pageTitle}}</h2>
      <p
        class="w-[330px] h-[75px] relative top-[164px] left-[46px] font-Montserrat font-[400] text-[12px] leading-[14.63px] text-[#000000]">
         {!!$page!!}
      </p>
    </div>

</div>
@if(auth()->check())
@include('user.bottom_menu')
@endif
@endsection

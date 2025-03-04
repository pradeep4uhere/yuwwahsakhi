@extends('layouts.default')
@section('title', 'Home Page')
@section('content')
    
    
    <section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > Overview</span> <br />
            </div>
            <div class="search-box">
                <i class="uil uil-search" style="color: rgba(5, 167, 209, 1);"></i>
                <input type="text" placeholder="Please type and search">
            </div>

        </div>
        </div>
        <div id="content-container">
        </div>
        <div class="dash-content">
            <div class="overview">
                <span class="texttitle">Overview</span>

                <div class="boxes">
                    <div class="box box1">
                        <span class="text">Partners</span>
                        <span class="number">{{$dashboard['partner']}}</span>
                        <a href="{{route('admin.partner')}}"> <img src="{{asset('asset/images/Editiconmain.png')}}" alt="" style="height: 100px; width: 120px; cursor: pointer;"" id="edit-icon"></a>

                    </div>
                    <div class="box box2">
                        <span class="text">Partner Centers</span>
                        <span class="number">{{$dashboard['partnerCenter']}}</span>
                        <a href="{{route('admin.partnercenter')}}"> <img src="{{asset('asset/images/Editiconmain.png')}}" alt="" style="height: 100px; width: 120px; cursor: pointer;"></a>


                    </div>
                    <div class="box box3">
                        <span class="text">Yuwaah Sakhi</span>
                        <span class="number">{{$dashboard['YuwaahSakhi']}}</span>
                        <a href="{{route('admin.yuwaahsakhi.list')}}"> <img src="{{asset('asset/images/Editiconmain.png')}}" alt="" style="height: 100px; width: 120px; cursor: pointer;"></a>


                    </div>
                    <div class="box box4">
                        <span class="text">Opportunities</span>
                        <span class="number">{{$dashboard['Opportunities']}}</span>
                        <a href="{{route('admin.opportunities.list')}}"> <img src="{{asset('asset/images/Editiconmain.png')}}" alt="" style="height: 100px; width: 120px; cursor: pointer;"></a>


                    </div>
                    <div class="box box5">
                        <span class="text">Promotions</span>
                        <span class="number">{{$dashboard['Promotions']}}</span>
                        <div class="editclass">

                        <a href="{{route('admin.promotions.list')}}"> <img src="{{asset('asset/images/Editiconmain.png')}}" alt="" style="height: 100px; width: 120px; cursor: pointer;"></a>

</div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @endsection

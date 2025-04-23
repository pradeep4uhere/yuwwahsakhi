@extends('layouts.partner')
@section('title', 'Partner Home Page')
@section('content')
@include('partner.menu')
    <div class="container">
        <div class="title">
            <span id="main_title">Parameters Across Time (Monthly)</span>
            <div class="date-picker">
                <form action="" method="get">
                @csrf
                <label for="start-date" >
                  <span style="font-size: 14px; font-weight: 500; letter-spacing: 0cm;"> Select Date :</span> 
                </label>
                <input id="start-date" name="start_date" type="date" value="{{date('Y-m-d')}}"/>
                <span style="font-size: 14px; font-weight: 500; letter-spacing: 0cm;">
                    to
                </span>
                <input id="end-date" name="end_date" type="date" value="{{date('Y-m-d')}}" />
                <input id="sbt" type="submit" value="Submit" />
                </form>
            </div>
        </div>
        <div class="card">
            <h2 class="name-value-box">
                <span class="name">Partner Center</span>
                <span class="value">{{$totalCount['totalPartnerCenter']}}</span>
            </h2>
            <div class="chart-container">
                <canvas id="partnerCenter"></canvas>
            </div>
            <div class="chart-name">
                #Partner Center (Per Month for {{date('Y')}})
            </div>
        </div>
        <div class="card">
            <h2 class="name-value-box">
                <span class="name">YuWaah Sakhi</span>
                <span class="value">{{$totalCount['totalYuwaahSakhi']}}</span>
            </h2>
            <div class="chart-container">
                <canvas id="yuwaahChart"></canvas>
            </div>
            <div class="chart-name">
                #YuWaah Sakhi (Per Month for {{date('Y')}})
            </div>
        </div>
       
        <div class="card">
            <h2 class="name-value-box">
                <span class="name">Event Completed</span>
                <span class="value">156</span>
            </h2>
            <div class="chart-container">
                <canvas id="coursesCompleted"></canvas>
            </div>
            <div class="chart-name">
                Event (Per Month for {{date('Y')}})
            </div>
        </div>
        <div class="card">
            <h2 class="name-value-box">
                <span class="name">Opportunities Verified</span>
                <span class="value">{{$totalCount['totalOpportunities']}}</span>
            </h2>
            <div class="chart-container">
                <canvas id="opportunitiesVerified"></canvas>
            </div>
            <div class="chart-name">
                Opportunities Verified (Per Month for {{date('Y')}})
            </div>
            <div class="dashboard">
                    <!-- Section 1 -->
                    <div class="section">
                    <div class="section-title">Age Group</div>
                        <canvas id="donutChartId"></canvas>
                    </div>
                
                    <!-- Section 2 -->
                    <div class="section">
                    <div class="section-title">Gender</div>
                    <canvas id="genderdonutChartId"></canvas>
                    </div>
                
                    <!-- Section 3 -->
                    <div class="section">
                    <div class="section-title">Opportunites / Event</div>
                    <canvas id="otherdonutChartId"></canvas>
                    </div>

              </div>
              <div class="dashboard">
                <div class="section">
                    <div class="section-title">Opportunites / Event</div>
                    <canvas id="lineChart"></canvas>
                </div>
                <div class="section">
                    <div class="section-title">Assigned Opportunites</div>
                    <canvas id="barChart"></canvas>
                </div>
                
              </div>
        </div>

    </div>
</div>
@endsection

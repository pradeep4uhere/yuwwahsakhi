@extends('layouts.partner_center')
@section('title', 'Partner Center Home Page')
@section('content')
@include('partner_center.menu')

    <div class="container">
        <div class="title">
            <span id="main_title">Parameters Across Time (Monthly)</span>
            <div class="date-picker">
                <label for="start-date" >
                  <span style="font-size: 14px; font-weight: 500; letter-spacing: 0cm;"> Select Date :</span> 
                </label>
                <input id="start-date" type="date" value="2020-01-01"/>
                <span style="font-size: 14px; font-weight: 500; letter-spacing: 0cm;">
                    to
                </span>
                <input id="end-date" type="date" value="2020-01-01" />
            </div>
        </div>
        <canvas id="barChart"></canvas>

        

        <div class="card">
            <h2 class="name-value-box">
                <span class="name">YuWaah Sakhi</span>
                <span class="value">120</span>
            </h2>
            <div class="chart-container">
                <div class="range">
                    <div>
                        20
                    </div>
                    <div>
                        15
                    </div>
                    <div>
                        10
                    </div>
                    <div>
                        5
                    </div>
                    <div>
                        0
                    </div>
                </div>
                <div class="chart">
                    <div style="height: 55%;">
                        <span>
                            10
                        </span>
                        <p>
                            January
                        </p>
                    </div>
                    <div style="height: 65%;">
                        <span>
                            13
                        </span>
                        <p>
                            February
                        </p>
                    </div>
                    <div style="height: 40%;">
                        <span>
                            7
                        </span>
                        <p>
                            March
                        </p>
                    </div>
                    <div style="height: 107%;">
                        <span>
                            20
                        </span>
                        <p>
                            April
                        </p>
                    </div>
                    <div style="height: 44%;">
                        <span>
                            8
                        </span>
                        <p>
                            May
                        </p>
                    </div>
                    <div style="height: 65%;">
                        <span>
                            12
                        </span>
                        <p>
                            June
                        </p>
                    </div>
                    <div style="height: 39%;">
                        <span>
                            5
                        </span>
                        <p>
                            July
                        </p>
                    </div>
                    <div style="height: 39%;">
                        <span>
                            5
                        </span>
                        <p>
                            August
                        </p>
                    </div>
                    <div style="height: 74%;">
                        <span>
                            14
                        </span>
                        <p>
                            September
                        </p>
                    </div>
                    <div style="height: 41%;">
                        <span>
                            6
                        </span>
                        <p>
                            October
                        </p>
                    </div>
                    <div style="height: 62%;">
                        <span>
                            11
                        </span>
                        <p>
                            November
                        </p>
                    </div>
                    <div style="height: 47%;">
                        <span>
                            9
                        </span>
                        <p>
                            December
                        </p>
                    </div>
                </div>
            </div>
            <div class="chart-name">
                YuWaah Sakhi (Per Month for 2024)
            </div>
        </div>
        
        <div class="card">
            <h2 class="name-value-box">
                <span class="name">Youth Registered</span>
                <span class="value">180</span>
            </h2>
            <div class="chart-container">
                <div class="range">
                    <div>
                        25
                    </div>
                    <div>
                        20
                    </div>
                    <div>
                        15
                    </div>
                    <div>
                        10
                    </div>
                    <div>
                        5
                    </div>
                    <div>
                        0
                    </div>
                </div>
                <div class="chart">
                    <div style="height: 60%;">
                        <span>
                            15
                        </span>
                        <p>
                            January
                        </p>
                    </div>
                    <div style="height: 35%;">
                        <span>
                            8
                        </span>
                        <p>
                            February
                        </p>
                    </div>
                    <div style="height: 90%;">
                        <span>
                            22
                        </span>
                        <p>
                            March
                        </p>
                    </div>
                    <div style="height: 75%;">
                        <span>
                            18
                        </span>
                        <p>
                            April
                        </p>
                    </div>
                    <div style="height: 50%;">
                        <span>
                            12
                        </span>
                        <p>
                            May
                        </p>
                    </div>
                    <div style="height: 70%;">
                        <span>
                            17
                        </span>
                        <p>
                            June
                        </p>
                    </div>
                    <div style="height: 59%;">
                        <span>
                            13
                        </span>
                        <p>
                            July
                        </p>
                    </div>
                    <div style="height: 62%;">
                        <span>
                            15
                        </span>
                        <p>
                            August
                        </p>
                    </div>
                    <div style="height: 20%;">
                        <span>
                            4
                        </span>
                        <p>
                            September
                        </p>
                    </div>
                    <div style="height: 65%;">
                        <span>
                            16
                        </span>
                        <p>
                            October
                        </p>
                    </div>
                    <div style="height: 75%;">
                        <span>
                            18
                        </span>
                        <p>
                            November
                        </p>
                    </div>
                    <div style="height: 90%;">
                        <span>
                            22
                        </span>
                        <p>
                            December
                        </p>
                    </div>
                </div>
            </div>
            <div class="chart-name">
                Youth Registered (Per Month for 2024)
            </div>
        </div>
        <div class="card">
            <h2 class="name-value-box">
                <span class="name">Courses Completed</span>
                <span class="value">156</span>
            </h2>
            <div class="chart-container">
                <div class="range">
                    <div>
                        25
                    </div>
                    <div>
                        20
                    </div>
                    <div>
                        15
                    </div>
                    <div>
                        10
                    </div>
                    <div>
                        5
                    </div>
                    <div>
                        0
                    </div>
                </div>
                <div class="chart">
                    <div style="height: 45%;">
                        <span>
                            10
                        </span>
                        <p>
                            January
                        </p>
                    </div>
                    <div style="height: 34%;">
                        <span>
                            6
                        </span>
                        <p>
                            February
                        </p>
                    </div>
                    <div style="height: 52%;">
                        <span>
                            12
                        </span>
                        <p>
                            March
                        </p>
                    </div>
                    <div style="height: 70%;">
                        <span>
                            18
                        </span>
                        <p>
                            April
                        </p>
                    </div>
                    <div style="height: 67%;">
                        <span>
                            17
                        </span>
                        <p>
                            May
                        </p>
                    </div>
                    <div style="height: 59%;">
                        <span>
                            13
                        </span>
                        <p>
                            June
                        </p>
                    </div>
                    <div style="height: 40%;">
                        <span>
                            9
                        </span>
                        <p>
                            July
                        </p>
                    </div>
                    <div style="height: 52%;">
                        <span>
                            11
                        </span>
                        <p>
                            August
                        </p>
                    </div>
                    <div style="height: 20%;">
                        <span>
                            4
                        </span>
                        <p>
                            September
                        </p>
                    </div>
                    <div style="height: 64%;">
                        <span>
                            16
                        </span>
                        <p>
                            October
                        </p>
                    </div>
                    <div style="height: 78%;">
                        <span>
                            18
                        </span>
                        <p>
                            November
                        </p>
                    </div>
                    <div style="height: 100%;">
                        <span>
                            22
                        </span>
                        <p>
                            December
                        </p>
                    </div>
                </div>
            </div>
            <div class="chart-name">
                Courses Completed (Per Month for 2024)
            </div>
        </div>
        <div class="card">
            <h2 class="name-value-box">
                <span class="name">Opportunities Verified</span>
                <span class="value">190</span>
            </h2>
            <div class="chart-container">
                <div class="range">
                    <div>
                        25
                    </div>
                    <div>
                        20
                    </div>
                    <div>
                        15
                    </div>
                    <div>
                        10
                    </div>
                    <div>
                        5
                    </div>
                    <div>
                        0
                    </div>
                </div>
                <div class="chart">
                    <div style="height: 56%;">
                        <span>
                            14
                        </span>
                        <p>
                            January
                        </p>
                    </div>
                    <div style="height: 65%;">
                        <span>
                            16
                        </span>
                        <p>
                            February
                        </p>
                    </div>
                    <div style="height: 52%;">
                        <span>
                            12
                        </span>
                        <p>
                            March
                        </p>
                    </div>
                    <div style="height: 70%;">
                        <span>
                            18
                        </span>
                        <p>
                            April
                        </p>
                    </div>
                    <div style="height: 67%;">
                        <span>
                            17
                        </span>
                        <p>
                            May
                        </p>
                    </div>
                    <div style="height: 50%;">
                        <span>
                            13
                        </span>
                        <p>
                            June
                        </p>
                    </div>
                    <div style="height: 53%;">
                        <span>
                            14
                        </span>
                        <p>
                            July
                        </p>
                    </div>
                    <div style="height: 64%;">
                        <span>
                            16
                        </span>
                        <p>
                            August
                        </p>
                    </div>
                    <div style="height: 53%;">
                        <span>
                            14
                        </span>
                        <p>
                            September
                        </p>
                    </div>
                    <div style="height: 64%;">
                        <span>
                            16
                        </span>
                        <p>
                            October
                        </p>
                    </div>
                    <div style="height: 74%;">
                        <span>
                            18
                        </span>
                        <p>
                            November
                        </p>
                    </div>
                    <div style="height: 100%;">
                        <span>
                            22
                        </span>
                        <p>
                            December
                        </p>
                    </div>
                </div>
            </div>
            <div class="chart-name">
                Opportunities Verified (Per Month for 2024)
            </div> 
            <div class="dashboard">
                <!-- Section 1 -->
                <div class="section">
                  <div class="section-title">Age Group</div>
                  <div class="donut-chart">
                    <img src="{{asset('asset/images/PieChartAge.png')}}" alt="Image 1">
                  </div>
                </div>
              
                <!-- Section 2 -->
                <div class="section">
                  <div class="section-title">Gender</div>
                  <div class="donut-chart">
                    <img src="{{asset('asset/images/PieChartGender.png')}}" alt="Image 2">
                  </div>
                </div>
              
                <!-- Section 3 -->
                <div class="section">
                  <div class="section-title">Youth Covered</div>
                  <div class="donut-chart">
                 
                    <img src="{{asset('asset/images/map.png')}}" alt="Image 3">
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
@endsection

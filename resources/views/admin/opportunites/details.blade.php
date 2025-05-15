@extends('layouts.default')
@section('title', $title)
@section('content')
<section class="dashboard">
<div class="top">
      <div class="title">
          <span class="">Dashboard &gt; Opportunities</span> <br>
      </div>
      <div class="search-box" style="max-width: 208px;">
        <div class="job-details-container">
            <a href="{{route('admin.opportunities.list')}}" style="text-decoration: none;">
            <h3 style="color: black; font-size: 14px; font-weight: 600;">← Back to all opportunities</h3>
        </a>
        </div>
      </div>
  </div>
<div class="dash-content">
<span class="texttitle">Opportunities</span>
</div>
<div class="page-content">
        
        <div class="activity-data" style="overflow-x: auto;">
            <h3 class="sub-heading">Opportunity Details</h3><table class="custom-table">
              <thead>
                
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 20%;">Opportunity Name</th>
                    <th style="width: 10%;">Salary (Rs)</th>
                    <th style="width: 4%;">Openings</th>
                    <th style="width: 12%;">Sakhi Incentive (Rs)</th>
                    <th style="width: 11%;">Start Date</th>
                    <th style="width: 11%;">End Date</th>
                    <th style="width: 15%;">Company Name</th>
                    <th style="width: 12%;">Specification Document</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>{{$opportunityDetails['id']}}</td>
                    <td>{{$opportunityDetails['opportunities_title']}}</td>
                    <td>{{$opportunityDetails['payout_monthly']}}/Month</td>
                    <td>{{$opportunityDetails['number_of_openings']}}</td>
                    <td>0</td>
                    <td>{{getdateformate($opportunityDetails['start_date'])}}</td>
                    <td>{{getdateformate($opportunityDetails['end_date'])}}</td>
                    <td>{{$opportunityDetails['provider_name']}}</td>
                    <td style="display: flex; color: #28388F; text-decoration: underline; cursor: pointer; gap:5px">
                        <a href="{{asset('storage/documents/'.$opportunityDetails['document'])}}" target="_blank">View Doc 
                        <img src="{{asset('asset/images/view.png')}}" alt="View Doc Image" height="20" width="20"></a>
                    </td>
                  </tr>
              </tbody>
            </table>
        </div>
        
          <!-- <div class="pathway-details">
            <div class="pathway-header">
                <h2 class="sub-heading1">Pathway Details</h2>
                <button class="add-pathway" onclick="openCustomPopup()">Add Pathway</button>
            </div>
        
            <div class="pathway-list">
                <div class="pathway-row pathway-header-row">
                    <div class="pathway-column">Pathway Name</div>
                    <div class="pathway-column">Status</div>
                    <div class="pathway-column">Completion Date</div>
                </div>
                <div class="pathway-row">
                    <div class="pathway-column">Complete Training</div>
                    <div class="pathway-column">Complete</div>
                    <div class="pathway-column">3 Aug 2024</div>
                </div>
                <div class="pathway-row">
                    <div class="pathway-column">Get certified</div>
                    <div class="pathway-column">Complete</div>
                    <div class="pathway-column">27 Sep 2024</div>
                </div>
                <div class="pathway-row">
                    <div class="pathway-column">Ground work of 60 Hours</div>
                    <div class="pathway-column">In Progress</div>
                    <div class="pathway-column">Not yet completed</div>
                </div>
                <div class="pathway-row">
                    <div class="pathway-column">Record your typing speed</div>
                    <div class="pathway-column">Incomplete</div>
                    <div class="pathway-column">Not yet completed</div>
                </div>
            </div>
        </div> -->
        
    </div>
    </section>

@endsection

    
@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > All Dashboard Learners</span> <br />
            </div>
            <div class="search-box">
                <form method="GET" action="{{ url()->current() }}" class="search-box" style="display: flex; align-items: center; gap: 10px;">
                    @csrf
                    <button class="p-2 bg-blue-600 text-black rounded hover:bg-blue-700" >
                    <i class="uil uil-search text-lg"></i>
                    </button>
                    <input type="text" name="search" placeholder="Please type and search">
                </form>
            </div>

        </div>
        </div>
        <div id="content-container">
        </div>
        <!-- <section class="dashboard-partners"> -->
        <?php
        $matched = [];
        $notMatched = [];

        if (isset($allRows) && count($allRows) > 0) {
            foreach ($allRows as $item) {
                if (isLearnerMatched($item['email_address'])) {
                    $matched[] = $item;
                } else {
                    $notMatched[] = $item;
                }
            }

            // Merge matched first, then not matched
            //$response = array_merge($matched, $notMatched);
        }
        ?>
        <div class="dash-content">
            <span class="texttitle">All Dashboard Learners [{{$response->total()}}]</span><br/>
            <span class="texttitle" style="font-size:18px;color:green">Total Matched Dashboard Learners [{{count($matched)}}]</span>
            
            <div class="activity">
                <div class="activitybutton">
                    <a href="{{route('admin.learner.skills.matched.export')}}">
                    <button class="add-partner-btn" id="addPartnerBtns" style="margin-left: 2px; background-color: green;">Export All Matched</button>
                    </a>
                    <a href="{{route('admin.learner.skills.export')}}">
                    <button class="add-partner-btn" id="addPartnerBtn" style="margin-left: 2px; background-color: brown;">Export Dashboard Learner</button>
                    </a>
                </div>
                    <div class="activity-data">
                        <x-alert />
                    </div>
        
                    <div class="table-containers">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Matched</th>
                                <th>Contact</th>
                                <th nowrap="nowrap">Completion Status</th>
                                <th>Load Date</th>
                                <th>Sync Date</th>
                            </tr>
                        </thead>
                       
                        
                        <tbody>
                        <?php if(isset($response) && count($response) > 0){ ?>
                            <?php $count=1;
                                  foreach($response as $item){ //dd($item); ?>
                            <tr>
                                <td>{{$count}}</td>
                                <td><?php if(isLearnerMatched($item['email_address'])){ ?>
                                   <span class="badge badge-success">Matched</span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger">Not Matched</span>
                                <?php } ?>
                                <td nowrap="nowrap">{{$item['email_address']}}</td>
                                <td class="text-center"><?php if($item['completion_status']==1){ ?>
                                   <span class="badge badge-success">Completed</span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger">Not Completed</span>
                                <?php } ?>
                                </td>
                                <td nowrap="nowrap">{{$item['load_date']}}</td>
                                <td nowrap="nowrap">{{$item['created_at']}}</td>
                                
                            </tr>
                            <?php $count++;} ?>
                            <?php } else{ ?>
                                <tr><td colspan="13">
                                    <div class="alert alert-danger text-center">No Dashboard Learner Found</div>
                                </td></tr>
                            <?php } ?>
                           
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            @include('admin.pagination')

        </div>
    </section>

@endsection

    
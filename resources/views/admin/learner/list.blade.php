@extends('layouts.default')
@section('title', 'Partner List')
@section('content')
<section class="dashboard">
        <div class="top">
            <div class="title">
                <span class="">Dashboard > Learner</span> <br />
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
        <div class="dash-content">
            <span class="texttitle">All Learners [{{$response->total()}}]</span>
            <div class="activity">
                <div class="activitybutton">
                    <a href="{{route('admin.learner.export')}}">
                    <button class="add-partner-btn" id="addPartnerBtn" style="margin-left: 2px; background-color: brown;">Export Learner</button>
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
                                <th>Photo</th>
                                <th nowrap="nowrap">First Name</th>
                                <th nowrap="nowrap">Last Name</th>
                                <th>Contact</th>
                                <th nowrap="nowrap">Date Of Birth</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Education Level</th>
                                <th nowrap="nowrap">Monthly Income Range</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Pincode</th>
                                <th nowrap="nowrap"Program Code</th>
                                <th nowrap="nowrap">Institute State</th>
                                <th nowrap="nowrap">Institute District</th>
                                <th>Unit</th>
                                <th nowrap="nowrap">Social Category</th>
                                <th>Religion</th>
                                <th nowrap="nowrap">Marital Status</th>
                                <th nowrap="nowrap">Differently Abled</th>
                                <th nowrap="nowrap">Digital Proficiency Level</th>
                                <th nowrap="nowrap">Engilsh Proficiency Level</th>
                                <th nowrap="nowrap">Identity Document</th>
                                <th nowrap="nowrap">Reason For Learning New Skills</th>
                                <th nowrap="nowrap">Earn At My Own Time</th>
                                <th nowrap="nowrap">Earn At My Own Time Hours Per Day</th>
                                <th nowrap="nowrap">Earn At My Own Time Nature of work</th>
                                <th nowrap="nowrap">Specific Skill</th>
                                <th nowrap="nowrap">Job Preferences Mobility</th>
                                <th nowrap="nowrap">Get a Job Qualification</th>
                                <th nowrap="nowrap">Job Preferences Mobility</th>
                                <th nowrap="nowrap">Get A Job When Can Start</th>
                                <th nowrap="nowrap">Get A Job Experiance</th>
                                <th nowrap="nowrap">Run A Business Status</th>
                                <th nowrap="nowrap">Run A Business Need Help With</th>
                                <th nowrap="nowrap">Pathway Completed</th>
                                <th nowrap="nowrap">Pathway Enrolled</th>
                                <th>Status</th>
                                <th>Created On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        <?php if(isset($response) && count($response) > 0){ ?>
                            <?php $count=1;
                                  foreach($response as $item){ //dd($item); ?>
                            <tr>
                                <td>{{$count}}</td>
                                @php
                                    $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                    $url = $item['profile_photo_url'] ?? '';
                                    $extension = strtolower(pathinfo($url, PATHINFO_EXTENSION));
                                @endphp

                                <td>
                                    @if(!empty($url) && in_array($extension, $validExtensions))
                                        <img src="{{ $url }}" height="35px" width="35px">
                                    @else
                                        <img src="{{ asset('asset/images/user.jpg') }}" height="35px" width="35px">
                                    @endif
                                </td>
                                <td>{{$item['first_name']}}</td>
                                <td>{{$item['last_name']}}</td>
                                <td>{{$item['primary_phone_number']}}</td>
                                <td nowrap="nowrap">{{getdateformate($item['date_of_birth'])}}</td>
                                <td>{{$item['email']}}</td>
                                <td>{{$item['gender']}}</td>
                                <td nowrap="nowrap">{{$item['education_level']}}</td>
                                <td>{{$item['MONTHLY_FAMILY_INCOME_RANGE']}}</td>
                                <td>{{$item['DISTRICT_CITY']}}</td>
                                <td>{{$item['STATE']}}</td>
                                <td>{{$item['PIN_CODE']}}</td>
                                <td>{{$item['PROGRAM_CODE']}}</td>
                                <td>{{$item['PROGRAM_STATE']}}</td>
                                <td>{{$item['PROGRAM_DISTRICT']}}</td>
                                <td>{{$item['UNIT_INSTITUTE']}}</td>
                                <td>{{$item['SOCIAL_CATEGORY']}}</td>
                                <td>{{$item['RELIGION']}}</td>
                                <td>{{$item['USER_MARIAL_STATUS']}}</td>
                                <td>{{$item['DIFFRENTLY_ABLED']}}</td>
                                <td>{{$item['digital_proficiency']}}</td>
                                <td>{{$item['english_knowledge']}}</td>
                                <td>{{$item['IDENTITY_DOCUMENTS']}}</td>
                                <td>{{$item['REASON_FOR_LEARNING_NEW_SKILLS']}}</td>
                                <td>{{$item['preferred_industry1']}}</td>
                                <td>{{$item['preferred_industry2']}}</td>
                                <td>{{$item['preferred_industry3']}}</td>
                                <td>{{$item['preferred_skill2']}}</td>
                                <td>{{$item['RELOCATE_FOR_JOB']}}</td>
                                <td>{{$item['preferred_skill2']}}</td>
                                <td>{{$item['WHEN_CAN_USER_START']}}</td>
                                <td>{{$item['experience_years']}}</td>
                                <td>{{$item['preferred_industry3']}}</td>
                                <td>{{$item['business_status']}}</td>
                                <td>{{$item['USER_NEED_HELP_WITH']}}</td>
                                <td>{{$item['no_of_pathway_completed']}}</td>
                                <td>{{$item['no_of_pathway_enrolled']}}</td>
                                <td><?php if($item['status']=='Active'){ ?>
                                   <span class="badge badge-success">Active</span>
                                <?php }else{ ?>
                                    <span class="badge badge-danger">InActive</span>
                                <?php } ?>
                                </td>
                                <td nowrap="nowrap">{{$item['created_at']}}</td>
                                <td>
                                    <a href="{{route('admin.partner.edit',['id'=>encryptString($item['id'])])}}"><i class="uil uil-edit" style="color: #27272A; font-size: 15px;"></i></a>
                                    <a href="javascript:void(0);" 
                                        data-route="{{ route('admin.partner.delete', ['id' => '__ID__']) }}" 
                                        onclick="deleteConfirm('{{ encryptString($item['id']) }}', this.getAttribute('data-route'))">
                                            <i class="uil uil-trash-alt" style="color: #27272A; font-size: 15px;"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $count++;} ?>
                            <?php } else{ ?>
                                <tr><td colspan="11">
                                    <div class="alert alert-danger text-center">No Partner Found</div>
                                </td></tr>
                            <?php } ?>
                           
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            @if ($response->lastPage() > 1)
                <!-- Pagination code start -->
                <div class="pagination">
                    <table>
                        <tr>
                            {{-- Previous Page Link --}}
                            <td>
                                @if ($response->onFirstPage())
                                    <span class="disabled"><i class="uil uil-angle-left"></i></span>
                                @else
                                    <a href="{{ $response->previousPageUrl() }}"><i class="uil uil-angle-left"></i></a>
                                @endif
                            </td>

                            {{-- Current Page --}}
                            <td class="current-page">
                                <span>{{ $response->currentPage() }}</span>
                            </td>

                            {{-- Next Page Link --}}
                            <td>
                                @if ($response->hasMorePages())
                                    <a href="{{ $response->nextPageUrl() }}"><i class="uil uil-angle-right"></i></a>
                                @else
                                    <span class="disabled"><i class="uil uil-angle-right"></i></span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            @endif

        </div>
    </section>

@endsection

    
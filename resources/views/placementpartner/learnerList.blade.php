@extends('layouts.list')
@section('title', 'Placement Partner Home Page')
@section('content')
@include('placementpartner.menu')
<div class="container">
       <table class="table w-100">
            <tr>
                <td style="width:88%" style="padding-top:35px;" ><h1>Learner [{{count($data)}}]</h1></td>
                <td>
                <table><tr>
                <td nowrap="nowrap">
                <span>Action Required</span>
                </td>
                <td>
                <div style="width:20px; height:20px; border-radius:50%; background-color:#f97316;"></div>
                </td>
                <td>
                <span class="text-[10px] text-blue-500">Submitted</span>
                </td>
                <td>
                <div style="width:20px; height:20px; border-radius:50%; background-color:#3b82f6;"></div>
                </td>
                <td>
                <span class="text-[10px] text-green-700">Accepted</span>
                </td>
                <td>
                <div style="width:20px; height:20px; border-radius:50%; background-color:#22c55e;"></div>
                </td>
                <td>
                <span class="text-[10px] text-red-700">Rejected</span>
                </td>
                <td>
                    <div style="width:20px; height:20px; border-radius:50%; background-color:#ef4444;"></div>
                </td>
                </tr>
                </table>
                </td>
                <td text-align="right" nowrap="nowrap" style="padding-top:25px;">
                    <a href="{{route('export.placementpartner.exportpplearner',['id'=>$ppid])}}"><b><img src="{{asset('asset/images/export.jpg')}}" width="25px" height="25px">&nbsp;Export Learner</b></a>
                </td>
            </tr>
          
        </table>
        <div class="table-responsive">
        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th nowrap="nowrap">Date Of Birth</th>
                <th>State</th>
                <th>District</th>
                <th>Mobile</th>
                <th nowrap="nowrap">Education Level</th>
                <th nowrap="nowrap">Digital Proficiency</th>
                <th nowrap="nowrap">English Knowledge</th>
                <th nowrap="nowrap">Certification</th>
                <th>Jobs</th>
                <th nowrap="nowrap">Social Protections</th>
             
                <th nowrap="nowrap">Diffrently Abled</th>
                
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach ($data as $item)
            <tr>
                <td>{{$count}}</td>
                <td nowrap="nowrap"> {{ $item['item']['first_name'] }}&nbsp;{{ $item['item']['last_name'] }}</td>
                <td nowrap="nowrap">{{ date('d M, Y', strtotime($item['item']['date_of_birth']))}}</td>
                <td nowrap="nowrap">{{ $item['item']['PROGRAM_STATE']}}</td>
                <td nowrap="nowrap">{{ $item['item']['PROGRAM_DISTRICT']}}</td>
                <td nowrap="nowrap">{{ $item['item']['primary_phone_number'] }}</td>
                <td nowrap="nowrap">{{ $item['item']['education_level'] }}</td>
                <td nowrap="nowrap">{{ $item['item']['digital_proficiency'] }}</td>
                <td nowrap="nowrap">{{ $item['item']['english_knowledge'] }}</td>
                @if($item['item']['course_completed']==1)
                <td nowrap="nowrap" style="text-align:center;">
                    <div style="width:20px; height:20px; border-radius:50%; background-color:#22c55e;"></div>
                </td>
                @else
                <td nowrap="nowrap" style="text-align:center;">
                    <div style="width:20px; height:20px; border-radius:50%; background-color:#ffffff; border:1px solid #000000;"></div>
                </td>
                @endif
                <td nowrap="nowrap">
                       
                    <?php if($item['job_event']['is_job_event']){ ?>
                            <?php if($item['job_event']['is_submitted']!='' &&  $item['job_event']['review_status']==''){ ?>
                                <div style="width:20px; height:20px; border-radius:50%; background-color:#3b82f6;"></div>
                            <?php }elseif($item['job_event']['is_submitted']!='' &&  $item['job_event']['review_status']=='Rejected'){ ?>
                                <div style="width:20px; height:20px; border-radius:50%; background-color:#ef4444;"></div>
                            <?php }elseif($item['job_event']['is_submitted']!='' &&  $item['job_event']['review_status']=='Accepted'){ ?>
                                <div style="width:20px; height:20px; border-radius:50%; background-color:#22c55e;"></div>
                            <?php }elseif($item['job_event']['is_submitted']!='' &&  $item['job_event']['review_status']!='Accepted'){ ?>
                                <div style="width:20px; height:20px; border-radius:50%; background-color:#f97316;"></div>
                            <?php }else{ ?>
                                <div style="width:20px; height:20px; border-radius:50%; background-color:#ffffff; border:1px solid #000000;"></div>                       
                                 <?php } ?>
                        <?php }else{?>
                            <div style="width:20px; height:20px; border-radius:50%; background-color:#ffffff; border:1px solid #000000;"></div>                       
                        <?php } ?>

                </td>
                <td nowrap="nowrap">
                        <?php if($item['social_protection']['is_social_event']){ ?>
                        <?php if($item['social_protection']['is_submitted']!='' &&  $item['social_protection']['review_status']==''){ ?>
                            <div style="width:20px; height:20px; border-radius:50%; background-color:#3b82f6;"></div>
                        <?php }elseif($item['social_protection']['is_submitted']!='' &&  $item['social_protection']['review_status']=='Rejected'){ ?>
                            <div style="width:20px; height:20px; border-radius:50%; background-color:#ef4444;"></div>
                        <?php }elseif($item['social_protection']['is_submitted']!='' &&  $item['social_protection']['review_status']=='Accepted'){ ?>
                            <div style="width:20px; height:20px; border-radius:50%; background-color:#22c55e;"></div>
                        <?php }elseif($item['social_protection']['is_submitted']=='' &&  $item['social_protection']['review_status']==''){ ?>
                            <div style="width:20px; height:20px; border-radius:50%; background-color:#3b82f6;"></div>
                        <?php }elseif($item['social_protection']['is_submitted']!='' &&  $item['social_protection']['review_status']!='Accepted'){ ?>
                            <div style="width:20px; height:20px; border-radius:50%; background-color:#f97316;"></div>
                        <?php }else{ ?>
                            <div style="width:20px; height:20px; border-radius:50%; background-color:#ffffff; border:1px solid #000000;"></div>                        <?php } ?>
                <?php }else{?>
                    <div style="width:20px; height:20px; border-radius:50%; background-color:#ffffff; border:1px solid #000000;"></div>
                <?php } ?>
                </td>
                <td nowrap="nowrap">
                    {{ in_array($item['item']['DIFFRENTLY_ABLED'], [0, '0', 'No', null], true) ? 'No' : 'Yes' }}
                </td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
    <div class="d-flex justify-content-center mt-3">
   
    </div>
    </div> 
    </div> 
    </div>
    <!-- Pagination -->
</div>
@endsection

@extends('layouts.list')
@section('title', 'Placement Partner Home Page')
@section('content')
@include('placementpartner.menu')
<div class="container">
       <table class="table w-100">
            <tr>
                <td style="width:88%" style="padding-top:35px;" ><h1>Learner [{{$data->total()}}]</h1></td>
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
                <th nowrap="nowrap">Course Name</th>
                <th nowrap="nowrap">Certification</th>
                <th nowrap="nowrap">Diffrently Abled</th>
                <th nowrap="nowrap">Created Date</th>
                
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach ($data as $item)
            
            <tr>
                <td>{{$count}}</td>
                <td nowrap="nowrap"> {{ $item->first_name }}&nbsp;{{ $item->last_name }}</td>
                <td nowrap="nowrap">{{ date('d M, Y', strtotime($item->date_of_birth))}}</td>
                <td nowrap="nowrap">{{ $item->PROGRAM_STATE}}</td>
                <td nowrap="nowrap">{{ $item->PROGRAM_DISTRICT}}</td>
                <td nowrap="nowrap">{{ $item->primary_phone_number }}</td>
                <td nowrap="nowrap">{{ $item->education_level }}</td>
                <td nowrap="nowrap">{{ $item->digital_proficiency }}</td>
                <td nowrap="nowrap">{{ $item->english_knowledge }}</td>
                <td>{{$item->completed_course_names}}</item>
                @if($item->completedCourses->isNotEmpty())
                <td nowrap="nowrap" style="text-align:center;">
                    <div style="width:20px; height:20px; border-radius:50%; background-color:#22c55e;"></div>
                </td>
                @else
                <td nowrap="nowrap" style="text-align:center;">
                    <div style="width:20px; height:20px; border-radius:50%; background-color:#ffffff; border:1px solid #000000;"></div>
                </td>
                @endif
                <td nowrap="nowrap">
                    {{ in_array($item->DIFFRENTLY_ABLED, [0, '0', 'No', null], true) ? 'No' : 'Yes' }}
                </td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {{ $data->links('pagination::bootstrap-5') }}
     </div> 
    </div> 
    </div>
    <!-- Pagination -->
</div>
@endsection

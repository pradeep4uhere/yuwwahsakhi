@extends('layouts.list')
@section('title', 'Placement Partner Home Page')
@section('content')
@include('placementpartner.menu')
<div class="container">
       <table class="table w-100">
            <tr>
                <td style="width:88%"><h1>Learner [{{$data->total()}}]</h1></td>
                <td text-align="right">
                    <!-- <a href="{{route('export.placementpartner.viewyuwaahsakhi')}}"><b><img src="{{asset('asset/images/export.jpg')}}" width="25px" height="25px">&nbsp;Export Learner</b></a> -->
                </td>
            </tr>
        </table>
        <div class="table-responsive">
        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>Name</th>
                <th>Date Of Birth</th>
                <th>State</th>
                <th>District</th>
                <th>Mobile</th>
                <th>Education Level</th>
                <th>Digital Proficiency</th>
                <th>English Knowledge</th>
                <th>Certificated</th>
                <th>Jobs</th>
                <th>Social Protections</th>
                <th>Diffrently Abled</th>
                
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach ($data as $item)
            <tr>
                <td>{{$count}}</td>
                <td nowrap="nowrap"> {{ $item->first_name }}&nbsp;{{ $item->last_name }}</td>
                <td nowrap="nowrap">{{ $item->date_of_birth }}</td>
                <td nowrap="nowrap">{{$item->PROGRAM_STATE}}</td>
                <td nowrap="nowrap">{{$item->PROGRAM_DISTRICT}}</td>
                <td nowrap="nowrap">{{ $item->primary_phone_number }}</td>
                <td nowrap="nowrap">{{ $item->education_level }}</td>
                <td nowrap="nowrap">{{ $item->digital_proficiency }}</td>
                <td nowrap="nowrap">{{ $item->english_knowledge }}</td>
                @if($item->completion_status=='Completed')
                <td nowrap="nowrap"><span style="color:green;font-weight:bold">{{$item->completion_status}}</span></td>
                @else
                <td nowrap="nowrap"><span style="color:red;font-weight:bold">{{$item->completion_status}}</span></td>
                @endif
                <td nowrap="nowrap">NA</td>
                <td nowrap="nowrap">NA</td>
                <td nowrap="nowrap">
                    {{ in_array($item->DIFFRENTLY_ABLED, [0, '0', 'No', null], true) ? 'No' : 'Yes' }}
                </td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
    <div class="d-flex justify-content-center mt-3">
    {{ $data->links('pagination::bootstrap-5') }}
    </div>
    </div> 
    </div> 
    </div>
    <!-- Pagination -->
</div>
@endsection

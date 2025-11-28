@extends('layouts.list')
@section('title', 'Placement Partner Home Page')
@section('content')
@include('placementpartner.menu')
<div class="container">
       <table class="table w-100">
            <tr>
                <td style="width:88%"><h1>Field Center [{{$data->total()}}]</h1></td>
                <td text-align="right"><a href="{{route('export.placementpartner.viewyuwaahsakhi')}}"><b><img src="{{asset('asset/images/export.jpg')}}" width="25px" height="25px">&nbsp;Export Field Center</b></a></td>
            </tr>
        </table>
        <div class="table-responsive">
        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th nowrap="nowrap">Program Code</th>
                <th>Code</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Partner</th>
                <th>Partner Division</th>
                <th>Learners</th>
                <th>Status</th>
                <th>Created</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach ($data as $item)
            <tr>
                <td>{{$count}}</td>
                <td nowrap="nowrap">{{ $item->csc_id }}</td>
                <td nowrap="nowrap"> {{ $item->sakhi_id }}</td>
                <td nowrap="nowrap">{{ $item->name }}</td>
                <td> nowrap="nowrap"{{ $item->contact_number }}</td>
                <td nowrap="nowrap">{{ $item->email }}</td>
                <td nowrap="nowrap">{{ $item->partner_name }}&nbsp;[{{ $item->partnerID }}]</td>
                <td nowrap="nowrap">{{ $item->partner_center_name }}&nbsp;[{{ $item->partner_division_id }}]</td>
                <td><a href="">0</a></td>
                <td>{{ ($item->status==1)?'Active':'InActive' }}</td>
                <td nowrap="nowrap">{{ getformateDate($item->created_at,'d M, Y H:i:s a') }}</td>
                <td nowrap="nowrap"><a href="">View Learner</a></td>
               
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

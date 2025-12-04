@extends('layouts.list')
@section('title', 'Placement Partner Home Page')
@section('content')
@include('placementpartner.menu')
<div class="container">
       <table class="table w-100">
            <tr>
                <td style="width:88%"><h1>Field Agent [{{$data->total()}}]</h1></td>
                <td text-align="right"><a href="{{route('export.placementpartner.viewyuwaahsakhi')}}"><b><img src="{{asset('asset/images/export.jpg')}}" width="25px" height="25px">&nbsp;Export Field Agent</b></a></td>
            </tr>
        </table>
        <div class="table-responsive">
        <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>SN</th>
                <th>Agent ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>State</th>
                <th>District</th>
                <th>Learners</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach ($data as $item)
            <tr>
                <td>{{$count}}</td>
               
                <td nowrap="nowrap"> {{ $item->sakhi_id }}</td>
                <td nowrap="nowrap">{{ $item->name }}</td>
                <td nowrap="nowrap">{{ $item->contact_number }}</td>
                <td nowrap="nowrap">{{ $item->email }}</td>
                <td nowrap="nowrap">{{ $item->state }}</td>
                <td nowrap="nowrap">{{ $item->district }}]</td>
                <td><a href="">{{$item->learner_count}}</a></td>
                <td nowrap="nowrap">
                @if($item->learner_count > 0)
                    <a href="{{ route('viewlearner', ['id' => encryptString($item->csc_id)]) }}" 
                    style="color: green;">
                        <strong>View Learner</strong>
                    </a>
                @else
                    <a href="#" style="color: gray; pointer-events:none;">
                        <strong>View Learner</strong>
                    </a>
                @endif
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
